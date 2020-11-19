<?php
session_start();
include_once('classes.php');

	if(Tools::register($_POST['FirstName'] ,$_POST['LastName'],$_POST['ReportSubject'], $_POST['Birthday'],$_POST['Country'],$_POST['Phone'],$_POST['Email']))

{
	$_SESSION['Email']=$_POST['Email'];
	echo'<div class="text-success">User was added Successfull </div>';
	include_once('form2.php');
}
else
{
	unset($_SESSION['Email']); 
	
}
?> 
