<?php
/**
 Template Name: Register
 */
 
get_header(); ?>
 
<div id="main-content" class="main-content">
  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
      <?php// if (!is_user_logged_in()) {?>
      <div class="container" style="margin:100px;">
        <div class="step1">
          <div class="row-fluid">
            <div class="span12">
              <h3> Greetings: Create an account</h3>
            </div>
          </div>
          <div>
            <?php if(defined('REGISTRATION_ERROR')){
            foreach(unserialize(REGISTRATION_ERROR) as $error){
              echo '<p class="order_error">'.$error.'</p><br>';
            }
          }?>
          </div>
        </div>
        <div class="row-fluid">
          <div class="span12">
            <form id="my-registration-form" method="post" action="<?php echo add_query_arg('do', 'register', get_permalink( $post->ID )); ?>" class="form_comment">
              <div class="span6">
                <input value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" name="email" id="email" placeholder="Email"  required="" type="text">
                <span class="toolTip" title="Enter a valid email address. your order will delivered on this email box">&nbsp;</span>
                <input value="" name="pass" id="password" placeholder="Password"  required="" type="Password">
                <span class="toolTip" title="Use atleast 6 characters">&nbsp;</span>
                <input value="" name="cpass" id="cpassword" placeholder="Confirm Password"  required="" type="Password">
                <span class="toolTip" title="Confirm your password">&nbsp;</span> </div>
              <div class="span6">
                <input value="<?php if(isset($_POST['user'])) echo $_POST['user'];?>" name="user" id="username" placeholder="User Name"  required="" type="text">
                <span class="toolTip" title="Enter your username">&nbsp;</span>
                <input value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>" name="phone" id="phone" placeholder="Phone"  required="" type="text">
                <div>
                  <input name="submit" type="submit" class="btn-ser" value="Sign Up & Continue" style="width:160px !important; padding-left:18px;">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php //} ?>
    </div>
    <!-- #content -->
  </div>
  <!-- #primary -->
</div>
<!-- #main-content -->
<?php
get_sidebar();
get_footer();
