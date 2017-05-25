<?php include("includes/admin_header.php"); ?> 
	</div>
	</br></br>
	<h1 style="margin-top:310px;margin-bottom:0px;">Welcome to admin panel.</h1>
	<form action="a_index.php" method="post">
		<table style="margin-top:50px;margin-left:300px;">
			<tr>
			<td colspan="2">	<?php 
		if(isset($_REQUEST['reset_all']))
		{
			$pass=trim($_REQUEST['pass_reset']);
			$pass=sha1($pass);
			$sq="select * from sys_cse_soc_admin where password='$pass'";
			$re=mysql_query($sq);
			if(mysql_num_rows($re)<=0)
			{
				echo '<p style="color:red;font-size:14px;">Password doesn\'t match for reset all.</p>'; 
			}
			else
			{
				$sq="delete from sys_cse_soc_candidate";
				mysql_query($sq);
				
				$sq="delete from sys_cse_soc_voter";
				mysql_query($sq);
				
				
				$sq="delete from sys_cse_soc_post";
				mysql_query($sq);
				
				echo '<p style="color:green;font-size:14px;">Successfully reseted whole system.</p>'; 
			}
		}
		if(isset($_REQUEST['log']))
		{
			$old_pass=trim($_REQUEST['old_pass']);
			$old_pass=sha1($old_pass);
			if($old_pass==$_SESSION['PASSWORD'])
			{
				$pass=trim($_REQUEST['new_pass']);
				$user=trim($_REQUEST['username']);
				if($pass!='' and $user!=$_SESSION['USERNAME'] and sha1($pass)!=$_SESSION['PASSWORD'])
				{
					$pass=sha1($pass);
					$sq="update sys_cse_soc_admin 
						set
							password='$pass',
							username='$user'
						where
							id='$_SESSION[ADMIN_ID]' ";
					mysql_query($sq);
					$_SESSION['USERNAME']=$user;
					$_SESSION['PASSWORD']=$pass;
					echo '<p style="color:green;font-size:14px;text-align:center;">Profile successfully updated.</p>';
				}
				else if($pass!='' and $user==$_SESSION['USERNAME'] and sha1($pass)!=$_SESSION['PASSWORD'])
				{
					$pass=sha1($pass);
					$sq="update sys_cse_soc_admin 
						set
							password='$pass'
						where
							id='$_SESSION[ADMIN_ID]' ";
					mysql_query($sq);
					$_SESSION['PASSWORD']=$pass;
					echo '<p style="color:green;font-size:14px;text-align:center;">Profile successfully updated.</p>';
				}
				else if(($pass=='' or sha1($pass)==$_SESSION['PASSWORD']) and $user!=$_SESSION['USERNAME'])
				{
					$sq="update sys_cse_soc_admin 
						set
							username='$user'
						where
							id='$_SESSION[ADMIN_ID]' ";
					mysql_query($sq);
					$_SESSION['USERNAME']=$user;
					echo '<p style="color:green;font-size:14px;text-align:center;">Profile successfully updated.</p>';
				}
			}
			else
			{
				echo '<p style="color:red;font-size:14px;">Password doesn\'t match.</p>'; 
			}
		}
	?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>: <input type="text" name="username" value="<?php echo $_SESSION['USERNAME']; ?>" style="border-radius:5px;" autocomplete="off" required></td> 
			</tr>
			<tr>
				<td colspan="2"> &nbsp </td>
			</tr>
			<tr>
				<td>Old Password</td>
				<td>: <input type="password" name="old_pass" placeholder="   ********" style="border-radius:5px;" required>
			</tr>
			<tr>
				<td colspan="2"> &nbsp </td>
			</tr>
			<tr>
				<td>New Password</td>
				<td>: <input type="password" name="new_pass" placeholder="   ********" title="Fill it only for change password" style="border-radius:5px;">
			</tr>
			<tr>
				<td colspan="2"> &nbsp </td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:right;"><input type="submit" name="log" value="Update" title="Click for update profile." style="background: url(images/1.jpg);color:white;border-radius:5px;">  </td>
			</tr>
		</table>
	</form>
	<form action="a_index.php" method="post" style="margin-top:20px;text-align:right;">
		<input type="password" name="pass_reset" placeholder="   ******" style="width:70px;border-radius:5px;" title="Enter your password" autocomplete="off" required >
		<input type="submit" name="reset_all" title="Click here for reset the hole system." value="Reset All" style="border-radius:5px;background:url(images/1.jpg);color:white;margin-left:10px;"> 
	</form>
	</br>
<?php include("includes/footer.php"); ?>