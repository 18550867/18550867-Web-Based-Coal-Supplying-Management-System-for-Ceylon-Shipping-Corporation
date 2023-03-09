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

	<title>About Us</title>
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
			<div class="col-sm-8">
				<h4>About Us</h4>

				<div class="card" style="border-color:black;">
					<div class="card-body">
						<p class="card-text text-justify">Sixth of June, 1971 was a historical day for the contemporary shipping industry of Sri Lanka , when the country's legislatures gave the nod to establish Ceylon Shipping Corporation as a fully government owned commercial enterprise. Infant National Carrier under the brand name of CSC grew from strength to strength and earned the credibility as a dependable carrier from Europe to Fareast and North of India to Australia .CSC helped many non-traditional export produces to enter global markets and establish footholds when the freight was a prohibitive factor and sailing opportunities were minimal at the time.</p>
						<p class="card-text" style="color:blue;">Vision</p>
						<p class="card-text">To develop a dependable and effective National Fleet of Ships for the country.</p>
						<p class="card-text" style="color:blue;">Mission</p>
						<p class="card-text text-justify">To cater to the sea transportation needs of the export, import and local coastal Trades of Sri Lanka that needs assistance from the National Carrier.</p>
					</div>
				</div>
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