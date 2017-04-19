<?php
/*
*Template Name:Agent Dashboard
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
					<div class="row">
						<div class="col-md-3">
							<a href="<?php echo site_url();?>/carriers">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php echo get_template_directory_uri();?>/images/menu-1.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>INSURANCE CARRIER</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>
						<!-- <div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php //echo get_template_directory_uri();?>/images/menu-2.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>Insurance Carriers</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div> -->

						<div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php echo get_template_directory_uri();?>/images/menu-10.jpg" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>CONTEST</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>




						<div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php echo get_template_directory_uri();?>/images/menu-3.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>LEADER BOARD</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo site_url(); ?>/contracts">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php echo get_template_directory_uri();?>/images/menu-4.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>CONTRACTING</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php echo get_template_directory_uri();?>/images/menu-5.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>AGENT RESOURCES</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>
						<div class="col-md-3">
							<a href="<?php echo site_url();?>/training">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php echo get_template_directory_uri();?>/images/menu-6.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>AGENT TRAINING</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>
						<div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php echo get_template_directory_uri();?>/images/menu-7.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>PUSH Events</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>
						<div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php echo get_template_directory_uri();?>/images/menu-8.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>NEW BUSINESS</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php //echo get_template_directory_uri();?>/images/menu-9.png" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>Insurance Carriers</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div> 
						 <div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php //echo get_template_directory_uri();?>/images/menu-10.jpg" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>CONTEST</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div>
						<div class="col-md-3">
							<a href="#">
							    <div class="info-tile">
								  <div class="tile-image">
									<img src="<?php //echo get_template_directory_uri();?>/images/menu-11.jpg" class="img-responsive" alt="img15">
								  </div>
								  <div class="btn btn-block btn-primary">
									<span>Insurance Carriers</span>
								  <i class="fa fa-angle-right pull-right" aria-hidden="true"></i>
								  </div>
								</div>
							</a>
						</div> 
					</div> -->
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
