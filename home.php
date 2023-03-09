<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">

	<title>Home Page</title>
	<style media="screen">
		.heading{
			font-family: Bitter,Georgia,"Times New Roman",Times,serif;
			font-weight: bold;
			color: #005E90;
		}
		.heading:hover{
			color: #0090DB;
		}
	</style>
</head>
<body>
	<!--NAVBAR-->
	<div style="height:5px; background: gray;"></div>
	<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
		<div class="container">
			<a href="#" class="navbar-brand">Coal Supplying Management System</a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarcollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a href="home.php" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<a href="aboutUs.php" class="nav-link">About Us</a>
				</li>
				<li class="nav-item">
					<a href="procurement.php" class="nav-link">Procurement</a>
				</li>
				<li class="nav-item">
					<a href="registration.php" class="nav-link">Registration</a>
				</li>
				<li class="nav-item">
					<a href="contactUs.php" class="nav-link">Contact Us</a>
				</li>
				<li class="nav-item">
					<a href="inquery.php" class="nav-link">Inquery</a>
				</li>
			</ul>
			</div>
		</div>		
	</nav>
	<div style="height:5px; background: gray;"></div>

	<!--Header-->
	<div class="container">
		<div class="row pb-2 mt-2">
			<div class="col-sm-4">
				<h4>Procurements</h4>
				
				<?php
				global $ConnectingDB;
				$sql = "SELECT * FROM procurement WHERE type='Transport Term' OR type='Transport Spot' ORDER BY deadline";
				$stmt = $ConnectingDB->query($sql);

				while($dataRaws = $stmt->fetch()){
					$id = $dataRaws["id"];
					$procId = $dataRaws["procId"];
					$title = $dataRaws["title"];
					$type = $dataRaws["type"];
					$qty = $dataRaws["qty"];
					$datetime = $dataRaws["datetime"];
					$deadline = $dataRaws["deadline"];
					$document = $dataRaws["document"];
				?>
				<div class="card" style="border-color:black;">
					<div class="card-body">
						<h5 class="card-title"><small><B><?php echo $title; ?></B></small></h5>
						<h5 class="card-title"><small><B><?php echo $procId; ?></B></small></h5>
						<hr>
						<?php
						echo ErrorMessage();
						echo SuccessMessage();
						?>
						<p class="card-text">Published Date: <?php echo $datetime; ?></p>
						<p class="card-text">Closing Date: <?php echo $deadline; ?></p>
						<p class="card-text">Quantity: <?php echo $qty; ?> MT </p>
						<p class="card-text">Procurement Type: <?php echo $type; ?> MT </p>
						<a href="file/<?php echo $document; ?>" target="_blank">
							<span style="float:left;">View Bid Document</span>
						</a>
						
						<a href="submitTransportOffer.php?id=<?php echo $id;?>">
							<span class = "btn btn-primary" style="float:right;">Offer Bid</span>
						</a>
					</div>
				</div>
				<?php } ?>
				<?php
				global $ConnectingDB;
				$sql = "SELECT * FROM procurement WHERE type='Coal Term' OR type='Coal Spot' ORDER BY deadline";
				$stmt = $ConnectingDB->query($sql);

				while($dataRaws = $stmt->fetch()){
					$id = $dataRaws["id"];
					$procId = $dataRaws["procId"];
					$title = $dataRaws["title"];
					$type = $dataRaws["type"];
					$qty = $dataRaws["qty"];
					$datetime = $dataRaws["datetime"];
					$deadline = $dataRaws["deadline"];
					$document = $dataRaws["document"];
				?>
				<div class="card" style="border-color:black;">
					<div class="card-body">
						<h5 class="card-title"><small><B><?php echo $title; ?></B></small></h5>
						<h5 class="card-title"><small><B><?php echo $procId; ?></B></small></h5>
						<hr>
						<p class="card-text">Published Date: <?php echo $datetime; ?></p>
						<p class="card-text">Closing Date: <?php echo $deadline; ?></p>
						<p class="card-text">Quantity: <?php echo $qty; ?> MT </p>
						<p class="card-text">Procurement Type: <?php echo $type; ?> MT </p>
						<a href="file/<?php echo $document; ?>" target="_blank">
							<span style="float:left;">View Bid Document</span>
						</a>
						
						<a href="submitCoalOffer.php?id=<?php echo $id;?>">
							<span class = "btn btn-primary" style="float:right;">Offer Bid</span>
						</a>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="col-sm-4">
				<h4>Supplier Registration</h4>
				<?php
				global $ConnectingDB;
				$sql = "SELECT * FROM register WHERE type='Transporter' ORDER BY deadline";
				$stmt = $ConnectingDB->query($sql);

				while($dataRaws = $stmt->fetch()){
					$regId = $dataRaws["regId"];
					$title = $dataRaws["title"];
					$type = $dataRaws["type"];
					$datetime = $dataRaws["datetime"];
					$deadline = $dataRaws["deadline"];
					$document = $dataRaws["document"];
				?>
				<div class="card" style="border-color:black;">
					<div class="card-body">
						<h5 class="card-title"><small><B><?php echo $title; ?></B></small></h5>
						<h5 class="card-title"><small><B><?php echo $regId; ?></B></small></h5>
					<hr>
						<p class="card-text">Published Date: <?php echo $datetime; ?></p>
						<p class="card-text">Closing Date: <?php echo $deadline; ?></p>
						
						<a href="file/<?php echo $document; ?>" target="_blank">
							<span style="float:left;">View Guideline</span>
						</a>
						<a href="coalTransRegForm.php">
							<span class = "btn btn-primary" style="float:right;">Register</span>
						</a>
					</div>
				</div>
				<?php } ?>
				<?php
				global $ConnectingDB;
				$sql = "SELECT * FROM register WHERE type='Supplier' ORDER BY deadline";
				$stmt = $ConnectingDB->query($sql);

				while($dataRaws = $stmt->fetch()){
					$regId = $dataRaws["regId"];
					$title = $dataRaws["title"];
					$type = $dataRaws["type"];
					$datetime = $dataRaws["datetime"];
					$deadline = $dataRaws["deadline"];
					$document = $dataRaws["document"];
				?>
				<div class="card" style="border-color:black;">
					<div class="card-body">
						<h5 class="card-title"><small><B><?php echo $title; ?></B></small></h5>
						<h5 class="card-title"><small><B><?php echo $regId; ?></B></small></h5>
						<hr>
						<p class="card-text">Published Date: <?php echo $datetime; ?></p>
						<p class="card-text">Closing Date: <?php echo $deadline; ?></p>
						
						<a href="file/<?php echo $document; ?>" target="_blank">
							<span style="float:left;">View Guideline</span>
						</a>
						<a href="coalSupRegForm.php">
							<span class = "btn btn-primary" style="float:right;">Register</span>
						</a>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="col-sm-4">
				<div class="card mt-2">
					<div class="card-body">
						<div class="text-justify">The Ceylon Shipping Corporation (CSC) is responsible for the transportation and supply of coal for the Lakvijaya Power Station in Norochcholai, Puttalam. Accordingly, CSC purchases coal and transportation from the parties that were selected through the bidding process.
						</div>
					</div>
				</div>
				<div class="card mt-1">
					<div class="card-header bg-primary text-light">
						<h5 class="lead">Sign Up</h5>
					</div>
					<div class="card-body">
						<a href="inquery.php" class="btn btn-success btn-block">Inquiery</a>
						<a href="login.php" class="btn btn-danger btn-block">Login</a>
					</div>
				</div>
				<div class="card mt-1">
					<div class="card-header bg-dark text-light">
						<h5 class="lead">Procurements Types</h5>
					</div>
					<div class="card-body">
						<?php
						global $ConnectingDB;
						$sql = "SELECT DISTINCT type FROM procurement";
						$stmt = $ConnectingDB->query($sql);
						while ($dataRaws = $stmt->fetch()) {
							$type = $dataRaws["type"];
						?>
						<a href="home.php?type=<?php echo$type; ?>"><span class="heading"><?php echo $type ?></span><br>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="height:5px; background: gray;"></div>

	<!--Main Area-->
	
	<!--Footer-->
	<div style="height:5px; background: gray;"></div>
	<footer class="bg-dark text-white">
		<div class="container">
			<div class="row pt-2">
				<div class="col">
					<p class="lead text-center small">Ceylon Shipping Corporation <span id="year"></span> &copy;--All Right Reserved--</p>
				</div>
			</div>
		</div>
	</footer>
	<div style="height:5px; background: gray;"></div>

	<script src="js/jquery.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.js"></script>

	<script>
		$('#year').text(new Date().getFullYear());
	</script>
</body>
</html>