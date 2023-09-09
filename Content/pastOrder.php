<!-- Home page for the store -->
<html>
<head>
  <title>T's Collectables - Past Orders</title>
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
        <li><a href="products.php">Shop Some More!</a></li>
        <li><a href="cart.php">Back to Cart</a></li>
        <li><a href="logginPage.html">Log out</a></li>
      </ul>
    </nav>
  </header>

<?php
    echo "<h1> PAST ORDER PAGE </h1>";
    $groupID = array();
    $orderID;

    
    // Connect to database and check for errors
  @ $db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
    if ($db->connect_errno) 
    {
        echo "Error: Could not connect to the database. Please try again later.";
        exit;
    }
    
    // Query and get each order number
    $idQuery = "SELECT DISTINCT Order_ID FROM BOUGHT";
    $idResult = $db->query($idQuery);
    if ($idResult->num_rows > 0) 
    {
        while ($idRow = $idResult->fetch_assoc())
        {
            $total = 0;
            $orderID = $idRow['Order_ID'];
            
            //Query and get all products of each order ID(loop above)
            $query = "SELECT * FROM BOUGHT WHERE Order_ID = '$orderID'";
            $result = $db->query($query);
            echo "Order Number: ".$orderID;
            echo "<br>";
                
                while ($row = $result->fetch_assoc())
                {
                    $productID = $row['PROD_ID'];
                    
                    // Query and get all attributes of each product in each order
                    $itemQuery = "SELECT * FROM PRODUCTS WHERE P_ID = '$productID'";
                    $itemResult = $db->query($itemQuery);
                    
                    while ($itemRow = $itemResult->fetch_assoc())
                    {
                        // Print out the info
                        echo "<p>". $itemRow['CharacterName'] . " " . $itemRow['Category'] . " Quantity: " .$row['Quantity']. "</p>";
                        $total += $row['Quantity'] * $itemRow['Price'];
                    }
                }
                echo "Total: $" . $total;
                echo "<br><br><br><br>";
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