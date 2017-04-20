<?php
/*
*Template Name:Agent Contracts
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
<script type="text/javascript">
	$(document).ready(function(){
		var user_id = '<?php echo $current_user;?>';
	$('#field_9bf7qv').val(user_id);
});
	
</script>

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
            <li><a href="#red" data-toggle="tab">Online Contracting</a></li>
            <li class="active"><a href="#orange" data-toggle="tab">Contracting Request</a></li>
           
        </ul>
						<div id="my-tab-content" class="tab-content">
						<div class="tab-pane" id="red">
							<iframe src="https://surelc.surancebay.com/sbweb/login.jsp?branchEditable=off&amp;branchRequired=on&amp;branch=New%20Agent&amp;branchVisible=on&amp;gaId=572&amp;gaName=Equis%20Financial%20Inc&amp;gaNameVisible=on" style="width: 100%;height: 700px;" frameborder="0" width="490px" height="300px" scrolling="auto" id="sureLCFrame">
							</iframe>
							</div>
							<div class="tab-pane active" id="orange">
								<div id="contracting" class="tab-pane ">
				<ul id="projects-collection" class="collection autoextendcontent" style="list-style-type: none;">
                    <li class="collection-item">
                      <i class="circle mdi-action-receipt light-blue"></i>
                      <span class="collection-header">CONTRACTING REQUEST FORM</span>
                      <p>PUSH Owners, please complete and submit this form to have contracting sent to a new agent.</p>
                    </li>
					<li class="collection-item">
						<!--<form class="form-horizontal" role="form" name="ContractingForm" method="post">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="newagentfirstname" class="control-label">New Agent First Name</label>
									<input id="newagentfirstname" class="form-control " type="text" ng-model="contracting.firstname" tabindex="1" required="" aria-required="true">
														
									
								</div>
								<div class="col-sm-4">
								<label for="newagentaddress" class="control-label">New Agent Address1</label>
									<input id="newagentaddress" class="form-control" type="text" tabindex="5" required="" aria-required="true">
														
									
								</div>
								<div class="col-sm-4">
								<label for="managername" class="control-label">New Agent Upline Name</label>	
									<input id="managername" class="form-control " type="text"  tabindex="9" required="" aria-required="true">
													
									
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4">
								<label for="newagentlastname" class="control-label">New Agent Last Name</label>	
									<input id="newagentlastname" class="form-control" type="text" tabindex="2" required="" aria-required="true">
													
									
								</div>
								<div class="col-sm-4">
								<label for="newagentzip" class="control-label">New Agent Zip</label>					
									
									<input id="newagentzip" class="form-control" type="text" maxlength="6" numbers-only="" tabindex="6" required="" aria-required="true">
									
								</div>
								
								<div class="col-sm-4">
								<label for="managercode" class="control-label">New Agent Upline Code</label>
									<input id="managercode" class="form-control" type="text" tabindex="10" required="" aria-required="true">
														
									
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4">
									<label for="newagentemail" class="control-label">New Agent Email</label>
									<input id="newagentemail" class="form-control" type="email" tabindex="3" required="" aria-required="true">
														
									
								</div>
								<div class="col-sm-4">
								<label for="newagentstate" class="control-label">New Agent State</label>
									<input id="newagentstate" class="form-control" type="text" tabindex="7" required="" aria-required="true">
														
									
								</div>
								<div class="col-sm-4">
									<label for="contractlevel" class="control-label">Contract Level</label>
								<select class="active form-control" id="contractlevel" tabindex="11" required="" aria-required="true"><option value="?" selected="selected" label=""></option><option value="0" label="ER1">ER1</option><option value="1" label="ER2">ER2</option><option value="2" label="ER3">ER3</option><option value="3" label="ER4">ER4</option><option value="4" label="ER5">ER5</option><option value="5" label="RM">RM</option><option value="6" label="SM">SM</option><option value="7" label="EM">EM</option><option value="8" label="RMD">RMD</option></select>
								
								
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4">
								<label for="newagentphonenumber" class="control-label">New Agent Phone Number</label>
									<input id="newagentphonenumber" class="form-control " phone-input="" type="text" tabindex="4" required="" aria-required="true">
														
									
								</div>
								<div class="col-sm-4">
								<label for="newagentcity" class="control-label">New Agent City </label>
									<input id="newagentcity" class="form-control" type="text" tabindex="8" required="" aria-required="true">
														
									
								</div>
								
								<div class="col-sm-4">
								<label for="currentlyicensed" class="control-label">Currently Licensed</label>								
								<select class="active form-control" id="currentlyicensed" material-select="" watch="" tabindex="12" required="" aria-required="true"><option value="? undefined:undefined ?"></option>
									<option value="1">Yes</option>
									<option value="0">No</option>	
								</select>
								</div>
								
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-primary" type="submit" name="action" ng-click="create();" tabindex="13">submit</button>
								</div>
							</div>
						</form>-->
						<?php echo do_shortcode('[formidable id=9]');?>
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
		//var user_id = '<?php //echo $current_user;?>';
		
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
