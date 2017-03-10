<?php
session_start();
include "../include/connect2.inc.php";

$list_school_obj = new GetList();
$list_school = $list_school_obj->get_list_school();

if ( isset($_POST['search']) ){
  if ( $_POST['id_subject'] != "" ) {
    $input = $_POST['id_subject'];
  } else {
    if ( $_POST['subject'] != "" ){
      $input = $_POST['subject'];
    } else {
      $input = $_POST['listsbj_select'];
    }
  }

  $selected_school = $_POST['listsbj_select'];
  
  if ( isset ($input)) {
    $get_list_subject = new Subject();
    $result_get_list_subject = $get_list_subject->get_info_subject( $input );
  }
  
  include '../user/user_listsubject.html';

  pg_free_result($result_get_list_subject);
} else {
  include '../user/user_listsubject.html';
}

pg_free_result($list_school);

?>
