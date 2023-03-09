<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$author = "Sameera";
	date_default_timezone_set("Asia/Colombo");
	$currentTime=time();
	$datetime = strftime("%B-%d-%Y %H:%M:%S",$currentTime);

	if (empty($title)) {
		$_SESSION['ErrorMessage'] = "Empty";
		RedirectTo("test.php");
	}elseif (strlen($title)<5) {
		$_SESSION['ErrorMessage'] = "At least 5 characters";
		RedirectTo("test.php");
	}else{
		$sql = "INSERT INTO test(title,author,datetime)";
		$sql .= "VALUES(:title,:author,:datetime)";
		$stmt = $ConnectingDB->prepare($sql);

		$stmt->bindValue(':title',$title);
		$stmt->bindValue(':author',$author);
		$stmt->bindValue(':datetime',$datetime);

		$Execute = $stmt->execute();

		if($Execute){
			$_SESSION["SuccessMessage"] = "Success";
			RedirectTo("basic.html");
		}else{
			$_SESSION["SErrorMessage"] = "Something Wrong";
			RedirectTo("test.php");
		}
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

	<title></title>
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
					<a href="#" class="nav-link">Dashboard</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Manage Admins</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="logout.php" class="nav-link">Logout</a>
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
					<h5 class="text-center">Manage Category</h5>
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
				?>
				<form class="" action="test.php" method="post">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-header pb-1">
							<h5>Add New</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Title</span></label>
								<input type="text" class="form-control" name="title" id="title" placeholder="">
							</div>
							<div class="row">
								<div class="col-lg-6">
									<a href="dashboard.php" style="border-color:black;" class="btn btn-block btn-light">Back To Dashboard</a>
								</div>
								<div class="col-lg-6">
									<button type="submit" style="border-color:black;" name="submit" class="btn btn-block btn-light">Publish</button>
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