<?php include("includes/header.php"); ?> 

	<h1 style="margin-top:10px;margin-left:100px;text-align:left;"> Voter Records</h1>
	<form action="login_exec.php" method="post">
	<table style="margin:36px 0px 27px 350px;font-size:20px;color:blue;">	
		<tr>
			<td colspan="2" style="text-align:center;">
				
				<?php
					
					if(isset($_REQUEST['vote']))
					{
						$te="select * from sys_cse_soc_voter where student_id='$_REQUEST[voter_id]'";
						$re=mysql_query($te);
						$ta=mysql_fetch_array($re);
						if($ta['vote_status']==0)
						{
							$uu="update sys_cse_soc_voter 
							set 
							vote_status='1' 
							where student_id='$_REQUEST[voter_id]' ";
							mysql_query($uu);		
							$po="po";
							$k=0;
							$sq="select * from sys_cse_soc_post order by id asc ";
							$re=mysql_query($sq);
							while($arr=mysql_fetch_array($re))
							{
								$k++;
								$po=$po.$k;
								$s="select * from sys_cse_soc_candidate where post_id='$arr[id]'";
								$q=mysql_query($s);
								if(mysql_num_rows($q)>1)
								{
									$id=$_REQUEST[''.$po.''];
									$sqs="select * from sys_cse_soc_candidate where id='$id'";
									$rer=mysql_query($sqs);
									$ara=mysql_fetch_array($rer);
									$vo=$ara['votes'];
									$vo+=1;
									$u="update sys_cse_soc_candidate set votes='$vo' where id='$id'";
									mysql_query($u);
									
								}
							}
							
							echo '<p style="color:green;">Thanks for your vote.</p>';
							echo '<p style="color:purple;margin-bottom:10px;">Your vote successfully casted.</p>';
						}
					}
					
					if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
					foreach($_SESSION['ERRMSG_ARR'] as $msg) {
					echo $msg;
					}
					echo '</ul>';
					unset($_SESSION['ERRMSG_ARR']);
					}
				?>
			</td>
		</tr>
		<tr>
			<td>Student ID </td>
			<td>: <input type="text" name="student_id" autocomplete="off" placeholder="  12 digit's student ID" title="12 digit's student ID" style="border-radius:5px;" required></td>
		<tr>
		<tr>
			<td colspan="2"> &nbsp </td>
		</tr>
		<tr>
			<td>Keyword  </td>
			<td>: <input type="password" name="keyword" placeholder="  Secret 8 digit's keyword" title="Secret 8 digit's keyword" style="border-radius:5px;" required></td>
		<tr>
		<tr>
			<td colspan="2"> &nbsp </td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:right;">
				<input type="submit" name="log" value="Submit" title="Submit for vote page" style="background: url(images/1.jpg);color:white;border-radius:5px;">
			</td>
		</tr>
	</table>
	<img src="images/l_t.gif" height="5" width="960" style="margin:0px;">
    </br></br>
<?php include("includes/footer.php"); ?>