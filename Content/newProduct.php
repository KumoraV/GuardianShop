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
$character = $_POST['character'];
$category = $_POST['category'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

// Check if all required fields are filled.
if (!$P_ID || !$price || !$quantity) {
    echo "You have not entered all the required details.<br />"
        . "Please go back and try again.";
    exit;
}

// Print the entered data.
echo "Product ID: " . $P_ID . "<br>";
echo "Category: " . $category . "<br>";
echo "Character: " . $character . "<br>";
echo "Price: $" . $price . "<br>";
echo "Quantity: " . $quantity . "<br>";

// Connect to the database and check for errors.
$db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
if (mysqli_connect_errno()) {
    echo "Error: Could not connect to the database. Please try again later.";
    exit;
}

// Query the databse and insert the new products
  $query = "INSERT INTO PRODUCTS VALUES
            ('".$P_ID."', '".$price."', '".$category."', '".$character."',
            '".$quantity."')";
  $result = $db->query($query);

  if ($result) {
      echo  $db->affected_rows." product inserted into database.";
  } else {
  	  echo "An error has occurred.  The item was not added.";
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