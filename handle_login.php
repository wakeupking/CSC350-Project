<?php

$username = filter_var($_REQUEST['username'],FILTER_SANITIZE_STRING);
$password = filter_var($_REQUEST['password'],FILTER_SANITIZE_STRING);
$msg = "";
if(!empty($username)){
	if(!empty($password)){
		//this should be written as seperate functions which are called here
		$dbc  = @mysqli_connect('localhost','devgroup','granfalloon','csc350project') OR //function to connect 
		die("Unable to connect to MYSQL server:".mysqli_connect_error());

		$query = "SELECT * from users WHERE username='".$username."'";
		$result = mysqli_query($dbc,$query);
	
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		echo $row['username'];
		//if( $r rows_affected < 1){$msg = "Username not found!";};
		if($row['password'] == sha1($password)){
			$msg = 'Successful login of user:'.$username.'';
			header("Location: index.php"); //transfers page to index. need to store username for unique privledges here
		}else{
			$msg = "Incorrect Password!";
		}
	}else{
		$msg = "You must enter a Password!";
	}
}else{
	$msg = "You must enter a Username!";
}
include ('login.php'); //likely not the best way to do this
?>