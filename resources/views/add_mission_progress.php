<html>
	<body>
		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>	
<input id="user_id" name="user_id" type="hidden" value="<?=$user_id?>"/><br> 
<input id="quests_id" name="quests_id" type="hidden" value="<?=$quests_id?>"/><br> 
Progress Information Name : <input id="progress_information_name" name="progress_information_name" type="text" value=""/><br>
<input type="button" id="Submit" name="Submit" value="Submit" onClick="submitData();"/>
<script>
	function submitData(){
		$.post("../../api/addMissionProgress",{
			"user_id":"<?=$user_id?>",
			"quests_id":"<?=$quests_id?>",
			"progress_information_name":$("#progress_information_name").val()
		},
		function(information, status){
			document.location.href='../../';
		});
	}	
</script>
	</body>
<html>