<?php
session_start();
include "../include/connect2.inc.php";

$all_require_subject = new User();
$result_all_require_subject = $all_require_subject->get_all_require_subject($_SESSION['username']);

include '../user/user_training.html';

pg_free_result($result_all_require_subject);

?>