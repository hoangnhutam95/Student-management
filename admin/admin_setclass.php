<?php
session_start();
include "../include/connect.inc.php";
include "../include/connect2.inc.php";

$list_obj = new GetList();
$list_semester = $list_obj->get_list_semester();
$list_school = $list_obj->get_list_school();

$register_class_obj = new User();
$class_obj = new Class_Obj();

$other = new Other();
$selected_semester = $other->full_semester();

if( isset($_POST['find_register_class']) || isset($_POST['submit']))
{
    if ( isset($_POST['find_register_class']) ){
        $_SESSION['selected_semester'] = $_POST['semester_select'];     //ten bien POST bang ten NAME trong html
        //$_POST[‘username’]; Username là tên field mà ngu?i s? d?ng nh?p li?u vào.
        $_SESSION['selected_school'] = $_POST['school_select'];
        $_SESSION['id_class'] = $_POST['id_class'];
        $_SESSION['id_subject'] = $_POST['id_subject'];
    }

    $selected_semester = $_SESSION['selected_semester'];
    $selected_school = $_SESSION['selected_school'];
    $id_class = $_SESSION['id_class'];
    $id_subject = $_SESSION['id_subject'];

    if ( ( $id_class != "") || ( ($id_subject != "") || ( $selected_school != "default") ) && ( $selected_semester != "default") )
    {  
        if ( $id_class != "" )
        {
            $last_id_class = $id_class;
            $list_class = $class_obj->get_list_class_by_id ($id_class );
            if(isset($_POST['submit']))
            {
                while ( $class = pg_fetch_array  ($list_class))
                {
                    $tmp_id = $class['id_class'];
                    if( isset( $_POST[$tmp_id]) )
                    {
                        $class_obj = new Class_Obj();
                        if( $_POST[$tmp_id] == "open" )
                        {
                            $stt = 'Open';
                            $class_obj->change_state_of_class_by_id_class_state ($tmp_id, $stt);
                        } 
                        else {
                            $stt = 'Close';
                            $class_obj->change_state_of_class_by_id_class_state ($tmp_id, $stt);
                        }
                    }
                }
          
                $success = "Complete!";
                $list_class = $class_obj->get_list_class_by_id ($id_class );
            }
            
            include '../admin/admin_setclass.html';
            pg_free_result($list_class);
        } 
        
        else 
        {
            if(( $selected_semester != "default") && ($id_subject != ""))
            {
                $last_id_subject = $id_subject;
                $list_class = $class_obj->get_list_class_by_id_subject_semester ($id_subject, $selected_semester);
                if( isset($_POST['submit']))
                {
                    while ( $class = pg_fetch_array ($list_class))
                    {
                        $tmp_id = $class['id_class'];
                        if( isset( $_POST[$tmp_id]) )
                        {
                            $class_obj = new Class_Obj();
                            if( $_POST[$tmp_id] == "open" )
                            {
                                $stt = 'Open';
                                $class_obj->change_state_of_class_by_id_class_state($tmp_id, $stt);
                            } 
                            else 
                            {
                                $stt = 'Close';
                                $class_obj->change_state_of_class_by_id_class_state($tmp_id, $stt);
                            }
                        }
                    }
                    
                    $success = "Complete!";        
                    $list_class = $class_obj->get_list_class_by_id_subject_semester ($id_subject, $selected_semester);
                }
                
                include '../admin/admin_setclass.html';
                pg_free_result($list_class);       
            }
        
            else {
        $list_class = $class_obj->get_list_class_by_school_semester ($selected_school, $selected_semester);
                if( isset($_POST['submit']))
                {
                    while ( $class = pg_fetch_array ($list_class))
                    {
                        $tmp_id = $class['id_class'];
                        if( isset( $_POST[$tmp_id]) )
                        {
                            $class_obj = new Class_Obj();
                            if( $_POST[$tmp_id] == "open" )
                            {
                                $stt = 'Open';
                                $class_obj->change_state_of_class_by_id_class_state ($tmp_id, $stt);
                            }
                            else 
                            {
                                $stt = 'Close';
                                $class_obj->change_state_of_class_by_id_class_state ($tmp_id, $stt);
                            }
                        }
                    }
                    $success = "Complete!";
                    $list_class = $class_obj->get_list_class_by_school_semester ($selected_school, $selected_semester);
                }
                include '../admin/admin_setclass.html';
                pg_free_result($list_class);
            }
        }  
    } 

    else 
    {
        $error_find = 'Please check that you fulfil all of fields';
        include '../admin/admin_setclass.html';
    }
}

else
{
    if( isset($_SESSION['selected_semester']) && isset($_SESSION['selected_school']) && isset($_SESSION['id_class']) && isset($_SESSION['id_subject']) )
    {
        $selected_semester = $_SESSION['selected_semester'];
        $selected_school = $_SESSION['selected_school'];
        $id_class = $_SESSION['id_class'];
        $id_subject = $_SESSION['id_subject'];
    
        if ( ( $id_class != "") || ( ($id_subject != "") || ( $selected_school != "default") ) && ( $selected_semester != "default") )
        {  
            if ( $id_class != "" )
            {
                $last_id_class = $id_class;
                $list_class = $class_obj->get_list_class_by_id ($id_class );
                include '../admin/admin_setclass.html';
                pg_free_result($list_class);
            }
            
            else
            {
                if(( $selected_semester != "default") && ($id_subject != ""))
                {
                    $last_id_subject = $id_subject;
                    $list_class = $class_obj->get_list_class_by_id_subject_semester ($id_subject, $selected_semester);
                    include '../admin/admin_setclass.html';
                    pg_free_result($list_class);       
                }
                else
                {
                    $list_class = $class_obj->get_list_class_by_school_semester ($selected_school, $selected_semester);
                    include '../admin/admin_setclass.html';
                    pg_free_result($list_class);
                }
            }  
        }
        else
        {
            $error_find = 'Please check that you fulfil all of fields';
            include '../admin/admin_setclass.html';
        }    
    } 
    else 
    {
        include '../admin/admin_setclass.html';
    }
}

pg_free_result($list_semester);
pg_free_result($list_school);

?>