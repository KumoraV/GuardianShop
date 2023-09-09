<!--Code checks if the input username and password is correct.
    Then redirects to correct page. -->
<html>
    <head>
        <title>Log in</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
        <section style= "text-align: center">

<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    
//SQL Injection prevention
    if (!get_magic_quotes_gpc()) 
    {
        $username = addslashes($username);
        $password = addslashes($password);
    }
    


// Create connection and check for errors
    $db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
    if (mysqli_connect_errno())
    {
        echo 'Error: Could not connect to the database. Please try again later.';
        exit;
    }
    
// Query the database and get the username and password of the input user. Get both employee and client.
    $sql = "SELECT Username, Password FROM EMPLOYEE WHERE Username = '$username'";
    $employeeResult = $db->query($sql);
    $sql = "SELECT Username, Password FROM CLIENT WHERE Username = '$username'";
    $clientResult = $db->query($sql);
    
// Checks if the user is employee and the password is correct. If it is, redirect to employee page.
    if ($employeeResult->num_rows > 0) 
    {
        while ($row = $employeeResult->fetch_assoc()) 
        {
            if ($row["Password"] == $password)
            {
                echo "Password good";
                $redirectUrl = "https://cyan.csam.montclair.edu/~fallasc1/GuardiansStore/employeePage.html";
                echo "<script>window.location.replace('$redirectUrl');</script>";
                exit();
            } 
        }
    }
// Checks if the user is a client and the password is correct. If it is, redirect to home page.
    if ($clientResult->num_rows > 0)
    {
        while ($row = $clientResult->fetch_assoc()) 
        {
            if ($row["Password"] == $password)
            {
                echo "Password good";
                $redirectUrl = "https://cyan.csam.montclair.edu/~fallasc1/GuardiansStore/home.html";
                echo "<script>window.location.replace('$redirectUrl');</script>";
                exit();
            }
            else
            {
                echo "Wrong Password";
            }
        }
    }
    else 
    {
        echo "<br><br><br>";
        echo "Wrong password or username, please try again.";
    }

    $db->close();
?>
<p><a href="logginPage.html">Go back to log in.</a></p>
     </section>
  <footer>
    <p>Posted by: Erzana, Chris & Justin</p>
    <p>Contact information: tscollectables@nowhere.com</p>
    <p>&copy; T's Collectables. All rights reserved.</p>
  </footer>

    </body>
</html>
