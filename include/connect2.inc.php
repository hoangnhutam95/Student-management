<?php
$link=pg_connect('host=localhost port=5432 dbname=QLSV user=postgres password=123456 ')
or die("Cannot connect to database server! Please check your connection!".pg_last_error());
pg_set_client_encoding($link, "UTF-8");

class GetList{
    public function get_list_school(){
        $query = "select \"TenKhoa\" as school 
                  from \"KhoaVien\" ;";
        return pg_query($query);
    }

    public function get_list_semester(){
        $query = "select distinct \"HocKy\" as semester 
				  from \"LopDangKy\"
				  order by \"HocKy\" desc;";
        return pg_query($query);
    }
    public function get_list_session(){
        $query = "select distinct \"KhoaHoc\" as session 
				  from \"SinhVien\"
				  order by \"KhoaHoc\" desc ;";
        return pg_query($query);
    }
    public function get_list_class(){
        $query = "select distinct \"MaLopSV\" as class 
				  from \"LopSV\" natural join \"KhoaVien\"
                  order by \"MaLopSV\" asc ;";
        return pg_query($query);
    }
        public function get_list_class_by_username($username){
        $query = "select \"TenLopSV\" as class
				  from \"LopSV\" natural join \"SinhVien\"
                  where \"MSSV\"='".$username."';";
        return pg_query($query);
    }
    public function get_list_class_by_school_session( $school, $session){
        if ( ($school != "*") && ($session != "*") )
        {
            $query ="select \"TenLopSV\" as class 
                     from \"LopSV\" natural join \"KhoaVien\"
					 where \"TenKhoa\" = '".$school."' and \"KhoaHoc\" = '".$session."'
                     order by \"MaLopSV\" asc ; ";
        } 
        else 
        {
            if ( $school != "*")
            {
            $query ="select \"TenLopSV\" as class  
			         from \"LopSV\" natural join \"KhoaVien\" 
                     where \"TenKhoa\" = '".$school."'; ";
            }
            else 
            {
                if( $session != "*")
                {
                $query ="select  \"TenLopSV\" as class 
                         from \"LopSV\" natural join \"KhoaVien\" 
                         where \"KhoaHoc\" = '".$session."'; ";
                }
                else 
                {
                    $query ="select \"TenLopSV\" as class 
						     from \"LopSV\" ;";
                }
             }
        }
        return pg_query($query);
    }  
}

class User{
    public function get_info_user( $username ){
        $query = "select \"MSSV\" as username, \"MatKhau\" as password, \"HoTen\" as fullname 
				  from \"SinhVien\" 
				  where \"MSSV\" = '".$username."'; ";
        return pg_query($query);
    }

    public function changepassword_user ( $username, $newpassword ){
        $query = "update \"SinhVien\" 
				  set \"MatKhau\" = '".$newpassword."' 
				  where \"MSSV\" = '".$username."'; ";
        return pg_query($query);
    }

    public function get_common_info_by_username ( $username  ){
        $query = "select \"HoTen\" as fullname, \"MSSV\" as username, \"NgaySinh\" as dob, \"GioiTinh\" as sex, \"QueQuan\" as hometown, \"KhoaHoc\" as session, \"TenLopSV\" as class, \"ChTrinh\" as training_system, \"HeHoc\" as level_school, \"TenKhoa\" as school
				  from \"SinhVien\" natural join \"LopSV\" natural join \"KhoaVien\"
				  where \"MSSV\" = '".$username."'; ";
        return pg_query($query);
    }
    public function get_timetable( $username ){
        $query = "select \"NgayHoc\" as day_of_week, \"GioHoc\" as time, \"TuanHoc\" as week, \"PhongHoc\" as place, \"LopDangKy\".\"MaHP\" as id_subject , \"HocPhan\".\"TenHP\" as subject
				  from \"ThoiGianHoc\", \"SinhVien\", \"LopSVDK\", \"LopDangKy\", \"HocPhan\"
				  where \"ThoiGianHoc\".\"MaLopHP\" = \"LopSVDK\".\"MaLopHP\" and \"SinhVien\".\"MSSV\" = \"LopSVDK\".\"MSSV\" and \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"LopDangKy\".\"MaHP\"=\"HocPhan\".\"MaHP\" and \"LopSVDK\".\"TrangThai\" ='Success' and \"SinhVien\".\"MSSV\" = '".$username."'
				  order by \"HocKy\" asc ;";
        return pg_query($query);
    }

