<?php
/*
For this we will have a db set up in phpmyadmin with following:
database name = test_db
table = test_table
-- CREATE TABLE test_table (ID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID), fname VARCHAR(20), lname VARCHAR(20)) --
ID | fname | lname

create this and add a couple of entries (here gerry garcia & bob dylan)
INSERT INTO `test_db`.`test_table` (`ID`, `fname`, `lname`) VALUES (NULL, 'gerry', 'garcia'), (NULL, 'bob', 'dylan');

connect to mysql and db without variables
$db = new PDO("mysql:host=localhost;dbname=databaseName", "user", "password");
*/

//with variables for easy changes
$server = 'localhost';
$dbName = 'test_db';
//for PDO put into $dns variable for ease (PDO connects with DSN or Data Source name)
$dsn = "mysql:host=".$server.";dbname=".$dbName;
$user = 'root';
$pass = '';

//now set up connection to db with PDO
$db = new PDO($dsn, $user, $pass);

//that's it connection to mysql and db essablished, you can check with:

if($db){
  echo "<p>connection successful!</p>";
}

//to query database and output data

//set up query string
$query = "SELECT * FROM test_table";
// query database
$result = $db->query($query);

//creat array and loop through it
while($arr = $result->fetch(PDO::FETCH_ASSOC)){
	echo $arr['ID']." | ".$arr['fname']." ".$arr['lname']."<br>";
}

/*
Using prepared statements can make life easier with variables and such
also the paramiters do not have to be quoted like $db->quote(string) as the
underling driver will quote and escape the data to safeguard against SQL injections
*/

if(isset($_POST['submit'])){
/*
here we will be addeing people to the table from a FORM so create either an array
or list of POST varables for the prepared statment
*/

$fistName = $_POST['fname'];
$lastName = $_POST['lname'];
//build query string but this time use variables like so :variableName
$newQuery = $db->prepare("INSERT INTO test_table (`ID`, `fname`, `lname`) VALUES (NULL, :firstName, :lastName)");
//create placeholder and bind to variables in query
$newQuery->bindParam(":firstName",$firstName);
$newQuery->bindParam(":lastName",$lastName);
//execute query
$newQuery->execute();

}

/*=============================
ERROR ERROR ERROR ERROR ERROR
=============================*/
/* there are multiple error modes but i'm not smart enought yet to use them
so stick with the default of PDO::ERRMODE_SILENT this doesn;t interupt script
and you don't have to set it with PDO::setAttribute() like
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

Lets create a query that looks for a table that doesn't exsits.
*/

$badQuery = "SELECT * FROM non_exsistent_table";
$badResult = $db->query($badQuery);

//now return the error
$error = $db->errorInfo();
if(!is_null($error[2])){
	echo $error[2];
}
/*$error[0] & $error[1] are just number calls on the error not human readable
but probably googleable you could always use print_r($error); to see the whole error
*/
/*====================================
FREE UP RESOURCES AND CLOSE CONNECTION
====================================*/
//to free resources from a query called $result
$result->closeCursor();
//to close connection
$db = null;
//you can check closed connection by
if(!$db){
	echo "<p>connection closed</p>";
}

//this was not possible witout the online article "Migrate from the MySQL Extension to PDO"
//by Timothy Boronczyk @ http://www.sitepoint.com/migrate-from-the-mysql-extension-to-pdo/

//to make it easier for me to learn i put things into a gist and create dummy pages in cloud9.io over and over and over :o)

//PDO documentaion  http://php.net/pdo
 ?>
