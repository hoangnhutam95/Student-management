<?php
session_start();
include "../include/connect2.inc.php";

$post_obj = new Post();
$result_10_last_post = $post_obj->get_10_last_post();
$result_post_admin = $post_obj->get_post_of_admin();
$result_post_register_class = $post_obj->get_post_register_class();
$result_post_graduate_project = $post_obj->get_post_graduate_project();
$result_post_graduate_consider = $post_obj->get_post_graduate_consider();
$result_post_warning_study = $post_obj->get_post_warning_study();

include "../user/trangchu.html";
?>