<?php
    echo "<h1>ALL PRODUCTS PAGE (=  </h1>";
    // Create connection and check for errors
    $db = new mysqli('localhost','fallasc1_workhere','workhere1','fallasc1_guardiansStore');
    if (mysqli_connect_errno()) 
    {
        $db->close();
        echo 'Error: Could not connect to database. Please try again later.';
        exit;
    }
            
    // Querys the database for all products
    $sql = "SELECT * FROM PRODUCTS";
    $result = $db->query($sql);
    
    // If any products are found, outputs the items and adds an option to add to cart
    if ($result->num_rows > 0)
    {
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
