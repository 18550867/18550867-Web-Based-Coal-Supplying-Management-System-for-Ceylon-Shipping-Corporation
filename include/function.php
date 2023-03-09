<?php require_once("include/db.php");?>

<?php
function RedirectTo($New_Location){
	header("Location:".$New_Location);
	exit;
}

function cheakDuplicateEmail($email){
	global $ConnectingDB;
	$sql = "SELECT email FROM user WHERE email=:email";
	$stmt = $ConnectingDB->prepare($sql);
	$stmt->bindValue(':email',$email);
	$stmt->execute();
	$result = $stmt->rowcount();
	if ($result==1) {
		return true;
	}else{
		return false;
	}
}


function login_atempt($userId,$password){
	global $ConnectingDB;
	$sql = "SELECT * FROM user WHERE userId=:username AND password=:password LIMIT 1";
	$stmt = $ConnectingDB->prepare($sql);
	$stmt->bindValue(':username',$userId);
	$stmt->bindValue(':password',$password);
	$stmt->execute();
	$result = $stmt->rowcount();

	if($result==1){
		return $foundAccount=$stmt->fetch();
	}else{
		return null;
	}
}

function login_atempt_vesselSupplier($supId,$password){
	global $ConnectingDB;
	$sql = "SELECT * FROM vesselsupplier WHERE supId=:username AND password=:password LIMIT 1";
	$stmt = $ConnectingDB->prepare($sql);
	$stmt->bindValue(':username',$supId);
	$stmt->bindValue(':password',$password);
	$stmt->execute();
	$result = $stmt->rowcount();

	if($result==1){
		return $foundAccount=$stmt->fetch();
	}else{
		return null;
	}
}

function cheakDuplicateTransOffer($procId,$supId){
	global $ConnectingDB;
	$sql = "SELECT procId,supId FROM offertrans WHERE procId=:procId AND supId=:supId";
	$stmt = $ConnectingDB->prepare($sql);
	$stmt->bindValue(':procId',$procId);
	$stmt->bindValue(':supId',$supId);
	$stmt->execute();
	$result = $stmt->rowcount();
	if ($result==1) {
		return true;
	}else{
		return false;
	}
}
?>


