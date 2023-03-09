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

	<title>Dashboard of System Administrator</title>
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
					<a href="#" class="nav-link">My Profile</a>
				</li>
				<li class="nav-item">
					<a href="dashAdmin.php" class="nav-link">Dashboard</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Manage Admins</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="login.php" class="nav-link">Logout</a>
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
				<div class="col-lg-3 p-2">
					<a href="addNewUser.php" class="btn btn-dark btn-block" style="border-color:white;">Add New User</a>
				</div>
				<div class="col-lg-3 p-2">
					<a href="viewProc.php" class="btn btn-dark btn-block" style="border-color:white;">View User</a>
				</div>
				<div class="col-lg-3 p-2">
					<a href="addReg.php" class="btn btn-dark btn-block" style="border-color:white;">View External User</a>
				</div>
				<div class="col-lg-3 p-2">
					<a href="viewReg.php" class="btn btn-dark btn-block" style="border-color:white;">Add New User</a>
				</div>
			</div>
		</div>
	</header>
	<div style="height:5px; background: gray;"></div>

	<!--Main Area-->
	<section class="container py-2 mb-1">
		<div class="row">
			<div class="col-lg-2">
				<div class="card text-center bg-dark text-white mb-2">
				<div class="card-body">
					<h1 class="lead">Internal Users</h1>
					<h4 class="display-5">
						<?php
							global $ConnectingDB;
							$sql = "SELECT COUNT(*) FROM user";
							$stmt = $ConnectingDB->query($sql);
							$totalRows = $stmt->fetch();
							$totalUser = array_shift($totalRows);
							echo $totalUser;
						?>
					</h4>
					</div>
				</div>
				<div class="card text-center bg-dark text-white mb-2">
					<div class="card-body">
						<h1 class="lead">External Users</h1>
						<h4 class="display-5">
							<?php
								global $ConnectingDB;
								$sql = "SELECT COUNT(*) FROM coalsupplier WHERE	status = 'Approved'";
								$stmt = $ConnectingDB->query($sql);
								$totalRows = $stmt->fetch();
								$totalCoal = array_shift($totalRows);
								echo $totalCoal;
							?>
						</h4>
					</div>
				</div>
				<div class="card text-center bg-dark text-white mb-2">
					<div class="card-body">
						<h1 class="lead">Transporters</h1>
						<h4 class="display-5">
							<?php
								global $ConnectingDB;
								$sql = "SELECT COUNT(*) FROM vesselsupplier WHERE status = 'Approved'";
								$stmt = $ConnectingDB->query($sql);
								$totalRows = $stmt->fetch();
								$totalVessel = array_shift($totalRows);
								echo $totalVessel;
							?>
						</h4>
					</div>
				</div>
			</div>
			<div class="col-lg-10">
				<h5>System Admin</h5>
				<h4>Internal Users</h4>
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>Proc Id</th>
							<th>Proc Name</th>
							<th>Proc Type</th>
							<th>Deadline</th>
						</tr>
					</thead>
					<?php
						$sql = "SELECT * FROM user Limit 0,5";
						$stmt = $ConnectingDB->query($sql);
						$sr=0;
						while($dataRaws=$stmt->fetch()){
							$id = $dataRaws['id'];
							$userId = $dataRaws['userId'];
							$name = $dataRaws['name'];
							$type = $dataRaws['usertype'];
							$email = $dataRaws['email'];
							$sr++;
						?>
						<tbody>
						<tr>
							<td><?php echo $sr; ?></th>
							<td><?php echo $userId; ?></th>
							<td><?php echo $name; ?></th>
							<td><?php echo $type; ?></th>
							<td><?php echo $email; ?></th>
						</tr>
					</tbody>
					<?php } ?>
				</table>
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