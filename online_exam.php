<?php
$q_sl_no = 1;
$total_question=0;
$total_question=0;
?>
<?php
	include '../header.php'
?>
<?php
	include_once '../connection/connection.php';
	$select=mysqli_query($conn, "SELECT *FROM online_exam_table WHERE online_exam_id='1'");
	$num_row=mysqli_num_rows($select);
	if($num_row>0)
	{
		while($row=mysqli_fetch_array($select, MYSQLI_BOTH))
		{
			$exam_title=$row['online_exam_title'];
			//$exam_id=$row['online_exam_id'];
			$exam_date_time=$row['online_exam_date_time'];
			$exam_duration=$row['online_exam_duration'];
			$total_question=$row['total_question'];
			$exam_status=$row['online_exam_status'];
			$exam_code=$row['online_exam_code'];
			//echo $row['question_title'];
		}
	}
	$exam_id=1234;
$exam_mnt=$exam_duration%60;
$exam_hr=$exam_duration/60;
?>

<div class="main">
	<div class="exam_riban">
		<div class="exam_title">Date & Time: <?php echo $exam_date_time;?></div>
		<div class="exam_title">Exam Name: <?php echo $exam_title;?></div>
		<div class="exam_title">Time: <?php echo $exam_duration;?></div>
		<div class="exam_title">Number of Question: <?php echo $total_question;?></div>
		<div class="exam_title">Exam Status: <?php echo $exam_status;?></div>
		<div class="exam_title">Exam Code: <?php echo $exam_code;?></div>
	</div>
<?php
	if($exam_status!="online")
	{
		echo '<div style="margin-left:auto; margin-right:auto; width:300px; text-align:center; color:red "><h1>Exam Over</h1></div>';
	}
	else
	{
?>
	<div class="left_panel">
	<?php
		
	
	
	?>
		<div class="q_section" style="height:92%;">
			<div id="question" style="float:left;height:30px; //border:1px solid red; width:49%; text-align:left;font-weight:bold">			
				Question No. : <?php echo $q_sl_no ?>
			</div>
			<div id="question" style="//border:1px solid green; float:left;height:30px; width:50%; text-align:right;font-weight:bold">			
				<h3 id="timer" style="color:green; padding:0px; margin:0px"> </p>
				
				<script>
				
				var exam_duration='<?php echo $exam_duration; ?>';
				var addDateTime= new Date().getTime() + (exam_duration*60*1000);
				var x = setInterval(function() 
				{
					var now = new Date().getTime();
					var distance = addDateTime - now;
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / 1000);
					document.getElementById("timer").innerHTML = hours + " : "
					+ minutes + " : " + seconds + " ";
					if(minutes<10)
					{
						document.getElementById("timer").style.color="red";
					}
					if (distance < 0) 
					{
						clearInterval(x);
						document.getElementById("timer").innerHTML = "EXPIRED";
					}
				}, 1000);
				
				//<script src="../script/online_exam.js"></script>
				</script>
				
				
				
				
			</div>
		<div id="question_section" class="question_section"></div>
		
</div>

</div>
<div class="right_panel">
<div id="2n"></div>
	<div id="a_box" class="a_box">
					
				</div>
				<div class="a_summary">
					<div class="summary_box" style="background-color:#009933; border:1px solid #004d1a;float:left;">Total Answered </div>
					<div class="summary_box" style="background-color:#3366ff; border:1px solid #3366ff;float:left;">Answered and Mark for review </div>
					<div class="summary_box" style="background-color:#ac00e6; border:1px solid purplr;">Msrk for review </div><br>
					<div class="summary_box" style="background-color:#ff5050; border:1px solid #e60000;">Unanswered  </div><br>
						
				</div>
			
			</div>
<?php
	}
?>
		</div>
		<div class="footer">&copy Learners Logic 2020</div>
	</body>
