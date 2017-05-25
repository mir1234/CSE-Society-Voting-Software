<?php include("connection.php");
	require_once("a_auth.php");
 ?>
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
<div id="wrap">
  <div id="header">
	<div class="logo" >
	</div>
	<div id="nav" style="background: url(images/1.jpg);">
		<a href="a_index.php"><img src="images/logo.png" height="140" width="120" alt="Logo"></a>
		<a href="a_index.php" style="text-decoration: none;color:white;"><h1 style="margin-bottom:20px;" onMouseOver="this.style.color='yellow'" onMouseOut="this.style.color='white'"> CSE Society Election - <?php echo date("y"); ?> </h1></a>
		</br>
		<ul id="nav-pages">
			<li> <a href="a_index.php" style="text-decoration: none;font-weight:bold;"> Home </a> </li>
			<li> <a href="a_result.php" style="text-decoration: none;font-weight:bold;"> Result </a> </li>
			<li> <a href="a_voter.php" style="text-decoration: none;font-weight:bold;"> Voter </a> </li>
			<li> <a href="a_post.php" style="text-decoration: none;font-weight:bold;"> Post </a> </li>
			<li> <a href="index.php" style="text-decoration: none;font-weight:bold;"> Log Out </a> </li>
		</ul>
	</div>
	 <!--end nav-->
  </div>
  <!--end header-->
  <div id="frontpage-content" style="min-height:625px;">
    <div id="container" >