<?php
include "dbconnect.php";
/*function show_park_info($connect){
	$arr = array();
	$query = "select park_info.p_status,park_info.p_space
    from park_info
    where a_id = 3 and (park_info.p_status='in' or park_info.p_status='book')";

$result = mysqli_query($connect,$query);
if(!$result){
	echo mysqli_error($connect);
	exit();
}else{
	$arr = show_matrix($connect);
	while($rows = mysqli_fetch_assoc($result)){
		$status = $rows['p_status'];
		$space = str_getcsv($rows['p_space']);
		$arr[$space[0]][$space[1]]=$status;
	}
	return $arr ;
}
}	
function show_matrix($connect){
	$arr1 = array();
	$query="select row , col from park_zone where a_id = 3 ; ";
	$result = mysqli_query($connect,$query);
	if(!$result){
		echo mysqli_error($connect);
		exit();
	}else {
		$row = mysqli_fetch_assoc($result);
		for($i=1;$i<=$row['row'];$i++){ 
			for($j=1;$j<=$row['col'];$j++){
				$arr1[$i][$j] ='out';
			}
		}
		return $arr1;
	}	
}*/
 function show_area($connect,$a_city="Dhaka"){
	$query = "select a_name  from park_zone where a_city like '$a_city%' group by a_name";
	$result= mysqli_query($connect,$query);
	if(!$result){
		echo mysqli_error($connect);
		echo mysqli_errno($connect);
	}else{
		return $result ;
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
	<h1>Car Parking Home </h1>
	<div style="margin:10px;"> 
		<ul class="nav nav-pills nav-justified">
			<li class="nav-item">
				<a class ="nav-link active" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkZonelist.php">Parking Zone</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkcar.php">Park Car</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link text-white bg-success" href="booked.php">Booked place</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkOwner.php">Register as a park Owner</a>
			</li>
		</ul>
		<div> 
			 <nav class="navbar navbar-expand-xl bg-dark navbar-dark ">
				  <form class="form-control bg-dark" action="home.php" method="post">
					  <div class="row">
						<div class="col">
						 <input class="form-control mr-sm-2" type="text" placeholder="Enter your city ex.Dhaka" name ="search">
						</div>
						<div class="col">
						 <button class="btn btn-success " type="submit" name="submit">Search</button>
						</div>
					  </div>
					</form> 
			</nav> 
		</div>
	</div>
	<div class="container" style="margin:15px;">
		<?php  
			if(isset($_POST['submit'])){
				$a_city = $_POST["search"];
			}else{
				$a_city ="Dhaka";
			}
			
			foreach(show_area($connect,$a_city) as $key => $value){	
		?>	
		<div class="row">
		<?php
			foreach($value as $k => $v){
		?>
		<div class="col bg-success"style="margin:15px; text-whites">
			 <p height="10%"> <a  class="text-white" href="parkZonelist.php?area=<?php echo $v?>"><?php echo $v?> </a> </p>
		</div>
		<?php	
			}
			echo "<br />";
		?>	
		</div>
		<?php
			}
		?>
	</div>
</body>
</html>