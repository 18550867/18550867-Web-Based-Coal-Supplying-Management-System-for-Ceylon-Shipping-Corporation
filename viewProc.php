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
		$pdf->Cell(35,6,'Document',1,1);
	
		$pdf->SetFont('Times','',9);
		while ($dataRaws = $stmt->fetch()) {
			$pdf->Cell(20,6,$dataRaws['procId'],1,0);
			$pdf->Cell(50,6,$dataRaws['title'],1,0);
			$pdf->Cell(25,6,$dataRaws['type'],1,0);
			$pdf->Cell(15,6,$dataRaws['qty'],1,0,'R');
			$pdf->Cell(27,6,$dataRaws['datetime'],1,0);
			$pdf->Cell(27,6,$dataRaws['deadline'],1,0);
			$pdf->Cell(35,6,$dataRaws['document'],1,1);
		}

		$pdf->Ln(5);
		$pdf->SetFont('Arial','I',10);
		$date = date("F j, Y");
		$pdf->Cell(30,6,'Report Date: '.$date,0,1);

		$pdf->Output('D','Published Procurements.pdf');
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

	<title>View Procurement</title>
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
					<a href="addProc.php" class="btn btn-dark btn-block" style="border-color:white;">Add New Procurement</a>
				</div>
				<div class="col-lg-4 p-2">
					<form class="" action="viewProc.php" method="Post" enctype="multipart/form-data">
						<button type="print" style="border-color:white;" name="print" id="print" class="btn btn-dark btn-block">Print</button>
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
					<h5 class="text-center">View Procurement</h5>
				</div>
			</div>
			<div class="col-lg-12">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th>Proc Id</th>
						<th>Title</th>
						<th>Type</th>
						<th>Quantity
						<th>Publish Date</th>
						<th>Deadline</th>
						<th>Document</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					</thead>
					<?php
					global $ConnectingDB;
					$sql = "SELECT * FROM procurement";
					$stmt = $ConnectingDB->query($sql);
					$sr=0;
					while ($dataRaws = $stmt->fetch()) {
						$id = $dataRaws["id"];
						$procId = $dataRaws["procId"];
						$title = $dataRaws["title"];
						$type = $dataRaws["type"];
						$qty = $dataRaws["qty"];
						$datetime = $dataRaws["datetime"];
						$deadline = $dataRaws["deadline"];
						$document = $dataRaws["document"];
						$sr++;
					?>
					<tbody>
					<tr>
						<td><?php echo $sr; ?></td>
						<td><?php echo $procId; ?></td>
						<td><?php if (strlen($title)>15){$title = substr($title,0,10).'...';}
						 	echo $title; ?></td>
						<td><?php echo $type; ?></td>
						<td><?php echo $qty; ?></td>
						<td><?php if (strlen($datetime)>15){$datetime = substr($datetime,0,10).'...';}
						 	echo $datetime; ?></td>
						<td><?php if (strlen($deadline)>15){$deadline = substr($deadline,0,10).'...';}
						 	echo $deadline; ?></td>
						<td><?php if (strlen($document)>15){$document = substr($document,0,10).'...';}
						 	echo $document; ?></td>
						<td><a href="editProc.php?id=<?php echo $id;?>"><span class="btn bg-warning">Edit</span></a></td>
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