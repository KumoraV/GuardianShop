<!-- Log in page -->
<html>
    <head>
        <title>Log in</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<!-- Header -->
  <header>
    <h1 style="text-align:center; font-size: 40px;">
        Tivan's Collectors Museum
        </h1>
    <h1 style="text-align:center; font-size: 20px;">
        Welcome Travelers, A lot to see once
        you have jumped in the spaceship!
        Join us in the gallery of our Galaxy Heros, 
        and take some products home with you!
        </h1>
  </header>
    <section style= "text-align: center">
<?php
    $Fname = $_POST['firstName'];
    $Lname = $_POST['lastName'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// SQL Injection prevention
	if (!get_magic_quotes_gpc())
	{
	    $Fname = addslashes($Fname);
	    $Lname = addslashes($Lname);
		$username = addslashes($username);
		$password = addslashes($password);
	}
	
    // Check if everything was filled out
    if (!$Fname || !$Lname || !$username || !$password) 
    {
    echo "You have not entered all the required details.<br />"
        . "Please go back and try again.";
    echo '<p><a href="logginPage.html">Go back to log in.</a></p>';
    exit;
    }

	// Create connection and check for errors
	$db = new mysqli('localhost', 'fallasc1_workhere', 'workhere1', 'fallasc1_guardiansStore');
	if (mysqli_connect_errno())
	{
		echo 'Error: Could not connect to the database. Please try again later.';
		exit;
	}
	

    // Get random ID
    $userID = rand(1, 99999);
    $idQuery = "SELECT E_ID FROM EMPLOYEE WHERE E_ID = '$userID'";
    $idResult = $db->query($idQuery);

    // If the ID exists, keep looking for a new one.
    while ($idResult->num_rows > 0) {
        $userID = rand(1, 99999);
        $idQuery = "SELECT E_ID FROM EMPLOYEE WHERE E_ID = '$userID'";
        $idResult = $db->query($idQuery);
    }
    
    // Insert new user account into database
    $query = "INSERT INTO EMPLOYEE (E_ID, Fname, Lname, Username, Password) VALUES ('$userID', '$Fname', '$Lname', '$username', '$password')";
	$result = $db->query($query);
    
    if ($result) 
    {
        echo "New account made";
    } 
    else 
    {
        echo "Error, could not make account. Please try again.";
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