<!-- This code inserts new products into the database -->
<html>
<head>
  <title>Employee Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<!-- Header -->
  <header>
    <h1 style="text-align:center; font-size: 40px;">
        Tivan's Collectors Museum
        </h1>
    <h1 style="text-align:center; font-size: 30px;">
        Adding to the Collection!
        </h1>
    <nav>
      <ul>
        <li><a href="products.php">Products</a></li>
        <li><a href="employeePage.html">Add More Products!</a></li>
        <li><a href="logginPage.html">Log out</a></li>
      </ul>
    </nav>
  </header>
</head>
<body>
<h1>Enter a new product below</h1>

<?php
// Retrieve values and assign them to variables.
$P_ID = $_POST['P_ID'];

$quantity = $_POST['quantity'];

// Check if all required fields are filled.
if (!$P_ID || !$quantity) {
    echo "You have not entered all the required details.<br />"
        . "Please go back and try again.";
    exit;
}

// Print the entered data.
echo "Product ID: " . $P_ID . "<br>";
echo "Quantity: " . $quantity . "<br>";

// Connect to the database and check for errors.
$db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
if (mysqli_connect_errno()) {
    echo "Error: Could not connect to the database. Please try again later.";
    exit;
}

// Update the quantity of the product in the PRODUCTS table.
$updateQuery = "UPDATE PRODUCTS SET Quantity = Quantity + '$quantity' WHERE P_ID = '$P_ID'";
$result = $db->query($updateQuery);

if ($result) {
    echo $db->affected_rows . " product updated in the database.<br>";
    echo "New Quantity: " . $quantity . "<br>";
} else {
    echo "An error has occurred. The quantity was not updated.";
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