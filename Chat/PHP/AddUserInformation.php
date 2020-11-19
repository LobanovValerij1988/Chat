<?php
session_start();
include_once('functions.php');
include_once('classes.php');
if(!isset($_SESSION['Email']))
{
echo "<h3><span style='color:red;'> Email was not defined  reload page and fill in form 1  </span><h3/>";
return false;
}
else
{
	
	if(is_uploaded_file($_FILES['photo']['tmp_name']))
	{
		 move_uploaded_file($_FILES['photo']['tmp_name'],    "../images/".$_FILES['photo']['name']);
		
	}
		if( Tools::changeInformation($_SESSION['Email'],$_POST['Company'],$_POST['Position'],$_POST['aboutMe'],$_FILES['photo']['name']))
		{
			$URL=getURL();
	        $MESSAGE=getMesssage("twitter");
	
		echo  "<a onclick=\" Share.facebook('','Check out this Meetup with SoCal AngularJS')\"><img src='icons/facebook.png' width='50'  height='50' alt='Facebook'></a>
		<a onclick=\"Share.twitter('$URL','$MESSAGE')\"><img src='icons/twit.png' width='50'  height='50' alt='twitter'></a>
		<p><a href='PHP/ShowAllUsers.php'> All members</a></p>";
		}


}
?> 