<?php
include '../../connection/connection.php';
	$exam_id=1234;
	$query="SELECT *FROM question WHERE online_exam_id = '$exam_id' ORDER BY ID ASC LIMIT 1";
	
	$result=mysqli_query($conn, $query);
	$row2=mysqli_fetch_array($result, MYSQLI_BOTH);
	foreach($row2 as $row)
	{
		echo $row['question_title'];
	}
?>
<html>
<head>
	
</head>
<body>
<script src="jquery-3.2.1.min.js"></script>
<script>

$(document).ready(function()
	{
		//load_question();
		var exam_id="<?php echo $exam_id?>";
		$("#msgid").html(exam_id);
		var dataString = 'exam_id='+ exam_id;
		load_question();
		function load_question(question_id = '')
		{
			$.ajax({
				type:"POST",
				url:"ajex.php",
				data: {page: 'question1' , action: 'load_question', question_id: question_id , exam_id: exam_id},
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
<div id="msgid" style="height:450px; width:500px; border:1px solid black;"></div>
</body>		
</html>