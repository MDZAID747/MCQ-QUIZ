<?php
session_start();//Starts a PHP Session 
if(!isset($_SESSION['username'])){
header('location:login.php');//send a HTTP header to a client or browser in raw form
  }

  $con =mysqli_connect('localhost','root');//opens a new connection to the MySQL server

  mysqli_select_db($con,'quizdbase');//to change the default database for the connection
  ?>

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

<script type="text/javascript">
  function timeout()
  {
    var minute=Math.floor(timeLeft/60);
    var second=timeLeft%60;
    if(timeLeft<=0)
    {
      clearTimeout(tm);
      document.getElementById('submit-btn').onclick();
    }
    else
    {
      document.getElementById("time").innerHTML=minute+":"+second;
    }
    timeLeft--;
    var tm=setTimeout(function() {timeout()},1000);

  }

 </script>
 
  </head>
  <body onload="timeout()">
  	<div class="container"> 
  		<br>

      <h1 class="text-center text-primary">QUIZZLER 
        <script type="text/javascript">
        var timeLeft=10;

        </script>

        <div id="time" style="float:right">timeout</div></h1><br>
  	<h2 class="text-center text-success">Welcome <?php  echo $_SESSION['username'];?></h2><br>

  	<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 m-auto d-block">
  		
  	
  		<div class="card"> 
  			<h3 class="text-center card-header">Welcome <?php  echo $_SESSION['username'];?> you have to select only one out of the four options.Best of Luck :)</h3>


  		</div><br>

  		<form action="check.php" id="myForm" method="post">

  		<?php  

  		for($i=0 ; $i < 6 ; $i++){
  		$q="select * from questions where qid=$i";
  		$query = mysqli_query($con,$q);// performs a query against a database
  		while($rows = mysqli_fetch_array($query)){	//  fetches a result row as an associative array
  			?>

  			<div class="card">
  			<h4 class="card-header"><?php echo $rows['question'] ?></h4>	

  			<?php
  			    $q="select * from answers where ans_id=$i";
  		        $query = mysqli_query($con,$q);	//performs a query against a database

  		        while($rows = mysqli_fetch_array($query)){	////  fetches a result row as an associative array
  			       ?>
  			       	<div class="card-body">
   			       	<input type="radio" name="quizcheck[<?php echo $rows['ans_id']; ?>]" value="
   			       	<?php echo $rows['aid']; ?>">
  			       	<?php echo $rows['answer']; ?>
  			       	</div>


  			  
  	<?php
  		}
  		}
  		}
  		?>

  		<input type="submit" id="submit-btn" name="submit" class="btn btn-success m-auto d-block" >
  		</form>
  	    </div>
  		</div>
  		<br>
  		<br>
  		
  		<div class="m-auto d-block">
      <a href="logout.php" class="btn btn-primary">LOGOUT</a>
  		</div><br>

  		<div>
  			
  			<h5 class="text-center"> @2018 TeslaTechnical </h5>
  	 </div><br><br>
  	
  </div>
  <script>
    setTimeout(function() {
  document.getElementById('submit-btn').click();
}, 10000);
</script>
  </body>
  </html>