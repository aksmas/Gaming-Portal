<?php
$newlogin = 0;
$name = $_POST['username'];
$pass = $_POST['password'];
if( isset($name) || isset($pass) )
{
    if( empty($name) ) {
	echo "Please enter username\n";
        echo "<br> Log in<br>";
        include 'login_form.html';
        echo "<br> OR Register<br>";
        include 'form.php';        
	die ();
    }
    if( empty($pass) ) {
	echo "Please enter password!\n";
	if(! empty($name)){
	        echo "<br> Log in<br>";
	        include 'login_form.html';
       		echo "<br> OR Register<br>";
        	include 'form.php';
	}
        die ();
    }
    $con = mysqli_connect("localhost", "root", "patmap", "ass1");
    //checking connection
    if (mysqli_connect_errno()){
        die ("Cannot connect to Database : ".mysqli_connect_error());
    }
    $query = "select count(*) as rows from passwords where username='".$name."' and password='".sha1($pass)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result)['rows'];
    if($row != 0){
        session_start();
        $_SESSION['auth'] = 1;
        setcookie("username", $_POST['username'], time()+(84600*30));
	echo "Access granted!<br>";
        echo "Welcome ".$name."!";
	include 'upload.html';
	//echo "<br><br><a href='show_files.php'>Show All Files</a><br>";
	$newlogin = 1;
    }
    else{
	$newlogin = 1;
        echo "Wrong Username or Password!";
        echo "<br> Log in<br>";
        include 'login_form.html';
        echo "<br> OR Register<br>";
        include 'form.php';
	}
    mysqli_close($con);
}
if(isset($_COOKIE['username']) && $newlogin != 1){
	echo "previosly logged in<br>";
	echo "Welcome ".$_COOKIE['username']."!";
	include 'upload.html';
	//echo "<br><br><a href='show_files.php'>Show All Files</a><br>";
}
elseif ($newlogin == 0){
	echo "new user";
	echo "<br> Log in<br>";
	include 'login_form.html';
	echo "<br> OR Register<br>";
	include 'form.php';
}
?>
