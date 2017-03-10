<?php
session_start();
include "../include/connect.inc.php";
include "../include/connect2.inc.php";

if ( isset($_GET['category']) && isset($_GET['post_id']) ){
  $post_obj = new Post();
  $post = $post_obj->get_post_by_category_id_post_id( $_GET['category'], $_GET['post_id']);
  include '../user/view_post.html';
  pg_free_result( $post);
} else {
  if ( isset( $_GET['post_id']) ) {
    $post_obj = new Post();
    $post = $post_obj->get_post_by_post_id( $_GET['post_id']);
    include '../user/view_post.html';
    pg_free_result( $post);
  } else {
    exit();
  }
}
?>