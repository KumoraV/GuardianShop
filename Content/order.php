<!-- This code takes the search of the user and prints out the items found -->
<head>
  <title>T's Collectables - My Order</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <!-- Header -->
  <header>
    <h1 style="text-align:center; font-size: 40px;">
        Tivan's Collectors Museum
        </h1>
    <h1 style="text-align:center; font-size: 30px;">
        Collections that are out of this world!
        </h1>
    <nav>
      <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="products.php">Shop Some More!</a></li>
        <li><a href="cart.php">Back to Cart</a></li>
        <li><a href="logginPage.html">Log out</a></li>
        
      </ul>
    </nav>
  </header>

<?php

// Make variables
$client = "user1";
$orderID = 0;
$newQty = 0;

// Connect to database and check for errors
@ $db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
if ($db->connect_errno) {
    echo "Error: Could not connect to the database. Please try again later.";
    exit;
}

// Query and get information about client's cart and product information
$query = "SELECT B.*, P.CharacterName, P.Category, P.Quantity AS ProdQuantity
          FROM BUYS AS B INNER JOIN PRODUCTS AS P ON B.PROD_ID = P.P_ID
          WHERE B.CLI_ID = '$client'";
$result = $db->query($query);

if ($result->num_rows > 0) {

    // Generate a random orderID for each purchase.
    $orderID = rand(1, 99999);
    $idQuery = "SELECT Order_ID FROM BOUGHT WHERE Order_ID = '$orderID'";
    $idResult = $db->query($idQuery);

    // If the orderID exists, keep looking for a new one.
    while ($idResult->num_rows > 0) {
        $orderID = rand(1, 99999);
        $idQuery = "SELECT Order_ID FROM BOUGHT WHERE Order_ID = '$orderID'";
        $idResult = $db->query($idQuery);
    }

    while ($row = $result->fetch_assoc()) {

        // Check if there is any quantity for the purchase
        if ($row['Quantity'] > $row['ProdQuantity']) {
            $db->close();
            echo "Not enough quantity, please lower the amount.";
            exit();
        }

        // Insert the items into the BOUGHT table
        $buyQuery = "INSERT INTO BOUGHT (Order_ID, CLI_ID, PROD_ID, Quantity) VALUES
        ('$orderID', '$client', '".$row['PROD_ID']."', '".$row['Quantity']."')";
        $buyResult = $db->query($buyQuery);

        // If successful, delete the item from BUYS (cart) and subtract the quantity from PRODUCTS
        if ($buyResult) {
            $newQty = $row['ProdQuantity'] - $row['Quantity'];
            $removeQuery = "DELETE FROM BUYS WHERE PROD_ID = '".$row['PROD_ID']."' AND CLI_ID = '$client'";
            $removeResult = $db->query($removeQuery);
            $qtyQuery = "UPDATE PRODUCTS SET Quantity = '$newQty' WHERE P_ID = '".$row['PROD_ID']."'";
            $qtyResult = $db->query($qtyQuery);
        } else {
            echo "Error, could not buy the item. Please try again.";
        }

        // Display the order confirmation for each product
        echo "<h2>Order Confirmation</h2>";
        echo "<p>Product: " . $row['CharacterName']. " " .$row['Category'] . "</p>";
        echo "<p>Quantity: " . $row['Quantity'] . "</p>";
        echo "<p>Thank you for your order!</p>";
    }

}
$db->close();
?>

    <footer>
    <p>Posted by: Erzana, Chris & Justin</p>
    <p>Contact information: tscollectables@nowhere.com</p>
    <p>&copy; T's Collectables. All rights reserved.</p>
  </footer>
</body>
</html>