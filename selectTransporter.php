<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>
<?php require_once("fpdf182/fpdf.php");?>

<?php
	if (isset($_POST['print'])) {

		$pdf = new FPDF();
		$pdf->AddPage();
		$searchQueryParameter = $_GET['id'];
		global $ConnectingDB;
		$sql = "SELECT * FROM offertrans
		INNER JOIN procurement
		ON offertrans.procId=procurement.procId
		INNER JOIN vesselsupplier
		ON offertrans.supId=vesselsupplier.supId WHERE offertrans.id = '$searchQueryParameter'";
		$stmt = $ConnectingDB->query($sql);

		$pdf->SetFont('Times','B',15);
		$pdf->Cell(40,6,'Details of Awarded Coal Transport Procurement',0,1);
		$pdf->Ln(5);

		$pdf->SetFont('Times','',10);
	
		$pdf->SetFont('Times','',10);
		while ($dataRaws = $stmt->fetch()) {
			$pdf->Cell(60,6,'Proc Id',1,0);
			$pdf->Cell(60,6,$dataRaws['procId'],1,1);
			$pdf->Cell(60,6,'Proc Name',1,0);
			$pdf->Cell(60,6,$dataRaws['title'],1,1);
			$pdf->Cell(60,6,'Sup Id',1,0);
			$pdf->Cell(60,6,$dataRaws['supId'],1,1);
			$pdf->Cell(60,6,'Sup Name',1,0);
			$pdf->Cell(60,6,$dataRaws['cName'],1,1);
			$pdf->Cell(60,6,'Email',1,0);
			$pdf->Cell(60,6,$dataRaws['email'],1,1);
			$pdf->Cell(60,6,'Quantity In MT',1,0);
			$pdf->Cell(60,6,$dataRaws['qty'],1,1);
			$pdf->Cell(60,6,'Unit Price (USD)',1,0);
			$pdf->Cell(60,6,$dataRaws['unitprice'],1,1);
			$pdf->Cell(60,6,'Address Comission (USD)',1,0);
			$pdf->Cell(60,6,$dataRaws['addcom'],1,1);
			$pdf->Cell(60,6,'Total Price (USD)',1,0);
			$pdf->Cell(60,6,$dataRaws['total'],1,1);
		}

		$pdf->Ln(5);
		$pdf->SetFont('Arial','I',10);
		$date = date("F j, Y");
		$pdf->Cell(30,6,'Report Date: '.$date,0,1);

		$pdf->Output('D','Selected Bidder.pdf');
	}
	?>

<?php
$searchQueryParameter = $_GET['id'];
if (isset($_POST['submit'])) {
	$approved = $_POST['approved'];
	
		global $ConnectingDB;
		$sql = "UPDATE offertrans SET results='$approved' WHERE id='$searchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);

		if($Execute){
			$_SESSION["SuccessMessage"] = "Successfully Selected";
			RedirectTo("viewTransportOffer.php");
		}else{
			$_SESSION["ErrorMessage"] = "Something Wrong..!";
			RedirectTo("viewTransportOffer.php");
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

	<title>Select Transporter</title>
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
					<h5 class="text-center">Award Transport Tender</h5>
				</div>
			</div>
		</div>
	</header>
	<div style="height:5px; background: gray;"></div>

	<!--Main Area-->
	<section class="container py-2 mb-1">
		<div class="row">
			<div class="offset-lg-3 col-lg-6">

				<form class="" action="selectTransporter.php?id=<?php echo $searchQueryParameter; ?>" method="Post" enctype="multipart/form-data">
					<div class="card mb-2" style="border-color:black;">
						<div class="card-body">
							<div class="form-group">
								<label for="type"><span class="FieldInfo">Decision:</span></label>
								<select class="form-control" id="approved" name="approved">
									<option value="Approved">Approved</option>
									<option value="Not Approved">Not Approved</option>
								</select>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<a href="viewTransportOffer.php" class="btn btn-block btn-warning">Back</a>
								</div>
								<div class="col-lg-4">
									<button type="submit" name="submit" class="btn btn-block btn-primary">Awarded</button>
								</div>
								<div class="col-lg-4">
									<button type="print" name="print" class="btn btn-block btn-primary">Print Details</button>
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