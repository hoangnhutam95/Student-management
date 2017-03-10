<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>OpenSIS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_custom.css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>

<body>
<div class="container-fluid">
    <div class="jumbotron">
        <h1>OpenSIS</h1>
        <h3>Preparing Students For Success In A Changing World</h3>
    </div>
    <div style="background:#d1e0ea;font-size: 50px; color: #F52222; font-family: myfonta;font-weight: bolder;; width: 955px; margin-left: 240px;margin-bottom:30px; " >
        <marquee align="center" direction="left" height="100" scrollamount="15" width="100%" style="margin-bottom: 0px;font-weight: bold;font-size:70px;">
        Welcome to OpenSIS!
        </marquee>
    </div>
    <?php $page = 'trang chu';
    // lien ket voi navbar
	  include_once('../admin/admin_navbar.html');
	  ?>
    <div class="container"> <div class="container">
	   <div id="content">
            <link href="../css/tabulous.css" rel="stylesheet" type="text/css">
            <link href="../css/dashboard.css" rel="stylesheet" type="text/css">
            <link href="../css/style.css" rel="stylesheet" type="text/css">
            <link href="../css/portal_dashboard.css" rel="stylesheet" type="text/css">
            <script type="text/javascript" src="../js/tabulous.js"></script>
            <script type="text/javascript" src="../js/dash_tab.js"></script>
            <div class="white_space">    
	           <div class="dash_box1 for_admin_box1">
    	           <div class="dash_subhed news"><b>&nbsp;&nbsp;&nbsp;&nbsp;Tin tức</b></div>
    	           <div class="mousescroll Default news_boxnew ps-container" style="margin-top:10px; height:216px;">
                        <ul>
                            <br/>
                            <p class="mail_dashnew_error">Không có tin mới</p>	
                        </ul>
                        <div class="ps-scrollbar-x-rail" style="width: 488px; display: none; left: 0px;">
                            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 216px; display: none; right: 3px;">
                            <div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div>
                        </div>
                  </div>
                   <div class="dash_bottom">
                	  <ul style="float:right !important;">
                        <li><div class="dash_eye"></div><a href="../user/user_trangchu.php">Xem tin</a></li>
                        <li><div class="dash_create"></div><a href="admin_post_write.php">Tạo tin</a></li>
                      </ul>
                   </div>
              </div>
    
            <div class="dash_box2 for_admin_box2">
    	       <div class="dash_subhed events"><b>&nbsp;&nbsp;&nbsp;&nbsp;Sự kiện</b></div>
                    <div class="events_box">
                    <div id="tabs4" class="tabs4 ">
                		<ul id="tm23">
                			<li><a href="#tabs-1" title="" class="tabulous_active">Hôm nay</a></li>
                			<li><a href="#tabs-2" title="">Tuần này</a></li>
                			<li><a href="#tabs-3" title="">Tuần sau</a></li>
                            <li><a href="#tabs-4" title="">Tháng sau</a></li><span class="tabulousclear"></span>
                		</ul>

                		<div id="tabs_container" class="mousescroll Default ps-container" style="height: 122px;">
                    		<div id="tabs-1" style="position: absolute; top: 10px; right: 10px; left: 10px; height: 122px;">
                                <p class="mail_dashnew_error">Không có sự kiện nào trong ngày</p>			   
                    		</div>
                    
                    		<div id="tabs-2" class="hideflip" style="position: absolute; top: 10px; right: 10px; left: 10px; height: 122px;">
                                <p class="mail_dashnew_error">Không có sự kiện nào trong tuần</p>	
                    		</div>
                    		<div id="tabs-3" class="hideflip" style="position: absolute; top: 10px; right: 10px; left: 10px; height: 122px;">
                    			 <p class="mail_dashnew_error">Không có sự kiện nào tuần sau</p>
                            </div>
                            <div id="tabs-4" class="hideflip" style="position: absolute; top: 10px; right: 10px; left: 10px; height: 122px;">
                			    <p class="mail_dashnew_error">Không có sự kiện nào tháng sau</p>
                            </div>
                    		<div class="ps-scrollbar-x-rail" style="width: 418px; display: inherit; left: 0px;">
                                <div class="ps-scrollbar-x" style="left: 0px; width: 390px;">
                                </div>
                            </div>
                            <div class="ps-scrollbar-y-rail" style="top: 0px; height: 122px; display: inherit; right: 3px;">
                                <div class="ps-scrollbar-y" style="top: 0px; height: 97px;">
                                </div>
                            </div>
                        </div>
	                  </div>
                   </div>
                    <div class="dash_bottom">
            	       <ul style="float:right !important;">
                            <li><div class="dash_eye"></div><a href="/index.php?r=mailbox/news">Xem sự kiện</a></li>
                            <li><div class="dash_create"></div><a href="/index.php?r=news/create">Tạo sự kiện</a></li>
                       </ul>
                    </div>
            </div>
        </div>
    </div><!-- content -->
</div>
</div>
</div>
</body>
  
</html>
