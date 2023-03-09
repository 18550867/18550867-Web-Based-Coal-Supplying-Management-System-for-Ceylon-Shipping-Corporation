<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>
<?php require_once("fpdf182/fpdf.php");?>

<?php
	if (isset($_POST['print'])) {

		$pdf = new FPDF();
		$pdf->AddPage();
		
		global $ConnectingDB;
		$sql = "SELECT * FROM procurement";
		$stmt = $ConnectingDB->query($sql);

		$pdf->SetFont('Times','B',15);
		$pdf->Cell(27,6,'Summary of Published Procurement',0,1);
		$pdf->Ln(5);

		$pdf->SetFont('Times','B',9);
		$pdf->Cell(20,6,'Proc Id',1,0);
		$pdf->Cell(50,6,'Title',1,0);
		$pdf->Cell(25,6,'Type',1,0);
		$pdf->Cell(15,6,'Quantity',1,0);
		$pdf->Cell(27,6,'Published On',1,0);
		$pdf->Cell(27,6,'Deadline',1,0);
		$pdf->Cell(40,6,'Document',1,1);
	
		$pdf->SetFont('Times','',9);
		while ($dataRaws = $stmt->fetch()) {
			$pdf->Cell(20,6,$dataRaws['procId'],1,0);
			$pdf->Cell(50,6,$dataRaws['title'],1,0);
			$pdf->Cell(25,6,$dataRaws['type'],1,0);
			$pdf->Cell(15,6,$dataRaws['qty'],1,0,'R');
			$pdf->Cell(27,6,$dataRaws['datetime'],1,0);
			$pdf->Cell(27,6,$dataRaws['deadline'],1,0);
			$pdf->Cell(40,6,$dataRaws['document'],1,1);
		}

		$pdf->Ln(5);
		$pdf->SetFont('Arial','I',10);
		$date = date("F j, Y");
		$pdf->Cell(30,6,'Report Date: '.$date,0,1);

		$pdf->Output('D','Published Procurements.pdf');
	}
	?>

<?php
$searchQueryParameter = $_GET['id'];
if (isset($_POST['approved'])) {
	$updateStatus = "Approved";

		global $ConnectingDB;
		$sql = "UPDATE coalsupplier SET status='$updateStatus' WHERE id='$searchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);


		if($Execute){
			$_SESSION["SuccessMessage"] = "Successfully Approved";
			RedirectTo("viewCoalSup.php");
		}else{
			$_SESSION["ErrorMessage"] = "Something Wrong..!";
			RedirectTo("viewCoalSup.php");
		}
}

if (isset($_POST['reject'])) {
	$updateStatus = "Rejected";

		global $ConnectingDB;
		$sql = "UPDATE coalsupplier SET status='$updateStatus' WHERE id='$searchQueryParameter'";
		$Execute = $ConnectingDB->query($sql);


		if($Execute){
			$_SESSION["SuccessMessage"] = "Successfully Rejected";
			RedirectTo("viewCoalSup.php");
		}else{
			$_SESSION["ErrorMessage"] = "Something Wrong..!";
			RedirectTo("viewCoalSup.php");
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

	<title>Check Call Supplier Qualification</title>
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
				<div class="col-lg-4 p-2">
					<a href="dashPManager.php" class="btn btn-dark btn-block" style="border-color:white;">Back to Dashboad</a>
				</div>
				<div class="col-lg-4 p-2">
					
				</div>
			</div>
		</div>
	</header>
	<div style="height:5px; background: gray;"></div>

	<!--Main Area-->
	<section class="container py-2 mb-1">
		<div class="row">
			<div class="col-lg-12">
			<div>
				<?php 
				echo ErrorMessage();
				echo SuccessMessage();
				?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h5 class="text-center">Check Applied Coal Suppliers's Individual Details</h5>
				</div>
			</div>
			<div class="offset-lg-2 col-lg-8">
				<table class="table table-striped table-hover table-bordered">
					<?php
					global $ConnectingDB;
					$sql = "SELECT * FROM coalsupplier WHERE id='$searchQueryParameter'";
					$stmt = $ConnectingDB->query($sql);
					$sr=0;
					while ($dataRaws = $stmt->fetch()) {
						$id = $dataRaws["id"];
						$supId = $dataRaws["supId"];
						$company = $dataRaws["cName"];
						$address = $dataRaws["address"];
						$telephone = $dataRaws["telephone"];
						$fax = $dataRaws["fax"];
						$email = $dataRaws["email"];
						$port = $dataRaws["port"];
						$qty = $dataRaws["coalSupply"];
						$experience = $dataRaws["experience"];
						$exDoc = $dataRaws["exDoc"];
						$regDoc = $dataRaws["regDoc"];
						$finDoc = $dataRaws["finDoc"];
						$datetime = $dataRaws["datetime"];
						$status = $dataRaws["status"];
						$sr++;
					}
					?>
					<tbody>
					<tr>
						<td>Sup Id: </td>
						<td><?php echo $supId; ?></td>
					</tr>
					<tr>
						<td>Company Name: </td>
						<td><?php echo $company; ?></td>
					</tr>
					<tr>
						<td>Address: </td>
						<td><?php echo $address; ?></td>
					</tr>
					<tr>
						<td>Telephone: </td>
						<td><?php echo $telephone; ?></td>
					</tr>
					<tr>
						<td>Fax: </td>
						<td><?php echo $fax; ?></td>
					</tr>
					<tr>
						<td>Email: </td>
						<td><?php echo $email; ?></td>
					</tr>
					<tr>
						<td>Port: </td>
						<td><?php echo $port; ?></td>
					</tr>
					<tr>
						<td>1,000,000 MT Coal Supply: </td>
						<td><?php echo $qty; ?></td>
					</tr>
					<tr>
						<td>Experience: </td>
						<td><?php echo $experience; ?></td>
					</tr>
					<tr>
						<td>Experience Documents: </td>
						<td><a href="file/<?php echo $exDoc; ?>" target="_blank">
							<span>View Document</span>
						</a></td>
					</tr>
					<tr>
						<td>Company Registration Documents: </td>
						<td><a href="file/<?php echo $regDoc; ?>" target="_blank">
							<span>View Document</span>
						</a></td>
					</tr>
					<tr>
						<td>Financial Statsments: </td>
						<td><a href="file/<?php echo $finDoc; ?>" target="_blank">
							<span>View Document</span>
						</a></td>
					</tr>
					<tr>
						<td>Submit date and time: </td>
						<td><?php echo $datetime; ?></td>
					</tr>
					<tr>
					<form class="" action="checkCoalSupplier.php?id=<?php echo $searchQueryParameter; ?>" method="Post" enctype="multipart/form-data">
							<td>Status: </td>
							<td><input type="text"class="form-control" name="updateStatus" id="updateStatus" value="<?php echo $status; ?>" disabled></td>
					</tr>
					<tr>
						<td><button type="submit" name="reject" class="btn btn-block btn-danger">Reject</button></td>
						<td><button type="submit" name="approved" class="btn btn-block btn-primary">Approve</button></td>
					</tr>
					<tr>
						<td colspan="2"><a href="viewCoalSup.php"><span class="btn bg-warning">Back</span></a></td>
					</tr>
					<tbody>
				</table>
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