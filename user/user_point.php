<?php
session_start();
include "../include/connect2.inc.php";

$get_user_table_point = new User();
$result_table_point = $get_user_table_point->get_table_point( $_SESSION['username'] );
$s_info = new User();
$info = $s_info->get_common_info_by_username( $_SESSION['username']);

include '../user/user_point.html';
pg_free_result($result_table_point);
pg_free_result ( $info );
?>