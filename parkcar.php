
<?php
	session_start();
	
	include "dbconnect.php";
	if(isset($_POST['r1'])){
		$_SESSION['a_id']=$_POST['a_id'];
		$_SESSION['a_address']=$_POST['a_address'];
		$_SESSION['p_space']=$_POST['r1'];
	}
	if(!isset($_SESSION['p_space'])){
		echo "please select the park zone and park space from ";
		echo '<br />';
		echo "<a href="."parkZonelist.php".">park zone list </a>";
		exit();
	}
	if(isset($_POST['submit'])){
		$id=insert_user($connect);
		insert_car($id,$connect);
		insert_park($connect);
		$id = $_SESSION['a_id'];
		$address  = $_SESSION['a_address'];
		$_SESSION['msg']="Your palce is Booked successfully";
		header("Location:booked.php?id=$id&address=$address");
	}
	// insert user info into user_info table 
	function insert_user($connect){
		$u_name = $_POST['u_name'];
		$u_phone = $_POST['u_phone'];
		$u_email = $_POST['u_email'];
		$u_address = $_POST['u_address'];
		
		$query = "insert into user_info values('','$u_name','$u_phone','$u_email','$u_address');";
		$result = mysqli_query($connect,$query);
		if($result){
			return mysqli_insert_id($connect);
		}else{
			echo mysqli_error($connect);
			echo mysqli_errno($connect);
			exit();
		}
	}
	function insert_car($id,$connect){
		$c_number = $_POST['c_number'];
		$c_model = $_POST['c_model'];
		$c_type  = $_POST['c_type'];
		
		$query = "insert into car_info values ('$c_number','$id','$c_model','$c_type')";
		$result = mysqli_query($connect,$query);
		if(!$result){
			echo mysqli_error($connect);
			echo mysqli_errno($connect);
			exit();
		}
	}
	function insert_park($connect){
	
		$a_id = $_SESSION['a_id'];
		$p_space= $_SESSION['p_space'];
		$c_number = $_POST['c_number'];
		$in_time = date("d/m/Y");
		$out_time = date("d/m/Y");
		$p_status ='book';
		$query = "insert into park_info values ('','$c_number','$a_id','$in_time','$out_time','$p_status','$p_space')";
		$result = mysqli_query($connect,$query);
		if(!$result){
			echo mysqli_error($connect);
			echo mysqli_errno($connect);
			exit();
		}
	}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

	<div style="margin:10px;"> 
		<ul class="nav nav-pills nav-justified">
			<li class="nav-item">
				<a class ="nav-link bg-success text-white " href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkZonelist.php">Parking Zone</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link active text-white" href="parkcar.php">Park Car</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkOwner.php">Register as a park Owner</a>
			</li>
		</ul>
	</div>
	<div class="container mt-4">  
		<form action="parkcar.php" method="post">
			<input type="hidden" name="pos" value="<?php echo $_SESSION['p_space'];?>" />
			<label for="user_name">Name:</label>
			<input type="text" class="form-control" name="u_name"/>
			<label for="user_phone">Phone:</label>
			<input type="text" class="form-control" name="u_phone"/>
			<label for="user_email">Email:</label>
			<input type="text" class="form-control" name="u_email"/>
			<label for="user_address">Adress:</label>
			<textarea name="u_address" id="" cols="15" rows="5" class="form-control" ></textarea>
			
			<label for="c_number">Car Number :</label>
			<input type="text" class="form-control" name="c_number"/>
			<label for="c_model">Car Model :</label>
			<input type="text" class="form-control" name="c_model"/>
			<label for="c_type">Car Type :</label>
			<input type="text" class="form-control"/ name="c_type">
			<label for="in_time">In Time :</label>
			<input type="text" class="form-control"/ name="in_time">
			<label for="out_time">Out Time :</label>
			<input type="text" class="form-control"/ name="out_time">
			<br />
			<input type="submit" class="btn btn-primary" value="Submit" name="submit"/>
		</form>
	</div>
</body>
</html>
