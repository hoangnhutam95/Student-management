<?php
session_start();
include "../include/connect.inc.php";

if ( isset ($_POST['change_password']) )
{
    if ( ($_POST['new_password'] == "")  || ( $_POST['old_password'] == "") || ( $_POST['confirm_password'] == "") )
    {
        $error_change = "Bạn phải nhập đầy đủ thông tin!";
    }

    else
    {   
        // Check pass

        if ( $_SESSION['password'] == $_POST['old_password'])
        {
            if($_POST['new_password']== $_SESSION['password']){
                $error_change="Mật khẩu mới trùng mật khẩu cũ!";
                include_once "../admin/admin_doipass.html";
            }
        // Xac nhan mat khau trung voi mat khau moi
            if( $_POST['new_password'] == $_POST['confirm_password'] )
            {

                $admin = new Admin();
                $admin->changepassword_admin($_SESSION['admin_id'], $_POST['new_password']);
                $row = pg_fetch_array( $admin->get_info_admin($_SESSION['admin_id']) );     
                if ( $row['password'] == $_POST['new_password'] )
                {
                    if(strlen($row['password'])>=6){
                        $_SESSION['password'] = $row['password'];
                        $sucess_change = "Ðổi mật khẩu thành công!";
                        include_once "../admin/admin_doipass.html";
                    }
                    else{
                        $error_change="Mật khẩu mới phải trên 6 ký tự!";
                        include_once "../admin/admin_doipass.html";
                    }
                } 
                else 
                {
                    $error_change = "Ðã xảy ra lỗi. Vui lòng thử lại!";
                    include_once "../admin/admin_doipass.html";
                }
            } 
            else
            {
                $error_change = "Xác nhận mật khẩu không đúng!";
                include_once "../admin/admin_doipass.html";
            }
        } 
        else
        {
            $error_change = "Mật khẩu cũ không đúng!";
            include_once "../admin/admin_doipass.html";
        }
    }
}

else
{
  include_once "../admin/admin_doipass.html";
}

?>