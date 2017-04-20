<?php
/*
*Template Name: Agent Hierarchy
*/
if(!is_user_logged_in()){
    wp_safe_redirect(site_url());
    exit;
}
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
   <style type="text/css">
   	.tree{white-space: nowrap;
    overflow: auto;
    cursor: -webkit-grab;
	}
	.tree ul {
    padding: 20px 0 0 0;
    position: relative;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
}
.tree li:only-child {
    padding-top: 0;
}
.tree li {
    display: inline-block;
    white-space: nowrap;
    vertical-align: top;
    margin: 0 -2px 0 -2px;
    text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}
.tree li a {
    border: 1px solid #ccc;
    padding: 5px 10px;
    text-decoration: none;
    color: #666;
    font-family: arial,verdana,tahoma;
    font-size: 14px;
    font-weight: bold;
    text-transform: capitalize;
    display: inline-block;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}
.avatar {
    width: 70px;
    height: 70px;
    border: 1px solid rgba(0,0,0,.1);
    border-radius: 40px;
    text-align: center;
    margin: 0 auto;
    object-fit: cover;
}
.img-responsive, .thumbnail>img, .thumbnail a>img, .carousel-inner>.item>img, .carousel-inner>.item>a>img {
    display: block;
    max-width: 100%;
    height: auto;
}
.tree ul ul::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    border-left: 1px solid #ccc;
    width: 0;
    height: 20px;
}
.tree li::after {
    right: auto;
    left: 50%;
    border-left: 1px solid #ccc;
}
.tree li::before, .tree li::after {
    content: '';
    position: absolute;
    top: 0;
    right: 50%;
    border-top: 1px solid #ccc;
    width: 50%;
    height: 20px;
}

.tree li a:hover, .tree li a:hover+ul li a {
    background: #c8e4f8;
    color: #000;
    border: 1px solid #94a0b4;
}
   </style>
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
<section>
<?php
global $wpdb;
$current_user = get_current_user_id();
$fname = get_user_meta($current_user,'first_name',true);
$lname = get_user_meta($current_user,'last_name',true);
$query = "SELECT * FROM `wp_usermeta` WHERE `meta_key` = 'under_user_id' AND `meta_value` = " . $current_user . " AND `user_id`<>".$current_user;
$gethierarchy = $wpdb->get_results($query);


$getcurrentuserparent = "SELECT parent FROM `wp_agent_hierarchy` WHERE `user_id` = ".$current_user;
$getparentid = $wpdb->get_results($getcurrentuserparent);
if(is_array($getparentid) && count($getparentid) > 0){
$parentid = $getparentid[0]->parent;
}
$parentfname = get_user_meta($parentid,'first_name',true);
$parentlname = get_user_meta($parentid,'last_name',true);
?>
	<div class="container-fluid">
		<div class="row">
			<div class="mainDiv">
				<?php require_once('dashboard_sidebar.php' );?>
				<div class="main-content">
					<div id="content">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#red" data-toggle="tab">My Agency</a></li>
            <li><a href="#orange" data-toggle="tab">My Immediate Agent</a></li>
           
        </ul>
						<div id="my-tab-content" class="tab-content">
						<div class="tab-pane active tree" id="red" style="min-height:300px;">

						<ul>

								<?php if($parentid!=""){?>
								<li><a href="#"><?php echo get_avatar( $parentid );?>
								<?php echo $parentfname." ".$parentlname;?></a>
								<ul>
									<li>
										<a href="#"><?php echo get_avatar( $current_user );?>
								<?php echo $fname." ".$lname;?></a>
									</li>
								</ul>
								<?php }else{?>
								<li><a href="#"><?php echo get_avatar( $current_user );?>
								<?php echo $fname." ".$lname;?></a>
								<?php }?>
								
								
								<?php
								
								 echo get_childrens($current_user);
								 ?>
								</li>
							</ul>
							</div>
							<div class="tab-pane tree" id="orange" style="min-height:300px;">
								<div id="contracting" class="tab-pane ">
								<ul>

								<?php if($parentid!=""){?>
								<li><a href="#"><?php echo get_avatar( $parentid );?>
								<?php echo $parentfname." ".$parentlname;?></a>
								<ul>
									<li>
										<a href="#"><?php echo get_avatar( $current_user );?>
								<?php echo $fname." ".$lname;?></a>
									</li>
								</ul>
								<?php }else{?>
								<li><a href="#"><?php echo get_avatar( $current_user );?>
								<?php echo $fname." ".$lname;?></a>
								<?php }?>
								
								
								<?php
								
								 echo get_childrens($current_user);
								 ?>
								</li>
							</ul>
			    
				
								</div>
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
