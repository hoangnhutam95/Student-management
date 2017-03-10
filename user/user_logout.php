<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
echo '<title>Đăng xuất</title>';
if (session_destroy()) 
    header("Location:../user/guest.php");
else
    echo "Có lỗi trong việc hủy session";

?>