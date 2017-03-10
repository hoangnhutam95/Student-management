<?php
session_start();
include("../include/connect2.inc.php");
include("../include/connect.inc.php");

$list = new GetList();
$list_session = $list->get_list_session();
$list_class = $list->get_list_class();
if( isset($_POST['add']) )
{
    $selected_session = $_POST['session'];
    $selected_class = $_POST['class'];
    if( ($_POST['username'] != "") && ( $_POST['fullname'] != "") && ( $_POST['dob'] != "") && ( $_POST['hometown'] != "" ) )
    {
        $admin = new Admin();
        $user = new User();
        if ( !pg_num_rows($user->get_info_user( $_POST['username'])) )
        {
            $admin->add_student_info( $_POST['username'], $_POST['fullname'], $_POST['sex'], $_POST['dob'], $_POST['hometown'], $_POST['class'], $_POST['password'], $_POST['course_type'], $_POST['session']);
            // Need check success!
            if ( pg_num_rows($user->get_info_user( $_POST['username'])) )
            {
                if(strlen($_SESSION['password']) >= 6)
                {
                    $success_add = "Ðã thêm sinh viên mới!";
                }
                else {$error_add = "Mật khẩu không hợp lệ!";}
            }
            else
            {
                $error_add = "Lỗi kết nối cơ sở dữ liệu!";
            }
        }
        else
        {
            $error_add= "Lỗi: Mã số sinh viên đã tồn tại!";
        }
    }
    else
    {
        $error_add = "Bạn phải nhập đầy đủ thông tin sinh viên!";
    }
    
    include '../admin/admin_addstd.html';
}

else
{
    include '../admin/admin_addstd.html';
}
?>
