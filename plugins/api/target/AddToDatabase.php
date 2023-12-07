<?php
include_once("../../config.php");

/*These are the category ids needed to send API requests

Cereals: 5xt0g
Bakery Products: 5xt19
Meats: {Beef: 4tgi8, Pork: 4tgi2}
Poultry: 4tgi7
Fish: 4tgi0
Dairy Products: 5xszm
Fruits: 4tglt
Vegetables: 4tglh
Spices: 5xszu
Condiments: 5xszw
Drinks: 5xt0r
Frozen Foods: 5xszd*/

$categoryIDs = array("5xt0g", "5xt19", "4tgi8", "4tgi2", "4tgi7", "4tgi0", "5xszm", "4tglt", "4tglh", "5xszu", "5xszw", "5xt0r", "5xszd");
$itemTypes = array("Cereals", "Bakery Products", "Meats", "Meats", "Poultry", "Fish", "Dairy Products", "Fruits", "Vegetables", "Spices", "Condiments", "Drinks", "Frozen Foods");
$zipcode = 65203;
$target = new Target();

for ($x = 0; $x < count($categoryIDs); $x++){
    $response = $target->callApi($categoryIDs[$x], $zipcode);
    $target->storeResponse($response, $itemTypes[$x]);
}
?>