<?php
    $product = $_POST['remove'];
    @ $db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
    if (mysqli_connect_errno()) 
    {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }
    $query = "DELETE FROM BUYS WHERE PROD_ID = '$product'";
    $result = $db->query($query);
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
<!-- This is the code to delete items from the cart 
// Connect to database and error check
// Query the database and delete the selected product from cart 
// Gets the value of the product that wants to get removed -->