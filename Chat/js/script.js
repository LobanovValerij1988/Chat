 ao = createAjaxObject(); //ao is global variable function
function createAjaxObject() 
{  ao=null;
 try
 {
	 ao = new XMLHttpRequest(); //for modern    browsers 
 }
  catch(e) {
	  try
	  {
		  //for new IE  
		  ao = new ActiveXObject("Msxml2.XMLHTTP");
	  }
	  catch(e)
	  {
		  try
		  { //for old browsers 
			  ao = new   ActiveXObject("Microsoft.XMLHTTP");   
		  }
		  catch(e)
		  {
			  alert("AJAX is not supported by your browser!");
			  return false;   
		  }
	  }
  }
return ao; 
}
function NewUserAdd()
{
	if(ao.readyState === 4 || ao.readyState === 0)  
	{ 
		
	let FirstName = document.getElementById("FirstName").value;
	let LastName = document.getElementById("LastName").value;
	let ReportSubject = document.getElementById("ReportSubject").value;
	let Birthday = document.getElementById("datep").value;
	let Country = document.getElementById("Country").value;
	let Phone = document.getElementById("phone").value;
	let Email = document.getElementById("email").value;
	ao.open("POST","./PHP/AddnewUser.php", true);
	ao.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
	ao.onreadystatechange = getData;
	ao.send("FirstName="+FirstName+"&LastName="+LastName+"&ReportSubject="+ReportSubject+"&Birthday="+Birthday+"&Country="+Country+"&Phone="+Phone+"&Email="+Email);
	}
}
function getData() 
{ 
	if(ao.readyState == 4  && ao.status == 200 ) 
	{   if(document.getElementById("Form2")!=null)
		{
	     document.getElementById("Form2").remove();
		}
	 else
	 {
		 document.getElementById("result").innerHTML=ao.responseText;
	 }
	}
}
Share = {
	facebook: function(purl, ptitle) {
		url  = 'http://www.facebook.com/sharer.php?s=100';
		url += '&p[title]='     + encodeURIComponent(ptitle);
		url += '&p[url]='       + encodeURIComponent(purl);
		
		Share.popup(url);
	},
	twitter: function(purl, ptitle) {
		url  = 'http://twitter.com/share?';
		url += 'text='      + encodeURIComponent(ptitle);
		url += '&url='      + encodeURIComponent(purl);
	Share.popup(url);
	},
	popup: function(url) {
		window.open(url,'','toolbar=0,status=0,width=626,height=436');
	}
};

