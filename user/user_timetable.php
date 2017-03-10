<?php
session_start();
include_once "../include/connect2.inc.php";

$get_timetable = new User();
$result_get_timetable = $get_timetable->get_timetable($_SESSION['username']);

include '../user/user_timetable.html';

pg_free_result($result_get_timetable);

?>