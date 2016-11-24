<?php
/*
*Template Name:Agent Profile
*/ 
//get_header();
if(!is_user_logged_in()){
    wp_safe_redirect(site_url());
    exit;
}

$current_user = get_current_user_id();
$user_info = get_userdata($current_user);
if(!empty($_POST['action'])){


$file = $_FILES['agent_image'];

if(!empty($file)){
require_once( ABSPATH . 'wp-admin/includes/admin.php' );
$file_return = wp_handle_upload( $file, array('test_form' => false ) );
      if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
          return false;
      } else {
          $filename = $file_return['file'];
          $attachment = array(
              'post_mime_type' => $file_return['type'],
              'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
              'post_content' => '',
              'post_status' => 'inherit',
              'guid' => $file_return['url']
          );
          $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
          require_once(ABSPATH . 'wp-admin/includes/image.php');
          $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
          wp_update_attachment_metadata( $attachment_id, $attachment_data );
          update_user_meta($user_info->ID,'image_id',$attachment_id);
      }
}

$fullname = $_POST['full_name'];
$phone = $_POST['phone'];
$streeaddr = $_POST['street_address'];
$addrline2 = $_POST['address_line2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$country = $_POST['country'];


if(!empty($fullname)){
update_user_meta($user_ID,'full_name',$fullname);
}
if(!empty($phone)){
update_user_meta($user_ID,'phone',$phone);
}
update_user_meta($user_ID,'street_address',$streeaddr);
update_user_meta($user_ID,'address_line2',$addrline2);
update_user_meta($user_ID,'city',$city);
update_user_meta($user_ID,'state',$state);
update_user_meta($user_ID,'zipcode',$zipcode);
update_user_meta($user_ID,'country',$country);


require_once(ABSPATH . 'wp-admin/includes/user.php');
require_once(ABSPATH . WPINC . '/registration.php');

//check_admin_referer('update-profile_' . $user_ID);
//echo $user_ID; die();
$errors = edit_user($user_ID);

if ( is_wp_error( $errors ) ) {
foreach( $errors->get_error_messages() as $message )
$errmsg = "$message";
}

if($errmsg == '')
{
// Update all meta fields

do_action('personal_options_update',$user_ID);
$d_url = $_POST['dashboard_url'];
wp_redirect( get_option("siteurl").'?page_id='.$post->ID.'&updated=true' );
}
else{
$errmsg = '<div class="box-red">' . $errmsg . '</div>';
$errcolor = 'style="background-color:#FFEBE8;border:1px solid #CC0000;"';

}
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
									<li><a href="#"><i class="fa fa-lock" aria-hidden="true"></i>Password</a></li>
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
					<form name="profile" action="" method="post" enctype="multipart/form-data">
<?php wp_nonce_field('update-profile_' . $user_ID) ?>
<input type="hidden" name="from" value="profile" />
<input type="hidden" name="action" value="update" />
<input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
<input type="hidden" name="dashboard_url" value="<?php echo get_option("dashboard_url"); ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
<input type="hidden" name="nickname" value="<?php echo $user_info->nickname;?>">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<?php if ( isset($_GET['updated']) ):
$d_url = $_GET['d'];?>
<tr>
<td align="center" colspan="2"><span style="color: #FF0000; font-size: 11px;">Your profile changed successfully</span></td>
</tr>
<?php elseif($errmsg!=""): ?>
<tr>
<td align="center" colspan="2"><span style="color: #FF0000; font-size: 11px;"><?php echo $errmsg;?></span></td>
</tr>
<?php endif;?>
<tr>
<td colspan="2" align="center"><h2>Update profile</h2></td>
</tr>

<tr>
<td>Profile Pic</td>
<td>
<input type="file" name="agent_image" id="agent_image" style="width: 300px;" />
<?php 
$image = wp_get_attachment_image_src(get_user_meta($user_info->ID,'image_id',true));
?>
<img src="<?php echo($image[0]!= "") ? $image[0] : get_template_directory_uri().'/images/dummy_players.png';?>"  class="profile_img"/>
</td>
</tr>
<tr>
<td>Full Name <span style="color: #F00">*</span></td>
<td><input type="text" name="full_name" id="full_name" value="<?php echo get_user_meta($user_info->ID,'full_name',true); ?>" style="width: 300px;" /></td>
</tr>
<tr>
<tr>
<td>Email <span style="color: #F00">*</span></td>
<td><input type="text" name="email" class="mid2" id="email" value="<?php echo $user_info->user_email ?>" style="width: 300px;" /></td>
</tr>
<tr>
<td>New Password </td>
<td><input type="password" name="pass1" class="mid2" id="pass1" value="" style="width: 300px;" /></td>
</tr>
<tr>
<td>New Password Confirm </td>
<td><input type="password" name="pass2" class="mid2" id="pass2" value="" style="width: 300px;" /></td>
</tr>
<tr>
<td align="right" colspan="2"><span style="color: #F00">*</span> <span style="padding-right:40px;">mandatory fields</span></td>
</tr>
<tr><td colspan="2"><h3>Extra profile information</h3></td></tr>
<tr>
<td>Phone <span style="color: #F00">*</span></td>
<td><input type="text" name="phone" id="phone" value="<?php echo get_user_meta($user_info->ID,'phone',true); ?>" style="width: 300px;" /></td>
</tr>
<tr>
<td>Street Address</td>
<td><input type="text" name="street_address" id="street_address" value="<?php echo get_user_meta($user_info->ID,'street_address',true); ?>" style="width: 300px;" /></td>
</tr>
<tr>
<td>Address Line 2</td>
<td><input type="text" name="address_line2" id="address_line2" value="<?php echo get_user_meta($user_info->ID,'address_line2',true); ?>" style="width: 300px;" /></td>
</tr>
<tr>
<td>City</td>
<td><input type="text" name="city" id="city" value="<?php echo get_user_meta($user_info->ID,'city',true); ?>" style="width: 300px;" /></td>
</tr>
<tr>
<td>State</td>
<td><input type="text" name="state" id="state" value="<?php echo get_user_meta($user_info->ID,'state',true); ?>" style="width: 300px;" /></td>
</tr>
<tr>
<td>ZipCode</td>
<td><input type="text" name="zipcode" id="zipcode" value="<?php echo get_user_meta($user_info->ID,'zipcode',true); ?>" style="width: 300px;" /></td>
</tr>
<tr>
<td>Country</td>
<td>
<?php $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");?>

    <select name="country" id="country" class="auto_width">

    <?php foreach ($countries as $country) {
    echo "<option value='$country'";
    if ($country == get_user_meta($user_info->ID,'country',true)) {
        echo " selected";
    }
    echo ">$country</option>\n";
    }
    ?>
          
     </select>
</td>
</tr>

<tr>
<td align="center" colspan="2"><input type="submit" value="Update" /></td>
</tr>
</table>
<input type="hidden" name="action" value="update" />
</form>
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
