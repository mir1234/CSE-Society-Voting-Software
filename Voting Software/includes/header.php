<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="images/logo.png" type="image/png">
<title>CSE Society Election - <?php echo date("y"); ?></title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="styles/galleriffic.css"/>
<link type="text/css" rel="stylesheet" href="styles/style.css" />
<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="js/jquery.opacityrollover.js"></script>
<script type="text/javascript" src="js/jquery.galleriffic.js"></script>
<script type="text/javascript" src="js/gallery-settings.js"></script>
<!--[if IE 6]>
<script src="js/ie6-transparency.js"></script>
<script>DD_belatedPNG.fix('#header .logo img, .subtitle img, .slideshow-container, .navigation-container #thumbs .thumbs li .thumb img, .navigation a.next, .footer-line, #sidebar .author-photo, .line, .commentlist .comment-reply-link, #contact-page #contact .submit');</script>
<link type="text/css" rel="stylesheet" type="text/css" href="styles/ie6.css" />
<![endif]-->
<!--[if IE 7]><link type="text/css" rel="stylesheet" type="text/css" href="styles/ie7.css" /><![endif]-->
<!--[if IE 8]><link type="text/css" rel="stylesheet" type="text/css" href="styles/ie8.css" /><![endif]-->
</head>
<body>
<?php
	//Start session
	session_start();
	//Unset the variables stored in session
	unset($_SESSION['MEMBER_ID']);
	unset($_SESSION['STUDENT_ID']);
	unset($_SESSION['KEYWORD']);
	unset($_SESSION['ADMIN_ID']);
	unset($_SESSION['USERNAME']);
	unset($_SESSION['PASSWORD']);
?>
<div id="wrap">
  <div id="header">
	<div class="logo" >
	</div>
	<div id="nav" style="background: url(images/1.jpg);">
		<a href="index.php"><img src="images/logo.png" height="140" width="120" alt="Logo"></a>
		<a href="index.php" style="text-decoration: none;color:white;"><h1 style="margin-bottom:20px;" onMouseOver="this.style.color='yellow'" onMouseOut="this.style.color='white'"> CSE Society Election - <?php echo date("y"); ?> </h1></a>
	</div>
	<img src="images/l_t.gif" height="5" width="960" style="margin:0px;">
    <!--end nav-->
  </div>
  <!--end header-->
  <div id="frontpage-content">
    <div id="container">