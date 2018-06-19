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
      h2 {padding: 10px 10px 10px;}
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
            $(this).next(".chapter").slideUp(250);
          } else {
            $(".chapter").slideUp(150);
            $(this).next(".chapter").slideDown(250);
          }
        });
      });
    </script>
  </head>
  <body>
    <h2>1부 파이썬 프로그래밍 기초</h2>

    <h4 class="heading"><a>1장 파이썬 기초</a></h4>
      <div class="chapter" style="display: block;">
        <section>
          <article class="">
            <p>
              <h5><strong>■ 대화형 쉘에 표현식 입력하기</strong></h5>
              <pre class="brush: xml">>>> 2 + 2<br>4</pre>
            </p>

            <p>
              <h5><strong>■ 표 1-1 수학 연산자</strong> (우선 순위가 가장 높은 것에서 가장 낮은 것 순으로)</h5>
              <table class="table table-hover table-condensed table table-bordered">
                <thead>
                  <tr>
                    <td>연산자</td><td>연산</td><td>예제</td><td>평가 값</td>
                  </tr>
                </thead>
                <tbody>
                  <tr><td>**</td><td>지수</td><td>2**3</td><td>8</td></tr>
                  <tr><td>%</td><td>모듈러스/나머지</td><td>22%8</td><td>2</td></tr>
                  <tr><td>//</td><td>정수 나누기/나머지를 버림</td><td>22//8</td><td>2</td></tr>
                  <tr><td>/</td><td>나누기</td><td>22/8</td><td>2.75</td></tr>
                  <tr><td>*</td><td>곱하기</td><td>3*5</td><td>15</td></tr>
                  <tr><td>-</td><td>빼기</td><td>5-2</td><td>3</td></tr>
                  <tr><td>+</td><td>더하기</td><td>2+2</td><td>4</td></tr>
                </tbody>
              </table>
            </p>

            <p>
              <h5><strong>■ 표 1-2 널리 쓰이는 데이터 유형</strong></h5>
              <table class="table table-hover table-condensed table table-bordered center">
                <thead>
                  <tr><td>데이터 유형</td><td>예</td></tr>
                </thead>
                <tbody>
                  <tr><td>정수(Integer)</td><td>-2, -1, 0, 1, 2, 3, 4, 5</td></tr>
                  <tr><td>부동소수점 숫자(Floating-point number)</td><td>-1.25, -1.0, --0.5, 0.0, 0.5, 1.0, 1.25</td></tr>
                  <tr><td>문자열(String)</td><td>'a', 'aa', 'aaa', 'Hello!', '11 cats'</td></tr>
                </tbody>
              </table>
            </p>

            <p>
              <h5><strong>■ 문자열 연결 및 복제</strong></h5>
              <pre class="brush: xml">>>> 'Alice' + 'Bob'<br>'AliceBob'</pre>
              <pre class="brush: xml">>>> 'Alice' * 5<br>'AliceAliceAliceAliceAlice'</pre>
              <p>문자열과 정수의 결합할 경우 아래와 같이 에러 발생</p>
              <pre class="brush: xml">>>> 'Alice' + 42<br>Traceback (most recent call last):<br>   File "&lt;pyshell#26>", line 1, in &lt;module><br>      'Alice' +42<br>TypeError: Can't convert 'int' object to str implicitly</pre>
            </p>

            <p>
              <h5><strong>■ 변수에 값 저장하기</strong></h5>
              <pre class="brush: xml">>>> spam = 40<br>>>> spam<br>40<br>>>> eggs = 2<br>>>> spam + eggs<br>42<br>>>> spam + eggs + spam<br>82<br>>>> spam = spam + 2<br>>>> spam<br>42<br>>>> spam = 'Hello'<br>>>> spam<br>'Hello'<br>>>> spam = 'Goodbye'<br>>>> spam<br>'Goodbye'</pre>
            </p>

            <p>
              <h5><strong>■ 표 1-3 유효한 변수 이름과 잘못된 변수 이름</strong></h5>
              <table class="table table-hover table-condensed table table-bordered center">
                <thead>
                  <tr><td>유효한 변수 이름</td><td>잘못된 변수 이름</td></tr>
                </thead>
                <tbody>
                  <tr><td>balance</td><td>current-balance (하이픈은 허용되지 않는다)</td></tr>
                  <tr><td>currentBalance</td><td>current balance (빈칸은 허용되지 않는다)</td></tr>
                  <tr><td>current_balance</td><td>4account (숫자로 시작되어서는 안 된다)</td></tr>
                  <tr><td>_spam</td><td>42 (숫자로 시작되어서는 안 된다)</td></tr>
                  <tr><td>SPAM</td><td>total_$um ($ 같은 특수 기호는 허용되지 않는다)</td></tr>
                  <tr><td>account4</td><td>'hello' ('같은 특수 기호는 허용되지 않는다)</td></tr>
                </tbody>
              </table>
            </p>

            <p>
              <h5><strong>■ 주석</strong></h5>
              <pre class="brush: xml"># This program says hello and asks for my name.</pre>
            </p>

            <p>
              <h5><strong>■ 관련 메소드</strong></h5>
              <ul>
                <li><strong>print()</strong> : print() 함수는 괄호 안의 값을 화면에 표시한다.</li>
                <li><strong>input()</strong> : input() 함수는 사용자가 키보드로 텍스트를 입력하고 Enter 키를 누를 때까지 기다린다.</li>
                <li><strong>len()</strong> : len() 함수는 문자열 또는 문자열을 포함하는 변수를 인자로 받아서, 해당 문자열의 문자 개수를 정수값으로 평가한다.</li>
                <li><strong>str()</strong> : str() 함수는 인자로 받은 값의 데이터 유형을 문자열 값으로 반환한다.</li>
                <li><strong>int()</strong> : int() 함수는 인자로 받은 값의 데이터 유형을 정수 값으로 반환한다.</li>
                <li><strong>float()</strong> : float() 함수는 인자로 받은 값의 데이터 유형을 부동 소수점 값으로 반환한다.</li>
              </ul>
            </p>
          </article>

        </section>

      </div>
    <h4 class="heading"><a>2장 흐름 제어</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>3장 함수</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>4장 리스트</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>5장 사전 및 구조화 데이터</a></h4>
      <div class="chapter">
        <section>
          <article class="">
            <p>
              <h5><strong>■ 사전 데이터 유형</strong></h5>
              <p>
                리스트와 마찬가지로 사전(dictionary)은 많은 값의 모음이다. 그러나 리스트의 인덱스와는 달리 사전의 인덱스는 정수만이 아닌 다양한 데이터 유형을 사용할 수 있다.<br>
                사전을 위한 인덱스를 키(key)라고 하며, 키와 그에 연관된 값을 키-값 쌍(key-value pair)이라고 한다. 코드에서 사전은 중괄호 { }로 정의된다.
              </p>
              <pre class="brush:xml">>>> myCat = {'size': 'fat', 'color': 'gray', 'disposition': 'loud'}</pre>
              <p>
                위 코드는 myCat 변수에 사전을 할당한다. 사전의 키는 'size', 'color', 'disposition' 이다. 이들키에 대한 값은 각각 'fat', 'gray', 'loud'다. 이들 키를 통해 값을 사용할 수 있다.
              </p>
            </p>

            <h5><strong>■ 관련 메소드</strong></h5>
            <ul>
              <li><strong>keys()</strong> : 사전명.keys() 형식으로 사용하며 해당 사전의 key 데이터를 추출한다.</li>
              <li><strong>values()</strong> : 사전명.values() 형식으로 사용하며 해당 사전의 value 데이터를 추출한다.</li>
              <li><strong>items()</strong> :  사전명.items() 형식으로 사용하며 해당 사전의 key와 value 데이터를 추출한다.(dict_items[('key1', 'value1'), ('key2', 'value2')]형식의 튜플로 반환)</li>
              <li><strong>get()</strong> : 사전명.get('key', 'defaultValue') 형식으로 사용하며 해당 사전의 키와 값을 가져오는데, 첫번째 인자로 가져올 값의 키, 두번째 인자로 해당 키가 없을 때 가져올 기본 값을 사용한다.</li>
            </ul>
          </article>
        </section>
      </div>



    <h4 class="heading"><a>6장 문자열 조작하기</a></h4>
      <div class="chapter">

      </div>

    <p>&nbsp;</p>
    <h2>2부 작업 자동화하기</h2>

    <h4 class="heading"><a>7장 정규표현식을 사용한 패턴 대조</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>8장 파일 읽기 및 쓰기</a></h4>
      <div class="chapter" id="no8">

      </div>
    <h4 class="heading"><a>9장 파일 조직화하기</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>10장 디버깅</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>11장 웹 스크랩</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>12장 엑셀 스프레드시트 다루기</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>13장 PDF 및 워드 문서 작업</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>14장 CSV 파일 및 JSON 데이터 작업</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>15장 시간 지키기, 작업 예약하기 및 프로그램 실행시키기</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>16장 전자메일 및 문자 메시지 전송</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>17장 이미지 조작</a></h4>
      <div class="chapter">

      </div>
    <h4 class="heading"><a>18장 키보드와 마우스 제어 및 GUI 자동화</a></h4>
      <div class="chapter">

      </div>
      <br><br><br>

  </body>
</html>
