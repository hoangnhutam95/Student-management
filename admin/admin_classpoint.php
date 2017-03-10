<?php
session_start();
include "../include/connect.inc.php";
include "../include/connect2.inc.php";

$class_obj = new Class_Obj();
$user = new User();
$other = new Other();

if ( isset ($_POST['find_class'])){
  if( $_POST['id_class'] != ""){
    $find_class_by_id = $class_obj->get_list_class_by_id( $_POST['id_class']);
    if ( pg_num_rows($find_class_by_id) ){
      $class_row = pg_fetch_array( $find_class_by_id );
      $list_student = $class_obj->get_list_student_by_id_class( $class_row['id_class']);
      $_SESSION['idclass_tmp'] = $_POST['id_class'];
    } else {
      $error_find_class = "Không tìm thấy lớp ".$_POST['id_class'];
    }
  } else {
    $error_find_class = "Bạn chưa nhập mã lớp cần tìm!";
  }
}

if ( isset ($_POST['commit_point'])){

  if( $_POST['commit_point'] == ""){
    $error_comit_point = 'Bạn chưa nhập mã lớp cần tìm!';
  } else {
    $find_class_by_id = $class_obj->get_list_class_by_id( $_POST['commit_point'] );
    $class_row = pg_fetch_array( $find_class_by_id );
    $list_student = $class_obj->get_list_student_by_id_class( $class_row['id_class']);

    while( $row_list_student = pg_fetch_array($list_student)){
      $temp_username = $row_list_student['username'];
      if( isset( $_POST['midle'.$temp_username])){
        if( $_POST['midle'.$temp_username] == "" || $_POST['midle'.$temp_username] == "0"){
          $midle_point = 1;
        } else {
        $midle_point = $_POST['midle'.$temp_username];
        }
      } else {
        $midle_point = 1;
      }
      
      if( isset( $_POST['end'.$temp_username])){
        if( $_POST['end'.$temp_username] == "" || $_POST['end'.$temp_username] == "0"){
          $end_point = 1;
        } else {
        $end_point = $_POST['end'.$temp_username];
        }
      } else {
        $end_point = 1;
      }

		$point = new Point();
		$class_obj = new Class_Obj();
		$get_id_subject = $class_obj->get_list_class_by_id($_SESSION['idclass_tmp']);
		$id_subject = pg_fetch_array( $get_id_subject);
		$get_trongso = $point->get_trongso_by_id_subject( $id_subject['id_subject'] );
		$trongso = pg_fetch_array($get_trongso)['Trongso'];
		
        $average = $midle_point * ( 1 - $trongso) + $end_point * $trongso;
		
        if( $average < 4){
			$thang4 = 0;
			$diemchu = 'F';
		}
		if( $average >= 4 && $average <5 ){
			$thang4 = 1;
			$diemchu = 'D';		
		}
		if( $average >= 5 && $average < 5.5 ){
			$thang4 = 1.5;
			$diemchu = 'D+';		
		}
		if( $average >= 5.5 && $average < 6.5 ){
			$thang4 = 2;
			$diemchu = 'C';		
		}
		if( $average >= 6.5 && $average < 7 ){
			$thang4 = 2.5;
			$diemchu = 'C+';		
		}
		if( $average >= 7 && $average < 8 ){
			$thang4 = 3;
			$diemchu = 'B';		
		}
		if( $average >= 8 && $average < 8.5 ){
			$thang4 = 3.5;
			$diemchu = 'B+';		
		}
		if( $average >= 8.5 && $average < 9.5 ){
			$thang4 = 4;
			$diemchu = 'A';		
		}
		if( $average >= 9.5 && $average <= 10 ){
			$thang4 = 4;
			$diemchu = 'A+';		
		}
		$admin = new Admin();

        $point_by_username_id_class = $class_obj->get_point_by_username_id_class( $temp_username, $_SESSION['idclass_tmp']);
      if( pg_num_rows($point_by_username_id_class)){
        $admin->update_point_of_student( $temp_username, $_SESSION['idclass_tmp'], $midle_point, $end_point, $average, $diemchu, $thang4 );
      } else {
        $admin->write_point_of_student( $temp_username, $_SESSION['idclass_tmp'], $midle_point, $end_point, $average, $diemchu, $thang4 );
      }
		$get_cpa = $point->view_cpa_point_by_username_semester( $temp_username, $id_subject['semester']);
		$cpa = pg_fetch_array($get_cpa);
        $cpa['cpa'] = round( $cpa['cpa'], 2);
        
        
		$get_gpa = $point->view_gpa_point_by_username_semester( $temp_username, $id_subject['semester']);
		$gpa = pg_fetch_array($get_gpa);
        $gpa['gpa'] = round( $gpa['gpa'], 2);

		$get_tcdangky = $point->view_tc_dangky_by_username_semester( $temp_username, $id_subject['semester']);
		$tcdangky = pg_fetch_array($get_tcdangky);

		$get_tctichluy = $point->view_tc_tichluy_by_username_semester( $temp_username, $id_subject['semester']);
        $tctichluy = pg_fetch_array($get_tctichluy);
        if( $tctichluy['tctichluy']  == ""){
          $tctichluy['tctichluy'] = 0;
        }
	
        if( $tctichluy['tctichluy'] < 32){
          $trinhdosv = 'Sinh viên năm thứ nhất';
        }
        if( ($tctichluy['tctichluy'] >= 32) && ($tctichluy['tctichluy'] < 64) ){
          $trinhdosv = 'Sinh viên năm thứ hai';
        }
        if( ($tctichluy['tctichluy'] >= 64)  && ($tctichluy['tctichluy'] < 96) ){
          $trinhdosv = 'Sinh viên năm thứ ba';
        } 
        if( ($tctichluy['tctichluy'] >= 96)  && ($tctichluy['tctichluy'] < 128) ){
          $trinhdosv = 'Sinh viên năm thứ tư';
        }
        if( $tctichluy['tctichluy'] >= 128){
          $trinhdosv = 'Sinh viên năm thứ năm';
        }

        $check_cpa_gpa = $point->display_if_have_info_about_CPA_GPA( $temp_username, $id_subject['semester']);
        if( pg_num_rows($check_cpa_gpa) ){
          $admin->update_GPA_CPA_of_student( $temp_username, $id_subject['semester'], $gpa['gpa'], $cpa['cpa'], $tcdangky['tcdangky'], $tctichluy['tctichluy'], $trinhdosv);
        } else {
          $admin->write_GPA_CPA_of_student( $temp_username, $id_subject['semester'], $gpa['gpa'], $cpa['cpa'], $tcdangky['tcdangky'], $tctichluy['tctichluy'], $trinhdosv);
        }      
      
    }
    $sucess_comit_point= "Ðã cập nhật điểm cho lớp ".$_SESSION['idclass_tmp'];
    unset( $_SESSION['idclass_tmp'] );
    unset( $class_obj );
  }
}

include "../admin/admin_classpoint.html";

?>