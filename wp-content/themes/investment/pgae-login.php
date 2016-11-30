<?php
/*
Template Name: Login Page
*/
?>

<?php //get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/local.css" />

    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/bootstrap/js/bootstrap.min.js"></script>
<style>
body{
    position: relative;
    color: #616161;
    min-height: 100%;
}

a{
    color: #03a9f4;
}

a:focus, a:hover {
    color: #000;
    text-decoration: none;
}

.login{
    background: url('http://localhost/insurance/wp-content/themes/investment/images/body-bg.jpg') no-repeat top center;
    background-position: 11% 17%;
}

.logo{
    text-align: center;
    display: block;
    margin-top: 120px;
    margin-bottom: 50px;
}

.logo img{
	margin: auto;
    width: 30%;
}
#loginform{
	padding:20px 20px 0;
}

.form-heading{
    background-color: #eaeaea;
    border-bottom: 1px solid #e2e1e1;
}

.form-heading h2{
    color: #2894c7;
    font-size: 17px;
    font-weight: bold;
    padding: 14px 10px;
    margin: 0;
    line-height: 20px;
    text-transform: uppercase;
}

.form-body {
    background-color: #fff;
    font-size: 14px;
    padding: 16px;
}

.form-footer {
    padding: 16px;
    background-color: #fafafa;
    border-radius: 0 0 2px 2px;
}

.form{
    background-color: #fafafa;
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.2);
    border-radius: 2px;
    background-color: #fff;
    margin: 0 0 32px;
    border-color: #fafafa;
}

.form input::-webkit-input-placeholder {
   color: #C5C5C5;
}

.form input:-moz-placeholder { /* Firefox 18- */
   color: #C5C5C5;  
}

.form input::-moz-placeholder {  /* Firefox 19+ */
   color: #C5C5C5;  
}

.form input:-ms-input-placeholder {  
   color: #C5C5C5;  
}


.form-group{
    position: relative;
    text-align: center;
}

.form input{
    border: 1px solid #e0e0e0;
    color: #616161;
    background: #fff;
    border-radius: 2px;
    display: block;
    height: 40px;
    padding-left: 10px;
    width: 100%;
}

.form input[type='submit']{
    background: #03a9f4;
    border: 1px solid #03a9f4;
    transition: 0.5s;
    text-transform: uppercase;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 3px;
}

.form input#rememberme{
	width:auto;
	display:inline-block;    
	vertical-align: middle;
}
.form-footer .form-group{
    text-align: right;
}

.form input[type='submit']:hover{
    background: #fff;
    color: #03a9f4;
}

.left-icon{
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    border-top-left-radius: 2px;
    border-bottom-left-radius: 2px;
    border: 1px solid #e0e0e0;
    background-color: #f7f7f7;
    padding: 7px 10px 5px;
    min-width: 40px;
    color: #616161;
}

.left-icon img{
    margin: 10px auto 0;
}

.form p{
    font-size: 16px;
}

.remember{
    position: relative;
}

.form label{
	color: #000;
    font-weight: normal;
    font-size: 15px;
    letter-spacing: 1px;
}

p#nav{
	text-align: right;
    padding: 0 15px 15px;
}


/* checkbox style */
.control {
    position: relative;
    display: inline-block;
    padding-left: 30px;
    cursor: pointer;
    font-weight: normal;
    font-size: 14px;
}

.control input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}

.control__indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #eee;
    background: #f1f1f1;
    border-radius: 2px;
}

.control__indicator:hover {
    border: 1px solid #03a9f4;
}

.control--radio .control__indicator {
    border-radius: 50%;
}

.control input:disabled ~ .control__indicator {
    pointer-events: none;
    opacity: .6;
    background: #e6e6e6;
}

.control__indicator:after {
    position: absolute;
    display: none;
    content: '';
}

.control input:checked ~ .control__indicator:after {
    display: block;
}

.control--checkbox .control__indicator:after {
    top: 2px;
    left: 5px;
    width: 5px;
    height: 10px;
    transform: rotate(45deg);
    border: solid #03a9f4;
    border-width: 0 2px 2px 0;
}

.control--checkbox input:disabled ~ .control__indicator:after {
    border-color: #7b7b7b;
}

.control--radio .control__indicator:after {
    top: 7px;
    left: 7px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #fff;
}

.control--radio input:disabled ~ .control__indicator:after {
    background: #7b7b7b;
}
/* checkbox style end*/

@media screen and (max-width: 480px){
}
</style>
<body class="login">
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="logo">
					<a href="#">
						<img src="<?php echo get_template_directory_uri();?>/images/400dpiLogoCropped.png" class="img-responsive">
					</a>
				</div>
				<div class="form">
					<div class="form-heading">
			            <h2>Login Form</h2>
			        </div>
<?php 
$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
if ( $login === "failed" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
} elseif ( $login === "empty" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
} elseif ( $login === "false" ) {
  echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
}
wp_login_form(); ?>

<p id="nav">
<a href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
</p>
</div>
			</div>
		</div>
	</div>
</section>
<div class="clear"></div>

</body>
<?php //get_sidebar(); ?>
<?php //get_footer(); ?>
