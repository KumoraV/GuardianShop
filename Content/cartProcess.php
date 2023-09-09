<?php
    $products = $_POST['product'];
    $client = "user1";
  @ $db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
    if (mysqli_connect_errno()) 
    {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }    
    foreach ($products as $id)
    {
        $query = "INSERT INTO BUYS(CLI_ID, PROD_ID) VALUES
                ('".$client."', '".$id."')";
        $result = $db->query($query);
    }
    if ($result)
    {
        $db->close();
        header("Location: cart.php");
        exit;
    }
    else
    {
        $db->close();
        echo "Error";
        exit;
    }
    $db->close();
?>
<!-- This code adds the selected products into the client's cart
//Connect to database and check for errors
/*  The $product variable is saved as an array, so we want to go through each item.
     For each item, query the database and save it into the cart(buys table). */-->