<?php
# set up the request parameters
class Target {
    private $api_key = '657118266DDB45CFBA00BD6B65C46B3C';
    private $log;
    private $db;

    public function __construct() {
        $this->log = new Log("Target Class");
        $this->db = new Database();
    }

    public function callApi($category_id,$zip_code){
        $queryString = http_build_query([
            'api_key' => $this->api_key,
            'type' => 'category',
            'category_id' => $category_id,
            'customer_zipcode' => $zip_code
        ]);
            
        # make the http GET request to RedCircle API
        $ch = curl_init(sprintf('%s?%s', 'https://api.redcircleapi.com/request', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        # the following options are required if you're using an outdated OpenSSL version
        # more details: https://www.openssl.org/blog/blog/2021/09/13/LetsEncryptRootCertExpire/
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        
        $api_result = curl_exec($ch);
        curl_close($ch);
        
        # print the JSON response from RedCircle API
        return $api_result;
    }
    
    public function formatResponse($response){
        $json = json_decode($response,true)['category_results'];
        $result_array = array();
        foreach($json as $item){
            $row = array();
            $row['name']=$item['product']['title'];
            $row['price']=$item['offers']['primary']['price'];
            $full_array[]=$row;
        }

        return $full_array;
    }

    public function storeResponse($response,$category){
        $json = $this->formatResponse($response);
        try{
            $this->db->startTransaction();
            $sql = "SELECT id FROM item_type WHERE name LIKE :category";
            $this->db->query($sql);
            $this->db->bind(":category",$category);
            $type_id = $this->db->single()['id'];
            
            if($type_id){
                foreach($json as $item){
                    $sql = "SELECT id,item FROM view_item WHERE item=:name";
                    $this->db->query($sql);
                    $this->db->bind(":name",$item['name']);
                    $res = $this->db->single();

                    if(!$res){
                        $sql = "INSERT INTO item (name,type_id) VALUES (:name,:type_id)";
                        $this->db->query($sql);
                        $this->db->bind(":name",$item['name']);
                        $this->db->bind(":type_id",$type_id);
                        $this->db->execute();

                        $this->db->query("SELECT id FROM item WHERE name=:name");
                        $this->db->bind(":name",$item['name']);
                        echo $this->db->single();
                    } else {
                        $sql = "INSERT INTO item (id,name,type_id) VALUES (:id,:name,:type_id) ON DUPLICATE KEY UPDATE name=:name,type_id=:type_id";
                        $this->db->query($sql);
                        $this->db->bind(":id",$res['id']);
                        $this->db->bind(":name",$item['name']);
                        $this->db->bind(":type_id",$type_id);
                        $this->db->execute();
                    }

                    $sql = "SELECT id,name FROM item WHERE name=:name";
                    $this->db->query($sql);
                    $this->db->bind(":name",$item['name']);
                    $item_id = ($this->db->single()!=null) ? $this->db->single()['id'] : null;

                    if($item_id){
                        $sql = "SELECT id FROM price WHERE item_id=:item_id";
                        $this->db->query($sql);
                        $this->db->bind(":item_id",$item_id);
                        $value = ($this->db->single()!=null) ? $this->db->single()['id'] : null;

                        if($value){
                            $sql = "UPDATE price SET price=:price WHERE id=:value";
                            $this->db->query($sql);
                            $this->db->bind(":price",$item['price']);
                            $this->db->bind(":value",$value);
                            $this->db->execute();
                        } else {
                            $sql = "INSERT INTO price (price,store_id,item_id,user_id) VALUES (:price,:store,:item,:user)";
                            $this->db->query($sql);
                            $this->db->bind(":price",$item['price']);
                            $this->db->bind(":store",4);
                            $this->db->bind(":item",$item_id);
                            $this->db->bind(":user",0);
                            $this->db->execute();
                        }
                    } else {
                        $this->log->error("ITEM_ID is NULL");
                        $this->db->stopTransaction();
                        return;
                    }
                }
            } else {
                $this->log->error("INVALID PARAMS");
                $this->db->stopTransaction();
                return;
            }
            $this->db->commitTransaction();
        } catch (PDOException $e){
            $this->db->stopTransaction();
            $this->log->debug("PDO Exception in target.php ".$e->getMessage());
        }
    }
}
?>