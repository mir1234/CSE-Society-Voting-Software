<?php include("includes/vote_header.php"); ?> 
	</div>
	</br></br>
	<h1 style="margin-top:240px;margin-bottom:40px;">Welcome to voting page</h1>
	<?php
		$sq="select * from sys_cse_soc_candidate ";
		$re=mysql_query($sq);
		if(mysql_num_rows($re)<=0)
		{
			echo '<marquee><p style="font-size:40px;color:red;margin-top:100px;height:120px;"> *** System not ready. Try later!!! ***</p></marquee>';
		}
		else
		{  ?>
		<form action="index.php" method="post">
		<?php
			$po="po";
			$k=0;
			$sql="select * from sys_cse_soc_post order by id asc ";
			$res=mysql_query($sql);
			while($arr=mysql_fetch_array($res))
			{
				$k++;
				$po=$po.$k;
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
		?>
			<div style="height:100px;min-width:220px;border:2px solid black;border-radius:5px;font-size:22px;float:left;margin-top:10px;margin-bottom:10px;margin-left:6px;margin-right:10px;background:#F5F5DC;" OnMouseOut="this.style.background='#F5F5DC'" OnMouseOver="this.style.background='#F5CAF9'" title="Select this candidate as <?php echo $arr['post_name']; ?>.">
				<img src="images/candidate/<?php echo $vo_arr['image']; ?>" height="85" width="65" style="float:left;border-radius:5px;margin: 5px 0px 0px 5px;border: 2px solid black;">
				<?php
					$s="select * from sys_cse_soc_voter where student_id='$vo_arr[voter_id]'";
					$r=mysql_query($s);
					$a=mysql_fetch_array($r);
				?>
				<p style="font-size:15px;font-weight:bold;float:left;margin: 15px 5px 0px 5px;"> <?php echo $a['name']; ?> </p>
				</br> 
				<p style="text-align:left;font-size:14px;color:blue;margin: 30px 0px 0px 0px;">
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Select: 
					<input type="radio" name="<?php echo $po; ?>" value="<?php echo $vo_arr['id']; ?>" required>
				</p>
			</div>
	<?php		} 
			} ?>
			</div>
			
	<?php		}  ?>
			
			</br>
			</br></br></br>
			<input type="hidden" name="voter_id" value="<?php echo $_SESSION['STUDENT_ID']; ?>">
			<input type="submit" name="vote" value="Vote" style="background: url(images/1.jpg);height:40px;color:white;margin-left:885px;font-size:30px;border-radius:5px;">
			</form>
		<?php
		} ?>
	</br></br>
<?php include("includes/footer.php"); ?>