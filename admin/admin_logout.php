<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
echo '<title>Ðăng xuất</title>';
if (session_destroy()) 
   header("Location:../admin/admin_login.php");
else
    echo "Có lỗi trong việc hủy session";
?>