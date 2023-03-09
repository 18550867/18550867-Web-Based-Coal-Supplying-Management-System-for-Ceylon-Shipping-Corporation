<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
if(isset($_SESSION['id'])){
	RedirectTo("dashboard.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username)||empty($password)){
		$_SESSION['ErrorMessage'] = "All Fields must be Filled Out";
		RedirectTo("login.php");
	}else{
		$foundAccount = login_atempt($username,$password);
		if ($foundAccount) {
			$Name = $foundAccount['name'];
			$userType = $foundAccount['usertype'];

			if(strcmp($userType,"Procurement Manager") == 0){
			RedirectTo("dashPManager.php");
			}

			if(strcmp($userType,"Admin") == 0){
			RedirectTo("dashAdmin.php");
			}

			if(strcmp($userType,"Charter Manager") == 0){
			RedirectTo("dashCManager.php");
			}

			
		}else{
			$_SESSION['ErrorMessage'] = "Invalid Credentials";
			RedirectTo("login.php");
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

	<title>Login</title>
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
			</div>
		</div>		
	</nav>
	<div style="height:5px; background: gray;"></div>

	<!--Header-->
	<header class="text-white bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h5 class="text-center">External User Login</h5>
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
				<form class="" action="login.php" method="post">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-header pb-1">
							<h5>User Login</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="username"><span class="FieldInfo">User Name:</span></label>
								<input type="text" class="form-control" name="username" id="username" placeholder="">
							</div>
							<div class="form-group">
								<label for="password"><span class="FieldInfo">Password:</span></label>
								<input type="Password" class="form-control" name="password" id="password" placeholder="">
							</div>
							<div class="row">
								<div class="col-lg-12">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Login</button>
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