<?php
    include_once("../../../../plugins/config.php");

    $db = new Database();
    $log = new Log("GET ITEMS AJAX");
    
    $store = ($_REQUEST['store'] !== "") ? $_REQUEST['store'] : null;
    $item = ($_REQUEST['item'] !== "") ? $_REQUEST['item'] : null;
    $low = ($_REQUEST['priceLow'] !== "") ? intval($_REQUEST['priceLow']) : null;
    $high = ($_REQUEST['priceHigh'] !== "") ? intval($_REQUEST['priceHigh']) : null;
    $log->warning("store: $store, item: $item, low: $low, high: $high");
    try{
        $sql = "SELECT item, price, type, store, date, vote, id FROM view_item WHERE 1";
        $conditions = array();
        if ($store !== null) {
            $conditions[] = "store = :store";
        }
        if ($item !== null) {
            $conditions[] = "item = :item";
        }
        if ($low !== null) {
            $conditions[] = "price >= :low";
        }
        if ($high !== null) {
            $conditions[] = "price <= :high";
        }

        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }
    
        $db->query($sql);
        $log->warning($sql);
        
        if($store !== null) $db->bind(":store",$store);
        if($item !== null) $db->bind(":item",$item);
        if($low !== null) $db->bind(":low",$low);
        if($high !== null) $db->bind(":high",$high);

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
        //$log->warning(json_encode($result_array));
    } catch (PDOException $e){
        $log->error("PDO EXCEPTION in /app/ajax/getItems.php");
        $log->error($e->getMessage());
        echo json_encode(array('data'=>""));
    }
    

    echo json_encode(array('data'=>$result_array));
?>