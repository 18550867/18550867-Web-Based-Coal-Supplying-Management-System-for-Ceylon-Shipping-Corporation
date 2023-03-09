<?php require_once("include/db.php");?>
<?php require_once("include/function.php");?>
<?php require_once("include/session.php");?>
<?php require_once("fpdf182/fpdf.php");?>

<?php
	if (isset($_POST['print'])) {

		$pdf = new FPDF();
		$pdf->AddPage();
		
		global $ConnectingDB;
		$sql = "SELECT * FROM vesselsupplier WHERE status='Approved'";
		$stmt = $ConnectingDB->query($sql);

		$pdf->SetFont('Times','B',15);
		$pdf->Cell(27,6,'Summary of Approved Transporter',0,1);
		$pdf->Ln(5);

		$pdf->SetFont('Times','B',9);
		$pdf->Cell(20,6,'Sup Id',1,0);
		$pdf->Cell(40,6,'Name',1,0);
		$pdf->Cell(50,6,'Email',1,0);
		$pdf->Cell(25,6,'Vessel',1,1);
	
		$pdf->SetFont('Times','',9);
		while ($dataRaws = $stmt->fetch()) {
			$pdf->Cell(20,6,$dataRaws['supId'],1,0);
			$pdf->Cell(40,6,$dataRaws['cName'],1,0);
			$pdf->Cell(50,6,$dataRaws['email'],1,0);
			$pdf->Cell(25,6,$dataRaws['vessel'],1,1);
		}

		$pdf->Ln(5);
		$pdf->SetFont('Arial','I',10);
		$date = date("F j, Y");
		$pdf->Cell(30,6,'Report Date: '.$date,0,1);

		$pdf->Output('D','Eligibal Transporter.pdf');
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

	<title>View Coal Transporter</title>
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
				<div class="col-lg-4 p-2">
					<form class="" action="viewTransSup.php" method="Post" enctype="multipart/form-data">
						<button type="print" style="border-color:white;" name="print" id="print" class="btn btn-dark btn-block">Print Approved Transporters</button>
					</form>
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
					<h5 class="text-center">View Applied Coal Transporters</h5>
				</div>
			</div>
			<div class="col-lg-12">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th>Sup Id</th>
						<th>Company Name</th>
						<th>Telephone</th>
						<th>Applied Date</th>
						<th>Status</th>
						<th>View</th>
						<th>Delete</th>
					</tr>
					</thead>
					<?php
					global $ConnectingDB;
					$sql = "SELECT * FROM vesselsupplier";
					$stmt = $ConnectingDB->query($sql);
					$sr=0;
					while ($dataRaws = $stmt->fetch()) {
						$id = $dataRaws["id"];
						$supId = $dataRaws["supId"];
						$company = $dataRaws["cName"];
						$telephone = $dataRaws["telephone"];
						$datetime = $dataRaws["datetime"];
						$status = $dataRaws["status"];
						$sr++;
					?>
					<tbody>
					<tr>
						<td><?php echo $sr; ?></td>
						<td><?php echo $supId; ?></td>
						<td><?php if (strlen($company)>15){$company = substr($company,0,10).'...';}
						 	echo $company; ?></td>
						 <td><?php echo $telephone; ?></td>
						<td><?php if (strlen($datetime)>15){$datetime = substr($datetime,0,10).'...';}
						 	echo $datetime; ?></td>
						 <td><?php echo $status; ?></td>
						<td><a href="checkCoalTransporter.php?id=<?php echo $id;?>"><span class="btn bg-warning">View</span></a></td>
						<td><a href="deleteProc.php?id=<?php echo $id;?>"><span class="btn bg-danger">Delete</span></a></td>
					</tr>
					<tbody>
					<?php } ?>
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