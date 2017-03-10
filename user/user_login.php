<?php
session_start();
include_once "../include/connect2.inc.php";

/* If user is login => homepage   else => login
if( isset($_SESSION['username']) ){
    header("Location: ../user/user_success.php");       //sau Location: phải có space
}

else {*/
    //Check null
    if( isset( $_POST['submit'] ) ) {
        // Check username and password
        if( $_POST['username'] != '' && $_POST['password'] != ''){
            $user = new User;
            $r = pg_num_rows( $user->get_info_user($_POST['username']));
            if( $r != 0){
                // Check password
                $row = pg_fetch_array( $user->get_info_user($_POST['username']) );
                if( $row['password'] == $_POST['password']){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['fullname'] = $row['fullname'];
                    header("Location: ../user/user_trangchu.php");
                } 
                else {
                    $error_login = "Mật khẩu không đúng!";
                    include_once "../user/user_login.html";
                }
            } 
            else {
                $error_login = "Tài khoản không hợp lệ!";
                include_once "../user/user_login.html";
            }
        } 
        
        else {
            $error_login = "Bạn hãy nhập tài khoản và mật khẩu!";
            include_once "../user/user_login.html";
        }
    }

    else {
        include_once "../user/user_login.html";
    }
    
//}
?>