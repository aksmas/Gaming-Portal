<?php
$name = $_POST['username'];
$pass = $_POST['pwd'];
$first = $_POST['firstname'];
$sur = $_POST['surname'];
$email = $_POST['email'];
$succ = 0;
if(!(isset($email) && isset($pass))){
	die();
}
    $con = mysqli_connect("localhost", "root", "patmap", "ass1");
    //checking connection
    if (mysqli_connect_errno()){
    	die ("Cannot connect to Database : ".mysqli_connect_error());
    }
    $query = "select count(*) as rows from users where email='".$email."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result)['rows'];
    if($row == 0){
	$query = "select count(*) as rows from users where username='".$name."'";
    	$result = mysqli_query($con, $query);
    	$row = mysqli_fetch_array($result)['rows'];
    	if($row == 0){
	$query = "insert into users values('".$name."','".$first."','".$sur."','".$email."')";
		mysqli_query($con, $query);
	mysqli_query($con, "insert into passwords values('".$name."', '".sha1($pass)."')");
        	echo "Account created! Proceed to <a href='index.php'>login</a>.";
		$succ = 1;
	}
	else{
		echo "Username exits! Select another username!";
		include 'form.php';
	}
    }
    else{
	echo "Cannot create account as email id has already been used!";
	include 'form.php';
    } 
    mysqli_close($con);
	if($succ == 0){
		echo "<br>OR LOGIN<br>";
		include "login_form.html";
	} 
?>
