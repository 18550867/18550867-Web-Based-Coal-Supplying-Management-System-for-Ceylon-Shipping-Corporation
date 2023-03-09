<?php
session_start();

function ErrorMessage(){
	if(isset($_SESSION["ErrorMessage"])){
		$outout = "<div class=\"alert alert-danger text-center\">";
		$outout .= htmlentities($_SESSION["ErrorMessage"]);
		$outout .= "</div";
		$_SESSION["ErrorMessage"] = null;
		return $outout;
	}
}

function SuccessMessage(){
	if(isset($_SESSION["SuccessMessage"])){
		$outout = "<div class=\"alert alert-success text-center\">";
		$outout .= htmlentities($_SESSION["SuccessMessage"]);
		$outout .= "</div";
		$_SESSION["SuccessMessage"] = null;
		return $outout;
	}
}
?>