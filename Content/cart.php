<!-- This is the page for the cart -->
<html>
<head>
  <title>T's Collectables - Cart</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
  <!-- Header -->
  <header>
    <h1>Welcome to Thy Cart!</h1>
    <img style="width:100%; height:350px;" src="gotg.jpeg" alt="gotg">
    <nav>
      <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="products.php">Shop Some More!</a></li>
        <li><a href="pastOrder.php">Past Order</a></li>
        <li><a href="index.html">Log out</a></li>
      </ul>
    </nav>
  </header>

<!-- Main Content -->
<?php
$client = "user1";
$total = 0;

// Create connection
$db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');

// Check connection
if ($db->connect_errno) {
    echo 'Error: Could not connect to the database. Please try again later.';
    exit;
}

// Query the database and receive the client's cart
$sql = "SELECT P.P_ID, P.CharacterName, P.Category, P.Price, B.Quantity
        FROM PRODUCTS AS P, BUYS AS B
        WHERE B.PROD_ID = P.P_ID AND B.CLI_ID = '$client'";
$result = $db->query($sql);

// Check if there are any products first
if ($result->num_rows > 0) {
    echo "<main>";
    echo "<h2>Shopping Cart</h2>";

    // Initialize array to store products and quantities for order confirmation
    $orderProducts = [];

    // Show each product in separate rows. Also add a remove button to remove a product.
    while ($row = $result->fetch_assoc()) {
        $total += $row['Quantity'] * $row['Price'];
        echo "<form action='updateCartQty.php' method='post'>";
        echo "<section>";
        echo "<h3>" . $row['CharacterName'] . " " . $row['Category'] . "</h3>";
        echo "<p>Price: $" . $row['Price'] . " Quantity: " . $row['Quantity'];

        // Update Quantity function
        echo "<input type='hidden' name='newQtyProduct' value='" . $row['P_ID'] . "'>";
        echo "  <input type='number' name='newQtyValue' min='1' size='5'>";
        echo "  <button type='submit' name='update'>Update Quantity</button>";

        // Get picture and show it
        $image = $row['CharacterName'] . $row['Category'] . '.jpg';
        echo "<br><p1><img src ='$image' width='150' height='150'></p1><br>";

        // Remove function
        echo "</form>";
        echo "<form action='updateCart.php' method='post'>";
        echo "<input type='hidden' name='remove' value='" . $row['P_ID'] . "'>";
        echo "<button type='submit' name='submit'>Remove</button>";
        echo "</form>";
        echo "</section>";

        // Add product and quantity to order confirmation array
        $orderProducts[$row['P_ID']] = $row['Quantity'];
    }

    echo "Total: $" . number_format($total, 2);

    // Print order confirmation button with hidden product and quantity fields
    echo "<form action='order.php' method='post'>";
    foreach ($orderProducts as $productId => $quantity) {
        echo "<input type='hidden' name='product[]' value='" . $productId . "'>";
        echo "<input type='hidden' name='quantity[]' value='" . $quantity . "'>";
    }
    echo "<button type='submit' name='buyProducts'>Buy</button>";
    echo "</form>";
} else {
    echo "Nothing in Thy Cart. Looks like you need to do some shopping...";
}

// Close the database connection
$db->close();
?>
<form method="post" action="orders.php">
 <!-- form fields and submit button -->
</form>

<!-- Footer -->
  <footer>
    <p>Posted by: Erzana, Chris & Justin</p>
    <p>Contact information: tscollectables@nowhere.com</p>
    <p>&copy; T's Collectables. All rights reserved.</p>
  </footer>
</body>
</html>