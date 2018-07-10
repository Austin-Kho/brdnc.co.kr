<!DOCTYPE HTML>
<html lang="ko">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="shortcut icon" type="image/x-icon" href="/static/img/favicon.ico"> -->
  <title>개발자를 위한 파이썬</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  -->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script>hljs.initHighlightingOnLoad();</script>
  <!-- 수식입력 mathjax -->
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]},
      displayAlign: "left"
    });
  </script>
  <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
  <!-- 수식입력 mathjax -->
  <script>localStorage.sp = 0;</script>
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-2686629-3']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
  <!-- <div class="container"> -->

    <div class="content row" style="margin-top:0;">

      <div class="col-sm-3" style="background-color:red;">
        <div class="row">
          <div class="col-sm-3 sidebar">  <!-- style="display:none;" -->
            <div class="toc" > <!--data-spy="affix_"-->
              <div class="row" style="border-bottom:solid 1px #ccc;">
                <div class="col-xs-10">
                  <input type="text" id="kw" name="kw" class="col-xs-10 input-search" placeholder="검색어를 입력하세요." value="">
                </div>
                <div class="col-xs-2">
                  <a class="pull-right menu_link menu-toggle col-xs-2" style="cursor:pointer;margin:15px 10px;"><span class="glyphicon glyphicon-menu-hamburger" title="메뉴"></span></a>
                </div>
              </div>


              <div class="list-group list-group-toc">
                <a class="list-group-item active" href="/book/20">
                  <span style="white-space:nowrap;overflow:hidden;display:block;" title="위키독스">위키독스</span>
                </a>
                <a href="javascript:page(151)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;" title="01 위키독스의 특징">
                    <span style="padding-left:0px">01 위키독스의 특징</span>
                  </span>
                </a>

                <a href="javascript:page(689)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;" title="02 위키독스 FAQ">
                    <span style="padding-left:0px">02 위키독스 FAQ</span>
                  </span>
                </a>

                <a href="javascript:page(156)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="03 위키독스 편집기">
                <span style="padding-left:0px">

                03 위키독스 편집기
                </span>
                </span>
                </a>

                <a href="javascript:page(1678)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="03-1 마크다운">
                <span style="padding-left:20px">

                03-1 마크다운
                </span>
                </span>
                </a>

                <a href="javascript:page(1679)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="03-2 수식입력">
                <span style="padding-left:20px">

                03-2 수식입력
                </span>
                </span>
                </a>

                <a href="javascript:page(8933)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="03-3 검색">
                <span style="padding-left:20px">

                03-3 검색
                </span>
                </span>
                </a>

                <a href="javascript:page(9346)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="04 위키독스 광고">
                <span style="padding-left:0px">

                04 위키독스 광고
                </span>
                </span>
                </a>

                <a href="javascript:page(154)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="05 주요이력">
                <span style="padding-left:0px">

                05 주요이력
                </span>
                </span>
                </a>

                <a href="javascript:page(184)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="06 저자님을 모십니다">
                <span style="padding-left:0px">

                06 저자님을 모십니다
                </span>
                </span>
                </a>

                <a href="javascript:page(153)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="07 아무거나 질문">
                <span style="padding-left:0px">

                07 아무거나 질문
                </span>
                </span>
                </a>

                <a href="javascript:page(8920)" class="list-group-item ">
                <span style="white-space:nowrap;overflow:hidden;display:block;"
                title="08 위키독스 기술스택">
                <span style="padding-left:0px">

                08 위키독스 기술스택
                </span>
                </span>
                </a>

              </div>


              <div style="border-top:solid 1px #ccc;padding:15px 15px 30px 15px;font-family:consolas;">
              <span><a href="/" style="color:#333;">Published with WikiDocs</a></span>
              </div>
            </div>

            <input type="hidden" name="request_mobile" id="request_mobile" value="0" />

            <form id="search_form" action="/book/search/20" method="post">
              <input type="hidden" name="keyword" id="keyword">
            </form>

          </div>
        </div>

        <script>
          function myTrim(x) {
            return x.replace(/^\s+|\s+$/gm,'');
          }

          function search_json() {
            var kw = myTrim($("#kw").val());
            if(!kw) {
              return;
            }

            $.post("/book/search.json", {
              "keyword": kw
            }, function (json) {
              if (json.success) {
                location.href = "/book/search/result/20";
              }
            }, "json");
          }

          $(document).ready(function () {
            $(".book-search").on("click", function() {
              $("#search_form").submit();
            });

            $("#mobile_search_btn").on("click", function() {
              search_json();
            });

            $('#kw').keyup(function(e) {
              if (e.keyCode == 13) {
                search_json();
              }
            });

            $(".home").on("click", function() {
              location.href = "/";
            });

            if (typeof(Storage) !== "undefined") {
              if(localStorage.sidebar == "hidden") {
                menuToggle(true);
              }else {
                $(".sidebar").show();
                $(".toc-header").show();
              }
            }else{
              $(".sidebar").show();
              $(".toc-header").show();
            }

            $(".toc").css("display", "block");
            if (typeof(Storage) !== "undefined") {
              $(".sidebar").scrollTop(localStorage.sp);
            }

            $(".sidebar").css("overflow-y", "auto");

            $(".toc_item").on("click", function() {
              var page_id = $(this).attr("page_id");
              // $(".selected_toc").removeClass("selected_toc");
              // $(this).addClass("selected_toc");
              page(page_id);
            });

            $(".menu-toggle").on("click", function() {
              menuToggle();

              if (typeof(Storage) !== "undefined") {
                if($(".sidebar").is(":hidden")) {
                  localStorage.sidebar = "hidden";
                }else {
                  localStorage.sidebar = "show";
                }
              }
            });
            $("#load_content").show();
          });

          function menuToggle(no_sidebar) {
            if(!no_sidebar) {
              $(".sidebar").toggle();
              $(".toc-header").toggle();
            }
            $("#load_content").toggleClass("col-sm-offset-3");
            $("#load_content").toggleClass("col-sm-9");
            $("#load_content").toggleClass("col-sm-12");
            $("#load_content").toggleClass("sidebar-padding");
            $(".prev_next_indicator").toggle();
            $(".menu-group").toggle();
          }

          function page(no) {
            var scrollpos = $(".sidebar").scrollTop();
            if (typeof(Storage) !== "undefined") {
              localStorage.sp = scrollpos;
            }

            location.href = "/"+no;
            return false;

            $(".selected_toc").removeClass("selected_toc");
            $(".toc_item").each(function() {
              var page_id = $(this).attr("page_id");
              if(page_id == no) {
                $(this).addClass("selected_toc");
              }
            });

            var url = "/load/"+no;
            $("#load_content").load(url, function(responseTxt, statusTxt, xhr){
              if(statusTxt == "success") {
                // alert("External content loaded successfully!");
                $("#load_content").scrollTop(0);
                window.history.pushState("object or string", "", "/"+no);
              }
              if(statusTxt == "error") {
                alert("Error: " + xhr.status + ": " + xhr.statusText);
              }
            });
          }
        </script>
      </div>

      <div class="col-sm-9" id="load_content" style="background-color:yellow"><!-- style="display:none;" -->

        <div class="" role="group">
          <small>
            <a class="menu_link menu-toggle"><span class="glyphicon glyphicon-menu-hamburger" title="메뉴"></span></a>
          </small>
        </div>
        <div class="menu-wikidocs"></div>
        <div class="clearfix page-depth">
          <ol class="breadcrumb pull-left">
            <li><small><a href="/book/20"><i class="glyphicon glyphicon-folder-open"></i> 개발자를 위한 파이썬</a></small></li>
          <!-- </ol> -->
          <!-- <ol class="breadcrumb pull-right"> -->
            <li><small><a href="/py/"><i class="glyphicon glyphicon-home"></i> Python</a></small></li>
          </ol>
        </div>

        <h1 class="page-subject">위키독스</h1>

        <div class="book-info row clearfix">

          <div class="pull-left" style="margin:10px 0 0 15px;">
            <div class="row">지은이 : 박응용</div>
            <div class="row">최종 편집일시 : 2018년 5월 20일 10:46 오후</div>
            <div class="row">저작권 :</div>
          </div>
        </div>

        <div class="page-content">
          <p><strong>Since 2008.</strong></p>
          <p>위키독스는 온라인 책을 제작 공유하는 플랫폼 서비스입니다. <br />누구나 위키독스에서 책을 만들수 있습니다.</p>
        </div>
        <a href="#top" class="label label-default back-to-top"><span class="glyphicon glyphicon-arrow-up"></span>TOP</a>
      </div>
    </div>

  <!-- </div> -->
</body>
</html>
