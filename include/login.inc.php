<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>quanlysinhvien</title>
<link rel="stylesheet" type="text/css" href="css/menu11.css"/>
<link rel="stylesheet" type="text/css" href="css/dinhdang.css"/>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/login.css"/>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
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
<!--================TOP_START======================-->
<div class="top">
   <!--=========logo cua truong======-->
    <div class="logo" style="width: 870px;">
      <a href="#" style="width: 100px;"><img src="hinh anh/logobk.jpg" width="70" height="100" alt= "logo" /></a>
      <div style="width: 750px;">
          <h1>Student Information System</h1>
          <h2>Hanoi University Of Science And Technology</h2>
      </div>
    </div>
    <!--========logo cua truong======-->
     <!--========DANG NHAP============-->
    <div class="thoat_dang_nhap" style="width: 300px; height: 80px; padding-bottom: 10px;">
     <div class="hello"><a href="#" style="text-decoration:inherit;color:white;">Xin chào bạn </a>
     <?php
    
     $name=$_SESSION['name'];
     echo "<div style=\"font-size:1.0em; font-weight: bold; color:yellow; float:right;padding-right: 90px; text-decoration:blink;\">$name</div>";
     ?>
</div>
      <div class="thoat_dn" style="font-size: 13pt; padding-top: 20px;"><a href="logout.php" style="text-decoration:inherit;color:white;">Thoát đăng nhập</a>
      </div>
    </div>
    <!--========DANG NHAP============-->
</div>
<!--================TOP_END======================-->

<!--============MENU_START=================-->
<div class="content">
 <!--========MENU============-->
<div id="menu_tab">
  <div class="top_menu_tab"></div>
  <div class="left_menu_tab"></div>
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <div class="top_menu_tab"></div>  
    <li><a href="index.php"  style="width:5em;align=center">Trang chủ</a></li>
      <li><a class="MenuBarItemSubmenu" href="#" style="width:10em">Thông tin sinh viên</a>
      <ul class="">
        <li><a href="info.php">Thông tin cá nhân</a></li>
        <li><a href="changepass.php">Đổi mật khẩu</a></li>
      </ul>
    </li>
    <li><a class="MenuBarItemSubmenu" href="#" style="width:9em">Kế hoạch học tập</a>
      <ul>
        <li><a href="thoikhoabieu.php">Thời khóa biểu</a></li>
        <li><a href="#">Lịch thi</a></li>
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
        <li><a href="bangdiemcanhan.php">Bảng điểm cá nhân</a></li>
        <li><a href="bangdiemhocphan.php">Bảng điểm học phần</a></li>
        
      </ul>
    </li>
    <li><a href="#" class="MenuBarItemSubmenu" style="width:9em">Đăng kí học tập</a>
      <ul style="width:12em" >
        <li style="width:230px" ><a href="listclass.php">Danh sách đăng kí lớp học</a></li>
         <li style="width:230px"><a href="dangkyhocphan.php">Đăng kí mã học phần</a></li>
          <li style="width:230px"><a href="huyhocphan1.php">Hủy học phần đăng kí</a></li>
        <li style="width:230px"><a href="dangkilop1.php">Đăng kí lớp học</a></li>
         <li style="width:230px"><a href="huylop1.php">Hủy lớp đăng kí</a></li>
       
        
        
      </ul>
    </li>
    <li><a href="#" class="MenuBarItemSubmenu" style="width:5em">Tra cứu</a>
      <ul>
        <li><a href="tracuulop.php">Danh sách lớp SV</a></li>
        <li><a href="tracuuhoctap.php">SV đăng kí học tập</a></li>
      </ul>
    </li>
     <li><a href="#" class="MenuBarItemSubmenu" style="width:5em">Hướng dẫn</a>
      <ul>
        <li><a href="huongdandkhp.php">Hướng dẫn ĐK mã HP</a></li>
        <li><a href="huongdandklh.php">Hướng dẫn ĐK lớp học</a></li>
      </ul>
    </li>
  </ul>
   <div class="righ_menu_tab"></div>
   <div class="duoi_menu_tab"></div>
</div>
</div>

 <!--============MENU-END=====================-->
