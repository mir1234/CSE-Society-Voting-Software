<?php include("includes/admin_header.php"); ?> 
	</div>
	</br></br>
	<h1 style="margin-top:310px;margin-bottom:30px;">Election Result</h1>
	<?php
		$sq="select * from sys_cse_soc_candidate ";
		$re=mysql_query($sq);
		if(mysql_num_rows($re)<=0)
		{
			echo '<marquee><p style="font-size:40px;color:red;margin-top:100px;height:120px;"> *** System not ready. Try later!!! ***</p></marquee>';
		}
		else
		{  ?>
		<?php
			$sql="select * from sys_cse_soc_post order by id asc ";
			$res=mysql_query($sql);
			while($arr=mysql_fetch_array($res))
			{
				$mm="select max(votes) total from sys_cse_soc_candidate where post_id='$arr[id]'";
				$sq=mysql_query($mm);
				$max=mysql_fetch_array($sq);
	?>
		<div style="min-height:120px;width:960px;float:left;margin-bottom:23px;border: 1px solid black;background:#A1B2C3;border-radius:5px;" title="<?php echo $arr['post_name']; ?>">
		<div style="margin-top:10px;margin-bottom:10px;min-height:100px;width:220px;border:2px solid black;border-radius:5px;font-size:22px;float:left;margin-right:6px;margin-left:10px;background:url(images/2.jpg);">
			<p style="color:white;font-weight:bold;margin-top:20px;"><?php echo $arr['post_name']; ?>
		</div>
		<?php
			$vot="select * from sys_cse_soc_candidate where post_id='$arr[id]'";
			$v_res=mysql_query($vot);
			if(mysql_num_rows($v_res)==0)
			{ ?>
				<div style="height:100px;min-width:220px;border:2px solid black;border-radius:5px;font-size:22px;float:left;margin-top:10px;margin-bottom:10px;margin-left:6px;margin-right:10px;background:#F5F5DC;" OnMouseOut="this.style.background='#F5F5DC'" OnMouseOver="this.style.background='#F5CAF9'" title="This candidate is selected as <?php echo $arr['post_name']; ?>.">
				<p style="text-align:center;font-weight:bold;font-size:14px;color:green;margin: 15px 0px 0px 0px;">
					<font color="black"> No Candidates!!! </font></br>
					<font color="blue">	Manual </font></br>
					** Selection **
				</p>
				</div>
	<?php	}
			else if(mysql_num_rows($v_res)==1)
			{  
				$vo_arr=mysql_fetch_array($v_res);
			?>
				<div style="height:100px;min-width:220px;border:2px solid black;border-radius:5px;font-size:22px;float:left;margin-top:10px;margin-bottom:10px;margin-left:6px;margin-right:10px;background:#F5F5DC;" OnMouseOut="this.style.background='#F5F5DC'" OnMouseOver="this.style.background='#F5CAF9'" title="This candidate is selected as <?php echo $arr['post_name']; ?>.">
				<img src="images/candidate/<?php echo $vo_arr['image']; ?>" height="85" width="65" style="float:left;border-radius:5px;margin: 5px 0px 0px 5px;border: 2px solid black;">
				<?php
					$s="select * from sys_cse_soc_voter where student_id='$vo_arr[voter_id]'";
					$r=mysql_query($s);
					$a=mysql_fetch_array($r);
				?>
				<p style="font-size:15px;font-weight:bold;float:left;margin: 15px 5px 0px 5px;"> <?php echo $a['name']; ?> </p>
				</br> 
				<p style="text-align:left;font-weight:bold;font-size:14px;color:green;margin: 30px 0px 0px 0px;">
					&nbsp ** Selected  **
				</p>
				</div>
	<?php	}
			else
			{
				while($vo_arr=mysql_fetch_array($v_res))
				{
				if($max['total']==$vo_arr['votes'])
						$col="gold";
				else
						$col="#F5F5DC";
		?>
			<div style="height:100px;min-width:220px;border:2px solid black;border-radius:5px;font-size:22px;float:left;margin-top:10px;margin-bottom:10px;margin-left:6px;margin-right:10px;background:<?php echo $col; ?>;" OnMouseOut="this.style.background='<?php echo $col; ?>'" OnMouseOver="this.style.background='#F5CAF9'" title="Select this candidate as <?php echo $arr['post_name']; ?>.">
				<img src="images/candidate/<?php echo $vo_arr['image']; ?>" height="85" width="65" style="float:left;border-radius:5px;margin: 5px 0px 0px 5px;border: 2px solid black;">
				<?php
					$s="select * from sys_cse_soc_voter where student_id='$vo_arr[voter_id]'";
					$r=mysql_query($s);
					$a=mysql_fetch_array($r);
				?>
				<p style="font-size:15px;font-weight:bold;float:left;margin: 15px 5px 0px 5px;"> <?php echo $a['name']; ?> </p>
				</br> 
				<p style="text-align:left;font-size:15px;font-weight:bold;color:purple;margin: 20px 0px 0px 0px;">
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Votes: <font color="blue"><?php echo $vo_arr['votes']; ?></font>
				</p>
				<?php 
					if($max['total']==$vo_arr['votes'])
					{ ?>
						<p style="text-align:left;font-size:15px;font-weight:bold;color:green;margin: 0px 0px 0px 0px;">
							&nbsp&nbsp&nbsp	** Winner **
						</p>
				<?php
				
					}
				?>
			</div>
	<?php		} 
			} ?>
			</div>
			
	<?php		}  
		} ?>
	</br>
	</br>
<?php include("includes/footer.php"); ?>