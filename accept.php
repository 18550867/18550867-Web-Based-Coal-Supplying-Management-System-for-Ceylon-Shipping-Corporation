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

	<title>Acceptance</title>
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
					<a href="#" class="nav-link">About Us</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Procurement</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Registration</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Contact Us</a>
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
	
	<header class="text-white bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h5 class="text-center">Acceptance</h5>
				</div>
			</div>
		</div>
	</header>
	<div style="height:5px; background: gray;"></div>

	<!--Main Area-->
	<section class="container py-2 mb-1">
		<div class="row">
			<div class="col-lg-12">
			<div>
				<?php 
				echo ErrorMessage();
				echo SuccessMessage();
				?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h5 class="text-center">View Offered for Coal Transport</h5>
				</div>
			</div>
			<div class="col-lg-12">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th>Laycon 01</th>
						<th>Quantity 01</th>
						<th>Laycon 02</th>
						<th>Quantity 02</th>
						<th>Laycon 03</th>
						<th>Quantity 03</th>
						<th>Action</th>
					</tr>
					</thead>
					<?php
					if (isset($_POST['submit'])) {
					global $ConnectingDB;
					$filter = $_POST['chooseProc'];
					$sql = "SELECT * FROM laycan WHERE procId='$filter'";
					$stmt = $ConnectingDB->query($sql);
					$sr=0;
					while ($dataRaws = $stmt->fetch()) {
						$id = $dataRaws["id"];
						$laycan1 = $dataRaws["laycan1"];
						$qty1 = $dataRaws["qty1"];
						$laycan2 = $dataRaws["laycan2"];
						$qty2 = $dataRaws["qty2"];
						$laycan3 = $dataRaws["laycan3"];
						$qty3 = $dataRaws["qty3"];
						$sr++;

					?>
					<tbody>
					<tr>
						<td><?php echo $sr; ?></td>
						<td><?php echo $laycan1; ?></td>
						<td><?php echo $qty1; ?></td>
						<td><?php echo $laycan2; ?></td>
						<td><?php echo $qty2; ?></td>
						<td><?php echo $laycan3; ?></td>
						<td><?php echo $qty3; ?></td>
						
						<td><a href="submitAgreement.php?id=<?php echo $id;?>"><span class="btn bg-warning">Agreement</span></a></td>
					</tr>
					<tbody>
					<?php } ?>
					<?php } ?>
				</table>

				<form class="" action="accept.php" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Proc Id:</span></label>
								<input type="text" class="form-control" name="chooseProc" id="chooseProc">
							</div>
							<div class="row">
								<div class="col-lg-6">
								</div>
								<div class="col-lg-6">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Filter</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
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