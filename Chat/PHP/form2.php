	<form  id="Form2" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="Compaтy">Company:</label>
			<input type="text" class="form-control" maxlength="35" name="Company">  
		</div>
   		<div class="form-group">
			<label for="Position">Position:</label>
			<input type="text" class="form-control" maxlength="35"  name="Position">  
		</div>
   		<div class="form-group">
			<label for="aboutMe">About me:</label>
			<textarea rows="10" cols="45" class="form-control" name="aboutMe" maxlength="500"></textarea> 
		</div>
        <div class="form-group">
			<label for="photo">Photo:</label>
			<input type="file" class="form-control" name="photo" accept="image/*">  
	
  	 </div>
   	 <p><input type="button" value="NextPage" onclick="addinfo()"></p>
	</form>
	<script>

function addinfo(){
    var form =document.getElementById("Form2");
	var Output = document.getElementById("result");
	var formData = new FormData(form);
var request = new XMLHttpRequest();
request.open("POST", "./PHP/AddUserInformation.php",true);
request.onload = function() {
    if (request.status == 200 && request.readyState == 4  ) {
   		if(document.getElementById("Form2")!=null)
		{
			document.getElementById("Form2").remove();
		}document.getElementById("result").innerHTML=request.responseText;
	   } else {
      Output.innerHTML = "Error " + request.status + " occurred when trying to upload your file.<br/>";
    }
  };
request.send(formData);
  };
</script>
	
