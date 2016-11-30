<script type="text/javascript">
	
jQuery(document).ready(function(){

$('form#change_pass').on('submit', function(e) {
	
        e.preventDefault();
        var target = $(this);
        var data = target.serialize();
        $.ajax({
              type: "POST",
              url: "<?php echo site_url() ?>/ajax-change-password",
              data: data,			  
              success: function(resp){
              	var obj = $.parseJSON(resp);
              	if(obj.flag == true){
              		alert(obj.msg);
              		window.location.href="";
              		
              	}else{
              		alert(obj.msg);
              		
              		
              	}
              }
          },'json');
        
    });

});




</script>
<div class="modal fade bd-example-modal-sm" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" style="bottom: 0;display: inline-block;left: 0;margin: auto;position: absolute;right: 0;top: 0;width: 50%;">
    <div class="modal-content">
      <div id="page-wrapper">
            <form name="change_pass" id="change_pass" action="javascript:void(0);" method="post">
<table width="100%" cellspacing="0" cellpadding="0" border="0">

<tr>
<td colspan="2" align="center"><h2>Change Password</h2></td>
</tr>

<tr>
<td>Old Password <span style="color: #F00">*</span></td>
<td><input type="password" name="old_pass" id="old_pass" value="" style="width: 300px;" required/></td>
</tr>

<tr>
<td>New Password <span style="color: #F00">*</span></td>
<td><input type="password" name="new_pass" id="new_pass" value="" style="width: 300px;" required/></td>
</tr>

<tr>
<td>Confirm New Password <span style="color: #F00">*</span></td>
<td><input type="password" name="cnew_pass" id="cnew_pass" value="" style="width: 300px;" required/></td>
</tr>

<tr>
<td align="center" colspan="2"><input type="submit" name="pass_submit_btn" id="pass_submit_btn" value="Change" /></td>
</tr>
</table>
</form>
        </div>
    </div>
  </div>
</div>
<div class="sidebarmenu">
					<div class="sidebar">
						<ul>
							<li class="selected"><a href="<?php echo site_url();?>/dashboard"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
							<li><a href="<?php echo site_url();?>/carriers"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Carriers</span></a></li>
							<li><a href="#"><i class="fa fa-external-link-square" aria-hidden="true"></i><span>OPT! Login</span></a></li>
							<li><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>Cruise Contest</span></a></li>
							<li><a href="#"><i class="fa fa-television" aria-hidden="true"></i><span>Leaderboard</span></a></li>
							<li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i><span>Contracting</span></a></li>
							<li><a href="#"><i class="fa fa-black-tie" aria-hidden="true"></i><span>Resources</span></a></li>
							<li><a href="<?php echo site_url();?>/training"><i class="fa fa-picture-o" aria-hidden="true"></i><span>Training</span></a></li>
							<li><a href="#"><i class="fa fa-calendar"></i><span>Events</span></a></li>
							<li><a href="<?php echo site_url();?>/new-business/"><i class="fa fa-building-o"></i><span>New Business</span></a></li>
							<li><a href="#"><i class="fa fa-sitemap"></i><span>Agent Hierarchy</span></a></li>
							<li><a href="<?php echo site_url();?>/profile"><i class="fa fa-user"></i><span>My Profile</span></a></li>
						</ul>
					</div>
</div>
