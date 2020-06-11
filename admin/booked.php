<?php 
include "dbconnect.php";
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
		
		

 if(isset($_GET['id']) and isset($_GET['address'])){ ?>

<?php 
include "dbconnect.php";

function show_park_info($id,$connect){
	$arr = array();
	$query = "select park_info.p_status,park_info.p_space,park_info.p_in_time,park_zone.row , park_zone.col
    from park_info join park_zone on park_info.a_id = park_zone.a_id
    where park_info.a_id = $id and (park_info.p_status='in' or park_info.p_status='book') ";

$result = mysqli_query($connect,$query);
if(!$result){
	echo mysqli_error($connect);
	exit();
}else{
	$arr = show_matrix($_GET['id'],$connect);
	while($rows = mysqli_fetch_assoc($result)){
		//array_push($arr,$rows);
		$status = $rows['p_status'];
		$space = str_getcsv($rows['p_space']);
		if($space[0]<=$rows['row'] and $space[1]<=$rows['col']){
			$arr[$space[0]][$space[1]]=$status;
		}else{
			echo "index out of bound ";
			exit();
		}
		
	}
	return $arr ;
}
}	
function show_matrix($id,$connect){
	// here we initialize the  matrix 
	$arr1 = array();
	$query="select row , col from park_zone where a_id = $id";
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
}

function show_time($id,$space,$connect){
	$query = "select park_info.p_status,park_info.p_space,park_info.p_in_time
    from park_info
    where park_info.a_id = $id and park_info.p_status='book' and p_space = '$space'";
	$result1 = mysqli_query($connect,$query);
	if($result1){
		return $result1 ;
	}else{
		mysqli_errno($connect);
		mysqli_error($connect);
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
				<a class ="nav-link bg-success text-white" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link text-white bg-success " href="parkZonelist.php">Parking Zone</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkcar.php">Park Car</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link text-white active" href="booked.php">Booked place</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkOwner.php">Register as a park Owner</a>
			</li>
		</ul>
	</div>
	
	<div class="container" style="margin:15px;">
		<div class="container" >
			<h1><?php echo $_GET['address'];?></h1>
			<form action="parkcar.php" method="post">
			<?php 
				$ascii = 65;
				foreach($res=show_park_info($_GET['id'],$connect) as $key => $value){	
			?>	
			<div class="row">
			<?php
				foreach($value as $k => $v){
			?>
			<div class="col bg-success <?php if($res[$key][$k]=='in'){echo "bg-danger";}elseif($res[$key][$k]=='book'){echo "bg-warning";}?>"style="margin:15px;">
				 <p height="10%">
					<?php 
						if($res[$key][$k]!='in'){
					?>
						<input type="radio" name="r1" value="<?php echo $key.','.$k;?>" />
					<?php
						}
						echo chr($ascii),$k;
						if($res[$key][$k]=='book'){
								$p_space = implode(",",array($key,$k));
								$row = mysqli_fetch_assoc(show_time($_GET['id'],$p_space,$connect));
								echo $row['p_in_time'];
						}
					?> 
				 </p>
			</div>
			<?php	
				}
				echo "<br />";
			?>	
			</div>
			<?php
				$ascii=$ascii+1;
				}
			?>
				<input type="hidden" value="<?php echo $_GET['id']?>" name='a_id'/>
				<input type="submit" class="btn btn-primary" value="Submit" name="u_submit" />
			</form>
			
		</div>
	</div>
</body>
</html>
 <?php }else{ ?>
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
				<a class ="nav-link text-white bg-success " href="parkZonelist.php">Parking Zone</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkcar.php">Park Car</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link text-white active" href="booked.php">Booked place</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkOwner.php">Register as a park Owner</a>
			</li>
		</ul>
	
	<form action="booked.php" method="post">
		<select name="city[]" id="city">
		<?php  while($row = mysqli_fetch_assoc($result)){ ?>
				<option value="<?php echo $row['a_name'] ?>"><?php echo $row['a_name'] ?></option>
	    <?php	} ?>
	  </select>
	  <input type="submit" value="submit" />
	</form>
	<?php 
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$res = show_area($_POST['city'][0],$connect);
			foreach($res as $value){ ?>
				<a href="booked.php?id=<?php echo $value['a_id'];?>&address=<?php echo $value['a_address'] ;?>"><?php echo $value['a_address'] ;?></a>
				<br />
		<?php 
			}
		}
	?>
	</div>
</body>
</html>
 <?php }?>