    public function get_system_training( $username ){
           $query = "select \"ChTrinh\" as training_system 
					 from \"SinhVien\" natural join \"LopSV\"
					 where \"MSSV\" = '".$username."' ;";
           return pg_query($query);
         }
 
    public function get_table_point ( $username ) {
        $query = "select \"HocKy\" as semester, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"Sotinchi\" as  credits_subject, \"MaLopHP\" as id_class, \"DiemQT\" as mid_point, \"DiemCK\" as end_point, \"XepLoai\" as  point_by_string
				  from \"KetQua\" natural join \"LopDangKy\" natural join \"HocPhan\" "."
				  where \"MSSV\" = '".$username."'
				  order by id_class asc;";
        return pg_query ( $query );
    }

    public function report_study ( $username ) {
        $query = "select \"HocKy\" as semester, \"TCdangky\" as signed_subject, \"TCtichluy\" as passed_subject, \"GPA\" as agv_point_semester, \"CPA\" as avg_point, \"TrinhDo\" as level, \"LopSV\".\"ChTrinh\" as training_system
				  from \"SinhVien\" natural join \"LopSV\", \"TichLuy\"
				  where \"SinhVien\".\"MSSV\" = \"TichLuy\".\"MSSV\" and \"TichLuy\".\"MSSV\" = '".$username."'
                  order by \"HocKy\" asc;";
        return pg_query ( $query );
      }

  // Danh sach hoc phan da dang ky
    public function get_list_singed_subject_by_semester_username ( $semester, $username ) {
        $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject,\"TenHP\" as subject, \"LopSVDK\".\"TrangThai\" as state_sign
				  from \"LopSVDK\", \"LopDangKy\", \"HocPhan\" 
				  where \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"LopDangKy\".\"MaHP\" = \"HocPhan\".\"MaHP\" and \"LopSVDK\".\"TrangThai\" LIKE 'Success' and \"LopSVDK\".\"MSSV\" ='".$username."' and \"LopDangKy\".\"HocKy\" = '".$semester."'; ";
        return pg_query ( $query );
    }

  // Danh muc hoc phan
    public function get_all_require_subject ( $username ){
        $query = "select \"ChuongTrinh\".\"MaHP\" as id_subject, \"HocPhan\".\"TenHP\" as subject, \"ChuongTrinh\".\"HocKy\" as semester, \"HocPhan\".\"Sotinchi\" as credits_subject, \"KhoaVien\".\"TenKhoa\" as school
                  from \"SinhVien\" natural join \"LopSV\", \"KhoaVien\", \"HocPhan\" natural join \"ChuongTrinh\" "."
                  where \"LopSV\".\"ChTrinh\"=\"ChuongTrinh\".\"ChTrinh\" and \"KhoaVien\".\"MaKhoa\" = \"HocPhan\".\"MaKhoa\" and \"MSSV\" = '".$username."' 
                  order by \"ChuongTrinh\".\"HocKy\" asc ;";
        return pg_query($query);
    }

    public function find_student ( $username ){
        $query = "select \"MSSV\" as username, \"HoTen\" as fullname, \"NgaySinh\" as dob,\"GioiTinh\" as sex, \"QueQuan\" as hometown, \"TenLopSV\" as class, \"LopSV\".\"KhoaHoc\" as session, \"ChTrinh\" as training_system
				  from \"SinhVien\" natural join \"LopSV\" 
				  where \"MSSV\" = '".$username."' ;";
        return pg_query( $query );
    }

