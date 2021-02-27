<?php
include '../../connection/connection.php';
mysqli_set_charset($conn,"utf8");
	if($_POST['page'] =='question1')
	{
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
			
			$result=mysqli_query($conn, $query);
			$num=mysqli_num_rows($result);
			if($num>0)
			{
				while($row=mysqli_fetch_array($result, MYSQLI_BOTH))
				{
					echo '<h4>'.$row['question_title'].'</h4>';
					$query2="SELECT *FROM option_table WHERE question_id = ' ".$row["question_id"]." ' ";
					$result2=mysqli_query($conn, $query2);
					$num2=mysqli_num_rows($result2);
					if($num2>0)
					{
						$count=0;
						while($row2=mysqli_fetch_array($result2, MYSQLI_BOTH))
						{
							$count=$count+1;
							echo '<input type="radio" ><span style="margin-right:30px; margin-left:5px; ;font-weight:bold;text-align:center;">'.$row2['option_title'].'</span></input>';
							if($count==2)
							{
								echo '<br/><br/>';
							}
						}
						
					}
				}
				
			}
		}
	}
	

mysqli_close($conn);
?>