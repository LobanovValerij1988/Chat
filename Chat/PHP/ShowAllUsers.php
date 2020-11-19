<!DOCTYPE html>
<html lang="en">
 
<head>
    
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     <link  rel="stylesheet" href="../CSS/bootstrap.min.css">
     <link  rel="stylesheet" href="../CSS/style1.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> 
  <title>AllUsers</title>
</head>
 
<body>
   <?php
include_once('classes.php');
Tools::GetAllUsers();
	?>
</body>
</html>