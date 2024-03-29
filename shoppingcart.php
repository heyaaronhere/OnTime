<?php
if (!isset($_SESSION)) {
  session_start();
}
include "include/connection.inc.php";
$userID = $priceTotal = $errorMsg = "";

if (!isset($_SESSION['userID'])) {
  header("Location: login_first");
  exit();
} else {
  $userID = $_SESSION['userID']; //only visible when logged in
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shopping Cart - OnTime</title>
  <meta name="description" content="ONtime - Top Seller & Best Quality Services on watches">
  <meta name="keywords" content="Watches, Watch, Strap, Minute, Second, Buying, Selling, Discount, Offer, Fix, Repair, Maintenance, New Arrivals, Gshock, Fossil, Tag Heuer, Fashion, Hand Accessory, Second Hand, Time, Time Keeper, Pocket Watch, Rolex">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/shoppingcart.css">
  <link rel="stylesheet" href="css/headerFooter.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script defer src="js/shoppingcartcheck.js"></script>
</head>

<body>
  <?php
  include "include/header.inc.php";
  ?>
  <main class="container">
    <header class="page-header">
      <h1>Your shopping cart at ONtime</h1>
    </header>
    <?php
    //execute the query
    $result = $conn->prepare("SELECT s.product_id, quantity, product_name, product_price, quantity * product_price as 'total' FROM shoppingcart s, product p WHERE s.user_id = ? AND s.product_id = p.product_id");
    $result->bind_param("i", $userID);
    $checkResult = $result->execute();
    $getResult = $result->get_result();
    $result->close();
    if (!$checkResult) {
      $errorMsg .= "<p>Database error 1: " . $conn->error . "</p>";
      $success = false;
    } else if ($getResult->num_rows > 0) {
      //there are products in the shopping cart, get all products incl details
      global $priceTotal;
      $res = $conn->prepare("SELECT SUM(P.product_price*S.quantity) AS sum FROM shoppingcart S, product P WHERE S.user_id = ? AND P.product_id = S.product_id");
      $res->bind_param("i", $userID);
      $checkRes = $res->execute();
      $getRes = $res->get_result();
      if (!$checkRes) {
        $errorMsg .= "<p>Database error 2: " . $conn->error . "</p>";
        $success = false;
      }
      $record = mysqli_fetch_row($getRes);
      $priceTotal = $record[0];
      $res->close();

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
                <th>
                  <form method="POST" action="clearShoppingCart">
                    <input type="submit" value="Clear Shoppingcart">
                  </form>
                </th>
              </tr>
            </thead>
            <?php

              while ($row = mysqli_fetch_array($getResult)) {
                ?>
              <tr>
                <td><?php echo $row['quantity'] ?></td>
                <td><?php echo $row['product_name'] ?></td>
                <td><?php echo "SGD " . $row['product_price'] ?></td>
                <td><?php echo "SGD " . $row['total'] ?></td>
                <td>
                  <form method="POST" action="removeItem">
                    <input type="hidden" name="product" value="<?php echo $row['product_id'] ?>">
                    <input type="submit" value="Remove Item">
                  </form>
                </td>
              </tr>
            <?php
              }
              ?>
            <tfoot>
              <tr class="tfooter">
                <td></td>
                <td></td>
                <td id="pricetotal">Price total: </td>
                <td id="amounttotal"><?php echo "SGD " . $priceTotal ?></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </section>


    <?php
    } else {
      echo "<p>Your shopping cart is empty, add an item to your shopping cart!</p>";
    }

    ?>

    <a href="product" class="btn btn-success btn-lg">Go on shopping</a>

    <?php
    if ($getResult->num_rows > 0) {
      ?>
      <section class="well well-sm row">
        <form id="orderform" method="post" action="checkout">
          <h2>Delivery Address</h2>

          <div class="form-group row">
            <div class="col-sm-3">
              <label for="fname">First Name</label>
              <input class="form-control" id="fname" name="fname" type="text" required>
            </div>
            <div class="col-sm-3">
              <label for="lname">Last Name</label>
              <input class="form-control" id="lname" name="lname" type="text" required>
            </div>
            <div class="col-sm-4">
              <label for="email">Email Address</label>
              <input class="form-control" id="email" name="email" type="email" required>
            </div>
            <div class="col-sm-2">
              <label for="phone">Phone number</label>
              <input class="form-control" id="phone" name="phone" type="text" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-4">
              <label for="street">Street and House number</label>
              <input class="form-control" id="street" name="street" type="text" required>
            </div>
            <div class="col-sm-2">
              <label for="appartment">Appartment</label>
              <input class="form-control" id="appartment" name="appartment" type="text" placeholder="21-07" required>
            </div>
            <div class="col-sm-1">
              <label for="countrycode">Country</label>
              <input class="form-control" id="countrycode" name="countrycode" type="text" required>
            </div>
            <div class="col-sm-2">
              <label for="postalcode">Postal Code</label>
              <input class="form-control" id="postalcode" name="postalcode" type="text" required>
            </div>
            <div class="col-sm-3">
              <label for="city">City</label>
              <input class="form-control" id="city" name="city" type="text" required>
            </div>
          </div>

          <h2>Select Payment Type</h2>
          <label for="cash">
            <input id="cash" type="radio" name="paymenttype" value="cash" required> Cash</label><br>
          <label for="card">
            <input id="card" type="radio" name="paymenttype" value="card" required> Credit/Debit Card</label>

          <div id="cardpayment" class="form-group row">
            <div class="col-sm-4">
              <label for="cardname">Name on Card</label>
              <input class="form-control" id="cardname" name="cardname" type="text">
            </div>
            <div class="col-sm-4">
              <label for="cardnumber">Card Number</label>
              <input class="form-control" id="cardnumber" name="cardnumber" type="text">
            </div>
            <div class="col-sm-2">
              <label for="expdate">Expiry Data</label>
              <input class="form-control" id="expdate" name="expdate" type="text" placeholder="02-22">
            </div>
            <div class="col-sm-2">
              <label for="cvv">cvv</label>
              <input class="form-control" id="cvv" name="cvv" type="text">
            </div>
          </div>

          <div id="checkoutbutton" class="row">
            <input type="submit" id="checkbutton" class="btn btn-success btn-lg" value="Purchase">
          </div>

        </form>
      </section>

    <?php
    }
    mysqli_close($conn);
    ?>
  </main>
  <?php
  include "include/footer.inc.php";
  ?>
</body>

</html>