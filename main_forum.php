<?php
    if(!isset($_COOKIE)){
    	echo "<h1>You are not logged in.</h1>";
	die();
    }
    $name = $_COOKIE['username'];
    echo"You are logged in as ".$_COOKIE['username']."!";
   // echo "a";
    include 'upload.html';
    //echo "b";
    $con = mysqli_connect("localhost", "root", "patmap", "forum");
     if (mysqli_connect_errno()){
        die ("Cannot connect to Database : ".mysqli_connect_error());
    }
    $que = "?";
    $query = "SELECT * from forum_question order by id desc";
	$result = mysqli_query($con, $query);
	//echo mysqli_num_rows($result);
	if (mysqli_num_rows($result) > 0) {
    //echo mysqli_num_rows($result);
    echo "<br><br>";
    while($row = mysqli_fetch_assoc($result)) {
         echo "<h3>Topic: ".$row["topic"]."</h3> - Replies: ".$row["reply"]." - Date/Time: ".$row["datetime"]." - Views: ".$row["view"]." " ;
         echo "<a href=veiw_topic.php".$que."id=".$row['id']."> More </a><br><br>";
    }}
