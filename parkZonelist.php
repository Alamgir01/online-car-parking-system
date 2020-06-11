
<?php
	include "dbconnect.php";
	
	function free_space($id,$connect){
			$query="select car_space -(select count(p_status)from park_info where a_id= $id and p_status = 'in') as space from park_zone WHERE a_id = $id";
			$result = mysqli_query($connect,$query);
			if(!$result){
				echo mysqli_errno($connect);
				echo mysqli_error($connect);
			}else{
				while($r=mysqli_fetch_assoc($result)){
					echo "<span>".$r['space']."</span>";
					echo "<span> free spacce</span> ";
				}  
				//echo $id ;
			}
			//unset($id);
		}
	if(isset($_GET['area'])){
		
		function show_area($arr,$connect){
			$query ="select * from park_zone where a_name ='$arr'";
			$result=mysqli_query($connect,$query);
			if(!$result){
				echo mysqli_error($connect);
				echo mysqli_errno($connect);
				exit();
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
	<div style="margin:10px;"> 
		<ul class="nav nav-pills nav-justified">
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link active text-white" href="parkZonelist.php">Parking Zone</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white " href="parkcar.php">Park Car</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkOwner.php">Register as a park Owner</a>
			</li>
		</ul>
	</div>
	<div id="" class="">
		<?php 
				$area = $_GET['area'];
				echo "<h1>".$area."</h1>";
				$res = show_area($area,$connect);
				foreach($res as $value){ 
		?>
				<p> <a href="parkSpace.php?id=<?php echo $value['a_id'];?>&address=<?php echo $value['a_address'] ;?>"><?php echo $value['a_address'] ;?></a> <?php free_space($value['a_id'],$connect); ?> </p>
				<br />
		<?php 
			    }
		?>
	</div>
</body>
</html>
<?php
	}else{
		
		$query = "select a_name from park_zone group by a_name";
		$result = mysqli_query($connect,$query);
		if(!$result){
			echo mysqli_error($connect);
			echo mysqli_errno($connect);
			exit();
		}
		
		function show_area($arr,$connect){
			$query ="select * from park_zone where a_name ='$arr'";
			$result=mysqli_query($connect,$query);
			if(!$result){
				echo mysqli_error($connect);
				echo mysqli_errno($connect);
				exit();
			}else{
				/*while($row=mysqli_fetch_assoc($result)){
					
				}*/
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
	<div style="margin:10px;"> 
		<ul class="nav nav-pills nav-justified">
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link active text-white" href="parkZonelist.php">Parking Zone</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white " href="parkcar.php">Park Car</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkOwner.php">Register as a park Owner</a>
			</li>
		</ul>
	</div>
	<div id="" class="">
	
		<?php while($row=mysqli_fetch_assoc($result)): 
			echo "<h1>".$row['a_name']."</h1>";
			$res = show_area($row['a_name'],$connect);
			//print_r($res);
			foreach($res as $value){ ?>
				<p> <a href="parkSpace.php?id=<?php echo $value['a_id'];?>&address=<?php echo $value['a_address'] ;?>"><?php echo $value['a_address'] ;?></a> <?php echo free_space($value['a_id'],$connect); ?> </p>
				<br />
		<?php 
			}
		 endwhile;?>
	</div>
</body>
</html>
<?php 
	}
?>


