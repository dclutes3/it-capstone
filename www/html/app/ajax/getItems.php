<?php
/********************* */
/* Drew Clutes aack2f  */
/********************* */

include_once("../../../../plugins/config.php");

$db = new Database();
$log = new Log("GET ITEMS AJAX");

$store = ($_REQUEST['store'] !== "") ? $_REQUEST['store'] : null; //get the initial values from the filter, set to null on default
$item = ($_REQUEST['item'] !== "") ? $_REQUEST['item'] : null;
$low = ($_REQUEST['priceLow'] !== "") ? intval($_REQUEST['priceLow']) : null;
$high = ($_REQUEST['priceHigh'] !== "") ? intval($_REQUEST['priceHigh']) : null;
//$log->warning("store: $store, item: $item, low: $low, high: $high");
try{
    $sql = "SELECT item, price, price_id, type, store, date, store_id, store_address, vote, id FROM view_item WHERE 1"; //query all items from view_item originally
    $conditions = array();
    if ($store !== null) {                                          //if there is a store filter, add that to the conditions array
        $conditions[] = "store_id = :store_id";
    }
    if ($item !== null) {                                           //if there is an item filter, add that to the conditions array
        $conditions[] = "item = :item";
    }
    if ($low !== null) {                                            //if there is a low price filter, add that to the conditions
        $conditions[] = "price >= :low";
    }
    if ($high !== null) {                                           //if there is a high price filter, add that to the conditions
        $conditions[] = "price <= :high";
    }

    if (!empty($conditions)) {                                      //implode the values of the conditions array to make a dynamic-length query based on the number of conditions. 
        $sql .= " AND " . implode(" AND ", $conditions);
    }

    $db->query($sql);
    
    if($store !== null) $db->bind(":store_id",$store);              //bind the values, on if they are not null.
    if($item !== null) $db->bind(":item",$item);
    if($low !== null) $db->bind(":low",$low);
    if($high !== null) $db->bind(":high",$high);

    $results = $db->multiple();                                     //get the results and format it for datatable use. 
    $result_array = array();
    foreach ($results as $result){
        $row = array();
        $row['price_id'] = $result['price_id'];
        $row['store_id'] = $result['store_id'];
        $row['item']    = $result['item'];
        $row['price']   = $result['price'];
        $row['type']    = $result['type'];
        $row['store']   = $result['store'] . " - " . $result['store_address'];
        $row['date']    = $result['date'];
        $row['vote']    = array();
        $row['vote']['id'] = $result['price_id'];
        $row['vote']['store_id'] = $result['store_id'];
        $row['vote']['sum'] = $result['vote'];
        $row['vote']['store'] = $result['store'];
        $result_array[] = $row;
    }
} catch (PDOException $e){
    $log->error("PDO EXCEPTION in /app/ajax/getItems.php");
    $log->error($e->getMessage());
    echo json_encode(array('data'=>""));
}


echo json_encode(array('data'=>$result_array));                     //if there are no errors, return the data to the datatable.
?>