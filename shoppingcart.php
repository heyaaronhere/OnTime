<?php
if (!isset($_SESSION)) {
    session_start();
}
define("DBHOST", "161.117.122.252");
define("DBNAME", "p2_7");
define("DBUSER", "p2_7");
define("DBPASS", "7tQeryxcIq");
$con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
$userID = $priceTotal = $errorMsg = "";
$userID = $_SESSION['userID']; //only visible when logged in, no need to if statement
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shopping Cart - OnTime</title>
        <meta name="description" content="ONtime - Top Seller & Best Quality Services on watches">
        <meta name="keywords"
              content="Watches, Watch, Strap, Minute, Second, Buying, Selling, Discount, Offer, Fix, Repair, Maintenance, New Arrivals, Gshock, Fossil, Tag Heuer, Fashion, Hand Accessory, Second Hand, Time, Time Keeper, Pocket Watch, Rolex">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/shoppingcart.css">
        <link rel="stylesheet" href="css/headerFooter.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
        <script defer src="js\shoppingcartcheck.js"></script>
    </head>
    <body>
        <section class="container">
<<<<<<< HEAD
<?php
            include "header.php";
?>
=======
            <?php
            include "header.inc.php";
            ?>
>>>>>>> 6a95a5f95b6c166e9657b1481dd54fa4ef057eec
            <header class="page-header">
                <h1>Your shopping cart at ONtime</h1>
            </header>
<?php
            if ($con->connect_error) {
                $errorMsg .= "<p>Connection failed: " . $con->connect_error . "</p>";
                $success = false;
            } else {
                //execute the query
                $result = "SELECT quantity, product_name, product_price, quantity * product_price as 'total' "
                        . "FROM shoppingcart s, product p WHERE s.user_id = '$userID' AND s.product_id = p.product_id";
                $res = "SELECT SUM(P.product_price*S.quantity) AS sum FROM shoppingcart S, product P WHERE S.user_id = '$userID' AND P.product_id = S.product_id";
                $checkResult = mysqli_query($con, $result);
                $checkRes = mysqli_query($con, $res);
                if (!$checkResult || !$checkRes) {
                    $errorMsg .= "<p>Database error1: " . $con->error . "</p>";
                    $success = false;
                } else if (mysqli_num_rows($checkResult) > 0) {
                    //there are products in the shopping cart, get all products incl details
                    global $priceTotal;
                    $record = mysqli_fetch_row($checkRes);
                    $priceTotal = $record[0];

?>
                  <section class="row">
                    <div class="col-md-12">
                      <h2>Your Shopping Cart contains:</h2>
                      <table class="table table-striped table-responsive">
                        <thead>
                          <tr>
                            <th>Quantity</th>
                            <th>Name</th>
                            <th>Price/piece</th>
                            <th>Total</th>
                          </tr>
                        </thead>
<?php
                  while($row = mysqli_fetch_array($checkResult)){
                    //$priceTotal = $priceTotal + $row['product_price'];
?>
                    <tr>
                      <td><?php echo $row['quantity']?></td>
                      <td><?php echo $row['product_name']?></td>
                      <td><?php echo $row['product_price']?></td>
                      <td><?php echo $row['total']?></td>
                    </tr>
<?php
                  }
?>
                      <tfoot>
                        <tr class="tfooter">
                          <td></td>
                          <td></td>
                          <td id="pricetotal">Price total: </td>
                          <td id="amounttotal"><?php echo $priceTotal ?></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </section>

                    <div id="checkoutbutton" class="row">
                        <button type="button" class="btn btn-success btn-lg">
                            <a id="checkbutton" href="checkout.php">Purchase <span
                                    class="glyphicon glyphicon-arrow-right"></span></a>
                        </button>
                    </div>
<?php
                } else {
                    echo "<p>Your shopping cart is empty, add an item to your shopping cart!</p>";
                }
            }
?>
          <button type="button" class="btn btn-success btn-lg">
            <a id="checkbutton" href="product.php"><span
                        class="glyphicon glyphicon-arrow-left"> Go on shopping</span></a>
          </button>
        </section>
<<<<<<< HEAD
<?php
        include "footer.php";
?>
</body>
=======
        <?php
        include "footer.inc.php";
        ?>
>>>>>>> 6a95a5f95b6c166e9657b1481dd54fa4ef057eec
</html>
