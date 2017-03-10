<?php
session_start();
include "../include/connect.inc.php";
include "../include/connect2.inc.php";

if( isset($_POST['find'])){
	if( ($_POST['username'] == "") || ($_POST['id_class'] == "") ){
		$error_find = 'Bạn hãy nhập đầy đủ các thông tin cần thiết!';
	} else {
		$class_obj = new Class_Obj();
		$check = $class_obj->print_if_username_study_on_class_by_username_idclass( $_POST['username'], $_POST['id_class']);
		if ( pg_num_rows($check)){
			$user_obj = new User();
			$student = pg_fetch_array( $user_obj->get_info_user($_POST['username']));
			$class = pg_fetch_array( $class_obj->get_list_class_by_id( $_POST['id_class']));
			$_SESSION['idclass_tmp'] = $_POST['id_class'];
			$_SESSION['username_temp'] = $_POST['username'];
		} else {
			$error_find = 'Không tìm sinh viên '.$_POST['username'].' trong danh sách lớp '.$_POST['id_class'].'';
		}
	}
}

if( isset($_POST['update_point'])){
		if( $_POST['update_point'] == "" ){
			$error_update_point = 'Bạn hãy tìm sinh viên trước khi cập nhật điểm';
		} else {
		$midle_point = $_POST['midle'];
		$end_point = $_POST['end'];
		$point_obj = new Point();
		$class_obj = new Class_Obj();
		$get_id_subject = $class_obj->get_list_class_by_id($_SESSION['idclass_tmp']);
		$id_subject = pg_fetch_array( $get_id_subject);
		$get_trongso = $point_obj->get_trongso_by_id_subject( $id_subject['id_subject'] );
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
		$admin_obj = new Admin();

        $point_by_username_id_class = $class_obj->get_point_by_username_id_class( $_SESSION['username_temp'], $_SESSION['idclass_tmp']);
      if( pg_num_rows($point_by_username_id_class)){
        $admin_obj->update_point_of_student( $_SESSION['username_temp'], $_SESSION['idclass_tmp'], $midle_point, $end_point, $average, $diemchu, $thang4 );
      } else {
        $admin_obj->write_point_of_student( $_SESSION['username_temp'], $_SESSION['idclass_tmp'], $midle_point, $end_point, $average, $diemchu, $thang4 );
      }
		$get_cpa = $point_obj->view_cpa_point_by_username_semester( $_SESSION['username_temp'], $id_subject['semester']);
		$cpa = pg_fetch_array($get_cpa);
        $cpa['cpa'] = round( $cpa['cpa'], 2);
        
        
		$get_gpa = $point_obj->view_gpa_point_by_username_semester( $_SESSION['username_temp'], $id_subject['semester']);
		$gpa = pg_fetch_array($get_gpa);
        $gpa['gpa'] = round( $gpa['gpa'], 2);

		$get_tcdangky = $point_obj->view_tc_dangky_by_username_semester( $_SESSION['username_temp'], $id_subject['semester']);
		$tcdangky = pg_fetch_array($get_tcdangky);

		$get_tctichluy = $point_obj->view_tc_tichluy_by_username_semester( $_SESSION['username_temp'], $id_subject['semester']);
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

        $check_cpa_gpa = $point_obj->display_if_have_info_about_CPA_GPA( $_SESSION['username_temp'], $id_subject['semester']);
        if( pg_num_rows($check_cpa_gpa) ){
          $admin_obj->update_GPA_CPA_of_student( $_SESSION['username_temp'], $id_subject['semester'], $gpa['gpa'], $cpa['cpa'], $tcdangky['tcdangky'], $tctichluy['tctichluy'], $trinhdosv);
        } else {
          $admin_obj->write_GPA_CPA_of_student( $_SESSION['username_temp'], $id_subject['semester'], $gpa['gpa'], $cpa['cpa'], $tcdangky['tcdangky'], $tctichluy['tctichluy'], $trinhdosv);
        }
        $sucess_update_point = 'Đã cập nhật điểm cho sinh viên '.$_SESSION['username_temp'];
}
}

include '../admin/admin_stdpoint.html';
?>
 