<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<script src="../js/navbarStatus.js"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index"><img src="../assets/photos/logo.png" style="height: 25px;" title="PricePal Logo" alt="PricePal Logo" disabled></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index" title="Home Button" aria-label="Home Button">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stores" title="Stores Button" aria-label="Stores Button">Stores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="items" title="Items Button" aria-label="Items Button">Items</a>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav">
                    <li class='nav-item'>
                        <?php if(!empty($_SESSION["user"])) { ?>
                        <div class='d-flex'>
                            <a class="nav-link" href="cart" title="Cart Button" aria-label="Cart Button"><i class="fas fa-cart-shopping fa-lg" style="color:white;"></i></a>
                        </div>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="usermenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white" aria-hidden="true" title="Account Menu Button" aria-label="Account Menu Button">
                                <a id="name">
                                    <?php
                                    if (!empty($_SESSION["name"])) {
                                        echo("Welcome, " . $_SESSION["name"] . "&nbsp;");
                                    }
                                    ?>
                                </a>
                                <i class="fas fa-user fa-lg"></i>
                            </button>
                            <br />
                            <div id="dropdown-options" class="dropdown-menu dropdown-menu-end" aria-labelledby="usermenu"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>