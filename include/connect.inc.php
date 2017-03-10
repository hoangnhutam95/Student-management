<?php

$link=pg_connect('host=localhost port=5432 dbname=QLSV user=postgres password=123456 ')
or die("Cannot connect to database server! Please check your connection!".pg_last_error());


class Admin{
    public function get_info_admin( $admin_id ){
        $query = "select \"MaAD\" as admin_id, \"HoTen\" as fullname, \"MatKhau\" as password
			      from \"ADMIN\" 
			      where \"MaAD\" ='".$admin_id."' ";
        return pg_query( $query);
    }

    public function changepassword_admin( $admin_id, $newpassword ){
        $query = "update \"ADMIN\" 
                  set \"MatKhau\" = '".$newpassword."' 
                  where \"MaAD\" = '".$admin_id."' ";
        return pg_query($query);
    }

  /* Doi pass sv 
  public function set_password_username_password ( $username, $newpassword ){
           $query = "update \"SinhVien\" 
					 set \"MatKhau\" = '$newpassword' 
					 where \"MSSV\" = '$username';";
           return pg_query($query);}*/

    public function add_student_info( $username, $fullname, $sex, $dob, $hometown, $class, $password, $course_type, $session){
        $query = "insert into \"SinhVien\" (\"MSSV\",\"HoTen\",\"GioiTinh\",\"NgaySinh\",\"QueQuan\",\"MaLopSV\", \"MatKhau\",\"HeHoc\",\"KhoaHoc\")
                  values ('".$username."', '".$fullname."',  '".$sex."', '".$dob."','".$hometown."', '".$class." ','".$password."', '".$course_type."', '".$session."') ;";
        return pg_query( $query);
    }
  
    public function update_student_with_info( $username_student, $fullname_student, $dob_student, $sex_of_student, $hometown_student, $session, $course_type){
        $query = "update \"SinhVien\" 
			      set  \"HoTen\" = '".$fullname_student."', \"GioiTinh\" = '".$sex_of_student."', \"NgaySinh\" = '".$dob_student."', \"QueQuan\" = '".$hometown_student."', \"KhoaHoc\" = '".$session."', \"HeHoc\" = '".$course_type."'
                  where \"MSSV\" = '".$username_student."' ;";
        return pg_query( $query);
    }
  
    /* Post id_admin, id_category, title, brief, header, content, auto add time of post */
    public function post_idadmin_idcategory_title_brief_header_content_file( $admin_id, $category_id, $title, $brief, $header, $content, $file){
        $query_get_date = "select current_date as current_date;";
        $result_get_date = pg_query($query_get_date);
        $current_date = pg_fetch_array($result_get_date)['current_date'];
        $post = "insert into \"ThongBao\"( \"admin_id\", \"category_id\", \"title\", \"brief\", \"header\", \"content\", \"date_post\", \"file_attack\") values( '".$admin_id."', '".$category_id."', '".$title."', '".$brief."', '".$header."', '".$content."', '".$current_date."', '".$file."');";
        return pg_query( $post);
    }

    /* post id and title */
    public function update_post_by_post_id_title( $post_id, $title ){
        $query = "update \"ThongBao\" set \"title\" = '".$title."' where \"post_id\" = '".$post_id."' ;";
        return pg_query( $query);
    }

    /* post by post id and brief */
    public function update_post_by_post_id_brief( $post_id, $brief ){
        $query = "update \"ThongBao\" set \"brief\" = '".$brief."' where \"post_id\" = '".$post_id."' ;";
        return pg_query( $query);
    }

    /* post by post id and header */
    public function update_post_by_post_id_header( $post_id, $header ){
        $query = "update \"ThongBao\" set \"header\" = '".$header."' where \"post_id\" = '".$post_id."' ;";
        return pg_query( $query);
    }

    /* post id and content */
    public function update_post_by_post_id_content( $post_id, $content ){
        $query = "update \"ThongBao\" set \"content\" = '".$content."' where \"post_id\" = '".$post_id."' ;";
        return pg_query( $query);
    }
    
    public function delete_post_by_post_id($id){
        $query ="delete from \"ThongBao\" where \"post_id\" = '".$id."';";
        return pg_query( $query);
    }
    
    public function update_point_of_student($username, $id_class, $midle_point, $end_point, $tb_point, $diemchu, $thang4){
        $query = " update \"KetQua\"
				   set \"DiemQT\" = '".$midle_point."', \"DiemCK\" = '".$end_point."', \"DiemTB\" = '".$tb_point."', \"XepLoai\" = '".$diemchu."', \"ThangDiem4\" = '".$thang4."'
				   where \"MSSV\" = '".$username."' and \"MaLopHP\" = '".$id_class."'; ";
        return pg_query( $query);
    } 
    
    public function write_point_of_student($username, $id_class, $midle_point, $end_point, $tb_point, $diemchu, $thang4){
        $query = " insert into \"KetQua\"
				   values ( '".$username."', '".$id_class."', '".$midle_point."', '".$end_point."', '".$tb_point."', '".$diemchu."', '".$thang4."') ;";
        return pg_query( $query);
    }
  
    public function update_GPA_CPA_of_student($username, $semester, $gpa, $cpa, $tcdangky, $tctichluy, $trinhdo){
        $query = " update \"TichLuy\"
				   set \"GPA\" = '".$gpa."', \"CPA\" = '".$cpa."', \"TCdangky\" = '".$tcdangky."', \"TCtichluy\" = '".$tctichluy."', \"TrinhDo\" = '".$trinhdo."'
				   where \"MSSV\" = '".$username."' and \"HocKy\" = '".$semester."'; ";
        return pg_query( $query);
    }
  
    /* them GPA CPA */
    public function write_GPA_CPA_of_student($username, $semester, $gpa, $cpa, $tcdangky, $tctichluy, $trinhdo){
        $query = " insert into \"TichLuy\"
				   values ('".$username."', '".$semester."', '".$gpa."', '".$cpa."', '".$tcdangky."', '".$tctichluy."', '".$trinhdo."' ) ;";
        return pg_query( $query);
    }
}
?>