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
    $id = $_GET['id'];
    $que = "?";
    $query = "SELECT * from forum_question where id ='".$id."'";
	$result = mysqli_query($con, $query);
	//echo mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
echo "<h3>Topic: ".$row["topic"]."</h3> - Replies: ".$row["reply"]." - Date/Time: ".$row["datetime"]." " ;

$query = "SELECT * from forum_question where question_id ='".$id."'";
	$result = mysqli_query($con, $query);
	//echo mysqli_num_rows($result);
	if (mysqli_num_rows($result) > 0) {
    //echo mysqli_num_rows($result);
    echo "<br><br>";
    while($row = mysqli_fetch_assoc($result)) {
         echo "<h3>By: ".$row["a_name"]."</h3> - Reply: ".$row["a_answer"]." - Date/Time: ".$row["a_datetime"]."  " ;
}}
?>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#F8F7F1"><strong>ID</strong></td>
<td bgcolor="#F8F7F1">:</td>

<tr>
<form name="form1" method="post" action="add_answer.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td valign="top"><strong>Answer</strong></td>
<td valign="top">:</td>
<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<? echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
