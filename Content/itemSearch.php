<!-- This code takes the search of the user and prints out the items found -->
<head>
  <title>T's Collectables - Search</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <!-- Header -->
  <header>
    <h1 style="text-align:center; font-size: 40px;">
        Tivan's Collectors Museum
        </h1>
    <h1 style="text-align:center; font-size: 40px;">
        Collections that are out of this world!
        </h1>
    <nav>
      <ul>
        <li><a href="home.html">Search Again!</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="logginPage.html">Log out</a></li>
      </ul>
    </nav>
    <img style="width:100%; height:500px;" src="gotg2.png" alt="gotg2">
  </header>

<?php
    $search = $_POST['search'];
    $type = $_POST['type'];
?>
<html>
    <body>
        <h1>Item search results:</h1>
        
 <?php
// Create connection
        $db = new mysqli('localhost','fallasc1_workhere','workhere1','fallasc1_guardiansStore');
// Check connection
            if (mysqli_connect_errno()) 
            {
                echo 'Error: Could not connect to database. Please try again later.';
                exit;
            }
            
// Querys the database for the item you searched
        echo $type;
        $sql = "SELECT * FROM PRODUCTS WHERE ".$type." like '%".$search."%'";
        $result = $db->query($sql);
        
        if ($result->num_rows > 0)
        {
            
// Outputs the items found and an option to add to cart
            echo '<form action = "cartProcess.php" method = "post">';
            while($row = $result->fetch_assoc()) 
            { 
                echo "" . $row["CharacterName"]. " " 
                . $row["Category"]. " $" .$row["Price"]." " . $row["Quantity"]. 
                ' <input type="checkbox" name="product[]" value="' . $row["P_ID"] . '"> <br>'; 
                // Get picture and show it
                $image = $row['CharacterName'] . $row['Category'] . '.jpg';
                echo "<p1><img src ='$image' width='150' height='150'></p1><br>";
            
            }

            echo '<input type="submit" value="Add to Cart">';
            echo '</form>';
          }
        else 
        {
          echo "0 results";
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