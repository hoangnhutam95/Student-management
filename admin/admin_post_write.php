<?php
session_start();
include "../include/connect.inc.php";

if( isset($_POST['post'])){
  if( ( $_POST['content'] != "") && ( $_POST['brief'] != "") && ( $_POST['title'] != "") ){
    $admin_obj = new Admin();
    
    //kiểm tra up file chưa
    if( $_FILES['file_attack']['name'] != NULL){
      $path = '../file/';
      $tmp_name = $_FILES['file_attack']['tmp_name']; //tên tạm thời của file trên server. khi thêm vào server ok là nó sẽ mất đi !
      $name = $_FILES['file_attack']['name'];

      move_uploaded_file( $tmp_name, $path.$name);
      $admin_obj->post_idadmin_idcategory_title_brief_header_content_file( $_SESSION['admin_id'], $_POST['select_category'], $_POST['title'], $_POST['brief'], $_POST['header'], $_POST['content'], $name);
    } else {
      $name = "";
      $admin_obj->post_idadmin_idcategory_title_brief_header_content_file( $_SESSION['admin_id'], $_POST['select_category'], $_POST['title'], $_POST['brief'], $_POST['header'], $_POST['content'], $name);
    }    
    $sucess_post= 'Đăng bài thành công!';
  } else {
    $error_post = 'Bài đăng không hợp lệ!';
  }
}

include '../admin/admin_post_write.html';

?>