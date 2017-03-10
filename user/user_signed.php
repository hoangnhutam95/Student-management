<?php
session_start();
include "../include/connect.inc.php";
include "../include/connect2.inc.php";

$list_obj = new GetList();
$list_semester = $list_obj->get_list_semester();

$other_obj = new Other();

$selected_semester= $other_obj->full_semester();
$semester = $selected_semester;
$username = $_SESSION['username'];

$signed_subject_list = new User();

if ( isset ( $_POST['find'] )){
  $selected_semester = $_POST['semester_select'];
  $semester = $selected_semester;

  $name = $other_obj->get_fullname_by_username($username);
  if ( NULL == $name){
    exit();
  }
  $result = $signed_subject_list->get_list_singed_subject_by_semester_username( $semester, $username);
  include '../user/user_signedclass.html';
  
  pg_free_result( $result);  
} else {

  $result = $signed_subject_list->get_list_singed_subject_by_semester_username( $semester, $username);
  $name = $other_obj->get_fullname_by_username($username);
  include '../user/user_signedclass.html';
  
  pg_free_result( $result);
}

?>