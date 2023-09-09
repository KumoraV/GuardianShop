<?php
    $newQty = $_POST['newQtyValue'];
    $product = $_POST['newQtyProduct'];
    @ $db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
    if (mysqli_connect_errno()) 
    {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }
    $query = "UPDATE BUYS SET Quantity = '$newQty' WHERE PROD_ID = '$product'";
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