<!-- Begin PHP Functions -->
<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Title and Meta tags -->
        <title>Grocery Price Comparer</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- JS -->
        <script src="js/plugins/bootstrap-5.3.2.bundle.min.js"></script>
        <script src="js/plugins/jquery-3.7.1.min.js"></script>
	    <script src="js/plugins/fontawesome-6.4.2.js"></script>
        <script src="js/search.js"></script>

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
        <form id="globalSearch" method="post" action="search.php">
            Item: <input id="itemName" type="text" name="item" required>
            Item type: <select id="itemType" name="itemType">
                <option value="All">All</option>
                <option value="Cereals and bakery products">Cereals and bakery products</option>
                <option value="Meats, poultry, fish and eggs">Meats, poultry, fish and eggs</option>
                <option value="Dairy products">Dairy products</option>
                <option value="Fruits and vegetables">Fruits and vegetables</option>
                <option value="Other foods at home">Other foods at home</option>
            </select>
            Store: <select id="storeName" name="store">
                <option value="All">All</option>
                <option value="Hy-Vee">Hy-Vee</option>
                <option value="Walmart">Walmart</option>
                <option value="Aldi">Aldi</option>
            <input id="globalSearchBtn" type="button" value="Search">
        </form>
        <p id="searchError"></p>
        <div id="searchBody">
            <?php //AJAX BODY WILL BE POPULATED HERE ?>
        </div>
        <!-- End Content Area -->
    </body>
</html>
