<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$type = $_POST['type'];
	$deadline = $_POST['deadline'];

	$document = $_FILES['biddocument']['name'];
	$target="file/".basename($_FILES["biddocument"]["name"]);

	$author = "Sameera";
	date_default_timezone_set("Asia/Colombo");
	$currentTime=time();
	$datetime = strftime("%Y-%m-%dT%H:%M",$currentTime);

	if (empty($title)||empty($deadline)||empty($document)) {
		$_SESSION['ErrorMessage'] = "Please Fill the All Fields";
		RedirectTo("addReg.php");
		}elseif (strlen($title)<5) {
			$_SESSION['ErrorMessage'] = "Title should be at least 5 characters";
			RedirectTo("addReg.php");
		}elseif(strtotime($deadline)<strtotime($datetime)) {
			$_SESSION['ErrorMessage'] = "It is old date";
			RedirectTo("addReg.php");
		}else{
		global $ConnectingDB;
		$sql = "INSERT INTO register(datetime,title,author,type,document,deadline)";
		$sql .= "VALUES(:datetime,:title,:author,:type,:document,:deadline)";
		$stmt = $ConnectingDB->prepare($sql);

		$stmt->bindValue(':datetime',$datetime);
		$stmt->bindValue(':title',$title);
		$stmt->bindValue(':author',$author);
		$stmt->bindValue(':type',$type);
		$stmt->bindValue(':document',$document);
		$stmt->bindValue(':deadline',$deadline);
		
		$Execute = $stmt->execute();

		move_uploaded_file($_FILES["biddocument"]["tmp_name"],$target);

		if($Execute){
			$_SESSION["SuccessMessage"] = "Successfully Published";
			RedirectTo("addReg.php");
		}else{
			$_SESSION["SErrorMessage"] = "Something Wrong..!";
			RedirectTo("addReg.php");
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

	<title>Add Registration</title>
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
					<h5 class="text-center">Add New Registration</h5>
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
				<form class="" action="addReg.php" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Title:</span></label>
								<input type="text" class="form-control" name="title" id="title" placeholder="Title shoud at lease 5 characters">
							</div>
							<div class="form-group">
								<label for="type"><span class="FieldInfo">Type:</span></label>
								<select class="form-control" id="type" name="type">
									<option value="Supplier">Coal Supplier</option>
									<option value="Transporter">Coal Trasnporter</option>
								</select>
							</div>
							<div class="form-group">
								<label for="document"><span class="FieldInfo">Select Document:</span></label>
								<div class="custom-file">
									<input class="custom-file-input" type="File" name="biddocument" id="biddocument" value="">
									<label for="selectDocument" class="custom-file-label">Select Document</label>
								</div>
							</div>
							<div class="form-group">
								<label for="deadline"><span class="FieldInfo">Select Deadline:</span></label>
								<div class="custom-file">
									<input class="form-control" type="datetime-local" name="deadline" id="deadline">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<a href="dashPManager.php" class="btn btn-block btn-warning">Back To Dashboard</a>
								</div>
								<div class="col-lg-6">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Publish</button>
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