<?php
session_start();

  $con =mysqli_connect('localhost','root');//opens a new connection to the MySQL server

  mysqli_select_db($con,'quizdbase');//used to change the default database for the connection
  ?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>

  <!DOCTYPE html>
  <html>
  <head>
  	<title></title>
  	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style type="text/css">
	.animateuse{
		animation: leelaanimate 0.5s infinite;
	}

@keyframes leelaanimate{
	0%{color:red},
	10%{color:yellow},
	20%{color:blue},
	40%{color:green},
	50%{color:pink},
	60%{color:orange},
	80%{color:black},
	100%{color:brown},
	}
</style>
</head>
<body>
	<div class="container text-center">
		<br><br>
		<h1 class="text-center text-success text-uppercase animateuse"> QUIZZLER </h1>
		<br><br><br><br>
		<table class="table text-center table-bordered table-hover">
			<tr>
				<th colspan="2" class="bg-dark"> <h1 class="text-white">Results</h1></th>
			</tr>
			<tr>
				<td>
					Questions Attempted
				</td>
     
				<?php

				if(isset($_POST['submit'])){ //checks whether a variable is set in submit
  	      		if(!empty($_POST['quizcheck'])){

  				$checked_count = count($_POST['quizcheck'])//returns the number of elements);

  				?>

  				<td>
  				<?php
  				echo "Out of 5,You have Attempted ".$checked_count." option.";
  				?>
  			    </td>

  				<?php 

  				$selected = $_POST['quizcheck'];
  				$q1="select * from questions";
  				$ansresults=mysqli_query($con,$q1);// performs a query against a database
  				
				$Resultans = 0;
  				$i=1;

  			while($rows =mysqli_fetch_array($ansresults)){ //fetches a result row as an associative array, a numeric array, or both. 
  				$flag=$rows['ans_id']==$selected[$i];
  				if($flag){
  					$Resultans++;
  				}
  				$i++;
  			}
  				 ?>

  				 <tr>
  				 	<td>
  				 		Your Total score
  				 	</td>
  				 <td colspan="2">
  				 	<?php
  				 		echo "Your score is ".$Resultans.".";
  				 	}
  				 	else{
  				 		echo "<b>Please Select Atleast One Option.</b>";
  				 	}
  				 }
  				 ?>
  				</td>
  			</tr>
  			<?php 

  				$name = $_SESSION['username'];
	  			$finalresult = " insert into user(username,totalques,answercorrect) values ('$name','5','$Resultans')";

  				$queryresult = mysqli_query($con,$finalresult);	//Performs a query on the database ...


  			?>
		</table>

		<a href="logout.php" class="btn btn-primary">LOGOUT</a>
	
</div>
</body>
</html>
