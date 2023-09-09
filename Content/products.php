<html>
<head>
  <title>T's Collectables - Products</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <!-- Header -->
  <header>
    <h1>Welcome to Thy Collectables!</h1>
    <nav>
      <ul>
        <li><a href="#PlayTrack!">Listen&Shop</a></li>
        <li><a href="home.html">Home</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="logginPage.html">Log out</a></li>
      </ul>
    </nav>
  </header>

<!-- Main Content -->
  <main>
    <h2>Shop By Guardian:</h2>
  <a href="gamoraProducts.php">
    <img src="A.png" alt="Gamora">
  </a>

  <a href="starlordProducts.php">
    <img src="A1.png" alt="Quill"> 
  </a>

  <a href="rocketProducts.php">
    <img src="A2.png" alt="Rocket">
  </a>

  <a href="draxProducts.php">
    <img src="A3.png" alt="Drax">
  </a>

  <a href="grootProducts.php">
    <img src="A4.png" alt="Groot">
  </a>
    
    <h2>Shop by Products:</h2>
  </main>
  
<section id="PlayTrack!">
        <p>Track 2: Spirit In The Sky - Norman Greenbaum</p>
        <audio controls src="Spirit In The Sky Norman Greenbaum.mov"></audio>
    </section>

<?php
// Create connection and check for errors
$db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
if (mysqli_connect_errno()) {
    $db->close();
    echo 'Error: Could not connect to the database. Please try again later.';
    exit;
}

// Query the database for all products
$sql = "SELECT * FROM PRODUCTS";
$result = $db->query($sql);

// If any products are found, output the items with image, price, and quantity
if ($result->num_rows > 0) {
    echo '<form action="cartProcess.php" method="post">';
    $count = 0;
    while ($row = $result->fetch_assoc()) {
        // Start a new row after every three products
        if ($count % 3 == 0) {
            echo '<div style="display: flex; justify-content: space-between; margin-bottom: 20px;">';
        }

        echo '<div style="text-align: center;">';
        echo '<img src="' . $row['CharacterName'] . $row['Category'] . '.jpg" width="150" height="150"><br>';
        echo $row['CharacterName'] . " " . $row['Category'] . '<br>';
        echo 'Price: $' . $row['Price'] . '<br>';
        echo 'Quantity: ' . $row['Quantity'] . '<br>';
        echo '<input type="checkbox" name="product[]" value="' . $row['P_ID'] . '"> Add to Cart<br>';
        echo '</div>';

        $count++;

        // Close the row after every three products
        if ($count % 3 == 0) {
            echo '</div>';
        }
    }

    // Close the row if it's not closed yet (for cases where the number of products is not a multiple of three)
    if ($count % 3 != 0) {
        echo '</div>';
    }

    echo '<input type="submit" value="Add to Cart">';
    echo '</form>';
} else {
    echo "0 results";
}
$db->close();
?>


<!-- Footer -->
  <footer>
    <p>Posted by: Erzana, Chris & Justin</p>
    <p>Contact information: tscollectables@nowhere.com</p>
    <p>&copy; T's Collectables. All rights reserved.</p>
  </footer>
</body>
</html>