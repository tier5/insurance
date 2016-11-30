<?php
/*
*Template Name:Agent New Business
*/ 
//get_header();
if(!is_user_logged_in()){
    wp_safe_redirect(site_url());
    exit;
}

$current_user = get_current_user_id();
$user_info = get_userdata($current_user);
if ( isset( $_POST['submit'] ) ){
    global $wpdb;
    $tablename='New_business_entry';
	$client_name=$_POST['firstname']." ".$_POST['middleinitial']." ".$_POST['lastname'];
	$current_date=date();
    $data=array(
        'agent_id' => $_POST['user_id'], 
        'agent_name' => $_POST['agentname_value'],
        'agent_code' => $_POST['agentcode'],
        'client_name' => $client_name, 
        'client_gender' => $_POST['gender'],
        'client_dob' => $_POST['dateofbirth'], 
        'client_address' => $_POST['address'],
        'client_zip' => $_POST['zip'], 
        'client_city' => $_POST['city'], 
        'client_state' => $_POST['state'],
        'client_phome' => $_POST['phonehome'], 
        'client_pno' => $_POST['phonenumbercell'], 
        'client_email' => $_POST['email'], 
        'ins_p_name' => $_POST['coverageptype'],
        'ins_p_com' => $_POST['company'], 
        'ins_p_type_coverage' => $_POST['coveragetype'],
        'ins_p_coverage_len' => $_POST['coveragelength'], 
        'ins_p_app_date' => $_POST['applicationdate'],
        'ins_p_coverage_amt' => $_POST['coverageamount'], 
        'ins_p_premium_fre' => $_POST['premiumfrequency'], 
        'ins_p_premium_amt' => $_POST['premiumamount'],
        'ins_p_premium_volum' => $_POST['annualpremiumvolume'], 
        'ins_p_draft_date' => $_POST['draftdate'], 
        'entry_date' => $current_date );
	//print_r($data);exit;
    $wpdb->insert( $tablename, $data);
    
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
<link href="<?php echo get_template_directory_uri();?>/new_business_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script>
  $( function() {
    $( "#dateofbirth" ).datepicker();
    $( "#draftdate" ).datepicker();
    $( "#applicationdate" ).datepicker();
  } );
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
			<li><a href="#green" data-toggle="tab">Upload New Business</a></li>
            <li><a href="#blue" data-toggle="tab">E-App New Business</a></li>
        </ul>
						<div id="my-tab-content" class="tab-content">
							<?php if($wpdb->insert_id)
								{
								echo "<span style='padding: 2% 30%;color:green;'>Data Successfully Stored</span>";
								}
							?>	 
							<div class="tab-pane active" id="green">
								<div class="form-style" id="contact_form">
    <div class="form-style-heading">Securely Upload Your New Business Applications And Requirements Below</div>
    <div id="contact_results"></div>
    <form id="contact_body" method="post" action="<?php echo site_url();?>/contact-me">
    <label for="subject"><span>Select recipient: <span class="required">*</span></span>
            <select name="subject" required>
			<option value="">Choose recipient</option>	
            <option value="Advertise">New business</option>
            
            </select>
        </label>
        <label for="email"><span>Email <span class="required">*</span></span>
            <input type="email" name="email" data-required="true"/>
        </label>
        <label for="name"><span>Name <span class="required">*</span></span>
            <input type="text" name="name" data-required="true"/>
        </label>       
        <label><span>Attachment</span>
            <input type="file" name="file_attach[]"  />
        </label>
        
            
        <label for="message"><span>Message <span class="required">*</span></span>
            <textarea name="message" data-required="true"></textarea>
        </label>
        <label><span>&nbsp;</span>
        	<button type="submit">Submit</button>
        </label>
    </form>
</div>

<script type="text/javascript">
var allowed_file_size = "1073741824";
//var allowed_files = ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg','.doc','.docx'];
var border_color = "#C2C2C2"; //initial input border color

$("#contact_body").submit(function(e){
    e.preventDefault(); //prevent default action 
	proceed = true;
	
	//simple input validation
	$($(this).find("input[data-required=true], textarea[data-required=true]")).each(function(){
            if(!$.trim($(this).val())){ //if this field is empty 
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag
            }
            //check invalid email
            var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
            if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
                $(this).css('border-color','red'); //change border color to red   
                proceed = false; //set do not proceed flag              
            }   
	}).on("input", function(){ //change border color to original
		 $(this).css('border-color', border_color);
	});
	
	//check file size and type before upload, works in modern browsers
	if(window.File && window.FileReader && window.FileList && window.Blob){
		var total_files_size = 0;
		$(this.elements['file_attach[]'].files).each(function(i, ifile){
			if(ifile.value !== ""){ //continue only if file(s) are selected
                if(allowed_files.indexOf(ifile.type) === -1){ //check unsupported file
                    alert( ifile.name + " is unsupported file type!");
                    proceed = false;
                }
             total_files_size = total_files_size + ifile.size; //add file size to total size
			}
		}); 
       if(total_files_size > allowed_file_size){ 
            alert( "Make sure total file size is less than 1 GB!");
            proceed = false;
        }
	}
	
	//if everything's ok, continue with Ajax form submit
	if(proceed){ 
		var post_url = $(this).attr("action"); //get form action url
		var request_method = $(this).attr("method"); //get form GET/POST method
		var form_data = new FormData(this); //Creates new FormData object
		
		$.ajax({ //ajax form submit
			url : post_url,
			type: request_method,
			data : form_data,
			dataType : "json",
			contentType: false,
			cache: false,
			processData:false
		}).done(function(res){ //fetch server "json" messages when done
			if(res.type == "error"){
				$("#contact_results").html('<div class="error">'+ res.text +"</div>");
			}
			
			if(res.type == "done"){
				$("#contact_results").html('<div class="success">'+ res.text +"</div>");
			}
		});
	}
});
</script>
							</div>
							<div class="tab-pane" id="blue">
								<div class="container-fluid">
								
              <form class="form-horizontal "  name="businessform" method ="post">
				  <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_info->ID;?>" >
                <div class="form-group">
                  <div class="col-sm-6">
                    <h4>AGENT INFORMATION</h4>
                    <div class="form-group">

                      <label for="agentname" class="col-sm-3 control-label"> Agent Name</label>
                      <div class="col-sm-8">
							<input id="agentname_value" name="agentname_value" ng-model="searchStr" type="text" placeholder="agentname" class="form-control" value="<?php echo get_user_meta($user_info->ID,'full_name',true); ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="agentcode" class="col-sm-3 control-label">Agent Code</label>
                      <div class="col-sm-8">
                        <input id="agentcode" name="agentcode" class="form-control" type="text" required="" aria-required="true">
                       
                        </div>
                    </div>
                    <h4>CLIENT INFORMATION</h4>
                    <div class="form-group">
                      <label for="first_name" class="col-sm-3 control-label">First Name</label>
                      <div class="col-sm-8">
                        <input id="firstname" name="firstname" class="form-control" type="text"  required="" aria-required="true">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="middleinitial" class="col-sm-3 control-label"> Middle Initial</label>
                      <div class="col-sm-8">
                        <input id="middleinitial" name="middleinitial" class="form-control" type="text">
												</div>
                    </div>
                    <div class="form-group">
                      <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                      <div class="col-sm-8">

                        <input id="lastname" name="lastname" class="form-control" type="text"  required="" aria-required="true">
                          

                        </div>
                    </div>
                    <div class="form-group">
                      <label for="gender" class="col-sm-3 control-label">Gender</label>
                      <div class="col-sm-8">
                        <input type="radio" name="gender" value="male"> Male<br>
						<input type="radio" name="gender" value="female"> Female<br>
						<input type="radio" name="gender" value="other"> Other

                          </div>

                    </div>
                    <div class="form-group">
                      <label for="dateofbirth" class="col-sm-3 control-label">Date Of Birth</label>
                      <div class="col-sm-8">
                        <input datetimepicker="" datetimepicker_options="{ format: 'MM/DD/YYYY'}" id="dateofbirth" name="dateofbirth" class="form-control form_datetime" type="text" required="" max="11/29/2016" aria-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="address" class="col-sm-3 control-label">Address</label>
                      <div class="col-sm-8">
                        <textarea id="address" name="address" class="form-control"  required="" aria-required="true" style="margin-top: 0px; margin-bottom: 0px; height: 125px;"></textarea>
                        

                      </div>
                    </div>
                    <div class="form-group">
                      <label for="zip" class="col-sm-3 control-label">Zip</label>
                      <div class="col-sm-8">
                        <input id="zip" name="zip" class="form-control" type="text" ng-model="busines.clients.zip" required="" aria-required="true">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="city" class="col-sm-3 control-label">City</label>
                      <div class="col-sm-8">
                        <input id="city" name="city" class="form-control" type="text" ng-model="busines.clients.city" required="" aria-required="true">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="address" class="col-sm-3 control-label">State</label>
                      <div class="col-sm-8">
                        <input id="state" name="state" class="form-control" type="text" ng-model="busines.clients.state" required="" aria-required="true">
                         
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="phonehome" class="col-sm-3 control-label">Phone Home</label>
                      <div class="col-sm-8">
                        <input type="tel" id="phonehome" name="phonehome" class="form-control" ng-model="busines.clients.phonehome" maxlength="15" required="">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="phonehome" class="col-sm-3 control-label">Phone number</label>
                      <div class="col-sm-8">
                        <input type="tel" phone-input="" id="phonenumbercell" name="phonenumbercell" class="form-control " required="" ng-model="busines.clients.phonenumbercell">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-3 control-label">Email</label>
                      <div class="col-sm-8">
                        <input id="email" name="email" type="email" class="form-control ng-pristine ng-untouched ng-valid-email ng-invalid ng-invalid-required" required="" aria-required="true">
                          
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <h4> INSURANCE COMPANY </h4>
                    <div class="form-group">
                      <label for="productcode" class="col-sm-3 control-label">Product Name</label>
                      <div class="col-sm-8">
                        <select class="form-control " id="coverageptype" name="coverageptype" material-select="" watch="" my-select2="" ng-model="busines.product" ng-options="(option.productname+' '+option.terms) for option in BUPolicyData" required="" ng-change="PolicyDataChange()" style="width:100%;" tabindex="-1" aria-hidden="true" aria-required="true"><option value="" class="">--Select--</option><option value="0" label="Term Life Express 10">Term Life Express 10</option><option value="1" label="Term Life Express 15">Term Life Express 15</option><option value="2" label="Term Life Express 20">Term Life Express 20</option><option value="3" label="Term Life Express 30">Term Life Express 30</option><option value="4" label="Term Life Answers 10">Term Life Answers 10</option><option value="5" label="Term Life Answers 15">Term Life Answers 15</option><option value="6" label="Term Life Answers 20">Term Life Answers 20</option><option value="7" label="Term Life Answers 30">Term Life Answers 30</option><option value="8" label="Living Promise Level Permanent">Living Promise Level Permanent</option><option value="9" label="Living Promise Graded Permanent">Living Promise Graded Permanent</option><option value="10" label="Children’s Whole Life Permanent">Children’s Whole Life Permanent</option><option value="11" label="Guaranteed Advantage N/A">Guaranteed Advantage N/A</option><option value="12" label=" Safe Harbor Term 10"> Safe Harbor Term 10</option><option value="13" label=" Safe Harbor Term 15"> Safe Harbor Term 15</option><option value="14" label=" Safe Harbor Term 20"> Safe Harbor Term 20</option><option value="15" label=" Safe Harbor Term 30"> Safe Harbor Term 30</option><option value="16" label=" Safe Harbor Term Express 10"> Safe Harbor Term Express 10</option><option value="17" label=" Safe Harbor Term Express 15"> Safe Harbor Term Express 15</option><option value="18" label=" Safe Harbor Term Express 20"> Safe Harbor Term Express 20</option><option value="19" label=" Safe Harbor Term Express 30"> Safe Harbor Term Express 30</option><option value="20" label="Grow Up Plan N/A">Grow Up Plan N/A</option><option value="21" label="College Plan N/A">College Plan N/A</option><option value="22" label="Guaranteed Life N/A">Guaranteed Life N/A</option><option value="23" label="Accident Protection N/A">Accident Protection N/A</option><option value="24" label="Remembrance N/A">Remembrance N/A</option><option value="25" label="Strong Foundation SI 15">Strong Foundation SI 15</option><option value="26" label="Strong Foundation SI 20">Strong Foundation SI 20</option><option value="27" label="Strong Foundation SI 25">Strong Foundation SI 25</option><option value="28" label="Strong Foundation SI 30">Strong Foundation SI 30</option><option value="29" label="Strong Foundation FU 10">Strong Foundation FU 10</option><option value="30" label="Strong Foundation FU 15">Strong Foundation FU 15</option><option value="31" label="Strong Foundation FU 20">Strong Foundation FU 20</option><option value="32" label="Strong Foundation FU 25">Strong Foundation FU 25</option><option value="33" label="Strong Foundation FU 30">Strong Foundation FU 30</option><option value="34" label="Smart UL SI N/A">Smart UL SI N/A</option><option value="35" label="Smart UL FU N/A">Smart UL FU N/A</option><option value="36" label="Safe Shield 15">Safe Shield 15</option><option value="37" label="Safe Shield 20">Safe Shield 20</option><option value="38" label="Safe Shield 30">Safe Shield 30</option><option value="39" label="Phone App SIWL N/A">Phone App SIWL N/A</option><option value="40" label="Home Certainty 15">Home Certainty 15</option><option value="41" label="Home Certainty 20">Home Certainty 20</option><option value="42" label="Home Certainty 25">Home Certainty 25</option><option value="43" label="Home Certainty 30">Home Certainty 30</option><option value="44" label="EZTerm 10">EZTerm 10</option><option value="45" label="EZTerm 20">EZTerm 20</option><option value="46" label="EZTerm 30">EZTerm 30</option><option value="47" label="Dignity Solutions Permanent">Dignity Solutions Permanent</option><option value="48" label="Family Legacy Permanent">Family Legacy Permanent</option><option value="49" label="Advantage Plus N/A">Advantage Plus N/A</option></select>
                        
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="company" class="col-sm-3 control-label">Insurance Company</label>
                      <div class="col-sm-8">
                        <input id="company" name="company" class="form-control ng-pristine ng-untouched ng-valid" type="text" ng-model="busines.companyfullname">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="coveragetype" class="col-sm-3 control-label">Type of Coverage</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="coveragetype" name="coveragetype" material-select="" watch="" ng-model="busines.typeofcoverage" ng-options="option.value as option.text for option in coveragetypedata" required=""><option value="?" selected="selected" label=""></option><option value="0" label="Term">Term</option><option value="1" label="Universal Life">Universal Life</option><option value="2" label="Anuity">Anuity</option><option value="3" label="Final Expense">Final Expense</option><option value="4" label="Whole Life">Whole Life</option><option value="5" label="Accidental Death">Accidental Death</option><option value="6" label="Guaranteed Issue">Guaranteed Issue</option><option value="7" label="Single Premium Whole Life">Single Premium Whole Life</option></select>
                        
                      </div>

                    </div>
                    <div class="form-group">
                      <label for="coveragelength" class="col-sm-3 control-label">Coverage Length</label>
                      <div class="col-sm-8">
                        <input id="coveragelength" name="coveragelength" class="form-control " type="text" required="" aria-required="true">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="applicationdate" class="col-sm-3 control-label">Application Date</label>
                      <div class="col-sm-8">
                        <input class="form-control " datetimepicker="" datetimepicker_options="{ format: 'MM/DD/YYYY'}" id="applicationdate" name="applicationdate" format="mm/dd/yyyy" type="text" ng-model="busines.applicationdate" required="" max="11/29/2016" aria-required="true">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="coverageamount" class="col-sm-3 control-label">Coverage Amount</label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control" id="coverageamount" name="coverageamount" required="" aria-required="true">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="premiumfrequency" class="col-sm-3 control-label">Premium Frequency</label>
                      <div class="col-sm-8">
                        <select class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" id="premiumfrequency" name="premiumfrequency" material-select="" ng-model="busines.premiumfrequency" ng-options="option.value as option.text for option in premiumfrequencydata" required="" aria-required="true"><option value="?" selected="selected" label=""></option><option value="0" label="Monthly">Monthly</option><option value="1" label="Quarterly">Quarterly</option><option value="2" label="Anuity">Anuity</option><option value="3" label="Semi Annual">Semi Annual</option><option value="4" label="Annual">Annual</option><option value="5" label="Single">Single</option></select>
                        
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="premiumamount" class="col-sm-3 control-label">Premium amount</label>
                      <div class="col-sm-8">
                        <input id="premiumamount" name="premiumamount" class="form-control" type="number" required="" aria-required="true">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="annualpremiumvolume" class="col-sm-3 control-label">Annual Premium Volume</label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control" id="annualpremiumvolume" name="annualpremiumvolume" required="" aria-required="true">
                          
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="draftdate" class="col-sm-3 control-label">Draft Date</label>
                      <div class="col-sm-8">
                        <input class="form-control " id="draftdate" name="draftdate" datetimepicker=""  type="text" required="" max="11/29/2016" aria-required="true">
                          
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-primary" type="submit" name="submit" ">
                      <i class="fa fa-save"></i> Save
                    </button>
                    <button class="btn btn-danger" type="button" name="action" ng-click="cancel();">

                      <i class="fa fa-close"></i> Cancel
                    </button>


                  </div>
                </div>
              </form>
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
