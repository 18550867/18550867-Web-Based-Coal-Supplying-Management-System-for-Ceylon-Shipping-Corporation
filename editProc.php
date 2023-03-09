<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
$searchQueryParameter = $_GET['id'];
if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$type = $_POST['type'];
	$deadline = $_POST['deadline'];
	$qty = $_POST['qty'];

	$document = $_FILES['biddocument']['name'];
	$target="file/".basename($_FILES["biddocument"]["name"]);

	$author = "Sameera";
	date_default_timezone_set("Asia/Colombo");
	$currentTime=time();
	$datetime = strftime("%Y-%m-%dT%H:%M",$currentTime);

	if (empty($title)||empty($deadline)||empty($document)||empty($qty)) {
		$_SESSION['ErrorMessage'] = "Please Fill the All Fields";
		RedirectTo("viewProc.php");
	}elseif (strlen($title)<5) {
		$_SESSION['ErrorMessage'] = "Title should be at least 5 characters";
		RedirectTo("viewProc.php");
	}elseif(strtotime($deadline)<strtotime($datetime)) {
			$_SESSION['ErrorMessage'] = "It is old date";
			RedirectTo("viewProc.php");
	}else{
		global $ConnectingDB;
		$sql = "UPDATE procurement SET title='$title', type='$type', qty='$qty', deadline='$deadline', document='$document' WHERE id='$searchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);

		move_uploaded_file($_FILES["biddocument"]["tmp_name"],$target);

		if($Execute){
			$_SESSION["SuccessMessage"] = "Successfully Updated";
			RedirectTo("viewProc.php");
		}else{
			$_SESSION["ErrorMessage"] = "Something Wrong..!";
			RedirectTo("viewProc.php");
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

	<title>Edit procurement</title>
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
					<h5 class="text-center">Edit Procurement</h5>
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
				$sql = "SELECT * FROM procurement WHERE id='$searchQueryParameter'";
				$stmt = $ConnectingDB->query($sql);
				while ($dataRaws=$stmt->fetch()) {
					$titleToBeUpdated = $dataRaws['title'];
					$typeToBeUpdated = $dataRaws['type'];
					$quantityToBeUpdated = $dataRaws['qty'];
					$documentToBeUpdated = $dataRaws['document'];
					$deadlineToBeUpdated = $dataRaws['deadline'];
				}
				?>

				<form class="" action="editProc.php?id=<?php echo $searchQueryParameter; ?>" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Title:</span></label>
								<input type="text" class="form-control" name="title" id="title" value="<?php echo $titleToBeUpdated; ?>">
							</div>
							<div class="form-group">
								<label for="type"><span class="FieldInfo">Type:</span></label>
								<span class="FieldInfo"><?php echo $typeToBeUpdated?> </span>
								<select class="form-control" id="type" name="type">
									<option value="Coal Term">Term Tender - Coal Supply</option>
									<option value="Coal Spot">Spot Tender - Coal Supply</option>
									<option value="Transport Term">Term Tender - Coal Transport</option>
									<option value="Transport Spot">Spot Tender - Coal Transport</option>
								</select>
							</div>
							<div class="form-group">
								<label for="quantity"><span class="FieldInfo">Coal Quantity in MT:</span></label>
								<input type="number" class="form-control" name="qty" id="qty" value="<?php echo $quantityToBeUpdated;?>">
							</div>
							<div class="form-group">
								<label for="document"><span class="FieldInfo">Select Document:</span></label>
								<span class="FieldInfo"><?php echo $documentToBeUpdated; ?> </span>
								<div class="custom-file">
									<input class="custom-file-input" type="File" name="biddocument" id="biddocument" value="">
									<label for="selectDocument" class="custom-file-label">Select Document</label>
								</div>
							</div>
							<div class="form-group">
								<label for="deadline"><span class="FieldInfo">Select Deadline:</span></label>
								<span class="FieldInfo"><?php echo $deadlineToBeUpdated; ?> </span>
								<div class="custom-file">
									<input class="form-control" type="datetime-local" name="deadline" id="deadline">
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<a href="viewProc.php" class="btn btn-block btn-warning">Back To View</a>
								</div>
								<div class="col-lg-6">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Update</button>
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