select "LopHP"."MaLopHP" as id_class, "HocPhan"."MaHP" as id_subject, "TenHP" as name_subject, "GhiChu" as note, "LopHP"."TrangThai" as status, "DangKymin" as min_sign, "DangKymax" as max_sign, count("LopHPDK"."MSSV") as signed, "TenKhoa" as course
from "LopHP" natural join "HocPhan" natural join "KhoaVien", "LopHPDK" 
where "LopHPDK"."MaLopHP" = "LopHP"."MaLopHP" and "LopHPDK"."TrangThai" = 'Thành Công' and  "LopHP"."MaLopHP" = '".$id."'
group by "LopHPDK"."MaLopHP", "LopHP"."MaLopHP", "HocPhan"."MaHP", "TenHP", "GhiChu", "LopHP"."TrangThai", "TenKhoa" ;