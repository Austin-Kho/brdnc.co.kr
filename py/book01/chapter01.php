    <h1><span class="glyphicon glyphicon-sunglasses" aria-hidden="true" style="color: #327108;"></span><strong> 파이썬으로 지루한 작업 자동화 하기</strong></h1>
    <h2>1부 파이썬 프로그래밍 기초</h2>

    <h4 class="heading"><a>1장 파이썬(python) 기초</a></h4>
    <div class="chapter">
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

          <p>
            <h5><strong>■ 연습 문제</strong></h5>
            <ul>
              <li>1. 다음 중 무엇이 연산자이고 무엇이 값인가?</li>
              <pre>*<br>'hello'<br>-88.8<br>-<br>/<br>+<br>5</pre>
              <li>2. 다음 중 무엇이 변수고 무엇이 값인가?</li>
              <pre>spam<br>'spam'</pre>
              <li>3. 세 가지 데이터 유형의 이름은 무엇인가?</li>
              <li>4. 표현식은 무엇으로 구성되는가? 표현식이 하는 일은 무엇인가?</li>
              <li>5. 이 장에서는 spam = 10 와 같은 할당문을 소개했다. 표현식과 문장의 차이점은 무엇인가?</li>
              <li>6. 다음 코드가 실행 된 후 변수 bacon 에는 무엇이 저장되어 있을까?</li>
              <pre>bacon = 20<br>bacon + 1</pre>
              <li>7. 다음 두 표현식은 어떻게 평가될까?</li>
              <pre>'spam' + 'spamspam'<br>'spam' * 3</pre>
              <li>8. eggs 는 유효한 변수 이름인데 반해 100은 잘못된 변수 이름인 이유는 무엇인가?</li>
              <li>9. 어떤 값의 정수, 부동 소수점 숫자, 또는 문자열 버전을 얻기 위해 이용될 수 있는 세 가지 함수는 무엇인가?</li>
              <li>10. 왜 이 표현식은 오류를 일으킬까? 어떻게 문제를 해결할 수 있을까?</li>
              <pre>'I have eaten ' + 99 + ' burritos.'</pre>
            </ul>
          </p>
        </article>

      </section>
    </div>
