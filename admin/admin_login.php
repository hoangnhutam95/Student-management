<?php
session_start();
include "../include/connect.inc.php";

/* Luu dang nhap */
/*if( isset($_SESSION['admin_id']) )
{
  header( "Location: ../admin/admin_trangchu.php");
}
else
{
*/
     //Close else in line 55

if( isset( $_POST['login'] ) )
{
    if( $_POST['admin_id'] != '' && $_POST['password'] != '')
    {
        $p = new Admin();
        $admin = $p->get_info_admin($_POST['admin_id']);
        $r = pg_num_rows( $admin);
            
        if( $r != 0)
        {
            $row = pg_fetch_array( $admin );
            if( $row['password'] == $_POST['password'])
            {
                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['fullname'] = $row['fullname'];
                header("Location: ../admin/admin_trangchu.php");
            }
            else 
            {
                $error = "Mật khẩu không đúng!";
                include_once "../admin/admin_login.html";
            }
        }
        else 
        {
            $error = "Tài khoản không hợp lệ!";
            include_once "../admin/admin_login.html";
        }
    }
    else 
    {
        $error = "Bạn hãy nhập tài khoản và mật khẩu!";
        include_once "../admin/admin_login.html";
    }
}

else 
{
    include_once "../admin/admin_login.html";
}
//}
?>