<?php 
session_start();			//creates a session or resumes the current one based on a session identifier passed via a GET or POST request
header('location:login.php');			//we can control data sent to the client or browser by the Web server before some other output has been sent.
$con= mysqli_connect('localhost','root');			// opens a new connection to the MySQL server.
if($con){
	echo "connection succesful";
}
else
{
	echo "No connection";
}

mysqli_select_db($con,'sessionpractical');          //function is used to change the default database for the connection.

$name=$_POST['user'];
$pass=$_POST['password'];

$q="select * from signin where name='$name' && password='$pass'";

$result = mysqli_query($con, $q);            //performs a query against a database

$num = mysqli_num_rows($result);       //return the number of rows present in the result set
if($num==1){
	echo "Duplicate data";
}
else
{
	$qy=" insert into signin(name,password) values('$name','$pass')";
	mysqli_query($con,$qy);			//performs a query against a database

}
 ?>

