<?php
session_start();
include "../include/connect2.inc.php";

$report_study = new User();
$result_report_study = $report_study->report_study ( $_SESSION['username'] );
$s_info = new User();
$info = $s_info->get_common_info_by_username( $_SESSION['username']);
include '../user/user_result.html';
pg_free_result ( $result_report_study );
pg_free_result ( $info );
?>