    public function find_student_by_name_session_school_class( $name_find, $session_find, $school_find, $class_find){
        if ( ($name_find != "*") || ($session_find != "*") || ( $school_find != "*") || ( $class_find != "*")){
            $query =  "select  \"MSSV\" as username, \"HoTen\" as fullname, \"NgaySinh\" as dob,\"GioiTinh\" as sex, \"QueQuan\" as hometown, \"TenLopSV\" as class, \"LopSV\".\"KhoaHoc\" as session, \"ChTrinh\" as training_system
	                   from \"SinhVien\" natural join \"LopSV\" natural join \"KhoaVien\" 
					   where ";
            if ( $session_find != "*" ){
                $query = $query." \"KhoaHoc\" = '".$session_find."' and ";
                if( $name_find != "*"){
                    $query = $query."\"HoTen\" = '".$name_find."' and ";
                }
                if( $school_find != "*"){
                    $query = $query." \"TenKhoa\" = '".$school_find."' and ";
                }
                if($class_find != "*"){
                    $query = $query." \"TenLopSV\" = '".$class_find."' and ";
                }
                
                $query = $query." true;";
             } 
             else {
               $query = $query." false ;";
             }
        } 
        else {
            $query = "select \"MSSV\" as username, \"HoTen\" as fullname, \"NgaySinh\" as dob,\"GioiTinh\" as sex, \"QueQuan\" as hometown, \"TenLopSV\" as class, \"LopSV\".\"KhoaHoc\" as session, \"ChTrinh\" as training_system 
					  from \"SinhVien\" natural join \"LopSV\" natural join \"KhoaVien\" 
					  where false ;";
            }
           return pg_query($query);
       }

    public function get_sum_credits_subject_by_semester_username( $semester, $username){
        $query = "select sum(\"Sotinchi\")
				  from \"LopSVDK\", \"LopDangKy\" natural join \"HocPhan\"
				  where \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"HocKy\" = '".$semester."' and \"LopSVDK\".\"MSSV\" = '".$username."' ;";
        return pg_query($query);
    }

  // Danh sach dang ki lop
    public function get_list_register_class_by_username_semester( $username, $semester){
        $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"LopDangKy\".\"TrangThai\" as state, \"LopSVDK\".\"TrangThai\" as register_state, \"Sotinchi\" as credits_subject 
				  from \"LopSVDK\", \"LopDangKy\" natural join \"HocPhan\" 
				  where \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"MSSV\" = '".$username."' and \"HocKy\" = '".$semester."';";
        return pg_query( $query);
    }

  // Dang ki lop
    public function register_class_by_username_id_class( $username, $id_class){
        $query = "insert into \"LopSVDK\" 
				  values ('".$id_class."', '".$username."', 'Waiting');";
        return pg_query( $query);
    }
    public function unregister_class_by_username_id_class( $username, $id_class){
        $query = "delete from \"LopSVDK\"
				  where \"MSSV\" = '".$username."' and \"MaLopHP\" = '".$id_class."' ;";	
        return pg_query( $query);
    }
    public function submit_register_class_by_username( $username){
        $query = "update \"LopSVDK\"
				  set \"TrangThai\" = 'Success'
				  where \"MSSV\" = '".$username."' ;";
        return pg_query( $query);
    }
  
}

class Post{
    public function get_10_last_post(){
        $query = "select * from \"ThongBao\" order by \"post_id\"  DESC;";
        return pg_query( $query);
    }

    public function get_post_of_admin( ){
        $query = "select * from \"ThongBao\" where \"category_id\" = '0' order by \"post_id\"  DESC";
        return pg_query( $query);
    }
    
    public function get_post_register_class(){
        $query = "select * from \"ThongBao\" where \"category_id\" = '1' order by \"post_id\"  DESC";
        return pg_query( $query);
    }

    public function get_post_graduate_project(){
        $query = "select * from \"ThongBao\" where \"category_id\" = '2' order by \"post_id\"  DESC";
        return pg_query( $query);
    }

    public function get_post_graduate_consider(){
        $query = "select * from \"ThongBao\" where \"category_id\" = '3' order by \"post_id\"  DESC";
        return pg_query( $query);
    }

    public function get_post_warning_study(){
        $query = "select * from \"ThongBao\" where \"category_id\" = '4' order by \"post_id\"  DESC";
        return pg_query ( $query);
    }

    public function get_post_test(){
        $query = "select * from \"ThongBao\" where \"category_id\" = '5' order by \"post_id\"  DESC";
        return pg_query ( $query);
    }
    
