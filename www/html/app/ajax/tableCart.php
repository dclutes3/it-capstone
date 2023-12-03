<!-- Begin PHP Functions -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("../../../../plugins/config.php");
$log = new Log("tableCart.php");
$db = new Database();
try{
    if($_SESSION['user']){
        $sql = "SELECT prices FROM cart WHERE user_id=:id";
        $db->query($sql);
        $db->bind(":id",$_SESSION['user']);
        $priceRows = json_decode(($db->single()['prices']),true);
        $cartRows = array();
        foreach($priceRows as $price){
                $row = array();
                $db->query("SELECT item, price, price_id, type, store FROM view_item WHERE price_id = :price_id");
                $db->bind(":price_id",$price['id']);
                $item = $db->single();
                $row['price_id']    = $item['price_id'];
                $row['item']        = $item['item'];
                $row['price']       = $item['price'];
                $row['type']        = $item['type'];
                $row['store']       = $item['store'];
                $row['quantity']    = $price['quantity'];
                $row['subtotal']    = $item['price']*$price['quantity'];
                $cartRows[] = $row;
        }        
    } else {
        $cartRows=array();
    }
} catch(PDOException $e){
    $log->warning("PDOException in cart.php ".$e->getMessage());
}

ob_start()
?>
<div class='col-sm-12 cart-wrapper px-0' style="overflow: inherit;">
    <?php
        $i = 0;
        $total = 0.00;
        foreach($cartRows as $row){
    ?>
        <div class="row cart-row <?php echo ($i % 2 == 0) ? "even" : "";?>">
            <div class='cart-col col-sm-12 col-md-1 d-flex align-items-center justify-content-center'>
                <input type="checkbox" name="cart-checkboxes" data-price='<?php echo $row['price_id']; ?>' id="cartCheckbox"></input>
            </div>
            <div class="cart-col col-sm-12 col-md-9 mb-2">
                <p class="h2 cart-title"><?php echo $row['item'];?></p>
                <p class='cart-subtitle'><b>Item Category: </b><?php echo $row['type'];?></p>
                <p class='cart-subtitle'><b>Store: </b><?php echo $row['store'];?></p>
                <p class='cart-subtitle'><b>Quantity: </b>
                    <select data-price='<?php echo $row['price_id']; ?>' id="quantityDropdown" name="quantity">
                        <option value="0">0 (Delete)</option>
                        <?php
                        $selectedValue = $row['quantity']; // Replace with the desired preselected value
                        for ($j = 1; $j <= 50; $j++) {
                            $selected = ($j == $selectedValue) ? 'selected' : '';
                            echo "<option value='$j' $selected>$j</option>";
                        }
                        ?>
                        <option value="100">100</option>
                    </select>
                </p>
            </div>
            <div class="cart-col col-sm-12 col-md-2">
                <p class='h4'>Price:</p>
                <p class='cart-subtitle'>$<?php echo $row['price'];?> x <?php echo $row['quantity']; ?> Units</p>
                <p class='cart-subtitle'><b>Subtotal:</b> $<?php echo number_format($row['subtotal'],2);?></p>
            </div>
        </div>
    <?php $total += $row['subtotal'];
        $i+=1;
        } ?>
</div>
<div class="row">
    <div class=col-10></div>
    <div class=col-2>
        <p class="h4">Expected Total:</p>
        <p>$<?php echo number_format($total,2); ?></p>
    </div>
</div>
<?php 
echo ob_get_clean();
?>