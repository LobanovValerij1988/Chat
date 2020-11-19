<?php
$path ='my.config';
function getURL() 
{
global $path;
	try
	{
$file=fopen($path,'r'); 
while($line=fgets($file))
{
	$readname=substr($line,0,strpos($line,':'));  
	if($readname == "URL"  ) 
	{
	fclose($file); 	
	return 	trim(substr($line,strpos($line,':')+1));
	}
}
		fclose($file); 
	return "URL was not found";
	}
	catch(Exception $e)
	{
	return false;
	}

}
function getMesssage($citeName)
{
global $path;
	try
	{
$file=fopen($path,'r'); 
while($line=fgets($file))
{
	$readname=substr($line,0,strpos($line,':'));  
	if($readname==$citeName) 
	{
		fclose($file); 	
	   return trim(substr($line,strpos($line,':')+1));
	}
	
}
		return "Message was not found";
		fclose($file); 	
	}
	catch(Exception $e)
	{
	return false;
	}
}


?>