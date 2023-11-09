<?php
    include_once("../../../../plugins/config.php");

    $db = new Database();
    $log = new Log("GET ITEMS AJAX");
    
    $id = $_REQUEST["Id"];
    
    try{
        $db->query("SELECT name,address FROM store WHERE id = :id");
        $db->bind(":id",$id);
        $storedata = $db->single();
        $db->query("SELECT item,price,type,store,date,vote,id FROM view_item_storeid WHERE store = :id");
        $db->bind(":id",$id);
        $results = $db->multiple();
        $result_array = array();
        foreach ($results as $result){
            $row = array();
            $row['item']    = $result['item'];
            $row['price']   = $result['price'];
            $row['type']    = $result['type'];
            $row['store']   = $result['store'];
            $row['date']    = $result['date'];
            $row['vote']    = array();
            $row['vote']['id'] = $result['id'];
            $row['vote']['sum'] = $result['vote'];
            $row['vote']['store'] = $result['store'];
            $result_array[] = $row;
        }
        $log->warning(json_encode($result_array));
    } catch (PDOException $e){
        $log->error("PDO EXCEPTION in /app/ajax/getItemsStore.php");
        echo json_encode(array('data'=>""));
    }
    

    echo json_encode(array('data'=>$result_array,'storename'=>$storedata['name'],'storeaddress'=>$storedata['address']));
?>