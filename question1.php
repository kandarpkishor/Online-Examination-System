<html>
	<head>
		<title>Question</title>
		<script src="jquery-3.2.1.min.js"></script>
	</head>
	<body>
	<?php 
		$exam_id=1234; 
		echo $exam_id;
	
	?>
	<div id="msgid">
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		
		var exam_id="<?php echo $exam_id?>";
		$("#msgid").html(exam_id);
		load_question();
		var dataString = 'id='+ id;
		function load_question(question_id = '')
		{
			$.ajax({
				type:"POST",
				url:"ajex_action.php",
				data:{exam_id: exam_id, question_id: question_id, page: 'question1' action: 'load_question'},
				success:function (data)
				{
					$('#msgid').html(data);
					 if(data=="OK")	
					   {
						return true;	
					   }
					   else
					   {
						return false;	
					   }
				}
			});
		}		
		
	});
		</script>
		
		<script type="text/javascript">

		$(document).ready(function(){
		 $("#msgid1").html("This is Hello World by JQuery");
		});
		</script>
<div id="msgid">
</div>
	
	
	
	</body>
</html>

<?php
/*	include '../connection/connection.php';
	mysqli_set_charset($conn,"utf8");
	
if(!isset($_REQUEST['$current_id'] && !isset($_REQUEST['$current_id'] && !isset($_REQUEST['$current_id'])
	$select=mysqli_query($conn, "SELECT *FROM question");
	$num_row=mysqli_num_rows($select);
	if($num_row>0)
	{
		while($row=mysqli_fetch_array($select, MYSQLI_BOTH))
		{
			$current_id=$row['ID'];
			echo $current_id;
			//echo $row['question_title'];
		}
	}
	else{
		mysqli_error($conn);
	}*/
?>