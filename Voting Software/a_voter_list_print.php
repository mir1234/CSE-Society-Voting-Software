<?php 
	include("includes/connection.php");
	require_once("a_auth.php");
	if(isset($_REQUEST['print'])){
		echo '<p style="fot-size:12px;">*** Press <font style="color:blue;"> " Ctrl+p " </font> for print. ***</p>';
	
		$des=date("Y");
		$i=$des-4;
		for(;$i<=$des;$i++)
		{	
			$sq="select * from sys_cse_soc_voter where semester='Spring' and year='$i' and status='Active' ";
			$res=mysql_query($sq);
			if(mysql_num_rows($res)>0)
			{
				echo '<h2 style="margin-top:50px;margin-left:40px;margin-bottom:0px;">Voter List (Spring - '. ($i-2000) .')</h2>';
				echo '<table style="width:900px;margin-left:30px;">';
				echo '<tr>
					<td style="font-size:20px;width:300px;text-align:center;border:2px solid black;">Name</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Student Id</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Semester</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Keyword</td>
				</tr>';
				$sql="select * from sys_cse_soc_voter where semester='Spring' and year='$i' and status='Active' order by student_id asc ";
				$res=mysql_query($sql);
				while($arr=mysql_fetch_array($res))
				{
				echo '<tr><td colspan="4"></td></tr>';
				echo '<tr>
				<td style="width:250px;text-align:center;">'.$arr['name'].'</td>
				<td style="width:150px;text-align:center;">'.$arr['student_id'].'</td>
				<td style="width:150px;text-align:center;">Spring - '. ($i-2000) .'</td>
				<td style="width:150px;text-align:center;">'.$arr['keyword'].'</td>
			</tr>';
				} 
			echo '</table>';
	
			}
				
				
			
			$sq="select * from sys_cse_soc_voter where semester='Summer' and year='$i' and status='Active' ";
			$res=mysql_query($sq);
			if(mysql_num_rows($res)>0)
			{
				echo '<h2 style="margin-top:50px;margin-left:40px;margin-bottom:0px;">Voter List (Summer - '. ($i-2000) .')</h2>';
				echo '<table style="width:900px;margin-left:30px;">';
				echo '<tr>
					<td style="font-size:20px;width:300px;text-align:center;border:2px solid black;">Name</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Student Id</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Semester</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Keyword</td>
				</tr>';
				$sql="select * from sys_cse_soc_voter where semester='Summer' and year='$i' and status='Active' order by student_id asc ";
				$res=mysql_query($sql);
				while($arr=mysql_fetch_array($res))
				{
				echo '<tr><td colspan="4"></td></tr>';
				echo '<tr>
				<td style="width:250px;text-align:center;">'.$arr['name'].'</td>
				<td style="width:150px;text-align:center;">'.$arr['student_id'].'</td>
				<td style="width:150px;text-align:center;">Summer - '. ($i-2000) .'</td>
				<td style="width:150px;text-align:center;">'.$arr['keyword'].'</td>
			</tr>';
				} 
			echo '</table>';
	
			}
			
			
			$sq="select * from sys_cse_soc_voter where semester='Fall' and year='$i' and status='Active' ";
			$res=mysql_query($sq);
			if(mysql_num_rows($res)>0)
			{
				echo '<h2 style="margin-top:50px;margin-left:40px;margin-bottom:0px;">Voter List (Fall - '. ($i-2000) .')</h2>';
				echo '<table style="width:900px;margin-left:30px;">';
				echo '<tr>
					<td style="font-size:20px;width:300px;text-align:center;border:2px solid black;">Name</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Student Id</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Semester</td>
					<td style="font-size:20px;width:200px;text-align:center;border:2px solid black;">Keyword</td>
				</tr>';
				$sql="select * from sys_cse_soc_voter where semester='Fall' and year='$i' and status='Active' order by student_id asc ";
				$res=mysql_query($sql);
				while($arr=mysql_fetch_array($res))
				{
				echo '<tr><td colspan="4"></td></tr>';
				echo '<tr>
				<td style="width:250px;text-align:center;">'.$arr['name'].'</td>
				<td style="width:150px;text-align:center;">'.$arr['student_id'].'</td>
				<td style="width:150px;text-align:center;">Fall - '. ($i-2000) .'</td>
				<td style="width:150px;text-align:center;">'.$arr['keyword'].'</td>
			</tr>';
				} 
			echo '</table>';
	
			}
			
		}
		
	}
	else
		header("location: index.php");
 ?>