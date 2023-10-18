<!-- Begin PHP Functions -->
<?php
session_start();
include("../../plugins/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST["item"];
    $itemType = $_POST["itemType"];
    $store = $_POST["store"];
    $db = new Database();
    $db->query("SELECT item.name, price.price, store.name AS store FROM item, price, store, item_type WHERE item.id = price.item_id AND price.store_id = store.id AND item.type_id = item_type.id AND item.name = :item AND item_type.name = :itemType AND store.name = :store");
    $db->bind(':item', $item);
    $db->bind(':itemType', $itemType);
    $db->bind(':store', $store);
    $result = $db->multiple();
}
?>
<!-- End PHP Functions -->

<!DOCTYPE html>
<html>
    <head>
        <!-- Title and Meta tags -->
        <title>Grocery Price Comparer</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- JS -->
        <script src="js/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="js/jquery-3.7.1.min.js"></script>
	<script src="js/fontawesome-6.4.2.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="css/bootstrap-5.3.2.min.css">
	<link rel="stylesheet" href="css/fontawesome-6.4.2.css">
        <link rel="stylesheet" href="css/grocery.css">
    </head>
    <body>
        <!-- Begin Navbar Include -->
        <?php include 'navbar.php' ?>
        <!-- End Navbar Include -->
        <!-- Begin Content Area -->
        <form method="post" action="search.php">
            Item: <input type="text" name="item" required>
            Item type: <select name="itemType">
                <option value="All">All</option>
                <option value="Cereals and bakery products">Cereals and bakery products</option>
                <option value="Meats, poultry, fish and eggs">Meats, poultry, fish and eggs</option>
                <option value="Dairy products">Dairy products</option>
                <option value="Fruits and vegetables">Fruits and vegetables</option>
                <option value="Other foods at home">Other foods at home</option>
            </select>
            Store: <select name="store">
                <option value="All">All</option>
                <option value="Hy-Vee">Hy-Vee</option>
                <option value="Walmart">Walmart</option>
                <option value="Aldi">Aldi</option>
            <input type="submit" value="Search">
        </form>
        <?php
            if (!empty($_POST["item"])) {
                echo "<h1>Results for ",$item , ", " , $itemType , ", " , $store,"</h1>";
            }
            if (!empty($result)){
                echo "<table>";
                echo "<tr>";
                echo "<th>Item</th>";
                echo "<th>Price</th>";
                echo "<th>Store</th>";
                echo "</tr>";
                foreach ($result as $row){
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["store"]) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else if ($_SERVER["REQUEST_METHOD"] == "POST"){
                echo "<h1>0 results</h1>";
            }
        ?>
        <!-- End Content Area -->
    </body>
</html>