    public function get_post_by_category_id_post_id( $category_id, $post_id){
        $query = "select \"category_id\", \"title\", \"header\", \"brief\", \"content\", to_char(\"date_post\", 'DD-MM-YYYY') as date_post, \"file_attack\" from \"ThongBao\" where \"category_id\" = '".$category_id."' and \"post_id\" = '".$post_id."'";
        return pg_query($query);
    }

    public function get_post_by_post_id( $post_id){
        $query = "select \"category_id\", \"title\", \"header\", \"brief\", \"content\", to_char(\"date_post\", 'DD-MM-YYYY') as date_post, \"post_id\", \"file_attack\" from \"ThongBao\" where \"post_id\" = '".$post_id."'";
        return pg_query($query);
    }
    
    public function get_name_category_by_category_id_post( $id){
        $query =" select * from \"LoaiTB\", \"ThongBao\" where \"post_id\" = '".$id."' and \"ThongBao\".\"category_id\" = \"LoaiTB\".\"category_id\" ;";
        $get_result = pg_query ( $query);
        $caterory_name = pg_fetch_array($get_result);
        return $caterory_name['category_name'];
    }
}

class Subject{
    public function get_info_subject ($input) {
        $query = "select \"MaHP\" as id_subject, \"TenHP\" as subject, \"Sotinchi\" as credits_subject, \"Trongso\" as weight_subject, \"TenKhoa\" as school 
				  from \"HocPhan\" natural join \"KhoaVien\"
				  where \"MaHP\" = '".$input."' or \"TenHP\"= '".$input."' or \"TenKhoa\" = '".$input."' ;";
        return pg_query($query);
    }
}

class Hien{
    public function get_list_class_by_id ( $id){
           $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"HocKy\" as semester, \"GhiChu\" as note, \"LopDangKy\".\"TrangThai\" as state, \"DangKymin\" as min_sign, \"DangKymax\" as max_sign, \"TenKhoa\" as school
					 from \"LopDangKy\" natural join \"HocPhan\" natural join \"KhoaVien\"
					 where \"LopDangKy\".\"MaLopHP\" = '".$id."' and \"LopDangKy\".\"TrangThai\" LIKE 'Open%'
					 group by \"LopDangKy\".\"MaLopHP\", \"HocPhan\".\"MaHP\", \"TenHP\", \"GhiChu\", \"LopDangKy\".\"TrangThai\", \"TenKhoa\" ;";
           return pg_query ($query);
         }

  public function get_list_class_by_id_subject_semester ( $id_subject, $semester){
           $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"GhiChu\" as note, \"LopDangKy\".\"TrangThai\" as state, \"DangKymin\" as min_sign, \"DangKymax\" as max_sign, \"TenKhoa\" as school
					 from \"LopDangKy\" natural join \"HocPhan\" natural join \"KhoaVien\"
					 where \"LopDangKy\".\"MaHP\" = '".$id_subject."' and \"HocKy\" = '".$semester."' and \"LopDangKy\".\"TrangThai\" LIKE 'Open%'
					 group by \"LopDangKy\".\"MaLopHP\", \"HocPhan\".\"MaHP\", \"TenHP\", \"GhiChu\", \"LopDangKy\".\"TrangThai\", \"TenKhoa\"  ;";
           return pg_query( $query);
         }

  public function get_list_class_by_school_semester ( $school, $semester){
           $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"GhiChu\" as note, \"LopDangKy\".\"TrangThai\" as state, \"DangKymin\" as min_sign, \"DangKymax\" as max_sign, \"TenKhoa\" as school
					 from \"LopDangKy\" natural join \"HocPhan\" natural join \"KhoaVien\"
					 where \"TenKhoa\" = '".$school."' and \"HocKy\" = '".$semester."'  and \"LopDangKy\".\"TrangThai\" LIKE 'Open%'
					 group by \"LopDangKy\".\"MaLopHP\", \"HocPhan\".\"MaHP\", \"TenHP\", \"GhiChu\", \"LopDangKy\".\"TrangThai\", \"TenKhoa\" ;";
           return pg_query( $query);           
         }
    public function get_time_table_class_register_by_username_semester( $username, $semester){
           $query = "select \"NgayHoc\" as day_of_week, \"GioHoc\" as clock, \"TuanHoc\" as week, \"PhongHoc\" as place, \"MaHP\" as id_subject, \"LopDangKy\".\"MaLopHP\" as id_class
					 from \"ThoiGianHoc\" natural join \"LopDangKy\" natural join \"LopSVDK\"
					 where \"LopSVDK\".\"MSSV\" ='".$username."' and \"HocKy\" = '".$semester."' 
					 order by \"NgayHoc\" asc ;";
           return pg_query($query);
    }
    
