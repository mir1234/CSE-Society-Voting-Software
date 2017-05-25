    <?php
    //Start session
    session_start();
     
    //Include database connection details
    require_once('includes/connection.php');
     
    //Array to store validation errors
    $errmsg_arr = array();
     
    //Validation error flag
    $errflag = false;
     
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
    $str = stripslashes($str);
    }
    return mysql_real_escape_string($str);
    }
     
    //Sanitize the POST values
    $student_id = clean($_POST['student_id']);
    $keyword = clean($_POST['keyword']);
    
	$username=$student_id;
	$password=sha1($keyword);
	$qry="SELECT * FROM sys_cse_soc_admin WHERE username='$username' AND password='$password'";
    $result=mysql_query($qry);
    if($result) {
		if(mysql_num_rows($result) > 0) {
			//Login Successful
			$member = mysql_fetch_assoc($result);
			session_regenerate_id();
			$_SESSION['ADMIN_ID'] = $member['id'];
			$_SESSION['USERNAME'] = $member['username'];
			$_SESSION['PASSWORD'] = $member['password'];
			session_write_close();
			header("location: a_index.php");
			exit();
		}
	}
    
    //Create query
    $qry="SELECT * FROM sys_cse_soc_voter WHERE student_id='$student_id' AND keyword='$keyword'";
    $result=mysql_query($qry);
     
    //Check whether the query was successful or not
    if($result) {
    if(mysql_num_rows($result) > 0) {
		//Login Successful
		$member = mysql_fetch_assoc($result);
		if($member['status']=="Inactive")
		{
			$errmsg_arr[] = '<font color="red" style="margin-left:0px;font-size:13px;padding-bottom:5px;"><b>** SORRY YOUR STUDENT ID IS INACTIVE **</b></font>';
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			session_write_close();
			header("location: index.php");
			exit();
		}
		else
		{
			session_regenerate_id();
			if($member['vote_status']==0)
			{
			$_SESSION['MEMBER_ID'] = $member['id'];
			$_SESSION['STUDENT_ID'] = $member['student_id'];
			$_SESSION['KEYWORD'] = $member['keyword'];
			session_write_close();
			header("location: vote.php");
			exit();
			}
			else
			{
				$errmsg_arr[] = '<font color="red" style="margin-left:0px;font-size:13px;padding-bottom:5px;"><b>** SORRY YOUR VOTE ALREADY CASTED **</b></font>';
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: index.php");
				exit();
			}
		}
    }
	
	else {
    //Login failed
    $errmsg_arr[] = '<font color="red" style="margin-left:0px;font-size:13px;padding-bottom:5px;"><b>** WRONG STUDENT ID OR KEYWORD **</b></font>';
    $errflag = true;
    if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
    }
    }
    }else {
    die("Query failed");
    }
    ?>