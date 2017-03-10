<?php
session_start();
include "../include/connect2.inc.php";

$common_infomation = new User();
$common_info = pg_fetch_array($common_infomation->get_common_info_by_username($_SESSION['username']));

include "../user/user_info.html";

?>