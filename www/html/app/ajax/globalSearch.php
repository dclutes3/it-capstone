<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include_once("../../../../plugins/config.php");
//assume these are not null, given javascript logic
$item = $_REQUEST["item"];
$itemType = $_REQUEST["type"];
$store = $_REQUEST["store"];

$log = new Log("globalSearch");
try{
    $db = new Database();
    $db->query(
        "SELECT item.name, price.price, store.name AS store
        FROM item, price, store, item_type
        WHERE item.id = price.item_id
            AND price.store_id = store.id
            AND item.type_id = item_type.id
            AND item.name LIKE :item
            AND item_type.name = :itemType
            AND store.name = :store"
    );
    $db->bind(':item', '%'.$item.'%');
    $db->bind(':itemType', $itemType);
    $db->bind(':store', $store);
    $result = $db->multiple();
    $log->warning("RES: ",$result);
    if($db->rowCount()==0){
        $html = "<p class='h3'>0 Results</p>";
    } else {
        $html = "<p class='h3'>Results for: '".$item. "', " . $itemType . ", " . $store . "</p>";
        $html .= "<table>";
            $html .= "<th>Item</th>";
            $html .= "<th>Price</th>";
            $html .= "<th>Store</th>";
        foreach ($result as $row){
            $html .= "<tr>";
                $html .= "<td>" . $row["name"] . "</td>";
                $html .= "<td>" . $row["price"] . "</td>";
                $html .= "<td>" . $row["store"] . "</td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
    }
    $log->warning("html: ".$html);
    echo json_encode(array('code'=>1,'msg'=>$html));
} catch (PDOException $e){
    $log->error("PDO EXCEPTION IN GLOBAL SEARCH");
    echo json_encode(array('code'=>-1,'msg'=>"pdo exception"));
}
?>