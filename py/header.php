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
      h4 {padding: 10px 30px 10px;}
      pre { background-color: #fbefdb; }
      p { padding: 2px; }
      section { background-color: #FFF; padding: 10px; margin: 10px 0;}
      /* article { background-color: yellow; } */
      .chapter { margin-left: 30px; padding: 10px 20px; background-color: #eaf4fc; display: none;}
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
    </script>
  </head>
  <body>
