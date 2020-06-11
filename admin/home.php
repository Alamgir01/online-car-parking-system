<?php
	include "dbconnect.php";
	if(isset($_POST['update'])){
		update($connect);
	}
	$a_id =  1 ;
	$query="select * from park_info where a_id = $a_id ";
	$result = mysqli_query($connect,$query);
	if(!$result){
		echo mysqli_error($connnect);
	}
	
	
	function update ($connect){
		echo "update";
		echo "<br />";
		if(isset($_POST['opt'])){
			 echo $_POST['stat'] ; 
				
				echo "<br />";
		}else{
			
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
				<a class ="nav-link active text-white" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link text-white bg-success " href="parkSpace.php">Parking Space</a>
			</li>
			<li class="nav-item">
				<a class ="nav-link bg-success text-white" href="parkOwner.php">Register as a park Owner</a>
			</li>
		</ul>
</div>

<div class="container"> 
	<form action="home.php" method="post">
	<table class="table">
		<thead class="thead-dark">
            <tr>
                <th>Car Number</th>
                <th>Park In Time</th>
                <th>Park Out Time</th>
                <th>Park Status</th>
                <th>Park Space</th>
                <th>Option</th>
            </tr>
        </thead>
		<?php
			while($row=mysqli_fetch_assoc($result)){ ?>
			<tr>
				<td> <?php echo $row['c_number'];  ?></td>
				<td> <?php echo $row['p_in_time'];  ?></td>
				<td> <?php echo $row['p_out_time'];  ?></td>
				<td><input type="text" name="stat" value="<?php echo $row['p_status'];?>"/></td>
				<td> <?php echo $row['p_space']; ?></td>
				<td> <input type="checkbox" name='opt' value="<?php echo $row['p_id'];?>" /></td>
			</tr>
		<?php	}
		?>
	</table>
	<input type="submit" value="Update" name="update"/>
	</form>
</div>	
</body>
</html>