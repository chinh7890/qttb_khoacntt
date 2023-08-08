<?php
	$localhost = "localhost";
	$username = "root";
	$password = "new_password";
	$database = "quanlythietbi";
	$conn = mysqli_connect($localhost,$username,$password,$database);
	mysqli_query($conn,"SET NAMES 'utf8'");
	if($conn)
	{
		
	}
	else{
		
	}
?>
