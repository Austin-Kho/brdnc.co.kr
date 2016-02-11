<!DOCTYPE HTML>
<html>
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
      <title>[주]바램디앤씨 _ 관리시스템 </title>
      <link rel="shortcut icon" href="http://brdnc.cafe24.com/cms/images/cms.ico">
      <link type="text/css" rel="stylesheet" href="http://brdnc.cafe24.com/cms/common/cms.css">
      <script src="../common/global.js"></script>
      <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
      <script src="../include/calendar/calendar.js"></script>





      <script src="../common/_menu1.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
        $("#loading").css("display","none");
        });
      </script>

      <script type="text/javascript">
      <!--
        function term_put(a,b,term){
          if(term=='d')var term="2016-02-11";
          if(term=='w')var term="2016-02-04";
          if(term=='m')var term="2016-01-11";
          if(term=='3m')var term="2015-11-11";
          document.getElementById(a).value = term;
          document.getElementById(b).value = "2016-02-11";
        }
      //-->
      </script>
  </head>
  <body onclick="cal_del();">
    <div id="loading" style="padding-top:530px;"><img src="../images/loading.gif"><br>loading...</div>
    <div id="wrap">
      <header><!-- <div id="header"> -->
        <div style="height:95px;">
          <div style="float:left; width:180px; height:70px; padding:25px 0 0 10px;"><!-- 첫째 줄 -->
          <a href="http://brdnc.cafe24.com/cms/cms.php"><img src="http://brdnc.cafe24.com/cms/images/cms_main_logo_.png" alt="" onmouseover="this.src='http://brdnc.cafe24.com/cms/images/cms_main_logo.png' " onmouseout="this.src='http://brdnc.cafe24.com/cms/images/cms_main_logo_.png' "></a>
          </div><!-- 로고부분 -->
          <div style="float:left; width:890px; text-align:right;"><!-- 둘째 줄 -->
            <div style="font-size:11px; height:15px; padding-top:5px;">
              <a href="http://brdnc.cafe24.com/cms/member/login_form.php" style="font-size:11px;">로그인</a>
              &nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>공지사항</b></a> &nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>My Page</b></a> &nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>매뉴얼</b></a>
            </div>
            <nav style="text-align:right; height:30px; padding:45px 170px 0 0px;">
              <a href="http://brdnc.cafe24.com/cms/_menu1/work_main.php"><img src="http://brdnc.cafe24.com/cms/images/t_menu_1_.png" id="tm_img0" onmouseover="img_over(0)" onmouseout="img_out(1)" alt=""></a><a href="http://brdnc.cafe24.com/cms/_menu2/local_main.php"><img src="http://brdnc.cafe24.com/cms/images/t_menu_2.png" id="tm_img1" onmouseover="img_over(1)" onmouseout="img_out(1)" alt=""></a><a href="http://brdnc.cafe24.com/cms/_menu3/capital_main.php"><img src="http://brdnc.cafe24.com/cms/images/t_menu_3.png" id="tm_img2" onmouseover="img_over(2)" onmouseout="img_out(1)" alt=""></a><a href="http://brdnc.cafe24.com/cms/_menu4/project_main.php"><img src="http://brdnc.cafe24.com/cms/images/t_menu_4.png" id="tm_img3" onmouseover="img_over(3)" onmouseout="img_out(1)" alt=""></a><a href="http://brdnc.cafe24.com/cms/_menu5/config_main.php"><img src="http://brdnc.cafe24.com/cms/images/t_menu_5.png" id="tm_img4" onmouseover="img_over(4)" onmouseout="img_out(1)" alt=""></a>
            </nav>
          </div>
        </div>
      </header><!-- </div> -->


      <article id="content">
        <div style="width:1080px; height:650px; text-align:center; display: table-cell; vertical-align: middle;">
          <p>로그인 정보가 없습니다. 다시 로그인하여 주십시요!</p>
          <input type="button" value="로그인" class="sub_bt1" onclick="location.href='http://brdnc.cafe24.com/cms/member/login_form.php';">
          <input type="button" value=" 닫 기 " class="sub_bt1" onclick="window.self.close()">
        </div>
      </article>
      <footer id="footwrap">
        <div id="footer">
          <b>[주] 바램디앤씨</b> | 인천광역시 연수구 인천타워대로323 B-1506(송도동, 송도센트로드오피스) | 전화 : 032-858-9556 | 문의하기 : <a href='mailto:cigiko@naver.com' class='under'>cigiko@naver.com</a><br>
          Copyright 2015~2016 by BARAEM D&C Co.,LTD All rights reserved.
        </div>
      </footer>
    </div>
  </body>
</html>