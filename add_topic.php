<?php
if(!isset($_COOKIE)){
    	echo "<h1>You are not logged in.</h1>";
	die();
    }
    $name = $_COOKIE['username'];
    echo"You are logged in as".$_COOKIE['username']."!";
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="patmap"; // Mysql password 
$db_name="forum"; // Database name 
$tbl_name="forum_question"; // Table name 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// get data that sent from form 
$topic=$_POST['topic'];
$detail=$_POST['detail'];
//$name=$_POST['name'];
//$email=$_POST['email'];

$datetime=date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO $tbl_name(topic, detail, name, datetime)VALUES('$topic', '$detail', '$name', '$datetime')";
$result=mysql_query($sql);

if($result){
echo "Successful<BR>";
echo "<a href=main_forum.php>View your topic</a>";
}
else {
echo "ERROR";
}
mysql_close();
?>
