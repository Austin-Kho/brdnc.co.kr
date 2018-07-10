<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>부트스트랩 101 템플릿</title>

    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>hljs.initHighlightingOnLoad();</script>
    <!-- 수식입력 mathjax -->
    <script type="text/x-mathjax-config">
      MathJax.Hub.Config({
          tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]},
          displayAlign: "left"
      });
    </script>

    <script type="text/javascript" async
      src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
    <!-- 수식입력 mathjax -->
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

    <div class="container">
      <div class="content row tex2jax_ignore" style="margin-top:0px;">
        <div class="col-sm-3">
          <div class="row">
            <div class="col-sm-3 sidebar" style="display:none;">
              <div class="toc" data-spy="affix_">
                <!--
                <div style="padding:15px 10px 15px 15px;background:#f9f9f9;border-bottom:solid 1px #ccc;">
                <a class="pull-right menu_link menu-toggle" style="cursor:pointer;margin-right:5px;"><span class="glyphicon glyphicon-menu-hamburger" title="메뉴"></span></a>
                <span class="">
                <a href="/" class="menu_link" style="font-family:consolas;">WikiDocs</a>
                </span>
                </div>
                -->
                <div class="row" style="border-bottom:solid 1px #ccc;">
                  <div class="col-xs-10">
                    <input type="text" id="kw" name="kw" class="col-xs-10 input-search" placeholder="검색어를 입력하세요." value="">
                  </div>
                  <div class="col-xs-2">
                    <a class="pull-right menu_link menu-toggle col-xs-2" style="cursor:pointer;margin:15px 10px;"><span class="glyphicon glyphicon-menu-hamburger" title="메뉴"></span></a>
                  </div>
                </div>
                <div class="list-group list-group-toc">
                  <a class="list-group-item " href="/book/110">
                    <span style="white-space:nowrap;overflow:hidden;display:block;" title="파이썬으로 배우는 알고리즘 트레이딩">파이썬으로 배우는 알고리즘 트레이딩</span>
                  </a>
                  <a href="javascript:page(2814)" class="list-group-item ">
                    <span style="white-space:nowrap;overflow:hidden;display:block;" title="00. 들어가기 전에">
                      <span style="padding-left:0px">00. 들어가기 전에</span>
                    </span>
                  </a>
                  <a href="javascript:page(2815)" class="list-group-item ">
                    <span style="white-space:nowrap;overflow:hidden;display:block;" title="1) 머리말 ">
                      <span style="padding-left:20px">1) 머리말</span>
                    </span>
                  </a>
                  <a href="javascript:page(2816)" class="list-group-item ">
                    <span style="white-space:nowrap;overflow:hidden;display:block;" title="2) 추천사">
                      <span style="padding-left:20px">2) 추천사</span>
                    </span>
                  </a>
                  <a href="javascript:page(981)" class="list-group-item ">
                    <span style="white-space:nowrap;overflow:hidden;display:block;" title="3) 주요 변경 이력 및 계획">
                      <span style="padding-left:20px">3) 주요 변경 이력 및 계획</span>
                    </span>
                  </a>
                  <a href="javascript:page(2818)" class="list-group-item ">
                    <span style="white-space:nowrap;overflow:hidden;display:block;" title="01. 파이썬 시작하기 (revision)">
                      <span style="padding-left:0px">01. 파이썬 시작하기 (revision)</span>
                    </span>
                  </a>

                  <a href="javascript:page(2819)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="1) 파이썬과 알고리즘 트레이딩">
                  <span style="padding-left:20px">

                  1) 파이썬과 알고리즘 트레이딩
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2820)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="1) 프로그래밍과 프로그래밍 언어">
                  <span style="padding-left:40px">

                  1) 프로그래밍과 프로그래밍 언어
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2821)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="2) 주식투자">
                  <span style="padding-left:40px">

                  2) 주식투자
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2822)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="3) 알고리즘 트레이딩">
                  <span style="padding-left:40px">

                  3) 알고리즘 트레이딩
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2823)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="4) 파이썬이란?">
                  <span style="padding-left:40px">

                  4) 파이썬이란?
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2824)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="2) 파이썬 설치">
                  <span style="padding-left:20px">

                  2) 파이썬 설치
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2825)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="1) 아나콘다 설치 파일 다운로드 ">
                  <span style="padding-left:40px">

                  1) 아나콘다 설치 파일 다운로드
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2826)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="2) 아나콘다 설치">
                  <span style="padding-left:40px">

                  2) 아나콘다 설치
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2827)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="3) 파이썬 인터프리터 실행">
                  <span style="padding-left:20px">

                  3) 파이썬 인터프리터 실행
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2828)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="1) 파이썬 IDLE 이용하기">
                  <span style="padding-left:40px">

                  1) 파이썬 IDLE 이용하기
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2829)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="2) 파이썬 들여쓰기 ">
                  <span style="padding-left:40px">

                  2) 파이썬 들여쓰기
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2830)" class="list-group-item active">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="4) 연습문제 및 풀이">
                  <span style="padding-left:20px">

                  4) 연습문제 및 풀이
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2831)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="1) 연습문제 ">
                  <span style="padding-left:40px">

                  1) 연습문제
                  </span>
                  </span>
                  </a>

                  <a href="javascript:page(2832)" class="list-group-item ">
                  <span style="white-space:nowrap;overflow:hidden;display:block;"
                  title="2) 연습문제 풀이">
                  <span style="padding-left:40px">

                  2) 연습문제 풀이
                  </span>
                  </span>
                  </a>
                </div>


              <div style="border-top:solid 1px #ccc;padding:15px 15px 30px 15px;font-family:consolas;">
                <span><a href="/" style="color:#333;">Published with WikiDocs</a></span>
              </div>
              </div>
              <input type="hidden" name="request_mobile" id="request_mobile" value="0" />
              <form id="search_form" action="/book/search/110" method="post">
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
                  location.href = "/book/search/result/110";
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
              }else {
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
                  window.history.pushState("object or string", "4) 연습문제 및 풀이", "/"+no);
                }
                if(statusTxt == "error") {
                  alert("Error: " + xhr.status + ": " + xhr.statusText);
                }
              });

            }
          </script>
        </div>



        <div class="page col-sm-offset-3 col-sm-9" id="load_content" style="display:none;margin-top:0px;">
        <div class="btn-group pull-right menu-group" role="group">
        <small>
        <a class="menu_link menu-toggle"><span class="glyphicon glyphicon-menu-hamburger" title="메뉴"></span></a>
        </small>
        </div>
        <div class="menu-wikidocs">
        </div>




        <div class="clearfix page-depth">
        <ol class="breadcrumb pull-left">
        <li><small><a href="/book/110"><i class="glyphicon glyphicon-folder-open"></i> 파이썬으로 배우는 알고리즘 트레이딩</a></small></li>

        <li><small><a href="/2818">01. 파이썬 시작하기 (revision)</a></small></li>

        <li><small><a href="/2830">4) 연습문제 및 풀이</a></small></li>

        </ol>
        <ol class="breadcrumb pull-right">
        <li><a href="/"><small class=""><i class="glyphicon glyphicon-home"></i> WikiDocs</small></a></li>
        </ol>
        </div>


        <h1 class="page-subject">
        4) 연습문제 및 풀이



        </h1>

        <div class="page-content tex2jax_process">
        <p>파이썬이라는 언어를 배울 때 가장 좋은 방법은 직접 프로그래밍을 해보는 것입니다. 눈으로 아무리 책을 읽더라도 직접 문제를 해결해보고 키보드로 타이핑해보지 않으면 배우기가 쉽지 않습니다. 다음 장으로 진도를 나가기 전에 꼭 아래의 연습문제를 직접 해결해보기 바랍니다. </p>
        </div>

        <div class="muted text-right" style="font-size: 12px;margin:10px 0;">

        마지막 편집일시 : 2016년 10월 8일 10:47 오후

        </div>

        <!-- google adsense -->
        <!-- PC -->


        <div style="margin:30px 0;">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- vcodecs -->
        <ins class="adsbygoogle"
        style="display:inline-block;width:728px;height:90px"
        data-ad-client="ca-pub-7780528504906069"
        data-ad-slot="6072452456"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        </div>




        <!-- Mobile -->


        <!-- google adsense -->

        <!--

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.10&appId=189410671132641";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="clearfix">
        <div class="fb-like" data-href="" data-layout="standard" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
        <div style="margin-top:2px; margin-right:5px;" class="pull-left">
        <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </div>
        </div>

        -->

        <div class="clearfix">
        <a href="javascript:show_comments();" class="label label-info">댓글 0</a>
        <a href="#myModal" data-toggle="modal" title="피드백을 남겨주세요" class="label label-info">피드백</a>
        </div>

        <div class="user_comments" style="display:none">
        <div class="comments">


        </div>


        <a href="/loginForm" class="text-info" style="font-size:11px">※ 댓글 작성은 로그인이 필요합니다.</a>
        <a href="#myModal" data-toggle="modal" style="font-size:11px">(또는 피드백을 이용해 주세요.)</a>

        </div>

        <div class="page-prev-next">
        <div class="clearfix">
        <div class="pull-left">
        <ul>

        <li><strong>이전글</strong> : <a href="javascript:page(2829)">2) 파이썬 들여쓰기 </a></li>


        <li><strong>다음글</strong> : <a href="javascript:page(2831)">1) 연습문제 </a></li>

        </ul>
        </div>


        </div>




        </div>

        <!--
        <div class="clearfix" style="font-family:consolas;margin:10px 0 10px 0;padding:0;">
        <small><a href="/" class="menu_link pull-left">Published with WikiDocs</a></small>
        </div>
        -->

        <a href="#top" class="label label-default back-to-top">
        <span class="glyphicon glyphicon-arrow-up"></span>
        TOP
        </a>


        <!--
        <a href="/" title="WikiDocs Home" class="home_link"><small class="glyphicon glyphicon-home back-to-home"></small></a>
        -->



        </div>

      </div>




      <!-- 프리뷰 넥스트 버튼 -->
      <div style="display:none" class="prev_next_indicator">
        <a class="prev_icon" href="javascript:page(2829)" role="button"><span class="glyphicon glyphicon-chevron-left" style="font-size:2em;"></span></a>
        <a class="next_icon" href="javascript:page(2831)" role="button"><span class="glyphicon glyphicon-chevron-right" style="font-size:2em;"></span></a>
      </div>




      <!-- Modal -->
      <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 id="myModalLabel" class="modal-title">이 페이지에 대한 피드백을 남겨주세요</h3>
            </div>
            <div class="modal-body">
              <form class="form" role="form">
                <input type="hidden" name="page_id" id="page_id" value="2830" />
                <div class="form-group">
                  <label class="control-label" for="email">답장받을 이메일 주소</label>
                  <div class="">
                    <input class="form-control" type="text" id="email" placeholder="Email" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label" for="feedback">하고 싶은 말</label>
                    <div class="controls">
                    <textarea class="form-control" id="feedback" rows="5"></textarea>
                  </div>
                </div>
                <p style="font-size:12px;">※ 피드백은 저자에게 e-메일로 전달됩니다.</p>
              </form>
            </div>
            <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" id="feedback_btn">전송하기</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  </body>
</html>
