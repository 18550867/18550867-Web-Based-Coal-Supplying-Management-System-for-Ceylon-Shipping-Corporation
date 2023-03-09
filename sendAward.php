<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$procId = $_POST['procId'];
	$message = "http://localhost/project/accept.php";

	//send email
	$to = $email;
	$mail_subject = $procId;
	$email_body = "Congratulations...! Your offer is Accepted for follwing procurement <br>";
	$email_body .= "Procurement Id: {$procId} <br>";
	$email_body .= "Please click the follwing link for acceptance <br>";
	$email_body .= $message;
	$header = "From: {$email}\r\nContent-Type: text/html;";

	$send_email_results = mail($to,$mail_subject,$email_body,$header);


	//Table Insert
	global $ConnectingDB;

		$laycan1 = $_POST['laycan1'];
		$laycan2 = $_POST['laycan2'];
		$laycan3 = $_POST['laycan3'];
		$qty1 = $_POST['qty1'];
		$qty2 = $_POST['qty2'];
		$qty3 = $_POST['qty3'];
		$decision = "Not Agreed";
		$supId = $_POST['supId'];

		$sql = "INSERT INTO laycan(procId,supId,laycan1,qty1,laycan2,qty2,laycan3,qty3,decision)";
		$sql .= "VALUES(:procId,:supId,:laycan1,:qty1,:laycan2,:qty2,:laycan3,:qty3,:decision)";
		$stmt = $ConnectingDB->prepare($sql);

		$stmt->bindValue(':procId',$procId);
		$stmt->bindValue(':supId',$supId);
		$stmt->bindValue(':laycan1',$laycan1);
		$stmt->bindValue(':qty1',$qty1);
		$stmt->bindValue(':laycan2',$laycan2);
		$stmt->bindValue(':qty2',$qty2);
		$stmt->bindValue(':laycan3',$laycan3);
		$stmt->bindValue(':qty3',$qty3);
		$stmt->bindValue(':decision',$decision);
		
		$Execute = $stmt->execute();

		if ($send_email_results and $Execute){
		$_SESSION['SuccessMessage'] = "Successfully Sent";
		RedirectTo("viewSelectedBidderT.php");
		}else{
		$_SESSION['ErrorMessage'] = "Something Went Wrong";
		RedirectTo("viewSelectedBidderT.php");
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

	<title>Create Job</title>
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
					<a href="dashCManager.php" class="nav-link">Dashboard</a>
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
					<h5 class="text-center">Create Schedule</h5>
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

				$searchQueryParameter = $_GET['id'];
				global $ConnectingDB;
				$sql = "SELECT * FROM  offertrans
					INNER JOIN vesselsupplier
					ON offertrans.SupId = vesselsupplier.SupId
					INNER JOIN procurement
					ON offertrans.procId = procurement.procId
					AND offertrans.results='Approved' WHERE procurement.id='$searchQueryParameter'";
					$stmt = $ConnectingDB->query($sql);
					while ($dataRaws=$stmt->fetch()) {
						$displayProcId = $dataRaws['procId'];
						$displaySupId = $dataRaws['supId'];
						$displayEmail = $dataRaws['email'];
				}
				?>
				<form class="" action="sendAward.php?id=<?php echo $searchQueryParameter?>" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="subject"><span class="FieldInfo">Procurement ID:</span></label>
								<input type="text" class="form-control" name="procId" id="procId" value="<?php echo $displayProcId; ?>" readonly>
							</div>
							<div class="form-group">
								<label for="subject"><span class="FieldInfo">Supplier Id:</span></label>
								<input type="text" class="form-control" name="supId" id="supId" value="<?php echo $displaySupId; ?>" readonly>
							</div>
							<div class="form-group">
								<label for="subject"><span class="FieldInfo">Email:</span></label>
								<input type="email" class="form-control" name="email" id="email" value="<?php echo $displayEmail; ?>" readonly>
							</div>
							<div class="form-group">
								<label for="deadline"><span class="FieldInfo">Laycan 01:</span></label>
								<div class="custom-file">
									<input class="form-control" type="datetime-local" name="laycan1" id="laycan1">
								</div>
							</div>
							<div class="form-group">
								<label for="subject"><span class="FieldInfo">Quantity for Laycan 01:</span></label>
								<input type="number" class="form-control" name="qty1" id="qty1" value="">
							</div>
							<div class="form-group">
								<label for="deadline"><span class="FieldInfo">Laycan 02:</span></label>
								<div class="custom-file">
									<input class="form-control" type="datetime-local" name="laycan2" id="laycan2">
								</div>
							</div>
							<div class="form-group">
								<label for="subject"><span class="FieldInfo">Quantity for Laycan 02:</span></label>
								<input type="number" class="form-control" name="qty2" id="qty2" value="">
							</div>
							<div class="form-group">
								<label for="deadline"><span class="FieldInfo">Laycan 03:</span></label>
								<div class="custom-file">
									<input class="form-control" type="datetime-local" name="laycan3" id="laycan3">
								</div>
							</div>
							<div class="form-group">
								<label for="subject"><span class="FieldInfo">Quantity for Laycan 03:</span></label>
								<input type="number" class="form-control" name="qty3" id="qty3" value="">
							</div>
							<div class="row pt-2">
								<div class="col-lg-6">
									<a href="viewSelectedBidderT.php" class="btn btn-block btn-warning">Back To Dashboard</a>
								</div>
								<div class="col-lg-6">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Send</button>
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