      public function get_time_class_by_id ( $id){
           //$query = "select * from \"class\" where \"id_class\" = '".$id."' ;";
           $query = "select \"NgayHoc\" as day_of_week, \"GioHoc\" as clock, \"TuanHoc\" as week, \"PhongHoc\" as place
					 from \"ThoiGianHoc\" natural join \"LopDangKy\"
					 where \"LopDangKy\".\"MaLopHP\" = '".$id."'
					 order by \"NgayHoc\" asc ;";
           return pg_query($query);
      }
      
      public function change_state_of_class_by_id_class_state( $id_class, $state ){
		   $query = "update \"LopDangKy\"
					 set \"TrangThai\" = '".$state."'
					 where \"MaLopHP\" = '".$id_class."' ;";
           return pg_query( $query);
      }

}
class Class_Obj{
  public function get_list_class_by_id ( $id){
           $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"HocKy\" as semester, \"GhiChu\" as note, \"LopDangKy\".\"TrangThai\" as state, \"DangKymin\" as min_sign, \"DangKymax\" as max_sign, count(\"LopSVDK\".\"MSSV\") as signed, \"TenKhoa\" as school
					 from \"LopDangKy\" natural join \"HocPhan\" natural join \"KhoaVien\" inner join \"LopSVDK\" 
					 on \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"LopSVDK\".\"TrangThai\" LIKE 'Success%' and  \"LopDangKy\".\"MaLopHP\" = '".$id."'
					 group by \"LopSVDK\".\"MaLopHP\", \"LopDangKy\".\"MaLopHP\", \"HocPhan\".\"MaHP\", \"TenHP\", \"GhiChu\", \"LopDangKy\".\"TrangThai\", \"TenKhoa\" ;";
           return pg_query ($query);
         }

  public function get_list_class_by_id_fake( $id){
           $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"HocKy\" as semester, \"GhiChu\" as note, \"LopDangKy\".\"TrangThai\" as state, \"DangKymin\" as min_sign, \"DangKymax\" as max_sign, count(\"LopSVDK\".\"MSSV\") as signed, \"TenKhoa\" as school
					 from \"LopDangKy\" natural join \"HocPhan\" natural join \"KhoaVien\" inner join \"LopSVDK\" 
					 on \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"LopSVDK\".\"TrangThai\" LIKE 'Success%' and  \"LopDangKy\".\"MaLopHP\" = '".$id."'
					 group by \"LopSVDK\".\"MaLopHP\", \"LopDangKy\".\"MaLopHP\", \"HocPhan\".\"MaHP\", \"TenHP\", \"GhiChu\", \"LopDangKy\".\"TrangThai\", \"TenKhoa\" ;";
           return pg_query( $query);
         }

  public function get_list_class_by_id_subject_semester ( $id_subject, $semester){
           $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"GhiChu\" as note, \"LopDangKy\".\"TrangThai\" as state, \"DangKymin\" as min_sign, \"DangKymax\" as max_sign, count(\"LopSVDK\".\"MSSV\") as signed, \"TenKhoa\" as school
					 from \"LopDangKy\" natural join \"HocPhan\" natural join \"KhoaVien\" inner join \"LopSVDK\" 
					 on \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"LopSVDK\".\"TrangThai\" LIKE 'Success%' and \"LopDangKy\".\"MaHP\" = '".$id_subject."' and \"HocKy\" = '".$semester."'
					 group by \"LopSVDK\".\"MaLopHP\", \"LopDangKy\".\"MaLopHP\", \"HocPhan\".\"MaHP\", \"TenHP\", \"GhiChu\", \"LopDangKy\".\"TrangThai\", \"TenKhoa\"  ;";
           return pg_query( $query);
         }

