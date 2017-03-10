<?php
session_start();
include "../include/connect.inc.php";
include "../include/connect2.inc.php";

$list_obj = new GetList();
$list_semester = $list_obj->get_list_semester();
$list_school = $list_obj->get_list_school();

if (isset ($_POST['find']))
{
  $selected_semester = $_POST['semester_select'];
  $selected_school = $_POST['school_select'];
  
  if ( ( ($_POST['id_subject'] != "") || ( $_POST['school_select'] != "default") ) && ( $_POST['semester_select'] != "default") )
  {
    
    /*if ( $_POST['id_class'] != "" ){
      $class_obj = new Class_Obj();
      $list_class = $class_obj->get_list_class_by_id( $_POST['id_class'] );
      include '../user/listclass_subject.html';
      pg_free_result($list_class);
    } else {*/
      if(( $_POST['school_select'] != "default") && ($_POST['id_subject'] != "")){
        $class_obj = new Class_Obj();
        $list_2 = $class_obj->list_class_by_id_subject_semester( $_POST['id_subject'], $_POST['semester_select']);
        $class_2 = new Class_Obj();
        $list_2 = $class_2->list_class_by_id_subject_semester( $_POST['school_select'], $_POST['semester_select']);
		//echo "Tìm lớp theo mã học phần và học kỳ";
        include '../user/user_listclass_subject.html';
        pg_free_result($list_class);       
      } 
      else {
        $class_obj = new Class_Obj();
        $list_class = $class_obj->list_class_by_school_semester( $_POST['school_select'], $_POST['semester_select']);
        $class_2 = new Class_Obj();
        $list_2 = $class_2->list_class_by_school_semester( $_POST['school_select'], $_POST['semester_select']);
        include '../user/user_listclass_subject.html';
        pg_free_result($list_class);
      }
    
  } else {
    include '../user/user_listclass_subject.html';
  }
} 
  else {
  include '../user/user_listclass_subject.html';
}

pg_free_result($list_semester);
pg_free_result($list_school);

?>
