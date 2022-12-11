<html>
	<body>
		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>		
		<script>
		  $.getJSON("api/selectUsers",
		  function(information, status){
			  var informations = "";
			$.each( information.data, function( key, value ) {
				informations+="<tr><td>"+value.id+"</td><td>"+value.name+"</td></tr>";
			});			
			$("#informations").append(informations);	
		  });		
		  function addUser(){
			  $.post("api/addUser",{
				  "name": $("#name").val(),
				  "email": $("#email").val(),	
				  "password": $("#password").val(),	
			  },
			  function(information, status){
					alert("Add user successfully");
					document.location.href='../';					
			  });				  
		  }
		</script>
		<input type="button" name="back" id="back" value="Back" onClick="document.location.href='../';"/>
		<table id="informations" border=1>
			<tr>
				<td>Name</td>
				<td>Email</td>				
			</tr>			
		</table>
		Name: <input type="text" id="name" name="name"/><br>
		Email: <input type="text" id="email" name="email"/><br>
		Password: <input type="password" id="password" name="password"/><br>
		<button onClick="addUser();">Submit</button>
		
	</body>
</html>	