<html>
	<head> <link src="online_exam.css" rel="stylesheet" type="text/css"/></head>
<body>
</body>
</html>
<?php
include '../connection/connection.php';
mysqli_set_charset($conn,"utf8");
	if($_POST['page'] =='question1')
	{
		if($_POST['action'] =='question_navigation')
		{
			//echo '<h3>Kandarp Kishor Jha</h3>';
			$query="SELECT *FROM question WHERE online_exam_id = ' ".$_POST["exam_id"]." ' ORDER BY ID ASC";
			$result=mysqli_query($conn, $query);
			$num=mysqli_num_rows($result);
			$q_sl_no=1;
			if($num>0)
			{
				while($row=mysqli_fetch_array($result, MYSQLI_BOTH))
				{
					echo '<div id="'.$q_sl_no.'" class="q_no" data-question_id="'.$row['question_id'].'" data-q_sl_no="'.$q_sl_no.'">'.str_pad($q_sl_no, 2, "0", STR_PAD_LEFT).'</div>';
					$q_sl_no=$q_sl_no+1;
				}
			}
			
			
			
			
			
			
		}
		$q_count=0;
	if($_POST['action'] =='load_question')
		{
			if($_POST['question_id']=='')
			{
				$query="SELECT *FROM question WHERE online_exam_id = ' ".$_POST["exam_id"]." ' ORDER BY ID ASC LIMIT 1";
			}
			else
			{
				$query="SELECT *FROM question WHERE question_id = ' ".$_POST["question_id"]." ' ";
			}
			$question_id='';
				$query5="SELECT question_id FROM question WHERE online_exam_id = ' ".$_POST["exam_id"]." ' ORDER BY ID DESC LIMIT 1";
				$result5=mysqli_query($conn, $query5);
				$row5=mysqli_fetch_array($result5, MYSQLI_BOTH);
				$last_q_id=$row5['question_id'];
				
			$result=mysqli_query($conn, $query);
			$num=mysqli_num_rows($result);
			if($num>0)
			{
				while($row=mysqli_fetch_array($result, MYSQLI_BOTH))
				{
					echo '<div style="height:89%; width:100%; border:1px solid red; float:left; overflow-y:auto;"><div style="width:100%;float:left;"><h3>'.$row['question_title'].'</h3></div>';
					$question_id=$row["question_id"];
					$q_count=$q_count+1;
					$query2="SELECT *FROM option_table WHERE question_id = $question_id ";
					$result2=mysqli_query($conn, $query2);
					$num2=mysqli_num_rows($result2);
					if($num2>0)
					{
						$count=64;
						
						while($row2=mysqli_fetch_array($result2, MYSQLI_BOTH))
						{
							$count=$count+1;
							echo chr($count).'<input type="radio" id="radio_selected_'.chr($count).'" name="option_selected" value="'.$row2['option_id'].'" data-question_id="'.$row["question_id"].'" data-q_count="'.$q_count.'"><span style="margin-right:30px; margin-left:5px; ;font-weight:bold;text-align:center;">'.$row2['option_title'].'</span></input>';
							echo '<br/><br/>';
						}
						echo '</div>';
					}
				}
				
			}
			//echo $question_id.'     ';
			$next_q_id='';
			if($last_q_id<$next_q_id)
			{
				
			}
			$query3="SELECT *FROM question WHERE online_exam_id = ' ".$_POST["exam_id"]." ' AND question_id > '$question_id' ORDER BY ID ASC LIMIT 1";
			$result3=mysqli_query($conn, $query3);
			$num3=mysqli_num_rows($result3);
			//$q_count=1;
			if($num3>0)
			{
				while($row3=mysqli_fetch_array($result3, MYSQLI_BOTH))
				{
					$next_q_id=$row3['question_id'];
					$q_count=$q_count+1;
				}
			}
			//echo $next_q_id;
			?>
			<div class="nav_panel" >
			<hr/>
				
				<input id ="<?php echo $next_q_id?>" data-count="<?php echo $q_count;?>" class="mrk_rvw" type="button" value="Mark For Review" name="mark_review" style="background-color:#ac00e6; border:1px solid purplr;"/>
				<input id ="clr_rsp" class="clr_rsp" type="button" value="Clear Responce" name="clear_responce" style="background-color:#ff5050; border:1px solid #e60000;"/>
				<input id ="<?php echo $next_q_id?>" class="sv_nxt" type="button" value="Save and Next" name="save_next" style="background-color:#009933; border:1px solid #004d1a; " onClick="load_question(2)" />
			</div>
			<?php
			
			setcookie("q_id", $question_id, time()+2*24*60*60);
			//$query4="SELECT *FROM question WHERE online_exam_id = ' ".$_POST["exam_id"]." ' AND question_id > ' ".$row["question_id"]." ' ORDER BY ID ASC LIMIT 1";
			
			
			
		}
		if($_POST['action']=='save_next')
		{
			$username=$_POST['username'];
			$exam_id=$_POST["exam_id"];
			$question_id=$_POST['question_id'];
			$option_id=$_POST['option_id'];
			echo '<h3>kandarp kishor jha</h3>';
			$query="SELECT *FROM online_exam_table WHERE online_exam_id ='$exam_id'";
			$result=mysqli_query($conn, $query);
			$num=mysqli_num_rows($result);
			if($num>0)
			{
				while($row=mysqli_fetch_array($result, MYSQLI_BOTH))
				{
					$right_mark=$row['mark_for_right_answer'];
					$wrong_mark=$row['mark_for_wrong_answer'];
				}
			}
			
			$query2="INSERT INTO user_exam_question_answer VALUES ( NULL,'$username','$exam_id','$question_id','$option_id','')";
			$result2=mysqli_query($conn, $query2);
			if($result2)
			{
				echo '<h3>success</h3>';
			}
			else
			{
				echo mysqli_error($conn);
			}
		}
	
	}
mysqli_close($conn);
?>