  public function get_list_class_by_school_semester ( $school, $semester){
           $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"GhiChu\" as note, \"LopDangKy\".\"TrangThai\" as state, \"DangKymin\" as min_sign, \"DangKymax\" as max_sign, count(\"LopSVDK\".\"MSSV\") as signed, \"TenKhoa\" as school
					 from \"LopDangKy\" natural join \"HocPhan\" natural join \"KhoaVien\" inner join \"LopSVDK\" 
					 on \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"LopSVDK\".\"TrangThai\" LIKE 'Success%' and \"TenKhoa\" = '".$school."' and \"HocKy\" = '".$semester."' 
					 group by \"LopSVDK\".\"MaLopHP\", \"LopDangKy\".\"MaLopHP\", \"HocPhan\".\"MaHP\", \"TenHP\", \"GhiChu\", \"LopDangKy\".\"TrangThai\", \"TenKhoa\" ;";
           return pg_query( $query);           
         }
    public function list_class_by_school_semester ( $school, $semester){
           $query = "select \"LopDangKy\".\"MaLopHP\" as id_class, \"HocPhan\".\"MaHP\" as id_subject, \"TenHP\" as subject, \"GhiChu\" as note, \"LopDangKy\".\"TrangThai\" as state, \"DangKymin\" as min_sign, \"DangKymax\" as max_sign, count(\"LopSVDK\".\"MSSV\") as signed, \"TenKhoa\" as school
					 from \"LopDangKy\" natural join \"HocPhan\" natural join \"KhoaVien\" inner join \"LopSVDK\" 
					 on \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"TenKhoa\" = '".$school."' and \"HocKy\" = '".$semester."' 
					 group by \"LopSVDK\".\"MaLopHP\", \"LopDangKy\".\"MaLopHP\", \"HocPhan\".\"MaHP\", \"TenHP\", \"GhiChu\", \"LopDangKy\".\"TrangThai\", \"TenKhoa\" ;";
           return pg_query( $query);           
         }

  public function get_time_class_by_id ( $id){
           //$query = "select * from \"class\" where \"id_class\" = '".$id."' ;";
           $query = "select \"NgayHoc\" as day_of_week, \"GioHoc\" as clock, \"TuanHoc\" as week, \"PhongHoc\" as place
					 from \"ThoiGianHoc\" natural join \"LopDangKy\"
					 where \"LopDangKy\".\"MaLopHP\" = '".$id."'
					 order by \"NgayHoc\" asc ;";
           return pg_query($query);
         }

  public function get_time_table_class_register_by_username_semester( $username, $semester){
           $query = "select \"NgayHoc\" as day_of_week, \"GioHoc\" as clock, \"TuanHoc\" as week, \"PhongHoc\" as place, \"MaHP\" as id_subject, \"LopDangKy\".\"MaLopHP\" as id_class
					 from \"ThoiGianHoc\" natural join \"LopDangKy\" natural join \"LopSVDK\"
					 where \"LopSVDK\".\"MaLopHP\" = \"LopDangKy\".\"MaLopHP\" and \"LopSVDK\".\"TrangThai\" LIKE 'Success' and \"LopSVDK\".\"MSSV\" ='".$username."' and \"HocKy\" = '".$semester."' 
					 order by \"NgayHoc\" asc ;";
           return pg_query($query);
         }

  public function get_list_student_by_id_class($id){
           $query = "select \"MSSV\" as username
					 from \"LopSVDK\"
					 where \"MaLopHP\" = '".$id."' ; ";
           return pg_query( $query);
         }

  public function get_point_by_username_id_class( $user, $id_class){
           $query = "select \"DiemQT\" as midle_point, \"DiemCK\" as end_point 
					 from \"KetQua\" 
					 where \"MSSV\" = '".$user."' and \"MaLopHP\" = '".$id_class."' ;";
           return pg_query( $query);
         }

  public function change_state_of_class_by_id_class_state( $id_class, $state ){
		   $query = "update \"LopDangKy\"
					 set \"TrangThai\" = '".$state."'
					 where \"MaLopHP\" = '".$id_class."' ;";
           return pg_query( $query);
  }

