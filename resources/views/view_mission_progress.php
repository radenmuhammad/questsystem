<html>
	<body>
		<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
		<script>
				String.prototype.replaceAll = function(search, replacement) {
					var target = this;
					return target.replace(new RegExp(search, 'g'), replacement);
				};		
			  $.post("../../api/seeMissionProgress",
				  {'user_id':'<?=$user_id?>','quests_id':'<?=$quests_id?>'}
			  ,
			  function(information, status){
					var a = 1;
					$.each( information.data.data, function( key, value ) {						
						$("#progess_information").append(
							'<tr><td>'+a+'</td><td>'+value.progress_information_name+'</td></tr>'
						);
						a++;	
					});
			  });										  
		</script>		
		Progress:
		<table id="progess_information" border=1 cellspacing=1 cellpading=1>
			<tr>
				<td>No</td>
				<td>Progress Information Name</td>
			</tr>	
		</table>		
	</body>
<html>	