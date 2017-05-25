<?php include("includes/admin_header.php"); ?> 
	</div>
	</br></br>
	<?php
	
if(isset($_REQUEST['add_can']))
{
	?>
		<h1 style="margin-top:310px;margin-bottom:30px;">Add Candidate</h1>
		<?php
			if(isset($_REQUEST['can_vot']))
			{
				$student_id=trim($_REQUEST['voter_id']);
				$sq="select * from sys_cse_soc_voter where student_id='$student_id'";
				$res=mysql_query($sq);
				if(mysql_num_rows($res)<=0)
					echo '<p style="color:red;text-align:center;">*** Invalid student ID *** </p>';
				else
				{
					$sq="select * from sys_cse_soc_candidate where voter_id='$student_id'";
					$res=mysql_query($sq);
					if(mysql_num_rows($res)>0)
						echo '<p style="color:red;text-align:center;">*** This student ID already in candidate list *** </p>';
					else
					{
						$fl=0;
						for($i=0;$i<strlen($student_id);$i++)
								if($student_id[$i]==';' or $student_id[$i]==')' or $student_id[$i]=='(')
								{
									$fl=1;
									break;
								}
						if($fl==1)
							echo '<p style="color:red;text-align:center;">*** Please avoid invaid characters. ex. ;,(, ) *** </p>';
						else
						{
							function photo_upload($file,$i,$max_foto_size,$photo_extention,$folder_name,$path='')
									{


											if($file['tmp_name'][$i]=="")
											{
													$ran="false";
													return $ran;
											}
											if($file['tmp_name'][$i]!="")
											{
													$p=$file['name'][$i];
													$pos=strrpos($p,".");
													$ph=strtolower(substr($p,$pos+1,strlen($p)-$pos));
													$im_size =  round($file['size'][$i]/1024,2);

													if($im_size > $max_foto_size)
													   {
															$msg='<font color="red" style="margin-left:30px;"><b> File is too large. </b></font>';
																	echo $msg.'</br></br>';
															
															return;
													   }
													$photo_extention = explode(",",$photo_extention);
													if(!in_array($ph,$photo_extention ))
													   {
															$msg='<font color="red" style="margin-left:30px;"><b> Upload correct file. </b></font>';
																	echo $msg.'</br></br>';
															

															return;
													   }
											}
													$ran=date(time());
													$c=$ran.rand(1,10000);
													$ran.=$c.".".$ph;



													if(isset($file['tmp_name'][$i]) && is_uploaded_file($file['tmp_name'][$i]))
													{
													$ff = $path."images/".$folder_name."/".$ran;
													move_uploaded_file($file['tmp_name'][$i], $ff );
													chmod($ff, 0777);
													}
													return  $ran;
										   
									}
									
							$file=$_FILES['photo'];
							$image_name=photo_upload($file,0,6000000,"jpg,gif,png,jpeg",'candidate',$path='');
							
							if($image_name=="false")
							{
								echo '<p style="color:red;text-align:center;"> *** Please upload a Image of candidate. *** </p>';
							}
							else
							{
								$sq="insert into sys_cse_soc_candidate(image,voter_id,post_id,votes)
									values
									('$image_name','$student_id','$_REQUEST[post_id]','0')";
								mysql_query($sq);
								echo '<p style="color:green;text-align:center;"> Candidate successfully added. </p>';
							}
						}
					}
				}
			}
		?>
		<a style="margin-right:600px;" href="a_post.php"><< Back</a>
		<form action="a_post.php" method="post"ENCTYPE="MULTIPART/FORM-DATA">
			<table style="margin-left:350px;">
				<tr>
					<td>Post Name<td>
					<td>: <button type="button" style="border-radius:5px;width:174px;">
					<?php
						$sq="select * from sys_cse_soc_post where id='$_REQUEST[post_id]'";
						$res=mysql_query($sq);
						$arr=mysql_fetch_array($res);
						echo $arr['post_name'];
					?>
					</button></td>
				</tr>
				<tr><td colspan="2"> &nbsp </td></tr>
				<tr>
					<td>Student ID<td>
					<td>: <input type="text" name="voter_id" placeholder="   Candidate Student ID" autocomplete="off" style="border-radius:5px;" required>
				</tr>
				<tr><td colspan="2"> &nbsp </td></tr>
				<tr>
					<td>Upload Photo<td>
					<td>: <input type="file" name="photo[0]" required>
				</tr>
				<tr><td colspan="2"> &nbsp </td></tr>
				<tr>
					<td colspan="3" style="text-align:right;">
						<input type="submit" title="Add candidate in this post." name="can_vot" value="Add" style="border-radius:5px;color:white;background:url(images/1.jpg);"> 
					</td>
				<tr>
			</table>
			<input type="hidden" name="add_can">
			<input type="hidden" name="post_id" value="<?php echo $_REQUEST['post_id'];?>" >
		</form>
		<h2 style="text-align:left;margin-left:80px;">Candidate list: </h2>
		<?php 
			if(isset($_REQUEST['del_can']))
			{
				$sq="delete from sys_cse_soc_candidate where id='$_REQUEST[candidate_id]'";
				mysql_query($sq);
				echo '<p style="color:red;text-align:center;"> Candidate deleted successfully. </p>';
			}
		?>
		<table style="margin-left:80px;">
			<tr>
				<td style="text-align:center;font-size:20px;width:350px;border:2px solid black;">
					Candidate Name
				</td>
				<td style="text-align:center;font-size:20px;width:150px;border:2px solid black;">
					Student Id
				</td>
				<td style="text-align:center;font-size:20px;width:150px;border:2px solid black;">
					Semester
				</td>
				<td style="text-align:center;font-size:20px;width:150px;border:2px solid black;">
					Action
				</td>
			</tr>
			<?php
				$sq="select * from sys_cse_soc_candidate where post_id='$_REQUEST[post_id]'";
				$re=mysql_query($sq);
				if(mysql_num_rows($re)<=0)
					echo '<tr><td colspan="4" style="text-align:center;color:red;"> No Candidate added yet. </td></tr>';
				while($arr=mysql_fetch_array($re))
				{
					$sk="select * from sys_cse_soc_voter where student_id='$arr[voter_id]' ";
					$rk=mysql_query($sk);
					$ak=mysql_fetch_array($rk);
					echo '<tr><td colspan="4">&nbsp </td></tr>';
					echo '<tr>';
						echo '<td style="font-size:17px;"><img src="images/candidate/'.$arr['image'].'" height="50" width="40" style="float:left;border-radius:5px;margin-right:10px;margin-left:10px;"> 
								<p style="margin-top:15px;">'.$ak['name'].'</p>
						</td>';
						echo '<td style="text-align:center;font-size:17px;">'.$arr['voter_id'].'</td>';
						echo '<td style="text-align:center;font-size:17px;">'.$ak['semester'].' - '. ($ak['year']-2000) .'</td>';
						echo '<td style="text-align:center;font-size:17px;"><a href="a_post.php?del_can=ll&add_can=ll&post_id='.$_REQUEST['post_id'].'&candidate_id='.$arr['id'].'">Delete</a></td>';
					echo '</tr>';
				}
			?>
		</table>
<?php
}
else
{
?>
	<form action="a_post.php" method="post" style="margin-top:20px;text-align:right;margin-left:0px;">
		<?php
			if(isset($_REQUEST['add_post']))
			{
				$p_name=trim($_REQUEST['p_name']);
				$kk="select * from sys_cse_soc_post where post_name='$p_name' ";
				$rr=mysql_query($kk);
				if(mysql_num_rows($rr)>0)
				{
						echo '<p style="color:red;">*** Post aready added. *** </p>';
				}
				else
				{
					$fl=0;
					for($i=0;$i<strlen($p_name);$i++)
						if($p_name[$i]==';' or $p_name[$i]==')' or $p_name[$i]=='(')
						{
							$fl=1;
							break;
						}
					if($fl==1)
						echo '<p style="color:red;">*** Please avoid invaid characters. ex. ;,(, ) *** </p>';
					else
					{
						$sq="insert into sys_cse_soc_post(post_name)
							values ('$p_name')";
						mysql_query($sq);
						echo '<p style="color:green;">*** Post successfully added. *** </p>';
					}
				}		
			}
		?>
		<input type="text" name="p_name" autocomplete="off" placeholder="  Election post name" style="border-radius:5px;" required>
		<input type="submit" name="add_post" title="Click for add a new post." value="Add Post" style="border-radius:5px;color:white;background: url(images/1.jpg);">
	</form>
	<h1 style="margin-top:30px;margin-bottom:30px;">Post List</h1>
	<?php
		if(isset($_REQUEST['update']))
		{
			$fl=0;
			$post_name=trim($_REQUEST['post_name']);
			for($i=0;$i<strlen($post_name);$i++)
				if($post_name[$i]==';' or $post_name[$i]==')' or $post_name[$i]=='(')
				{
					$fl=1;
					break;
				}
			if($fl==1)
				echo '<p style="color:red;text-align:center;">*** Please avoid invaid characters. ex. ;,(, ) *** </p>';
			else
			{
				$sq="update sys_cse_soc_post set
						post_name='$post_name'
					where id='$_REQUEST[post_id]'";
				mysql_query($sq);
				echo '<p style="color:green;text-align:center;">*** Post name updated successfully. *** </p>';
			}
		}
		if(isset($_REQUEST['delete_post']))
		{
			$s_d="delete from sys_cse_soc_candidate where post_id='$_REQUEST[post_id]'";
			mysql_query($s_d);
			$s_dd="delete from sys_cse_soc_post where id='$_REQUEST[post_id]'";
			mysql_query($s_dd);
			echo '<p style="text-align:center;color:red;"> *** Post & post related all candidates deleted. *** </p>';
		}
	?>
	<table style="margin-left:25px;">
		<tr>
			<td style="font-size:20px;border:2px solid black;width:370px;text-align:center;"> Post Name </td>
			<td style="font-size:20px;border:2px solid black;width:230px;text-align:center;"> Candidates </td>
			<td style="font-size:20px;border:2px solid black;width:300px;text-align:center;"> Action </td>
		</tr>
		<?php
			$sq="select * from sys_cse_soc_post order by id asc ";
			$res=mysql_query($sq);
			if(mysql_num_rows($res)<=0)
			{
				echo '<tr><td colspan="3" style="color:red;text-align:center;">*** No post added yet. *** </td></tr>';
			}
			while($arr=mysql_fetch_array($res))
			{
				echo '
					<form action="a_post.php" method="post">
				<tr>';
					echo '<td style="font-size:16px;width:370px;text-align:center;"><input type="text" name="post_name" value="'.$arr['post_name'].'" style="border-radius:5px;width:290px;" autocomplete="off">
							<input type="submit" name="update" value="Update" title="Click for update the post name." style="color:white;border-radius:5px;background:url(images/1.jpg);">
							<input type="hidden" name="post_id" value="'.$arr['id'].'">
					</td>';
					$ss="select * from sys_cse_soc_candidate where post_id='$arr[id]' ";
					$rr=mysql_query($ss);
					echo '<td style="font-size:16px;width:230px;text-align:center;">'.mysql_num_rows($rr).'</td>';
					echo '<td style="font-size:16px;width:300px;text-align:center;">
								<a href="a_post.php?add_can=act&post_id='.$arr['id'].'">Candidates </a> |
								<a href="a_post.php?delete_post=act&post_id='.$arr['id'].'">Delete </a>
						  </td>';
				echo '</tr></form>';
			}
		?>
	</table>
	<?php } ?>
	</br>
	</br>
<?php include("includes/footer.php"); ?>