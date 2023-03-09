<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
if (isset($_POST['submit'])) {
	$companyName = $_POST['company'];
	$address = $_POST['address'];
	$telephone = $_POST['telephone'];
	$fax = $_POST['fax'];
	$email = $_POST['email'];
	$vessel = $_POST['vessel'];
	$qty = $_POST['qty'];
	$experience = $_POST['experience'];

	$experienceDoc = $_FILES['experienceDoc']['name'];
	$target1="file/".basename($_FILES["experienceDoc"]["name"]);

	$companyReg = $_FILES['companyRegistration']['name'];
	$target2="file/".basename($_FILES["companyRegistration"]["name"]);

	$finStmt = $_FILES['financial']['name'];
	$target2="file/".basename($_FILES["financial"]["name"]);

	$status = "Pending";
	$type = "Coal Transport";
	date_default_timezone_set("Asia/Colombo");
	$currentTime=time();
	$datetime = strftime("%Y-%m-%dT%H:%M",$currentTime);

	$password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@#$"),0,8);

	if (empty($companyName)||empty($address)||empty($telephone)||empty($fax)||empty($email)||empty($qty)||empty($vessel)||empty($experienceDoc)||empty($companyReg)||empty($finStmt)) {
		$_SESSION['ErrorMessage'] = "Please Fill the All Fields";
		RedirectTo("coalTransRegForm.php");
	}elseif(!is_numeric($telephone)) {
		$_SESSION['ErrorMessage'] = "Please Insert Numbers";
		RedirectTo("coalTransRegForm.php");
	}elseif(!is_numeric($fax)) {
		$_SESSION['ErrorMessage'] = "Please Insert Numbers";
		RedirectTo("coalTransRegForm.php");
	}else{
		global $ConnectingDB;
		$sql = "INSERT INTO vesselsupplier(cName,address,telephone,fax,email,vessel,coalSupply,experience,exDoc,regDoc,finDoc,datetime,type,status,password)";
		$sql .= "VALUES(:cName,:address,:telephone,:fax,:email,:vessel,:coalSupply,:experience,:exDoc,:regDoc,:finDoc,:datetime,:type,:status,:password)";
		$stmt = $ConnectingDB->prepare($sql);

		$stmt->bindValue(':cName',$companyName);
		$stmt->bindValue(':address',$address);
		$stmt->bindValue(':telephone',$telephone);
		$stmt->bindValue(':fax',$fax);
		$stmt->bindValue(':email',$email);
		$stmt->bindValue(':vessel',$vessel);
		$stmt->bindValue(':coalSupply',$qty);
		$stmt->bindValue(':experience',$experience);
		$stmt->bindValue(':exDoc',$experienceDoc);
		$stmt->bindValue(':regDoc',$companyReg);
		$stmt->bindValue(':finDoc',$finStmt);
		$stmt->bindValue(':datetime',$datetime);
		$stmt->bindValue(':type',$type);
		$stmt->bindValue(':status',$status);
		$stmt->bindValue(':password',$password);

		$Execute = $stmt->execute();

		move_uploaded_file($_FILES["experienceDoc"]["tmp_name1"],$experienceDoc);
		move_uploaded_file($_FILES["companyRegistration"]["tmp_name2"],$companyReg);
		move_uploaded_file($_FILES["financial"]["tmp_name3"],$finStmt);

		if($Execute){
			$_SESSION["SuccessMessage"] = "Successfully Submitted";
			RedirectTo("coalTransRegForm.php");
		}else{
			$_SESSION["SErrorMessage"] = "Something Wrong..!";
			RedirectTo("coalTransRegForm.php");
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

	<title>Coal Transporter Registration</title>
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
					<h5 class="text-center">Coal Transporter Registration</h5>
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
				<form class="" action="coalTransRegForm.php" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="address"><span class="FieldInfo">Name of the Company:</span></label>
								<input type="text" class="form-control" name="company" id="company">
							</div>
							<div class="form-group">
								<label for="address"><span class="FieldInfo">Address:</span></label>
								<input type="text" class="form-control" name="address" id="address">
							</div>
							<div class="form-group">
								<label for="telephone"><span class="FieldInfo">Telephone:</span></label>
								<input type="text" class="form-control" name="telephone" id="telephone" placeholder="">
							</div>
							<div class="form-group">
								<label for="fax"><span class="FieldInfo">Fax:</span></label>
								<input type="text" class="form-control" name="fax" id="fax" placeholder="">
							</div>
							<div class="form-group">
								<label for="email"><span class="FieldInfo">Email:</span></label>
								<input type="email" class="form-control" name="email" id="email" placeholder="Ex: example@example.com">
							</div>
							<div class="form-group">
								<label for="coal supply"><span class="FieldInfo">Number of Vessels:</span></label>
								<input type="number" class="form-control" name="vessel" id="vessel">
							</div>
							<div class="form-group">
								<label for="quantity"><span class="FieldInfo">Do You Transport Above 1,000,000 MT Coal Supply for International Market Since 2021:</span></label>
								<select class="form-control" id="qty" name="qty">
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
							<div class="form-group">
								<label for="Experiences"><span class="FieldInfo">Experience of Coal Transport for International Market:</span></label>
								<select class="form-control" id="experience" name="experience">
									<option value="0" checked>No Experinces</option>
									<option value="1">1 Year</option>
									<option value="2">2 Years</option>
									<option value="3">3 Years</option>
									<option value="4">4 Years</option>
									<option value="5">5 Years</option>
									<option value="Above 5 Years">Above 5 Years</option>
								</select>
							</div>
							<div class="form-group">
								<label for="Experiences"><span class="FieldInfo">Add Experiences Details:</span></label>
								<div class="custom-file">
									<input class="custom-file-input" type="File" name="experienceDoc" id="experienceDoc" value="">
									<label for="selectDocument" class="custom-file-label">Select Document</label>
								</div>
							</div>
							<div class="form-group">
								<label for="Company Registration"><span class="FieldInfo">Add Company Registration Details:</span></label>
								<div class="custom-file">
									<input class="custom-file-input" type="File" name="companyRegistration" id="companyRegistration" value="">
									<label for="selectDocument" class="custom-file-label">Select Document</label>
								</div>
							</div>
							<div class="form-group">
								<label for="Company Registration"><span class="FieldInfo">Add Last 3 Years Financial Statsments:</span></label>
								<div class="custom-file">
									<input class="custom-file-input" type="File" name="financial" id="financial" value="">
									<label for="selectDocument" class="custom-file-label">Select Document</label>
								</div>
							</div>
							<div class="form-group">
								<input type="checkbox" name="" required><span class="FieldInfo"> <small>Agree to Term & Conditions Stipulated in the Registration Documents</small></span></label>
							</div>
							<div class="row">
								<div class="col-lg-6">
								</div>
								<div class="col-lg-6">
									<button type="submit" style="border-color:black;" name="submit" class="btn btn-block btn-primary">Register</button>
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