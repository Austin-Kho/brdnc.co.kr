<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>파이썬으로 지루한 작업 자동화 하기</title>
    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <style media="screen">
      h1 {padding: 10px 10px 50px; }
      h2 {padding: 10px 10px 10px; }
      h4 {padding: 10px 20px 10px; cursor: pointer; }
      section > article > h4 { padding: 0;}
      pre { background-color: #f0f5fa; }
      pre > strong { color: #980202; }
      p { padding: 2px; }
      section { background-color: #FFF; padding: 10px; margin: 10px 0;}
      /* article { background-color: yellow; } */
      ::selection { background-color: #63c336; color: #FFF; }
    	::-moz-selection { background-color: #63c336; color: #FFF; }
      .chapter { margin-left: 30px; padding: 10px 20px; background-color: #eaf4fc; display: none;}
      a#MOVE_TOP_BTN {
        position: fixed;
        right: 3%;
        bottom: 38px;
        display: none;
        z-index: 999;
      }
    </style>
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!-- jquery Framework -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".heading").click(function() {
          if($(this).next(".chapter").is(":visible")){
            $(this).next(".chapter").slideUp(350);
          } else {
            $(".chapter").slideUp(300);
            $(this).next(".chapter").slideDown(350);
          }
        });
      });

      $(function() {
        $(window).scroll(function() {
          if ($(this).scrollTop() > 500) {
            $('#MOVE_TOP_BTN').fadeIn();
          } else {
            $('#MOVE_TOP_BTN').fadeOut();
          }
        });

        $("#MOVE_TOP_BTN").click(function() {
          $('html, body').animate({
            scrollTop : 0
          }, 400);
          return false;
        });
      });
    </script>
  </head>
  <body>
