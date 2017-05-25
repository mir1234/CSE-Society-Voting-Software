<?php include("includes/admin_header.php"); ?> 
	</div>
	</br></br>
	<h1 style="margin-top:310px;margin-bottom:30px;">Voter List</h1>
	<form action="a_voter_sem_view.php" method="post">
	<a href="a_voter.php?reset=ll" class="confirmation_reset_st"><button type="button" title="Click for reset all voter vote status." style="background: url(images/1.jpg);color:white;width:140px;height:30px;border-radius:5px;margin-left:10px;margin-bottom:5px;">Reset vote status</button></a>
	<script type="text/javascript">
		var elems_st = document.getElementsByClassName('confirmation_reset_st');
		var confirmIt_st = function (er) {
			if (!confirm('Are you sure you want to reset all voter vote status?')) er.preventDefault();
		};
		for (var i = 0, l = 3; i < l; i++) {
			elems_st[i].addEventListener('click', confirmIt_st, false);
		}
	</script>
	<a href="a_voter.php?reset_key=ll" class="confirmation_reset" ><button type="button" title="Click for reset all voter keywords." style="background: url(images/1.jpg);color:white;width:140px;height:30px;border-radius:5px;margin-left:5px;margin-bottom:5px;">Reset Keywords</button></a>
	<script type="text/javascript">	
		var elems = document.getElementsByClassName('confirmation_reset');
		var confirmIt = function (e) {
			if (!confirm('Are you sure you want to reset all voter keywords?')) e.preventDefault();
		};
		for (var i = 0, l = 3; i < l; i++) {
			elems[i].addEventListener('click', confirmIt, false);
		}
	</script>

	<a href="a_voter_list_print.php?print=ll" target="_blank"><button type="button" title="Click for print all voters token." style="background: url(images/1.jpg);color:white;width:140px;height:30px;border-radius:5px;margin-left:5px;margin-bottom:5px;">Print tokens</button></a>
	<a href="a_voter_add.php?add_v=ll"><button type="button" title="Click for add a new voter." style="background: url(images/1.jpg);color:white;width:140px;height:30px;border-radius:5px;margin-left:5px;margin-bottom:5px;">Add Voter</button></a>
	<input type="text" name="student_id" title="Search voter by Student ID." autocomplete="off" placeholder="   Student ID" style="border-radius:5px;width:200px;height:23px;margin-left:55px;" required>
	<input type="submit" name="search" value="Search" title="Search voter by Student ID." style="border-radius:5px;height:30px;background: url(images/1.jpg);color:white;">
	<input type="hidden" name="act">
	</form>
	<table style="margin-left:30px;">
	<tr>
		<td style="border:2px solid black;width:300px;text-align:center;font-size:20px;">Spring Semester</td>
		<td style="border:2px solid black;width:300px;text-align:center;font-size:20px;">Summer Semester</td>
		<td style="border:2px solid black;width:300px;text-align:center;font-size:20px;">Fall Semester</td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center;">
			<?php
				if(isset($_REQUEST['reset_key'])){
				$sql="select * from sys_cse_soc_voter order by id asc ";
					$res=mysql_query($sql);
					$k=12345;
					while($arr=mysql_fetch_array($res)){
						$key=rand(11011011,95959595);
						$key+=$k;
						$k++;
						$ss="update sys_cse_soc_voter set keyword='$key' where id='$arr[id]'";
						mysql_query($ss);
					}
					echo '<p style="color:purple;font-size:17px;">Voter keywords successfully reseted.<p>';
				}
				if(isset($_REQUEST['reset'])){
					$sql="select * from sys_cse_soc_voter order by id asc ";
					$res=mysql_query($sql);
					while($arr=mysql_fetch_array($res)){
						$ss="update sys_cse_soc_voter set vote_status='0' where id='$arr[id]'";
						mysql_query($ss);
					}
					$sql="select * from sys_cse_soc_candidate order by id asc ";
					$res=mysql_query($sql);
					while($arr=mysql_fetch_array($res)){
						$ss="update sys_cse_soc_candidate set votes='0' where id='$arr[id]'";
						mysql_query($ss);
					}
					echo '<p style="color:green;font-size:17px;">Voter status successfully reseted.<p>';
				}
			?>
		</td>
	</tr>
	<?php
		$des=date("Y");
		$i=$des-4;
		for(;$i<=$des;$i++)
		{
			echo '<tr>';
			
			$sq="select * from sys_cse_soc_voter where semester='Spring' and year='$i' ";
			$res=mysql_query($sq);
			if(mysql_num_rows($res)>0)
				echo '<td style="text-align:center;"><a href="a_voter_sem_view.php?act=ll&semester=Spring&year='.$i.'"><button type="button" title="Click for show Spring - '.($i-2000).' semester voters." style="background: url(images/1.jpg);color:white;width:200px;border-radius:5px;">Spring - '. ($i-2000) .'</button></a></td>';
			else
				echo '<td></td>';
				
				
			
			$sq="select * from sys_cse_soc_voter where semester='Summer' and year='$i' ";
			$res=mysql_query($sq);
			if(mysql_num_rows($res)>0)
				echo '<td style="text-align:center;"><a href="a_voter_sem_view.php?act=ll&semester=Summer&year='.$i.'"><button type="button" title="Click for show Summer - '.($i-2000).' semester voters." style="background: url(images/1.jpg);color:white;width:200px;border-radius:5px;">Summer - '. ($i-2000) .'</button></a></td>';
			else
				echo '<td></td>';

			
			
			$sq="select * from sys_cse_soc_voter where semester='Fall' and year='$i' ";
			$res=mysql_query($sq);
			if(mysql_num_rows($res)>0)
				echo '<td style="text-align:center;"><a href="a_voter_sem_view.php?act=ll&semester=Fall&year='.$i.'"><button type="button" title="Click for show Fall - '.($i-2000).' semester voters." style="background: url(images/1.jpg);color:white;width:200px;border-radius:5px;">Fall - '. ($i-2000) .'</button></a></td>';
			else
				echo '<td></td>';
			echo '</tr>';
		}
	?>
	</table>
	</br>
	</br>
<?php include("includes/footer.php"); ?>