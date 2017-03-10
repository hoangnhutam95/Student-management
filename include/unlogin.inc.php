<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>trang chủ</title>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/menu11.css"/>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/hoanthien_nd1.css"/>
<link rel="stylesheet" type="text/css" href="css/login.css"/>
<link rel="stylesheet" type="text/css" href="css/dinhdang.css"/>
<!--=========hinh anh cua truong======-->
<link rel="stylesheet" type="text/css" href="nivo-slider/themes/bar/bar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="nivo-slider/themes/light/light.css" media="screen" />
<link rel="stylesheet" type="text/css" href="nivo-slider/themes/dark/dark.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="nivo-slider/nivo-slider.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="nivo-slider/themes/default/default.css" media="screen"/>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<script type="text/javascript" src="nivo-slider/demo/scripts/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="nivo-slider/jquery.nivo.slider.pack.js"></script>
</head>

<body>
<!--===========<=====TOP_START======================-->
<div class="top">
   <!--=========logo cua truong======-->
    <div class="logo">
      <a href="#"><img src="hinh anh/logobk.jpg" width="70" height="100" alt= "logo" /></a>
      <div>
          <h1>Student Information System</h1>
          <h2>Hanoi University Of Science And Technology</h2>
      </div>
    </div>
    <!--========logo cua truong======-->
     <!--========DANG NHAP============-->
    <div class="dang_nhap">
      <form id="form1" name="form1" method="post" action="login.php">
       <div class="Dn_tex1"><a href="#" style="text-decoration:inherit; color:white;">Mã đăng nhập</a></div>
       <input type="text" class="ma_dn" name="mssv" >
       <div class="Dn_tex2"><a href="#" style="text-decoration:inherit;color:white;">Mật khẩu</a></div>
       <input type="password" class="mat_khau" name="pass" >
       <input type="submit" class="dnhap" style="width:80px;" value="Đăng nhập" name="Đăng nhập" >
      </form>
    </div>
    <!--========DANG NHAP============-->
</div>
<!--================TOP_END======================-->

<!--============CONTENT_START=================-->
<div class="content">
  <!--========MENU============-->
<div id="menu_tab">
  <div class="top_menu_tab"></div>
  <div class="left_menu_tab"></div>
  <ul id="MenuBar1" class="MenuBarHorizontal" style="background:#">
    <div class="top_menu_tab"></div>  
    <li><a href="index.php" align="center" style="width:5em">Trang chủ</a></li>
    <li><a class="MenuBarItemSubmenu" href="#" style="width:8em">Kế hoạch học tập</a>
      <ul>
        <li><a href="error.php">Thời khóa biểu</a></li>
        <li><a href="#">Lịch thi</a></li>
      </ul>
    </li>
    <li><a class="MenuBarItemSubmenu" href="#" style="width:5em">Giới thiệu</a>
      <ul>
        <li><a href="gioithieuchung.php">Giới thiệu chung</a></li>
        <li><a href="lich_su.php">Lịch sử</a></li>
        <li><a href="tochuc.php">Sơ đồ tổ chức</a></li>
      </ul>
    </li>
    <li><a class="MenuBarItemSubmenu" href="#" style="width:5em">Đào tạo</a>
      <ul>
        <li><a href="hocphan.php">Danh mục học phần</a></li>
        <li><a href="nganhdaotao.php">Ngành đào tạo</a></li>
        <li><a href="khoavien.php">Khoa viện</a></li>
        <li><a href="hedaotao.php">Hệ đào tạo</a></li>
      </ul>
    </li>
    <li><a class="MenuBarItemSubmenu" href="#" style="width:8em">Kết quả học tập</a>
      <ul>
        <li><a href="error.php">Bảng điểm cá nhân</a></li>
        <li><a href="error.php">Bảng điểm học phần</a></li>
        
      </ul>
    </li>
    <li><a href="#" class="MenuBarItemSubmenu" style="width:9em">Đăng kí học tập</a>
      <ul>
         <li style="width:230px" ><a href="listclass.php">Danh sách đăng kí lớp học</a></li>
         <li style="width:230px"><a href="error.php">Đăng kí mã học phần</a></li>
          <li style="width:230px"><a href="error.php">Hủy học phần đăng kí</a></li>
        <li style="width:230px"><a href="error.php">Đăng kí lớp học</a></li>
         <li style="width:230px"><a href="error.php">Hủy lớp đăng kí</a></li>
      </ul>
    </li>
     <li><a href="#" class="MenuBarItemSubmenu" style="width:5em">Hướng dẫn</a>
      <ul>
        <li><a href="huongdandkhp.php">Hướng dẫn ĐK mã HP</a></li>
        <li><a href="huongdandklh.php">Hướng dẫn ĐK lớp học</a></li>
      </ul>
    </li>
   <div class="righ_menu_tab"></div>
   <div class="duoi_menu_tab"></div>
</div>
</div>

 <!--============CONTENT-END=====================-->
 </body>
 