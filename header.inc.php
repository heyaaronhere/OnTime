<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Main Page - OnTime</title>
        <meta charset="utf-8">
        <meta name="description" content="ONtime - Top Seller & Best Quality Services on watches">
        <meta name="keywords"
              content="Watches, Watch, Strap, Minute, Second, Buying, Selling, Discount, Offer, Fix, Repair, Maintenance, New Arrivals, Gshock, Fossil, Tag Heuer, Fashion, Hand Accessory, Second Hand, Time, Time Keeper, Pocket Watch, Rolex">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/headerFooter.css" />
        <script src="js/mainPage.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/bootstrap.min.js"></script>
        <!--<script defer src="js\showCart.js"></script>-->
        <style>
            @font-face {
                font-family: 'collection';
                src: url(fonts/CollectionFree.otf);
                font-style: normal;
                font-weight: 100;
            }
        </style>
    </head>
    <nav class="navbar navbar-custom navbar-fixed-top navbar-inverse">
        <div id="topnav-centered">
            <a class="navbar-brand" href="index.php"><img src="images\logo3.png" alt="Ontime logo" style="width:150px;height:60px;"></a>
        </div>
        <section class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </section>
        <section class="collapse navbar-collapse container-fluid" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="product.php">Products</a></li>
                <li><a href="customerservice.php">Customer Service</a></li>
                <li><a href="productsreview.php">Reviews</a></li>
                <li><a href="aboutus.php">About us</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['firstName'])) {
                    echo'<li><a href="profile_edit.php"><span class="glyphicon glyphicon-user"></span>  ' . $_SESSION['firstName'] . '</a></li>';
                    echo'<li><a href="shoppingcart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>';
                    echo'<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
                } else {
                    echo'<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                    echo '<li><a href="signup.php"><span class="glyphicon glyphicon-pencil"></span> Signup</a></li>';
                }
                ?>
            </ul>
        </section>
    </nav>
</html>