</html>
<script>
function qGreen() 
{
  var x = document.getElementById("q_no");
    x.style.backgroundColor = "green";
	x.style.color="white";
}
</script>
<?php
if(isset($_POST['save_next']))
{
	if(isset($_POST['a_id']))
	{
		echo $question_id.'<br/>';
		$a_id=$_POST['a_id'];
		echo $a_id;
		echo '<script>qGreen()</script>';
		
	}
	
}
if(isset($_COOKIE["q_id"])){ 
    $cook_q_id= $_COOKIE["q_id"]; 
} else{ 
    $cook_q_id=''; 
} 
?>
<script src="jquery-3.2.1.min.js"></script>
		<script>
			$(document).ready(function()
			{
				//load_question();
				var exam_id="<?php echo $exam_id?>";
				var q_id="<?php echo $cook_q_id?>";
				$("#msgid").html(exam_id);
				var dataString = 'exam_id='+ exam_id;
				question_navigation();
				load_question();
				function load_question(question_id = q_id)
				{
					$.ajax({
						type:"POST",
						url:"ajex_action.php",
						data: {page: 'question1' , action: 'load_question', question_id: question_id , exam_id: exam_id},
						success:function (data)
						{
							$('#question_section').html(data);
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
				function question_navigation()
				{
					$.ajax({
						type:"POST",
						url:"ajex_action.php",
						data: {page: 'question1' , action: 'question_navigation', exam_id: exam_id},
						success:function (data)
						{
							$('#a_box').html(data);
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
				$(document).on( 'click' , '.q_no' , function(){
					var q_id=$(this).data('question_id');
					var q_no=$(this).data('q_sl_no');
					$("#question").html("Question No. : "+q_no);
					load_question(q_id);
					//alert('hi clicked'+q_id+ ' q_no = '+q_no);
				});
				var i=1;
				var q_no=1;
				var review='';
				//save and next button funtion
				$(document).on( 'click' , '.sv_nxt' , function(){
					var question_id= $(this).attr('id');
					var q_count=$('#radio_selected_A').data('q_count');
					alert('q_count = '+q_count);
					var sl_no="#"+i;
					if(q_no>=3)//<?php echo $total_question?>)
					{
						q_no=0;
					}
					else{
						q_no=q_no+1;
						$("#question").html("Question No. : "+q_no);
					}
					
					//$("#2n").html(sl_no);
					load_question(question_id);
					
					var option_A = $("#radio_selected_A").prop("checked");
					var option_B = $("#radio_selected_B").prop("checked");
					var option_C = $("#radio_selected_C").prop("checked");
					var option_D = $("#radio_selected_D").prop("checked");
					if(review==="marked")
					{
						i=i+1;
						review='';
					}
					else{
						if (option_A == true || option_B == true || option_C == true || option_D == true) {
							// do something
							$(sl_no).css("background-color", "green");
							$(sl_no).css("color", "white");
							//$("#2n").html(sl_no);
						}
						else{
							$(sl_no).css("background-color", "#ff5050");
							$(sl_no).css("color", "white");
						}
					i=i+1;
					}
					var option_id=$('input[name=option_selected]:checked').val();
					//alert(option_id);
					$.ajax({
						type:"POST",
						url: "ajex_action.php",
						data:{page :'question1' , action : 'save_next', username : 'kkjha', exam_id : exam_id, question_id : question_id, option_id : option_id},
						success:function(data)
						{
							$("#2n").html(data);
						}
						
					})
					
					
					
					
				});
				var val_btn="";
				$(document).on( 'click' , '.mrk_rvw' , function(){
					var sl_no="#"+i;
					var val_btn=$(this).val();
					var option_A = $("#radio_selected_A").prop("checked");
					var option_B = $("#radio_selected_B").prop("checked");
					var option_C = $("#radio_selected_C").prop("checked");
					var option_D = $("#radio_selected_D").prop("checked");
					if (option_A == true || option_B == true || option_C == true || option_D == true) 
					{
							if(val_btn==="Unmark for Review")
							{
								$(sl_no).css("background-color", "white");
								$(sl_no).css("color", "black");
								//alert($(".mrk_rvw").prop("value"));
								$(".mrk_rvw").attr("value" , "Mark for Review");
								review='';
							}
							else
							{
								review='marked';
								$(sl_no).css("background-color", "#3366ff");
								$(sl_no).css("color", "white");
								$(".mrk_rvw").attr("value" , "Unmark for Review");
								//alert($(".mrk_rvw").prop("value"));
							}
					}
					else
					{
							if(val_btn==="Unmark for Review")
							{
								$(sl_no).css("background-color", "white");
								$(sl_no).css("color", "black");
								//alert($(".mrk_rvw").prop("value"));
								$(".mrk_rvw").attr("value" , "Mark for Review");
								review='';
							}
							else
							{
								review='marked';
								$(sl_no).css("background-color", "#ff5050");
								$(sl_no).css("color", "white");
								$(".mrk_rvw").attr("value" , "Unmark for Review");
							}
					}
						
				});
				$(document).on( 'click' , '.clr_rsp' , function(){
					$('input[name=option_selected]').each(function(){
						if($(this).prop("checked")==true)
						{
							//alert("checked");
							$(this).prop("checked" , false);
						}
					});
						
				});
			});
			/*$('#ab').click(function() {
				alert('radio selected');
				 if ($(this).attr("checked") == "checked") {
					alert("checked");
					
					}
			});*/
		</script>
		<script>
		//script for summary//
			$(document).ready(function()
			{
				
			});
			
		</script>
		