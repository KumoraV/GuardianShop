<?php
   //Creating a connection
   $con = new mysqli('localhost','fallasc1_workhere','workhere1','fallasc1_guardiansStore');

   $con -> query("CREATE TABLE Test(Name VARCHAR(255), Age INT)");
   $con -> query("insert into Test values('Raju', 25),('Rahman', 30),('Sarmista', 27)");
   print("Table Created.....\n");

   $stmt = $con -> prepare( "SELECT * FROM Test WHERE Name in(?, ?)");
   $stmt -> bind_param("ss", $name1, $name2);
   $name1 = 'Raju';
   $name2 = 'Rahman';

   //Executing the statement
   $stmt->execute();

   //Retrieving the result
   $result = $stmt->get_result();

   //Fetching all the rows as arrays
   while($obj = $result->fetch_assoc()){	
      print("Name: ".$obj["Name"]."\n");
      print("Age: ".$obj["Age"]."\n");
   }

   //Closing the statement
   $stmt->close();

   //Closing the connection
   $con->close();
?>