<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    
      <script
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBETTpF2jPDcy6Ga5TVl_EkCsg3DQevBMo &callback=initMap" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link  rel="stylesheet" href="CSS/bootstrap.min.css">
     <link  rel="stylesheet" href="CSS/style1.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="js/script1.js"></script>
<script src="js/script.js"></script>   
    <title>Cite</title>
</head>
 
<body>
    <div id="map" class="ui-widget-content">
    </div>
	<h3>To participate in the conference, please fill out the form</h3>
	<form  id="form1" method="post">
		<div class="form-group">
			<label for="FirstName">First Name:</label>
			<input type="text" class="form-control" maxlength="25" id="FirstName">  
		</div>
   		<div class="form-group">
			<label for="LastName">Last Name:</label>
			<input type="text" class="form-control" maxlength="25"  id="LastName">  
		</div>
   		<div class="form-group">
			<label for="ReportSubject">ReportSubject:</label>
			<input type="text" class="form-control" id="ReportSubject" maxlength="35"> 
		</div>
   	 	<div class="ui-widget">
			<label for="datep">Birthday: </label>
			<input id="datep" />
       </div>
     	<div class="form-group">
		  <label for="Country">Country: </label>
		  <select class="browser-default custom-select" id="Country">
			  <option selected>Argentina</option>
			  <option>Belgium</option>
			  <option>Canada</option>
			  <option>Denmark</option>
			  <option>Germany</option>
		   </select>
		</div>
		<div class="form-group">
			<label for="phone" maxlength="10">Phone number in format 1(555)555-5555 </label>
			<input type="tel" id="phone">		
       </div>
       <div class="form-group">
			<label for="Login">email </label>
			<input type="email" id="email" maxlength="50">		
       </div>
       <p><input type="button" value="Next"  onclick="NewUserAdd()"></p>
	</form>
	<div id="result"></div> 
		<?php 
	if(isset($_SESSION['Email'])) 
	{
		include_once('PHP/form2.php');
	}

	?>
	
	</body>

</html>