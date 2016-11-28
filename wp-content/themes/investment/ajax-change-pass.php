<?php
/*
*Template Name: Ajax Change Password
*/ 
$response_arr = array('flag' => false, 'msg' => NULL);

        $old_password = trim($_POST['old_pass']);
        $new_password = trim($_POST['new_pass']);
        $confirm_new_password = trim($_POST['cnew_pass']);


        $msg = NULL;

        $user = wp_get_current_user();

        if (empty($old_password)) {
            $msg = 'Old password is Required';
        } else if (!wp_check_password($old_password, $user->data->user_pass, $user->ID)) {
            $msg = 'Old Password does not match';
        } else if (empty($new_password)) {
            $msg = 'New password is Required';
        } else if (empty($confirm_new_password)) {
            $msg = 'Confirm New password is Required';
        } else if ($old_password == $new_password) {
            $msg = 'Please provide new password other than old password';
        } else if ($new_password != $confirm_new_password) {
            $msg = 'New Password and Confirm New password must be same';
        } else {

            wp_update_user(array('ID' => $user->ID, 'user_pass' => $new_password));
            $msg = 'Your Password change Successfully';
            $response_arr['flag'] = TRUE;
        }
        $response_arr['msg'] = $msg;

        echo json_encode($response_arr);
        exit;
?>
