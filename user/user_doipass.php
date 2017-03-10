<?php
session_start();
include_once "../include/connect2.inc.php";

if ( isset ($_POST['changepassword']) )
{
  // Check password
  if ( $_SESSION['password'] == $_POST['oldpassword'])
  {
    if($_POST['newpassword']== $_SESSION['password']){
        $error_changepassword="Mật khẩu mới trùng mật khẩu cũ!";
        include_once "../user/user_doipass.html";
    }
    // Check new password is match with confirm password
    if( $_POST['newpassword'] == $_POST['confirmnewpassword'] ){
      $model_user = new User;
      $model_user->changepassword_user($_SESSION['username'], $_POST['newpassword']);
      // Check change password is success.
      $row = pg_fetch_array( $model_user->get_info_user($_SESSION['username']) );
      if ( $row['password'] == $_POST['newpassword'] ){
        if(strlen($row['password'])>=6){
            $_SESSION['password'] = $row['password'];
            $sucess_changepassword = "Ðổi mật khẩu thành công!";
            include_once "../user/user_doipass.html";
            }
        else{
            $error_changepassword="Mật khẩu mới phải trên 6 ký tự!";
            include_once "../user/user_doipass.html";
        }
      } else {
        $error_changepassword = "Đã xảy ra lỗi, vui lòng thử lại!";
        include_once "../user/user_doipass.html";
      }
    } else {
      $error_changepassword = "Xác nhận mật khẩu không đúng!";
      include_once "../user/user_doipass.html";
    }
  }
  else {
    $error_changepassword = "Mật khẩu cũ không đúng!";
    include_once "../user/user_doipass.html";
  }
} else {
  include_once "../user/user_doipass.html";
}

?>