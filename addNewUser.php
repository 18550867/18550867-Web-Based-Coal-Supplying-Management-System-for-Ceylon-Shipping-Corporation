<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$userType = $_POST['usertype'];

	$addedBy = "Admin";

	$password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@#$"),0,8);

	if (empty($name)||empty($mobile)||empty($email)) {
		$_SESSION['ErrorMessage'] = "Please Fill the All Fields";
		RedirectTo("addNewUser.php");
	}elseif (cheakDuplicateEmail($email)) {
		$_SESSION['ErrorMessage'] = "Email is Already Existing";
		RedirectTo("addNewUser.php");
	}elseif (strlen($mobile)!=10) {
		$_SESSION['ErrorMessage'] = "Invalid Mobile Number";
		RedirectTo("addNewUser.php");
	}else{
		global $ConnectingDB;
		$sql = "INSERT INTO user(name,mobile,email,usertype,password,createBy)";
		$sql .= "VALUES(:name,:mobile,:email,:usertype,:password,:createBy)";
		$stmt = $ConnectingDB->prepare($sql);

		$stmt->bindValue(':name',$name);
		$stmt->bindValue(':mobile',$mobile);
		$stmt->bindValue(':email',$email);
		$stmt->bindValue(':usertype',$userType);
		$stmt->bindValue(':password',$password);
		$stmt->bindValue(':createBy',$addedBy);

		$Execute = $stmt->execute();


		if($Execute){
			$_SESSION["SuccessMessage"] = "Successfully Created";
			RedirectTo("addNewUser.php");
		}else{
			$_SESSION["SErrorMessage"] = "Something Wrong..!";
			RedirectTo("addNewUser.php");
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

	<title>Add New Internal User</title>
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
				<div class="col-md-12">
					<h5 class="text-center">Add New User</h5>
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
				<form class="" action="addNewUser.php" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Name:</span></label>
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter Valid Name">
							</div>
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Mobile:</span></label>
								<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Ex: 07xxxxxxxx">
							</div>
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Email:</span></label>
								<input type="email" class="form-control" name="email" id="email" placeholder="Ex: example@example.com">
							</div>
							<div class="form-group">
								<label for="type"><span class="FieldInfo">User Type:</span></label>
								<select class="form-control" id="usertype" name="usertype">
									<option value="Admin">Admin</option>
									<option value="Procurement Manager">Procurement Manager</option>
									<option value="Chartering Manager">Charter Manager</option>
								</select>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<a href="dashAdmin.php" class="btn btn-block btn-warning">Back To Dashboard</a>
								</div>
								<div class="col-lg-6">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Add</button>
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