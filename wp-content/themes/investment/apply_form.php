<?php
/* Template Name: Apply Form
*/
get_header();
global $wpdb;
if(isset($_GET['form_id']) && $_GET['form_id']!=""){
    $form_id = $_GET['form_id'];

    $form_results = $wpdb->get_results( 'SELECT * FROM wp_frm_items WHERE id ='.$form_id);
    $user_id = $form_results[0]->user_id;
    $user_info = get_userdata( $user_id );
    $user_fname = get_user_meta($user_id,'first_name',true);
    $user_lname = get_user_meta($user_id,'last_name',true);
}
?>
<div class="wpb_text_column wpb_content_element ">
        <div class="wpb_wrapper">
            <p><strong style="font-size: 18px; color: #4c4c4c;">” Discover How YOU Can Earn $50,000- $100,000/Year And MORE Ensuring Secure Futures For Individuals And Families! “</strong></p>

        </div>
    </div>

    <div class="wpb_text_column wpb_content_element  vc_custom_1477662049025">
        <div class="wpb_wrapper">
            <p><strong style="color: #10638d; fornt-size: 20px;">Push Candidates: To Apply or For More Information Fill Out Form Below and A PUSH Team Member Will Follow Up With You!<br>
</strong></p>

        </div>
    </div>

<?php 
echo FrmFormsController::show_form(2);
?>
<script type="text/javascript">
jQuery(document).ready(function(){
var user_fname = '<?php echo $user_fname;?>';
var user_lname = '<?php echo $user_lname;?>';
if(user_fname!="" && user_lname!=""){
var user_name = user_fname +" "+ user_lname;
}else{
    user_name = user_fname;
}

if(user_name !=""){
$('#field_98w7ij').val(user_name).attr('readonly', true);

}
var user_id = '<?php echo $user_id;?>';
if(user_id!=""){
$('#field_3x8ugw').val(user_id);
//$('#field_zl0dif').val(user_id);
}
});  
</script>
<?php get_footer(); ?>
