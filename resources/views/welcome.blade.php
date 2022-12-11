<html>
	<body>
		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
		<script>
				String.prototype.replaceAll = function(search, replacement) {
					var target = this;
					return target.replace(new RegExp(search, 'g'), replacement);
				};		
			  $.getJSON("api/show_user_or_player_informations",
			  function(information, status){
					$.each( information.data, function( key, value ) {
						var misi_id_all = value.misi_id.split(",");
						var status_mision_all = value.status_mision.split(",");
						var key_all = "";
						for (var key in status_mision_all) {
							var value2 = status_mision_all[key];
							if(value2 == "0"){
								key_all += '<select onChange=see_completed('+value.id+','+misi_id_all[key]+'); class="see_completed" id="see_completed_'+value.id+'_'+misi_id_all[key]+'"><option value=\'0\' selected>Not Complete</option><option value=\'1\'>Complete</option></select> <a href=\'\View_Mission_Progress\\'+value.id+'\\'+misi_id_all[key]+'\'\'>View Mission Progress</a>&nbsp;<a href=\'\add_mission_progress\\'+value.id+'\\'+misi_id_all[key]+'\'>Add Mission Progress</a><br>';								
							}
							if(value2 == "1"){
								key_all +='Completed <a href=\'View_Mission_Progress\\'+value.id+'\\'+misi_id_all[key]+'\'>View Mission Progress</a><br>';
							}	
						}
						$("#show_user_or_player_informations").append(
							'<tr><td>'+value.name+'</td><td>'+value.email+'</td><td>'+value.misi.replaceAll(',','<br>')+'</td><td>'+key_all+'</td><td>'+value.total_gold_rewards+'</td></tr>'
						);					  							
					});				  
			  });										  
		</script>
		<button onClick="document.location.href='/new_mission';">New Mission</button>
		<button onClick="document.location.href='/new_user';">New User</button>
		<table id="show_user_or_player_informations" border=1 cellspacing=1 cellpading=1>
			<tr>
				<td>Name</td>
				<td>Email</td>
				<td>Misi</td>
				<td>Status Misi</td>
				<td>Total Gold Rewards</td>
			</tr>	
		</table>
		<script>
			function see_completed(user_id,quests_id){
				$.post( "api/completeMission", 
					{ 
				  "user_id":user_id,
				  "quests_id":quests_id,
					}
				)
				.done(function(data) {
					alert("changed to complete mission");
					document.location.href='';
				});				
			} 	
		</script>
	</body>
</html>