<?php
session_start();
include "../include/connect2.inc.php";

$list_obj = new GetList();
$list_session = $list_obj->get_list_session();
$list_school = $list_obj->get_list_school();

if ( isset ( $_POST['search'] ) ) {

  $selected_session = $_POST['session_select'];
  $selected_school = $_POST['school_select'];
  $selected_class = $_POST['class_select'];
  
  if( $_POST['username_find'] != "" ){
    $find_student = new User();
    $result_find_student = $find_student->find_student( $_POST['username_find']  );
  } else {
    if($_POST['name_find'] == ""){
      $name_find = "*";
    } else {
      $name_find = $_POST['name_find'];
    }
    if($_POST['session_select'] == "default"){
      $session_find = "*";
    } else {
      $session_find = $_POST['session_select'];
    }
    if($_POST['school_select'] == "default"){
      $school_find = "*";
    } else {
      $school_find = $_POST['school_select'];
    }
    if($_POST['class_select'] == "default"){
      $class_find = "*";
    } else {
      $class_find = $_POST['class_select'];
    }
    
    $find_student = new User();
    $result_find_student = $find_student->find_student_by_name_session_school_class($name_find, $session_find, $school_find, $class_find);
  }

  if( isset ( $school_find) && isset ( $session_find)){
    $list_class = $list_obj->get_list_class_by_school_session($school_find, $session_find);
  }
  
  include '../user/user_listclass_student.html';

  pg_free_result($result_find_student);
  if( isset ( $school_find) && isset ( $session_find)){
    pg_free_result($list_class);
  }
} else {
  include '../user/user_listclass_student.html';
}

pg_free_result($list_session);
pg_free_result($list_school);

?>