<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
$searchQueryParameter = $_GET['id'];
if (isset($_POST['submit'])) {
	global $ConnectingDB;
	$sql = "DELETE FROM procurement WHERE id='$searchQueryParameter'";
	$Execute = $ConnectingDB->query($sql);

	if($Execute){
		$_SESSION["SuccessMessage"] = "Successfully Deleted";
		RedirectTo("viewProc.php");
	}else{
		$_SESSION["SErrorMessage"] = "Something Wrong..!";
		RedirectTo("viewProc.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">

	<title>Delete Procurement</title>
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
			<div class="collapse navbar-collapse" id="navbarcollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a href="#" class="nav-link">My Profile</a>
				</li>
				<li class="nav-item">
					<a href="dashPManager.php" class="nav-link">Dashboard</a>
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
				<div class="col-md-12">
					<h5 class="text-center">Delete Procurement</h5>
				</div>
			</div>
		</div>
	</header>
	<div style="height:5px; background: gray;"></div>

	<!--Main Area-->
	<section class="container py-2 mb-1">
		<div class="row">
			<div class="offset-lg-3 col-lg-6">
				<?php 
				echo ErrorMessage();
				echo SuccessMessage();

				global $ConnectingDB;
				$searchQueryParameter = $_GET['id'];
				$sql = "SELECT * FROM procurement WHERE id='$searchQueryParameter'";
				$stmt = $ConnectingDB->query($sql);
				while ($dataRaws=$stmt->fetch()) {
					$title = $dataRaws['title'];
					$procId = $dataRaws['procId'];
				}
				?>

				<form class="" action="deleteProc.php?id=<?php echo $searchQueryParameter; ?>" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="procId"><span class="FieldInfo">Procurement Id:</span></label>
								<input type="text" class="form-control" name="procId" id="procId" value="<?php echo $procId; ?>" readonly>
							</div>
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Title:</span></label>
								<input type="text" class="form-control" name="title" id="title" value="<?php echo $title; ?>" readonly>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<a href="viewProc.php" class="btn btn-block btn-warning">Back To View</a>
								</div>
								<div class="col-lg-6">
									<button type="submit" name="submit" class="btn btn-block btn-danger">Delete Confiremed</button>
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