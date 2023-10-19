<script src="js/navbarStatus.js"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Grocery Price Comparer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stores.php">Stores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="items.php">Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Search</a>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="usermenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white" aria-hidden="true">
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