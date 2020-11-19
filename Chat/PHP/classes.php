<?php 
class Tools 
{
	static function connect(
	$host="localhost",
	$user="root",
	$pass="root",
	$dbname="dbchat")
	{
		$cs='mysql:host='.$host.';dbname='.$dbname.';charset=utf8;';
		$options=array(
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,  PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,  PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'  );  
		try {
			$pdo=new PDO($cs,$user,$pass,$options); 
			return $pdo;  
		   } 
		catch(PDOException $e)
		{  
		 echo $e->getMessage();
		 return false;  
		}
	}
static function GetAllUsers()
{
	if($Users=User::GetUserInformationfromDb())
	{
		$pathPicture;
	
		echo    "<table class='table'> 
	<tr>
			<th>FullName</th>
			<th>Report Subject</th>
			<th>Email</th>
			<th>Photo</th>
   </tr>";
		
    for($i=0;$i<count($Users);$i++) 
	{
		if($Users[$i]['imagepath']==null)
		{
			$pathPicture="../images/default/default.jfif";
		}
		else
		{
			$pathPicture="../images/".$Users[$i]['imagepath'];
		}
		echo "<tr>
		     <td>{$Users[$i]['fULLNAME']}</td>
			 <td>{$Users[$i]['reportSubject']}</td>
			 <td> {$Users[$i]['email']}</td><td><img src='$pathPicture' width='50' alt='photo'></td>
		      </tr>";
	}
		
     echo  " </table>";
		return true;
	}
	return false;
	
}
	static function changeInformation($email,$company,$position,$aboutMe,$imagepath)
{
   $err=User::UpdateInformationByEmail($email,$company,$position,$aboutMe,$imagepath);
			if(isset($err))
			{
			 echo "<h3/><span style='color:red;'> Error code:".$err."!</span><h3/>"; 
			return false;
		    }
	return true;
}	
static function register($FirstName ,$LastName,$ReportSubject, $Birthday,$Country,$Phone ,$Email)
{
		if(strlen($FirstName)<1||strlen($FirstName)>25)
		{
			$error.="FistName cannot be more than 25 and less than 1 <br>";
		}
		if (!preg_match('/^[A-Za-z]+$/', $FirstName)) 
		{
			$error.="FistName can contain only english letters <br>";
		}
		if(strlen($LastName)<1||strlen($LastName)>25)
		{
			$error.="LastName cannot be more than 25 and less than 1 <br>";
		}
		if (!preg_match('/^[A-Za-z]+$/', $LastName)) 
		{
			$error.="LastName can contain only english letters <br>";
		}
		if(strlen($ReportSubject)<1||strlen($ReportSubject)>35)
		{
			$error.="ReportSubject cannot be more than 35 and less than 1 <br>";
		}
		if(!(bool)strtotime($Birthday))
		{
			$error.="errot date format<br>";
		}
		if (!preg_match('/^[A-Za-z]+$/', $Country)) 
		{
			$error.="Country can contain only english letters <br>";
		}
		if (!preg_match('/^[0-9]\([0-9]{3}\)[0-9]{3}-{0,1}[0-9]{4}+$/', $Phone)) 
		{
			$error.="Error phone phormat 3(888)886-8888<br>";
		}
		if (!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $Email)) 
		{
			$error.="incorrect email<br>";
		} 	
		if(strlen($error)>0)
		{
				echo '<div class="text-danger">'.$error.'</div>';
			    return false;
		}	

	else
	{   
		
		$User=new User($FirstName ,$LastName,$ReportSubject, $Birthday,$Country,$Phone ,$Email);
		$err=$User->intoDb();
			if($err)
			{
				if($err==1062)
					echo "<h3/><span style='color:red;'> 
					This Login Is Already Taken!</span><h3/>";
			else   echo "<h3/><span style='color:red;'> Error code:".$err."!</span><h3/>"; 
			return false;
		    }
	return true;
	}
}
}
 
class User
{
protected $id; 
protected $firstname;
protected $lastname;
protected $reportSubject;
protected $birthdate;
protected $country;
protected $phone;
protected $email;
protected $company;
protected $position;
protected $aboutMe;
protected $imagepath; 
function __construct($firstname ,$lastname,$reportSubject,$Birthdate, $country, $phone,$email,$company=null,$position=null,$aboutMe=null ,$imagepath=null , $id=0) 
{
	$this->firstname=$firstname;
	$this->lastname =$lastname;
	$this->reportSubject=$reportSubject;
	$this->birthdate=$Birthdate;
	$this->country=$country;
	$this->phone=$phone;
	$this->email=$email;
	$this->company=$company;
	$this->position=$position;
	$this->aboutMe=$aboutMe;
	$this->imagepath=$imagepath;
	$this->id=$id;
}
static function UpdateInformationByEmail($email,$company,$position,$aboutMe,$imagepath){
	try
	{
	if(!$pdo=Tools::connect())
			   {
				  
				   return "error connection";
			   }
	$ps=$pdo->prepare("UPDATE  Users SET company=:company, position=:position,aboutMe=:aboutMe,imagepath=:imagepath where email=:email" );
	$ps->execute(array(company=>$company,position=>$position, 
	        aboutMe=>$aboutMe,imagepath=>$imagepath,email=>$email));
	}
	
	catch(PDOException $e)
		{
			
		return $e->getMessage();  
		}
	
	
}	
	function IntoDb() 
	{
		
		try{ 
			
			if(!$pdo=Tools::connect())
			   {
				   return "error connection";
			   }
			$ps=$pdo->prepare("INSERT INTO                       Users(firstname,lastname,reportSubject,birthdate,country,phone,email)
			VALUES (:firstname,:lastname,:reportSubject,:birthdate,:country,:phone,:email)");
			

			
			$ps->execute(array(firstname=>$this->firstname, lastname=>$this->lastname, 
	        reportSubject=>$this->reportSubject,
			birthdate=>$this->birthdate ,
			country=>$this->country,
			phone=>$this->phone,
			email=>$this->email));
			
		}
		catch(PDOException $e)
		{
			$err=$e->getMessage();
			 if(substr($err,0,strrpos($err,":"))=='SQLSTATE[23000]: Integrity constraint violation')
				   {
				
					   return 1062;//code this email was already added
				   }
			else
				return $e->getMessage();  
		}
	}
	static function GetUserInformationfromDb()
	{
		$Users=[];
		try
		{
				$pdo=Tools::connect();
				$list=$pdo->query('SELECT CONCAT(firstname ," ",lastname) AS fULLNAME,reportSubject,imagepath,email FROM `users`');
				$i=0;
			    while($row=$list->fetch())
				{
					$Users[$i]['fULLNAME']     =$row['fULLNAME'];
					$Users[$i]['reportSubject']=$row['reportSubject'];
					$Users[$i]['email']        =$row['email'];
					$Users[$i]['imagepath']    =$row['imagepath'];
					$i++;
				}
			if($i==0)
			{
				echo  "<h3><span style='color:red;'> There are no users in yuor database  </span><h3/>";
				return false;
			}	
			else
			{
				return $Users; 
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();  
			return false;
		}
	
}
}
?>