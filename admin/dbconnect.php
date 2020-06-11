<?php
	$connect = mysqli_connect("localhost","root","","parkingsystem");
	if(!$connect){
		echo mysqli_errno($connect);
		echo mysqli_error($connect);
	}
?>