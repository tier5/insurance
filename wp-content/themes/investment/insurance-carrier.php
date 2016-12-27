<?php
/*
* Template Name:Insurance Carrier
 */
//get_header();
if(!is_user_logged_in()){
    wp_safe_redirect(site_url());
    exit;
}

$current_user = get_current_user_id();
$user_info = get_userdata($current_user);
$args1 = array(
'post_type' => 'carrier',
'posts_per_page' => -1,
'tax_query' => array(
		array(
			'taxonomy' => 'carrier-category',
			'field'    => 'slug',
			'terms'    => 'instant-quote-access',
		),
	),
);
$query1 = new WP_query($args1);
$found_post1 = $query1->found_posts;
$args2 = array(
'post_type' => 'carrier',
'posts_per_page' => -1,
'tax_query' => array(
		array(
			'taxonomy' => 'carrier-category',
			'field'    => 'slug',
			'terms'    => 'pending-business',
		),
	),
);
$query2 = new WP_query($args2);
$found_post2 = $query2->found_posts;
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
			<div id="page-wrapper">
            <div class="container-fluid ng-scope">
				<div class="row">
					<div class="col-sm-12">
						<h4 class="text-uppercase"><i class="fa fa-circle" aria-hidden="true"></i> Instant Quote Access</h4>
                                <p class="text-uppercase">
                                    Select the images below to transfer instant quote sites
                                </p>
					</div>
				</div>
				<?php if($query1->have_posts()): $i=0;?>
					<div class="row">	
					<?php while($query1->have_posts()):$query1->the_post();?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));?>
				
		  			<div class="col-sm-6 col-md-2 col-lg-2">
						<a href="<?php echo get_the_content();?>" target="_blank">
						<div class="info-tile">
							<div class="tile-image">
						<img class="width-max-150 img-responsive" src="<?php echo($image[0]!="")?$image[0]:'';?>">
							</div>
						</div>
						</a>
		  			</div>
		  <?php $i++;?>
		  		<?php if($i%6 == 0):?>
				</div><div class="row">
			<?php endif;?>
			<?php endwhile;?>
			<?php endif;?>




				</div>

		</div>




			<div class="container-fluid ng-scope">
							<div class="row">
								<div class="col-sm-12">
									<h4 class="text-uppercase"><i class="fa fa-circle" aria-hidden="true"></i> PENDING BUSINESS</h4>
			                                <p class="text-uppercase">
			                                    SELECT THE IMAGE BELOW TO AGENT LOGIN SITES
			                                </p>
								</div>
				</div>
				<?php if($query2->have_posts()): $i=0;?>
<div class="row">
					<?php while($query2->have_posts()):$query2->the_post();?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ));?>
				
		  			<div class="col-sm-6 col-md-2 col-lg-2">
						<a href="<?php echo get_the_content();?>" target="_blank">
						<div class="info-tile">
							<div class="tile-image">
						<img class="width-max-150 img-responsive" src="<?php echo($image[0]!="")?$image[0]:'';?>">
							</div>
						</div>
						</a>
		  			</div>
		  <?php $i++;?>
		  		<?php if($i%6 == 0):?>
				</div><div class="row">
			<?php endif;?>
			<?php endwhile;?>
			<?php endif;?>




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
