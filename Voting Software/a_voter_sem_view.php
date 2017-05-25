<?php 
	if(isset($_REQUEST['act'])){
	include("includes/admin_header.php"); ?> 
	</div>
	</br></br>
	<?php 
	if(isset($_REQUEST['search']))
	{ ?>
	<h1 style="margin-top:310px;margin-bottom:40px;">Voter Details</h1>
		<?php 
			$flag=0;
			if(isset($_REQUEST['update']))
			{
				$q="select * from sys_cse_soc_candidate where voter_id='$_REQUEST[prev_student_id]'"; 
				$r=mysql_query($q);
				if(mysql_num_rows($r)>0)
					echo '<p style="color:red;font-size:17px;">*** Sorry voter is in candidate list. ***<p>';
				else
				{
					$kk="select * from sys_cse_soc_voter where id!='$_REQUEST[id]' and student_id='$_REQUEST[student_id2]' ";
					$rr=mysql_query($kk);
					if(mysql_num_rows($rr)>0)
					{
							echo '<p style="color:red;">*** Student ID already in use *** </p>';
					}
					else
					{
						$name=trim($_REQUEST['name']);
						$student_id=trim($_REQUEST['student_id2']);
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
							$flag=1;
							$sq="update sys_cse_soc_voter set
								name='$name',
								student_id='$student_id',
								semester='$_REQUEST[semester]',
								year='$_REQUEST[year]',
								status='$_REQUEST[status]'
								where id='$_REQUEST[id]' ";
							mysql_query($sq);
							echo '<p style="color:green;">Voter details successfully updated.</p>';
						
						}
					}
				}
			}
			if($flag==0)
				$ss="select * from sys_cse_soc_voter where student_id='$_REQUEST[student_id]' ";
			else	
				$ss="select * from sys_cse_soc_voter where student_id='$_REQUEST[student_id2]' ";
		$res=mysql_query($ss);
		$kkr=mysql_fetch_array($res);
		if(mysql_num_rows($res)<=0)
			echo '<p style="color:red;">*** No match found. ***</p>';
				
		?>
		<form action="a_voter_sem_view.php" method="post">
		<a style="margin-right:300px;margin-bottom:10px;" href="a_voter.php"><< Back</a>
		<input type="text" name="student_id" title="Search voter by Student ID." autocomplete="off" placeholder="   Student ID" style="border-radius:5px;width:200px;height:23px;margin-left:210px;" required>
		<input type="submit" name="search" value="Search" title="Search voter by Student ID." style="border-radius:5px;height:30px;background: url(images/1.jpg);color:white;">
		<input type="hidden" name="act">
		</form>
		<?php
			if(mysql_num_rows($res)>0){
		?>
		<form action="a_voter_sem_view.php" method="post">
		<table style="margin-left:340px;">
			<tr>
				<td>Name</td>
				<td>: <input type="text" name="name" value="<?php echo $kkr['name']; ?>" style="border-radius:5px;" autocomplete="off" required></td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Student ID</td>
				<td>: <input type="text" name="student_id2" value="<?php echo $kkr['student_id']; ?>" style="border-radius:5px;" autocomplete="off" required></td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Keyword</td>
				<td>: <button type="button" style="border-radius:5px;width:172px;"><?php echo $kkr['keyword']; ?></button></td>
			</tr>
			<tr><td colspan="2">&nbsp </td></tr>
			<tr>
				<td>Semester</td>
				<td>: <select name="semester" style="border-radius:5px;width:172px;">
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
				<td>: <select name="year" style="border-radius:5px;width:172px;">
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
			<input type="hidden" name="act">
			<input type="hidden" name="search">
			<input type="hidden" name="id" value="<?php echo $kkr['id'];?>">
			<input type="hidden" name="prev_student_id" value="<?php echo $kkr['student_id'];?>">
			<input type="hidden" name="student_id" value="<?php echo $_REQUEST['student_id'];?>">
		</table>
		</form>
	
	<?php } }
	else if(isset($_REQUEST['edit']))
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
								semester='$_REQUEST[semester]',
								year='$_REQUEST[year]',
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
		<a style="margin-right:600px;" href="a_voter_sem_view.php?act=ll&semester=<?php echo $_REQUEST['semester'];?>&year=<?php echo $_REQUEST['year'];?>"><< Back</a>
		<form action="a_voter_sem_view.php" method="post">
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
				<td>: <select name="semester" style="border-radius:5px;width:172px;">
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
				<td>: <select name="year" style="border-radius:5px;width:172px;">
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
			<input type="hidden" name="act">
			<input type="hidden" name="edit">
			<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>">
			<input type="hidden" name="prev_student_id" value="<?php echo $kkr['student_id'];?>">
		</table>
		</form>
	<?php
	}
	else
	{
	?>
	<h1 style="margin-top:310px;margin-bottom:30px;">Voter List (<?php echo $_REQUEST['semester']; echo ' - '; echo $_REQUEST['year']; ?>)</h1>
	
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
			$sql="select * from sys_cse_soc_voter where semester='$_REQUEST[semester]' and year='$_REQUEST[year]' order by student_id asc ";
			$res=mysql_query($sql);
			while($arr=mysql_fetch_array($res))
			{
		?>
			<tr>
				<td style="width:250px;text-align:center;"><?php echo $arr['name']; ?></td>
				<td style="width:150px;text-align:center;"><?php echo $arr['student_id']; ?></td>
				<td style="width:150px;text-align:center;"><?php echo $arr['keyword']; ?></td>
				<td style="width:150px;text-align:center;"><?php if($arr['vote_status']==0){ echo 'Not Yet'; } else { echo 'Casted'; } ?></td>
				<td style="width:150px;text-align:center;"><?php echo $arr['status']; ?></td>
				<td style="width:300px;text-align:center;"><a href="a_voter_sem_view.php?act=ll&edit=act&id=<?php echo $arr['id']; ?>&semester=<?php echo $arr['semester']; ?>&year=<?php echo $arr['year']; ?>">Edit</a> | <a href="a_voter_sem_view.php?act=ll&delete=act&student_id=<?php echo $arr['student_id']; ?>&semester=<?php echo $arr['semester']; ?>&year=<?php echo $arr['year']; ?>">Delete</a></td>
			</tr>
		<?php } ?>
	</table>
	<?php } ?>
	</br>
	</br>
<?php include("includes/footer.php");
		}
	else
		header("location: index.php");
 ?>