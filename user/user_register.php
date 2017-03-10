<?php
session_start();
include "../include/connect.inc.php";
include "../include/connect2.inc.php";

$list_obj = new GetList();
$list_semester = $list_obj->get_list_semester();
$list_school = $list_obj->get_list_school();

$register_class_obj = new User();
$class_obj = new Hien();
$other_obj = new Other();
$selected_semester = $other_obj->full_semester();
$sum_credits = $register_class_obj->get_sum_credits_subject_by_semester_username( $selected_semester, $_SESSION['username']);
$result_register_class_obj = $register_class_obj->get_list_register_class_by_username_semester( $_SESSION['username'], $selected_semester);

if ( isset($_POST['unregister_class']) )
{
    echo count($_POST['unregister']);
    foreach($_POST['unregister'] as $unregister_id_class)
    {
        echo $unregister_id_class;
        $register_class_obj->unregister_class_by_username_id_class($_SESSION['username'], $unregister_id_class);
    }
    header("Location:../user/user_register.php");
}

if(isset($_POST['register_class'])){
    $register = $_POST['register_class'];
    echo $register;
    $register_class_obj->register_class_by_username_id_class($_SESSION['username'], $register);
    header("Location:../user/user_register.php");
}


/* if( isset($_POST['find_register_class']) || isset($_POST['register_class']) || isset( $_POST['unregister_class']) || isset($_POST['submit_register'])){*/
if( isset($_POST['find_register_class']) || isset($_POST['submit_register']))
{
    if ( isset($_POST['find_register_class']) ){
        $_SESSION['selected_semester'] = $_POST['semester_select'];
        $_SESSION['selected_school'] = $_POST['school_select'];
        $_SESSION['id_class'] = $_POST['id_class'];
        $_SESSION['id_subject'] = $_POST['id_subject'];     
    }

    if(isset($_POST['register_class'])){
        $register = $_POST['register_class'];
        echo $register;
        $register_class_obj->register_class_by_username_id_class($_SESSION['username'], $register);
    }

    if ( isset($_POST['unregister_class']) )
    {
        echo count($_POST['unregister']);
        foreach($_POST['unregister'] as $unregister_id_class)
        {
            echo $unregister_id_class;
            $register_class_obj->unregister_class_by_username_id_class($_SESSION['username'], $unregister_id_class);
        }
    }

    if (isset($_POST['submit_register']) )
    {
        $register_class_obj->submit_register_class_by_username($_SESSION['username']);
    }

    $selected_semester = $_SESSION['selected_semester'];
    $selected_school = $_SESSION['selected_school'];
    $id_class = $_SESSION['id_class'];
    $id_subject = $_SESSION['id_subject'];
    $result_register_class_obj = $register_class_obj->get_list_register_class_by_username_semester( $_SESSION['username'], $selected_semester);

    if ( ( $id_class != "") || ( ($id_subject != "") || ( $selected_school != "default") ) && ( $selected_semester != "default") )
    {
        if ( $id_class != "" )
        {
            $last_id_class = $id_class;
            $list_class = $class_obj->get_list_class_by_id( $id_class );
            $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
            include '../user/user_register.html';
            pg_free_result($result_time_table_class_register);
            pg_free_result($list_class);
        } 
        else 
        {
            if(( $selected_semester != "default") && ($id_subject != ""))
            {
                $last_id_subject = $id_subject;
                $list_class = $class_obj->get_list_class_by_id_subject_semester( $id_subject, $selected_semester);
                $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
                include '../user/user_register.html';
                pg_free_result($result_time_table_class_register);
                pg_free_result($list_class);       
            }
            else 
            {
                $list_class = $class_obj->get_list_class_by_school_semester( $selected_school, $selected_semester);
                $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
                include '../user/user_register.html';
                pg_free_result($result_time_table_class_register);
                pg_free_result($list_class);
            }
        }
    } 
    
    else
    {
        $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
        include '../user/user_register.html';
        pg_free_result($result_time_table_class_register);
    }
    pg_free_result($result_register_class_obj);
  
}

else
{
    $result_time_table_class_register = $class_obj->get_time_table_class_register_by_username_semester($_SESSION['username'], $selected_semester);
    include '../user/user_register.html';
    pg_free_result($result_time_table_class_register);
}

pg_free_result($list_semester);
pg_free_result($list_school);

?>