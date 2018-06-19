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
      h2 {padding: 20px 10px 10px;}
      h4 {padding: 20px 20px 10px;cursor: pointer;}
      h4 {padding: 20px 30px 10px;}
      section { padding: 10px 50px; background-color: #fbf6e0; }
      code { padding: 10px; background-color: #faebe7; }
      p { padding: 3px; }
    </style>
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!-- jquery Framework -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>

  </head>
  <body>
    <h2>1부 파이썬 프로그래밍 기초</h2>
    <h4>1장 파이썬 기초</h4>
    <h4>2장 흐름 제어</h4>
    <h4>3장 함수</h4>
    <h4>4장 리스트</h4>
    <h4 onclick="$('#output_option').toggle();">5장 사전 및 구조화 데이터</h4>
      <section>
        <article class="a1">
          <h5>사전 데이터 유형</h5>
          <p>리스트와 마찬가지로 사전(dictionary)은 많은 값의 모음이다. 그러나 리스트의 인덱스와는 달리 사전의 인덱스는 정수만이 아닌 다양한 데이터 유형을 사용할 수 있다.<br>
          사전을 위한 인덱스를 키(key)라고 하며, 키와 그에 연관된 값을 키-값 쌍(key-value pair)이라고 한다. 코드에서 사전은 중괄호 { }로 정의된다.</p>
          <p><code>>>> myCat = {'size': 'fat', 'color': 'gray', 'disposition': 'loud'}</code></p>
          <p>위 코드는 myCat 변수에 사전을 할당한다. 사전의 키는 'size', 'color', 'disposition' 이다.<br>
            이들키에 대한 값은 각각 'fat', 'gray', 'loud'다. 이들 키를 통해 값을 사용할 수 있다.</p>
        </article>
      </section>

      <section>
        <article class="">
          <h5>관련 메소드</h5>
          <ul>
            <li>keys() : 사전명.keys() 형식으로 사용하며 해당 사전의 key 데이터를 추출한다.</li>
            <li>values() : 사전명.values() 형식으로 사용하며 해당 사전의 value 데이터를 추출한다.</li>
            <li>items() :  사전명.items() 형식으로 사용하며 해당 사전의 key와 value 데이터를 추출한다.(dict_items[('key1', 'value1'), ('key2', 'value2')]형식의 튜플로 반환)</li>
            <li>get() : 사전명.get('key', 'defaultValue') 형식으로 사용하며 해당 사전의 키와 값을 가져오는데, 첫번째 인자로 가져올 값의 키, 두번째 인자로 해당 키가 없을 때 가져올 기본 값을 사용한다.</li>
          </ul>
        </article>
      </section>


    <h4>6장 문자열 조작하기</h4>


    <p>&nbsp;</p>
    <h2>2부 작업 자동화하기</h2>

    <h4>7장 정규표현식을 사용한 패턴 대조</h4>
    <h4>8장 파일 읽기 및 쓰기</h4>
    <h4>9장 파일 조직화하기</h4>
    <h4>10장 디버깅</h4>
    <h4>11장 웹 스크랩</h4>
    <h4>12장 엑셀 스프레드시트 다루기</h4>
    <h4>13장 PDF 및 워드 문서 작업</h4>
    <h4>14장 CSV 파일 및 JSON 데이터 작업</h4>
    <h4>15장 시간 지키기, 작업 예약하기 및 프로그램 실행시키기</h4>
    <h4>16장 전자메일 및 문자 메시지 전송</h4>
    <h4>17장 이미지 조작</h4>
    <h4>18장 키보드와 마우스 제어 및 GUI 자동화</h4>

  </body>
</html>
