<?php
# set up the request parameters
class Kroger {
    private $clientSecret;
    private $clientId;
    private $log;
    private $db;

    public function __construct() {
        $pass = new Passwords();
        $this->clientSecret = $pass->getKrogerClientSecret();
        $this->clientId = $pass->getKrogerClientId();
        $this->log = new Log("Target Class");
        $this->db = new Database();
    }

    public function getToken(){
        // Your client ID and client secret
        
        // API endpoint
        $apiEndpoint = 'https://api.kroger.com/v1/connect/oauth2/token';

        // Authorization header value (base64 encoded)
        $authorizationHeaderValue = base64_encode($this->clientId . ':' . $this->clientSecret);

        // Request parameters
        $data = array(
            'grant_type' => 'client_credentials'
        );

        // cURL setup
        $ch = curl_init($apiEndpoint);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Basic ' . $authorizationHeaderValue
        ));

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Output the API response
        return $response;
    }

    public function callApi($token,$category){
        //$apiEndpoint = "https://api.kroger.com/v1/locations/61500124";
        $productId = "0001111085428";
        $locationId = "61500124";
        $apiEndpoint = "https://api.kroger.com/v1/products/{$productId}";
        // cURL setup
        $ch = curl_init($apiEndpoint);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Authorization: Bearer ' . json_decode($token,true)['access_token']
        ));
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Output the API response
        $decodedResponse = json_decode($response, true);

        if ($decodedResponse === null) {
            // Output the raw response if JSON decoding fails
            echo "unencoded";
            return $response;
        } else {
            // Output the decoded JSON
            return print_r($decodedResponse);
        }
    }
    
    private function formatResponse($response){
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