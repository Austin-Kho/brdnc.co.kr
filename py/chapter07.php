    <h2>2부 작업 자동화하기</h2>

    <h4 class="heading"><a>7장 정규표현식을 사용한 패턴 대조하기</a></h4>
    <div class="chapter">
      <section>
        <article class="">
          <p>
            <h5><strong>■ 정규표현식이란</strong></h5>
            <p>정규표현식(正規表現式, Regular Expression)은 문자열을 처리하는 방법 중의 하나로 특정한 조건의 문자를 '검색'하거나 '치환'하는 과정을 매우 간편하게 처리 할 수 있도록 하는 수단이다.</p>
          </p>

          <p>
            <h5><strong>■ 정규표현식 없이 텍스트 패턴 찾기</strong></h5>
            <p>문자열 안에서 전화번호를 찾고 싶다고 가정할때, 패턴은 세 개의 숫자, 하이픈, 세 개의 숫자, 하이픈, 네 개의 숫자 순서다. 즉 다음과 같을 것이다. 415-555-4242. 문자열이 이러한 패턴과 일치하는지 여부를 확인하는 isPhoneNumber()라는 함수를 사용한다.</p>
            <pre>def isPhoneNumber(text):<br>    if len(text) != 12:<br>        return False<br>    for i in range(0, 3):<br>        if not text[i].isdecimal():<br>            return False
    if text[3] != '-':<br>        return False<br>    for i in range(4, 7):<br>        if not text[i].isdecimal():<br>            return False<br>    if text[7] != '-':
        return False<br>    for i in range(8, 12):<br>        if not text[i].isdecimal():<br>            return False<br>    return True
              <br>print('415-555-4242 is a phone number:')<br>print(isPhoneNumber('415-555-4242'))<br>print('Moshi moshi is a phone number:')<br>print(isPhoneNumber('Moshi moshi'))</pre>
            <p>이 프로그램을 실행하면 출력은 다음과 같다.</p>
            <pre>415-555-4242 is a phone number:<br>True<br>Moshi moshi is a phone number:<br>False</pre>
            <p>더 큰 문자열에서 이 텍스트 패턴을 찾기 위해서는 더 많은 코드를 추가해야 한다. 위 isPhoneNumber() 함수에 아래에 다음 코드를 추가해 보자.</p>
            <pre>message = 'Call me at 415-555-1011 tomorrow. 415-555-9999 is my office.'<br>for i in range(len(message)):<br>    chunk = message[1:1+12]<br>    if isPhoneNumber(chunk):<br>        print('Phone number found: ' + chunk)<br>print('Done')</pre>
            <p>이 프로그램을 실행하면 출력은 다음과 같다.</p>
            <pre>Pone number found: 415-555-1011<br>Pone number found: 415-555-9999<br>Done</pre>
          </p>
        </article>
      </section>
    </div>
