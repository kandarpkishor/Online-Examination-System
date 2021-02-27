<html>
	<head>
		<title>Question</title>
	</head>
	<body>
	<?php
		//code for question
						include '../connection/connection.php';
						//$conn->set_charset("utf8");
						mysqli_set_charset($conn, "utf8");
						$select_count=mysqli_query($conn, "SELECT *FROM question ORDER BY ID ASC");
						$total_question= mysqli_num_rows($select_count);
						$select_question="SELECT *FROM question ORDER BY ID ASC LIMIT 1";
						$select=mysqli_query($conn, $select_question);
						$num = mysqli_num_rows($select);
						if($num>0)
						{
							while($row=mysqli_fetch_array($select,MYSQLI_BOTH))
							{
								$current_id=$row['ID'];
								$question_id=$row['question_id'];
								echo '<h3 id="q_title">'.$row['question_title']. ':</h3>';
							}
						}
						echo $question_id;
						$select_option="SELECT *FROM option_table WHERE question_id= '$question_id'";
						$select1=mysqli_query($conn, $select_option);
						$num1 = mysqli_num_rows($select1);
						if($num1>0)
						{
							echo '<form action="#" method="POST">';
							while($row1=mysqli_fetch_array($select1,MYSQLI_BOTH))
							{
							?>
							<table>
								<tr>
									<td> 
										<input type="radio" id="o_id" name = "a_id" value="<?php echo $row1['option_id']; ?>" ><h3 id="o_id1"><?php echo $row1['option_title']; ?></h3></radio>
									</td>
								</tr>
							</table>
							
							<?php
							}
						}
						
					?>
					<h3 id="o_id">jksackjchjkash</h3>
						<input type="submit" name="save_next" value="Save and Next" />
						</form>
	</body>
</html>

<?php
if(isset($_POST['save_next']))
	{
		echo $question_id.'<br/>';
		//$a_id=$_POST['a_id'];
		//echo $a_id;
		//$current_id=$_POST['id'];
		$current_id=$current_id+1;
		echo $current_id;
		$select_question2="SELECT *FROM question WHERE ID= '$current_id'";
		$select2=mysqli_query($conn, $select_question2);
		$num2 = mysqli_num_rows($select2);
		if($num2>0)
		{
			echo 'hi if';
			while($row2=mysqli_fetch_array($select2,MYSQLI_BOTH))
			{
				$current_id=$row2['ID'];
				$question_title=$row2['question_title'];
				$question_id=$row2['question_id'];
				echo $current_id;
				echo $row2['question_title'];
				echo 'hi while';
				?>
				<script> 
					document.getElementById('q_title').style.color = "blue" 
					document.getElementById('q_title').innerText = <?php echo '"'.$question_id. $question_title.'"'?>
				</script>
				<?php
						$select_option="SELECT *FROM option_table WHERE question_id= '$question_id'";
						$select1=mysqli_query($conn, $select_option);
						$num1 = mysqli_num_rows($select);
						if($num1>0)
						{
							echo '<form action="#" method="POST">';
							while($row1=mysqli_fetch_array($select1,MYSQLI_BOTH))
							{
								$option=$row1['option_title'];
								echo $option;
							?>
								<script> 
									document.getElementById('o_id').style.color = "green" 
									document.getElementById('o_id').innerText = <?php echo '"'.$option.'"'?>
								</script>
							<?php
							}
						}
				
				unset($_POST['save_next']);
			}
		}
		else{
			echo mysqli_error($conn);
		}
	}
	mysqli_close($conn);
?>