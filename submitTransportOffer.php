<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
$searchQueryParameter = $_GET['id'];
if (isset($_POST['submit'])) {
	$total = 0;
	$procId = $_POST['procId'];
	$qty = $_POST['qty'];
	$unitPrice = $_POST['unitPrice'];
	$addressComission = $_POST['addCom'];
	$username = $_POST['userId'];
	$password = $_POST['password'];

	$results = "Pending";

	date_default_timezone_set("Asia/Colombo");
	$currentTime=time();
	$datetime = strftime("%Y-%m-%dT%H:%M",$currentTime);

	if (empty($unitPrice)||empty($addressComission)||empty($username)||empty($password)) {
		$_SESSION['ErrorMessage'] = "Please Fill the All Fields";
		RedirectTo("home.php");
	}elseif (cheakDuplicateTransOffer($procId,$username)) {
		$_SESSION['ErrorMessage'] = "Already Offered";
		RedirectTo("home.php");
	}else{
		$total = $qty * ($unitPrice + $addressComission);
		$foundAccount = login_atempt_vesselSupplier($username,$password);
		if ($foundAccount) {
			global $ConnectingDB;
			$status = $foundAccount['status'];

			if(strcmp($status,"Approved") == 0){
			
			$sql = "INSERT INTO offertrans(supId,procId,datetime,qty,unitprice,addcom,total,results)";
			$sql .= "VALUES(:supId,:procId,:datetime,:qty,:unitprice,:addcom,:total,:results)";
			$stmt = $ConnectingDB->prepare($sql);

			$stmt->bindValue(':supId',$username);
			$stmt->bindValue(':procId',$procId);
			$stmt->bindValue(':datetime',$datetime);
			$stmt->bindValue(':qty',$qty);
			$stmt->bindValue(':unitprice',$unitPrice);
			$stmt->bindValue(':addcom',$addressComission);
			$stmt->bindValue(':total',$total);
			$stmt->bindValue(':results',$results);
		
			$Execute = $stmt->execute();
				if($Execute){
				$_SESSION["SuccessMessage"] = "Successfully Offered";
				RedirectTo("home.php");
				}else{
				$_SESSION["SErrorMessage"] = "Something Wrong..!";
				RedirectTo("home.php");
				}
			}else{
			$_SESSION["ErrorMessage"] = "Rejected Supplier";
			RedirectTo("home.php");
			}
			
		}else{
			$_SESSION['ErrorMessage'] = "Invalid Credentials";
			RedirectTo("home.php");
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

	<title>Submit Coal Transport Offer</title>
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
	<header class="text-white bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h5 class="text-center">Submit Coal Transport Offer</h5>
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

				global $ConnectingDB;
				$sql = "SELECT * FROM procurement WHERE id='$searchQueryParameter'";
				$stmt = $ConnectingDB->query($sql);
				while ($dataRaws=$stmt->fetch()) {
					$displayProcId = $dataRaws['procId'];
					$displayQty = $dataRaws['qty'];
				}
				?>

				<form class="" action="submitTransportOffer.php?id=<?php echo $searchQueryParameter; ?>" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="title"><span class="FieldInfo">Procurement Id:</span></label>
								<input type="text" class="form-control" name="procId" id="procId" value="<?php echo $displayProcId; ?>" readonly>
							</div>
							<div class="form-group">
								<label for="quantity"><span class="FieldInfo">Coal Quantity in MT:</span></label>
								<input type="text" class="form-control" name="qty" id="qty" value="<?php echo $displayQty; ?>" readonly>
							</div>
							<div class="form-group">
								<label for="quantity"><span class="FieldInfo">Offer for 1MT Coal in USD: </span></label>
								<input type="number" class="form-control" name="unitPrice" id="unitPrice" value="">
							</div>
							<div class="form-group">
								<label for="quantity"><span class="FieldInfo">Address Commision: </span></label>
								<input type="number" class="form-control" name="addCom" id="addCom" value="">
							</div>
							<div class="form-group">
								<label for="quantity"><span class="FieldInfo">User Id: </span></label>
								<input type="text" class="form-control" name="userId" id="userId" value="">
							</div>
							<div class="form-group">
								<label for="quantity"><span class="FieldInfo">Password: </span></label>
								<input type="Password" class="form-control" name="password" id="password" value="">
							</div>
							<div class="row">
								<div class="col-lg-6">
									<a href="home.php" class="btn btn-block btn-warning">Back To Home</a>
								</div>
								<div class="col-lg-6">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Offer</button>
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