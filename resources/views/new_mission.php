<html>
	<body>
		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
		Name &nbsp; : &nbsp; <select name="user_id" id="user_id"></select><br>
		New Mission &nbsp; : &nbsp; <input type="text" name="misi" id="misi" value=""/><br> 
		Gold Rewards &nbsp; : &nbsp; <input type="text" name="gold_rewards" id="gold_rewards" value=""/><br> 		
		Time Limit &nbsp; : &nbsp; <input type="text" name="time_limit" id="time_limit" value=""/><br> 		
		<button onClick="submitNewMission();">Submit New Mission</button>
		<script>
		  $.getJSON("api/selectUsers",
		  function(information, status){
			  var select_users = "";
			$.each( information.data, function( key, value ) {
				select_users+="<option value='"+value.id+"'>"+value.name+"</option>";
			});			
			$("#user_id").append(select_users);	
		  });		
		  function submitNewMission(){
			  $.post("api/takeTheNewMission",{
					"user_id":$("#user_id").val(),	
					"misi":$("#misi").val(),	
					"gold_rewards":$("#gold_rewards").val(),	
					"time_limit":$("#time_limit").val(),	
			  },
			  function(information, status){
				  alert("take The New Mission");
				  document.location.href='../';
			  });					  			  
		  }
		</script>			
	</body>
<html>	