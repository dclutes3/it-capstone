<?php
include_once("../../config.php");

/*These are the category ids needed to send API requests

Cereals: 976759_976783_1231208_4423991_9877415
Bakery Products: {bread: 976759_976779_8399244, artisan bread:976759_976779_3396508, pastries:976759_976779_1001456, rolls: 976759_976779_1037480}
Meats: {Beef: 976759_9569500_1730435, Pork: 976759_9569500_1044143}
Poultry: 976759_9569500_1001443
Fish: 976759_9569500_1001442_9417046
Dairy Products: {milk:976759_9176907_4405816,cheese: 976759_9176907_1001468, yogurt: 976759_9176907_1001470}
Eggs: 976759_9176907_1001469
Fruits: 976759_976793_9756351
Vegetables: 976759_976793_8910423
Spices: 976759_976794_3029941
Condiments: 976759_976794_7981173
Drinks: {soda:976759_976782_1001680 juice:976759_976782_1001321 sports_drinks:976759_976782_1001682 energy_drinks:976759_976782_9357528}
Frozen Foods: 976759_976791_6259087,976759_976791_1272219*/

$categoryIDs = array(
    /*'976759_976783_1231208_4423991_9877415'*/
    '976759_976779_8399244',
    '976759_976779_3396508',
    '976759_976779_1001456',
    '976759_976779_1037480',
    "976759_9569500_1730435",
    '976759_9569500_1044143',
    '976759_9569500_1001443',
    '976759_9569500_1001442_9417046',
    '976759_9176907_4405816',
    '976759_9176907_1001468',
    '976759_9176907_1001470',
    '976759_9176907_1001469',
    '976759_976793_9756351',
    '976759_976793_8910423',
    '976759_976794_3029941',
    '976759_976794_7981173',
    '976759_976782_1001680',
    '976759_976782_1001321',
    '976759_976782_1001682',
    '976759_976782_9357528',
    '976759_976791_6259087',
    '976759_976791_1272219'
);
$itemTypes = array(
    /*"Cereals",*/
    "Bakery Products",
    "Bakery Products",
    "Bakery Products",
    "Bakery Products",
    "Meats", 
    "Meats", 
    "Poultry", 
    "Fish", 
    "Dairy Products", 
    "Dairy Products", 
    "Dairy Products", 
    "Eggs",
    "Fruits", 
    "Vegetables", 
    "Spices", 
    "Condiments", 
    "Drinks",
    "Drinks",
    "Drinks",
    "Drinks", 
    "Frozen Foods",
    "Frozen Foods"
);
$walmart = new Walmart();

for ($x = 0; $x < count($categoryIDs); $x++){
    $response = $walmart->callApi($categoryIDs[$x]);
    $walmart->storeResponse($response, $itemTypes[$x]);
}
?>