  public function print_if_username_study_on_class_by_username_idclass( $username, $idclass){
	$query = "select *
			  from \"LopSVDK\"
			  where \"MSSV\" = '".$username."' and \"MaLopHP\"='".$idclass."' and \"TrangThai\" LIKE 'Success%' ; ";
	return pg_query( $query);
  }

  public function get_semester_by_id_class( $idclass ){
	$query = "";
	return pg_query( $query);
  }
}

class Point{
    public function get_trongso_by_id_subject($id_subject){
           $query = "select \"Trongso\"
			  from \"HocPhan\"
			  where \"MaHP\" = '".$id_subject."'; ";
           return pg_query($query);
         }

    public function view_cpa_point_by_username_semester( $username, $semester){
           $query = " select sum(\"ThangDiem4\" * \"Sotinchi\")/sum(\"Sotinchi\") as cpa
				   from \"ViewDiemTB\", \"KetQua\" natural join \"LopDangKy\" natural join \"HocPhan\"
				   where \"ViewDiemTB\".\"MaHP\"=\"LopDangKy\".\"MaHP\" and \"KetQua\".\"MSSV\" = '".$username."' and \"HocKy\" <= '".$semester."';";
           return pg_query( $query);
         }

    public function view_gpa_point_by_username_semester( $username, $semester){
           $query = " select sum(\"ThangDiem4\" * \"Sotinchi\")/sum(\"Sotinchi\") as gpa
				   from \"KetQua\" natural join \"LopDangKy\" natural join \"HocPhan\"
				   where \"MSSV\"='".$username."' and \"HocKy\"='".$semester."';";
           return pg_query( $query);
         }

    public function view_tc_dangky_by_username_semester( $username, $semester){
           $query = " select sum(\"Sotinchi\") as tcdangky
				   from ( select distinct \"HocPhan\".\"MaHP\", \"Sotinchi\"
						  from \"LopSVDK\" ,\"LopDangKy\" natural join \"HocPhan\"
						  where \"LopSVDK\".\"MaLopHP\"=\"LopDangKy\".\"MaLopHP\" and \"LopSVDK\".\"TrangThai\" LIKE 'Success' and \"MSSV\" = '".$username."' and \"HocKy\" <= '".$semester."') as TCdangky ; ";
           return pg_query( $query);
         }

    public function view_tc_tichluy_by_username_semester( $username, $semester){
           $query = " select sum(\"Sotinchi\") as tctichluy
				   from (select distinct \"HocPhan\".\"MaHP\", \"Sotinchi\"
						 from \"LopSVDK\" ,\"KetQua\" natural join \"LopDangKy\" natural join \"HocPhan\"
						 where \"LopSVDK\".\"MaLopHP\"=\"LopDangKy\".\"MaLopHP\" and \"LopSVDK\".\"TrangThai\" LIKE 'Success' and \"KetQua\".\"ThangDiem4\" > '0' and \"KetQua\".\"MSSV\" = '".$username."' and \"HocKy\" <= '".$semester."') as TCtichluy ;";
           return pg_query( $query);
         }

    public function display_if_have_info_about_point( $username, $id_class){
           $query = " select *
				   from \"KetQua\"
				   where \"MSSV\" = '".$username."' and \"MaLopHP\" = '".$id_class."' ;";
           return pg_query( $query);
         }

    public function display_if_have_info_about_CPA_GPA( $username, $semester){
           $query = " select *
				   from \"TichLuy\"
				   where \"MSSV\" = '".$username."' and \"HocKy\" = '".$semester."' ;";
           return pg_query( $query);
         }
}

class Other{
    public function get_fullname_by_username( $username){
        $query = "select \"HoTen\" as fullname 
				  from \"SinhVien\" 
				  where \"MSSV\" = '".$username."' ;";
        $result = pg_query($query);
        $r = pg_num_rows($result);
        if ( $r != 0) {
            $row= pg_fetch_array($result);
            pg_free_result($result);
            return $row['fullname'];
        } 
        else {
            pg_free_result($result);
            return null;
        } 
    }

    public function full_semester(){
           $query = "select distinct \"HocKy\" as semester 
					 from \"LopDangKy\"
					 order by \"HocKy\" desc;";
           $list_semester = pg_query($query);
           $semester = pg_fetch_array($list_semester);
           return $semester['semester'];
    }
}

?>
