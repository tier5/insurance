<?php
/*
*Template Name:Agent Training
*/ 
//get_header();
if(!is_user_logged_in()){
    wp_safe_redirect(site_url());
    exit;
}

$current_user = get_current_user_id();
$user_info = get_userdata($current_user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/bootstrap/css/bootstrap.min.css" />
<link href="<?php echo get_template_directory_uri();?>/css/style_dashboard.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/font-awesome/css/font-awesome.min.css" />

<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/bootstrap/js/bootstrap.min.js"></script>


</head>
<body class="login">	
<!-- header start -->
<header>
	<div class="container-fluid">
		<div class="row">
			<div class="header">
				<div class="col-md-6 col-sm-6 col-xs-9">
					<div class="top-left">
						<a href="#" class="menubar"><i class="fa fa-bars" aria-hidden="true"></i></a>
						<div class="smalllogo">
							<a href="#"><img src="<?php echo get_template_directory_uri();?>/images/logo.png" class="img-responsive"></a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-3">
					<div class="top-right text-right">
						<div class="usr-pic">
							<a href="#">
								<?php 
$image = wp_get_attachment_image_src(get_user_meta($user_info->ID,'image_id',true));
?><img src="<?php echo($image[0]!= "") ? $image[0] : get_template_directory_uri().'/images/dummy_players.png';?>" class="img-responsive"/>
								<!--<img src="images/user.png" class="img-responsive">--></a>
							<div class="user-details">
								<ul>
									<li><a href="<?php echo site_url();?>/profile"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>
									<li><a href="#" data-toggle="modal" data-target="#modalPassword"><i class="fa fa-lock" aria-hidden="true"></i>Password</a></li>
									<li><a href="<?php echo wp_logout_url(site_url());?>"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- header end -->

<!-- Main Content Start -->
<section>
	<div class="container-fluid">
		<div class="row">
			<div class="mainDiv">
				<?php require_once('dashboard_sidebar.php' );?>
				<div class="main-content">
					
		<div id="content">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#red" data-toggle="tab">SALES TRAINING VIDEOS</a></li>
            <li><a href="#orange" data-toggle="tab">OPT! TRAINING VIDEOS</a></li>
            <li><a href="#yellow" data-toggle="tab">APPLICATION TRAINING</a></li>
            <li><a href="#green" data-toggle="tab">PODCAST TRAINING</a></li>
            <li><a href="#blue" data-toggle="tab">PRODUCT VIDEOS</a></li>
        </ul>
						<div id="my-tab-content" class="tab-content">
							<div class="tab-pane active" id="red">
								<div class="row">
								<div class="col-sm-4">
									<div class="info-tile">
										<div class="embed-responsive embed-responsive-16by9">
											<iframe class="iframeautosize" src="https://www.youtube.com/embed/Ple4MeKmqaM" frameborder="0" allowfullscreen=""></iframe>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info-tile">
										<div class="embed-responsive embed-responsive-16by9 ">
											<iframe class="iframeautosize" src="https://www.youtube.com/embed/9MuzVKwTGZ0" frameborder="0" allowfullscreen=""></iframe>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="info-tile">
								<div class="embed-responsive embed-responsive-16by9 ">
									<iframe class="iframeautosize" src="https://www.youtube.com/embed/pXKdfUk2TeM" frameborder="0" allowfullscreen=""></iframe>
								</div>
							</div>
						</div>
							</div>
							</div>
							<div class="tab-pane" id="orange">
								<h1>Orange</h1>
								<p>orange orange orange orange orange</p>
							</div>
							<div class="tab-pane" id="yellow">
								<h1>Yellow</h1>
								<p>yellow yellow yellow yellow yellow</p>
							</div>
							<div class="tab-pane" id="green">
								<h1>Green</h1>
								<p>green green green green green</p>
							</div>
							<div class="tab-pane" id="blue">
								<h1>Blue</h1>
								<p>blue blue blue blue blue</p>
							</div>
						</div>
					</div>
				

				</div>
			</div> 
		</div>
	</div>
</section>
<div class="clear"></div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$(".menubar").click(function(){
			$(".sidebarmenu").toggleClass("open");
			$(".main-content").toggleClass("morewidth");
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".usr-pic a").click(function(){
			$(".user-details").toggleClass("openmenu");
		});
	});
</script>
</html>
