<?php
if(isset($_REQUEST['add_v'])){
	include("includes/admin_header.php"); ?> 
	</div>
	</br></br>
	<?php
	if(isset($_REQUEST['next']))
	{ 
		if(isset($_REQUEST['edit']))
		{ 
		?>
		<h1 style="margin-top:310px;margin-bottom:40px;">Voter Details</h1>
		<?php 
			if(isset($_REQUEST['update']))
			{
				$q="select * from sys_cse_soc_candidate where voter_id='$_REQUEST[prev_student_id]'"; 
				$r=mysql_query($q);
				if(mysql_num_rows($r)>0)
					echo '<p style="color:red;font-size:17px;">*** Sorry voter is in candidate list. ***<p>';
				else
				{
					$kk="select * from sys_cse_soc_voter where id!='$_REQUEST[id]' and student_id='$_REQUEST[student_id]' ";
					$rr=mysql_query($kk);
					if(mysql_num_rows($rr)>0)
					{
							echo '<p style="color:red;">*** Student ID already in use *** </p>';
					}
					else
					{
						$name=trim($_REQUEST['name']);
						$student_id=trim($_REQUEST['student_id']);
						$fl=0;
						for($i=0;$i<strlen($name);$i++)
							if($name[$i]==';' or $name[$i]==')' or $name[$i]=='(')
							{
								$fl=1;
								break;
							}
						for($i=0;$i<strlen($student_id);$i++)
							if($student_id[$i]==';' or $student_id[$i]==')' or $student_id[$i]=='(')
							{
								$fl=1;
								break;
							}
						if($fl==1)
							echo '<p style="color:red;">*** Please avoid invaid characters. ex. ;,(, ) *** </p>';
						else if($_REQUEST['year']>date("Y"))
							echo '<p style="color:red;">*** Please insert valid year. *** </p>';		
						else
						{
							$sq="update sys_cse_soc_voter set
								name='$name',
								student_id='$student_id',
								semester='$_REQUEST[semester2]',
								year='$_REQUEST[year2]',
								status='$_REQUEST[status]'
								where id='$_REQUEST[id]' ";
							mysql_query($sq);
							echo '<p style="color:green;">Voter details successfully updated.</p>';
						
						}
					}
				}
			}
			$ss="select * from sys_cse_soc_voter where id='$_REQUEST[id]'";
			$res=mysql_query($ss);
		$kkr=mysql_fetch_array($res);
		?>
		<a style="margin-right:600px;" href="a_voter_add.php?add_v=ll&next=act&semester=<?php echo $_REQUEST['semester'];?>&year=<?php echo $_REQUEST['year'];?>"><< Back</a>
		<form action="a_voter_add.php" method="post">
		<table style="margin-left:340px;">
			<tr>
				<td>Name</td>
				<td>: <input type="text" name="name" value="<?php echo $kkr['name']; ?>" style="border-radius:5px;" autocomplete="off" required></td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Student ID</td>
				<td>: <input type="text" name="student_id" value="<?php echo $kkr['student_id']; ?>" style="border-radius:5px;" autocomplete="off" required></td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Keyword</td>
				<td>: <button type="button" style="border-radius:5px;width:172px;"><?php echo $kkr['keyword']; ?></td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Semester</td>
				<td>: <select name="semester2" style="border-radius:5px;width:172px;">
					<option value="<?php echo $kkr['semester']; ?>"><?php echo $kkr['semester']; ?></option>
					<?php
						if($kkr['semester']!="Spring"){
							echo '<option value="Spring">Spring</option>'; }
						if($kkr['semester']!="Summer"){
							echo '<option value="Summer">Summer</option>'; }
						if($kkr['semester']!="Fall"){
							echo '<option value="Fall">Fall</option>';  }
					?>
					</select>
				</td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Year</td>
				<td>: <select name="year2" style="border-radius:5px;width:172px;">
					<option value="<?php echo $kkr['year']; ?>"><?php echo $kkr['year']; ?></option>
					<?php
						for($i=2012;$i<=2050;$i++)
						{
							if($kkr['year']!=$i){
								echo '<option value="'.$i.'">'.$i.'</option>'; }
						}
					?>
					</select>
				</td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Vote Status</td>
				<td>: <button type="button" style="border-radius:5px;width:172px;"><?php if($kkr['vote_status']==0){ echo 'Not Yet'; } else { echo 'Casted'; } ?></td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Status</td>
				<td>: <select name="status" style="border-radius:5px;width:172px;">
					<option value="<?php echo $kkr['status']; ?>"><?php echo $kkr['status']; ?></option>
					<?php
						if($kkr['status']!='Active'){
							echo '<option value="Active">Active</option>'; }
						if($kkr['status']!='Inactive'){
							echo '<option value="Inactive">Inactive</option>'; }
					?>
					</select>
				</td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr><td colspan="2" style="text-align:right;"> <input title="Click for update voter details" type="submit" name="update" value="Update" style="border-radius:5px;background:url(images/1.jpg);color:white;"> </td></tr>
			<input type="hidden" name="add_v">
			<input type="hidden" name="next">
			<input type="hidden" name="edit">
			<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>">
			<input type="hidden" name="prev_student_id" value="<?php echo $kkr['student_id'];?>">
			<input type="hidden" name="semester" value="<?php echo $_REQUEST['semester'];?>">
			<input type="hidden" name="year" value="<?php echo $_REQUEST['year'];?>">
		</table>
		</form>
	<?php
	}
	else
	{
		?>
			<h1 style="margin-top:310px;margin-bottom:40px;">Add Voter</h1>
	
		<?php
		if(isset($_REQUEST['add']))
		{
			$kk="select * from sys_cse_soc_voter where student_id='$_REQUEST[student_id]' ";
				$rr=mysql_query($kk);
				if(mysql_num_rows($rr)>0)
				{
						echo '<p style="color:red;">*** Student ID already in use *** </p>';
				}
				else
				{
					$name=trim($_REQUEST['name']);
					$student_id=trim($_REQUEST['student_id']);
					$fl=0;
					for($i=0;$i<strlen($name);$i++)
						if($name[$i]==';' or $name[$i]==')' or $name[$i]=='(')
						{
							$fl=1;
							break;
						}
					for($i=0;$i<strlen($student_id);$i++)
						if($student_id[$i]==';' or $student_id[$i]==')' or $student_id[$i]=='(')
						{
							$fl=1;
							break;
						}
					if($fl==1)
						echo '<p style="color:red;">*** Please avoid invaid characters. ex. ;,(, ) *** </p>';
					else if($_REQUEST['year']>date("Y"))
						echo '<p style="color:red;">*** Please insert valid year. *** </p>';
					else
					{
						$key=rand(11011011,95959595);
						$key+=12;
						$sq="insert into sys_cse_soc_voter(name,student_id,semester,year,keyword,vote_status,status)
							values('$name','$student_id','$_REQUEST[semester]','$_REQUEST[year]','$key','0','Active')";
						mysql_query($sq);
						echo '<p style="color:green;">Voter details successfully added.</p>';
					
					}
				}
		}
	?>
			<a style="margin-right:500px;margin-bottom:10px;" href="a_voter_add.php?add_v=ll"><< Back</a>
	<form action="a_voter_add.php" method="post">
	<table style="margin-left:380px;">
		<tr>
			<td>Name</td>
			<td>: <input type="text" name="name" placeholder="   Student Name" autocomplete="off" style="border-radius:5px;" required>			
			</td>
		</tr>
		<tr><td colspan="2"> &nbsp </td></tr>
		<tr>
			<td>Student ID</td>
			<td>: <input type="text" name="student_id" placeholder="   Student ID" autocomplete="off" style="border-radius:5px;" required>
			</td>
		</tr>
		<tr><td colspan="2"> &nbsp </td></tr>
		<tr>
			<td>Semester</td>
			<td>: <button type="button" style="border-radius:5px;width:172px;"><?php echo $_REQUEST['semester']; ?></button>			
			</td>
		</tr>
		<tr><td colspan="2"> &nbsp </td></tr>
		<tr>
			<td>Year</td>
			<td>: <button type="button" style="border-radius:5px;width:172px;"><?php echo $_REQUEST['year']; ?></button>			
			</td>
		</tr>
		<tr><td colspan="2"> &nbsp </td></tr>
		<tr><td colspan="2" style="text-align:right;"> <input title="Add this student as a voter" type="submit" name="add" value="Add" style="border-radius:5px;background: url(images/1.jpg);color:white;" ></td></tr>
		<input type="hidden" name="semester" value="<?php echo $_REQUEST['semester']; ?>">
		<input type="hidden" name="year" value="<?php echo $_REQUEST['year']; ?>">
		<input type="hidden" name="add_v">
		<input type="hidden" name="next">
	</table>
	</form>
	
	<h2 style="text-align:left;margin-left:30px;">Last 2 added voter:</h2>
	<table style="width:900px;margin-left:30px;">
		<tr>
			<td style="font-size:18px;width:250px;text-align:center;border:2px solid black;">Name</td>
			<td style="font-size:18px;width:150px;text-align:center;border:2px solid black;">Student Id</td>
			<td style="font-size:18px;width:150px;text-align:center;border:2px solid black;">Keyword</td>
			<td style="font-size:18px;width:150px;text-align:center;border:2px solid black;">Vote Status</td>
			<td style="font-size:18px;width:100px;text-align:center;border:2px solid black;">Status</td>
			<td style="font-size:18px;width:100px;text-align:center;border:2px solid black;">Action</td>
		</tr>
		<tr>
			<td colspan="6" style="text-align:center;">
				<?php if(isset($_REQUEST['delete']))
						{
							$q="select * from sys_cse_soc_candidate where voter_id='$_REQUEST[student_id]'"; 
							$r=mysql_query($q);
							if(mysql_num_rows($r)>0)
								echo '<p style="color:red;font-size:17px;">*** Sorry voter is in candidate list. ***<p>';
							
							else
							{
								$sql="delete from sys_cse_soc_voter where student_id='$_REQUEST[student_id]'";
								mysql_query($sql);
								echo '<p style="color:red;font-size:17px;">Voter is successfully deleted.<p>';
							}
						}
				?>
			</td>
		</tr>
		<?php 
			$c=0;
			$sql="select * from sys_cse_soc_voter where semester='$_REQUEST[semester]' and year='$_REQUEST[year]' order by id desc ";
			$res=mysql_query($sql);
			if(mysql_num_rows($res)<=0)
			{
				echo '<tr>
						<td colspan="6" style="text-align:center;color:red;">
							*** No voter or student added yet ***
						</td>
					 </tr>';
		
			}
			while($arr=mysql_fetch_array($res))
			{
				if($c==2)
					break;
				$c++;
		?>
			<tr>
				<td style="width:250px;text-align:center;"><?php echo $arr['name']; ?></td>
				<td style="width:150px;text-align:center;"><?php echo $arr['student_id']; ?></td>
				<td style="width:150px;text-align:center;"><?php echo $arr['keyword']; ?></td>
				<td style="width:150px;text-align:center;"><?php if($arr['vote_status']==0){ echo 'Not Yet'; } else { echo 'Casted'; } ?></td>
				<td style="width:150px;text-align:center;"><?php echo $arr['status']; ?></td>
				<td style="width:300px;text-align:center;"><a href="a_voter_add.php?add_v=ll&next=act&edit=act&id=<?php echo $arr['id']; ?>&semester=<?php echo $_REQUEST['semester']; ?>&year=<?php echo $_REQUEST['year']; ?>">Edit</a> | <a href="a_voter_add.php?add_v=ll&next=act&delete=act&student_id=<?php echo $arr['student_id']; ?>&semester=<?php echo $_REQUEST['semester']; ?>&year=<?php echo $_REQUEST['year']; ?>">Delete</a></td>
			</tr>
		<?php } ?>
	</table>
	
	<?php } }
	else
	{ ?>
	<h1 style="margin-top:310px;margin-bottom:40px;">Add Voter</h1>
	<a style="margin-right:500px;margin-bottom:10px;" href="a_voter.php"><< Back</a>
	<form action="a_voter_add.php" method="post">
	<table style="margin-left:380px;">
		<tr>
			<td>Semester</td>
			<td>: <select name="semester" style="width:124px;border-radius:5px;">
				<option value="Spring">Spring</option>
				<option value="Summer">Summer</option>
				<option value="Fall">Fall</option>
				</select>
			</td>
		</tr>
		<tr><td colspan="2"> &nbsp </td></tr>
		<tr>
			<td>Year</td>
			<td>: <select name="year" style="width:124px;border-radius:5px;">
			<?php
				for($i=2012;$i<=2050;$i++)
				{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			?>
			</select>
			</td>
		</tr>
		<tr><td colspan="2"> &nbsp </td></tr>
		<tr><td colspan="2" style="text-align:right;"> <input title="Click next for 2nd step." type="submit" name="next" value="Next" style="border-radius:5px;background: url(images/1.jpg);color:white;" ></td></tr>
		<input type="hidden" name="add_v">
	</table>
	</form>
	<?php } ?>
	</br>
	</br>
<?php include("includes/footer.php");
		}
	else
		header("location: index.php");
 ?>