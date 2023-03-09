<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>

<?php
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$to = $email;
	$mail_subject = $subject;
	$email_body = $message;
	$header = "From: {$email}\r\nContent-Type: text/html;";

	$send_email_results = mail($to,$mail_subject,$email_body,$header);

	if ($send_email_results){
		$_SESSION['SuccessMessage'] = "Successfully Sent";
		RedirectTo("inquery.php");
	}else{
		$_SESSION['ErrorMessage'] = "Something Went Wrong";
		RedirectTo("inquery.php");
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

	<title>Inquery</title>
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
					<a href="#" class="nav-link">About Us</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Procurement</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Registration</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Contact Us</a>
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
					<h5 class="text-center">Inquery</h5>
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
				<form class="" action="inquery.php" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="subject"><span class="FieldInfo">Email:</span></label>
								<input type="email" class="form-control" name="email" id="email">
							</div>
							<div class="form-group">
								<label for="subject"><span class="FieldInfo">Subject:</span></label>
								<input type="text" class="form-control" name="subject" id="subject">
							</div>
							<div>
								<label for="message"><span class="FieldInfo">Message:</span></label>
								<textarea class="form-control" name="message" rows="6" cols="80"></textarea>
							</div>
							<div class="row pt-2">
								<div class="col-lg-6">
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