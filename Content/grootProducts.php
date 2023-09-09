<html>
<head>
  <title>Shop Groot</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<!-- Header -->
  <header>
    <h1 style="text-align:center; font-size: 40px;">
        Tivan's Collectors Museum
        </h1>
    <h1 style="text-align:center; font-size: 30px;">
        Shop Groot's Merch:
        </h1>
    <nav>
      <ul>
        <li><a href="#PlayTrack!">Listen&Shop</a></li>
        <li><a href="home.html">Home</a></li>
        <li><a href="products.php">Back to Products</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="logginPage.html">Log out</a></li>
      </ul>
    </nav>
  </header>

<?php

// Create connection
$db = new mysqli('localhost','fallasc1_workhere','workhere1','fallasc1_guardiansStore');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$sql = "SELECT * FROM PRODUCTS WHERE CharacterName='Groot'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    echo '<form action="cartProcess.php" method="post">';
    echo '<div style="display: flex; flex-wrap: wrap; justify-content: space-between;">'; // Start the container for product rows
    while($row = $result->fetch_assoc()) { 
        echo '<div style="width: 45%; margin-bottom: 20px;">'; // Start a div for each product with space between them

        echo "<p>" . $row["CharacterName"] . " " . $row['Category'] . "</p>"; // Product name
        echo "<p>Price: $" .$row["Price"]."</p>"; // Product price
        echo "<p>Quantity: " . $row["Quantity"]. "</p>"; // Product quantity

        // Get picture and show it
        $image = $row['CharacterName'] . $row['Category'] . '.jpg';
        echo "<img src ='$image' width='150' height='150'><br>";

        echo '<input type="checkbox" name="product[]" value="' . $row["P_ID"] . '">'; // Checkbox for adding to cart
        echo '<label>Add to Cart</label>';

        echo '</div>'; // End the div for each product
    }
    echo '</div>'; // End the container for product rows

    echo '<input type="submit" value="Add to Cart">';
    echo '</form>';
}
else {
    echo "0 results";
}

$db->close();
?>
<section id="PlayTrack!">
        <p>Track 2: Spirit In The Sky - Norman Greenbaum</p>
        <audio controls src="Spirit In The Sky Norman Greenbaum.mov"></audio>
    </section>

<!-- Footer -->
  <footer>
    <p>Posted by: Erzana, Chris & Justin</p>
    <p>Contact information: tscollectables@nowhere.com</p>
    <p>&copy; T's Collectables. All rights reserved.</p>
  </footer>
</body>
</html>