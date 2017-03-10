<?php
session_start();
include "../include/connect.inc.php";
include "../include/connect2.inc.php";

$list_obj = new GetList();
$list_session = $list_obj->get_list_session();
$list_class= $list_obj->get_list_class();
if( isset($_POST['find_username']) ){
  if( $_POST['username_find'] != ""){

    $user_obj = new User();
    $get_student = $user_obj->get_common_info_by_username( $_POST['username_find'] );
    if ( pg_num_rows ( $get_student )){
      $student = pg_fetch_array( $get_student );
      $variable_student = '1';
    } else {
      $error_find_username = "Không tìm thấy sinh viên mã ".$_POST['username_find'].'!<br />';
    }
  }
}

if( isset($_POST['commit']) ){
  if( $_POST['username'] != ""  ){

  if( ( $_POST['fullname'] == "") || ( $_POST['student_dob'] == "" ) || ( $_POST['new_hometown'] == ""  ) ){
    $error_commit = "Thông tin cập nhật không hợp lệ. Vui lòng kiểm tra lại!";
  } else {
    $admin_obj = new Admin();
    $admin_obj->update_student_with_info($_POST['username'], $_POST['fullname'], $_POST['student_dob'], $_POST['sex_select'], $_POST['new_hometown'], $_POST['new_session'], $_POST['course_type']);
	$update_student_success = "Cập nhật thông tin thành công!";
  }
  }
}

include '../admin/admin_updatestd.html';
?>