<?php
    if(!isset($_COOKIE)){
    	echo "<h1>You are not logged in.</h1>";
	die();
    }
    $name = $_COOKIE['username'];
    echo"You are logged in as ".$_COOKIE['username']."!";
    include 'upload.html';
    include 'run.html';
    $score = $_POST["score"];
    $think = $_POST["think"];
    $rate = $_POST["rate"];
    $con = mysqli_connect("localhost", "root", "patmap", "ass1");
     if (mysqli_connect_errno()){
        die ("Cannot connect to Database : ".mysqli_connect_error());
    }
	include 'score.html';
	include 'like.html';
	if ($think == "like")
	{
	$query = "update scores set think=1 where username='".$name."'";
    	mysqli_query($con, $query);
	}
	if ($think == "unlike")
	{
	$query = "update scores set think=0 where username='".$name."'";
    	mysqli_query($con, $query);
	}
	$query = "select sum(think) as sum from scores";
    	$result = mysqli_query($con, $query);
    	$hscore = mysqli_fetch_array($result);
    	echo "Likes: ".$hscore['sum']."<br>";
    	include 'comment.html';
	if ($rate){
	$query = "update scores set rate='".$rate."' where username='".$name."'";
	mysqli_query($con, $query);
	}
	
	$query = "select avg(rate) as avg from scores";
	$result = mysqli_query($con, $query);
	$avr = mysqli_fetch_array($result);
    	echo "Average Rating: ".$avr['avg']."<br>";
	
    	echo"<br><h3>LEADERBOARD</h3>";
	
	$query = "select * from scores where username='".$name."'";
    	$result = mysqli_query($con, $query);
    	$hscore = mysqli_fetch_array($result);
    
    if ($score > $hscore['highscore'])
    {
    	$query = "update scores set highscore='".$score."' where username='".$name."'";
    	mysqli_query($con, $query);
    }
    
    	$query = "SELECT * from scores order by highscore desc limit 10";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         echo "Name: ".$row["username"]." - Highscore: ".$row["highscore"]."<br>";
    }
} else {
    echo "0 results";
}
	
    mysqli_close($con);
?>
