    <h4 class="heading"><a>6장 문자열(String) 조작하기</a></h4>
    <div class="chapter">
      <section>
        <article class="">
          <p>
            <h5><strong>■ 문자열 다루기</strong></h5>
            <p>파이썬이 문자열을 작성하고, 출력하고, 사용하는 몇 가지 방법을 알아보자.</p>
          </p>

          <p>
            <h5><strong>■ 문자열 리터럴</strong></h5>
            <p>파이썬 코드에서 문자열 값 입력은 기본적으로 홑따옴표로 시작하고 홑따옴표로 끝난다. 그러나 문자열 안에 따옴표를 입력하여야 할 경우 다른 방식이 필요하다.</p>
            <p><strong>▶ 겹따옴표</strong> : 문자열은 홑따옴표를 쓰는 방식과 마찬가지로 겹따옴표로도 시작하고 끝맺을 수 있다. 겹따옴표를 사용하는 이점 중 하나는 문자열 안에 홑따옴표를 둘 수 있다는 것이다.</p>
            <pre>>>> spam = "That is Alice's cat."</pre>
            <p><strong>▶ 이스케이프 문자</strong> : 하지만 문자열 안에 홑따옴표와 겹따옴표를 모두 사용해야 한다면 이스케이프 문자를 사용해야 한다. 이스케이프 문자는 백슬래시(\) 다음에 문자열에 넣고 싶은 글자를 두는 방식으로 구성된다.(두 글자로 이루어졌지만 보통은 한 개의 이스케이프 문자로 간주된다.)</p>
            <pre>>>> spam = 'Say hi to Bob\'s mother.'</pre>
          </p>

          <p>
            <h5><strong>■ 표 6-1 이스케이프 문자</strong></h5>
            <table class="table table-hover table-condensed table table-bordered">
              <thead>
                <tr>
                  <td>이스케이프 문자</td><td>출력되는 글자</td>
                </tr>
              </thead>
              <tbody>
                <tr><td>\'</td><td>홑따옴표</td></tr>
                <tr><td>\"</td><td>겹따옴표</td></tr>
                <tr><td>\t</td><td>탭</td></tr>
                <tr><td>\n</td><td>줄바꿈</td></tr>
                <tr><td>\\</td><td>백슬래쉬</td></tr>
              </tbody>
            </table>
            <pre>>>> print("Hello there!\nHow are you?\nI\'m doing fine.")<br>Hello there!<br>How are you?<br>I'm doing fine.</pre>
            <p><strong>▶ 세겹 따옴표를 사용하는 여러 줄에 걸친 문자열</strong> : 파이썬에서 여러 줄 문자열은 세 개의 홑따옴표나 세 개의 겹따옴표로 시작하고 끝난다. 세겹 따옴표 사이의 모든 따옴표, 탭, 또는 줄바꿈은 문자열의 일부로 간주된다. 블록에 대한 파이썬의 들여쓰기 규칙은 여러 줄 문자열 안에 있는 줄들에는 적용되지 않는다.</p>
            <pre>>>> print('''Dear Alice,<br><br>Eve's cat has been arrested for catnapping, cat burglary, and extortion.<br><br>Sincerely,<br>Bob''')</pre>
            <p><strong>▶ 여러 줄 주석</strong> : 해시 문자(#)는 그 줄의 나머지 부분에 대한 주식의 시작을 표시하는 반면, 여러 줄에 걸친 문자열을 여러 줄에 걸친 주석에 사용할 때도 있다. </p>
            <pre>"""This is a test Python program.<br>Written by Al Sweigart al@inventwithpython.com<br><br>This program was designed for Python 3, not Python 2.<br>"""</pre>
          </p>

          <p>
            <h5><strong>■ 문자열 인덱스와 슬라이스</strong></h5>
            <p>문자열은 리스트처럼 인덱스와 슬라이스를 사용한다.</p>
            <pre>>>> spam = 'Hello world!'<br>>>> spam[0]<br>'H'<br>>>> spam[4]<br>'o'<br>spam[-1]<br>'!'<br>>>> spam[0:5]<br>'Hello'<br>spam[:5]<br>'Hello'<br>>>> spam[6:]<br>'world!'</pre>
          </p>

          <p>
            <h5><strong>■ 문자열에 in 또는 not in 연산자 사용하기</strong></h5>
            <p>문자열은 리스트처럼 in 또는 not in 연산자를 쓸 수 있다. 이 표현식은 부울 True 또는 False 값으로 평가된다.</p>
            <pre>>>> 'Hello' in 'Hello World'<br>True<br>'Hello' in 'Hello'<br>True<br>'HELLO' in 'Hello World'<br>False<br>'' in 'spam'<br>True<br>'cats' not in 'cats and dogs'<br>False</pre>
          </p>

          <p>
            <h5><strong>■ 관련 모듈</strong></h5>
            <ul>
              <li><strong>import pyperclip</strong> : pyperclip 모듈은 컴퓨터의 클립보드로 텍스트를 보내거나 클립보드에서 텍스트를 가지고 올 수 있는 copy(), paste() 함수를 가지고 있다. 프로그램의 출력을 클립보드로 보내면 이메일, 워드프로세서 또는 다른 소프트웨어에 텍스트를 쉽게 붙여 넣을 수 있다.
                <br>pyperclip 모듈은 python에 들어있지 않다. 각 OS별 타사 모듈 설치 가이드를 따라야 한다.</li>
            </ul>

            <h5><strong>■ 관련 메소드</strong></h5>
            <ul>
              <li><strong>upper()</strong> : upper() 함수는 문자열의 모든 글자를 대문자로 변환한 새로운 문자열을 돌려준다.</li>
              <li><strong>lower()</strong> : lower() 함수는 문자열의 모든 글자를 소문자로 변환한 새로운 문자열을 돌려준다.</li>
              <pre>>>> spam = 'Hello world!'<br>>>> spam = spam.upper()<br>>>> spam<br>'HELLO WORLD!'<br>>>> spam = spam.lower()<br>>>> spam<br>'hello world!'</pre>
              <li><strong>isupper()</strong> : isupper() 함수는 문자열이 모두 대문자로 이루어져 있다면 부울 값 True 를 돌려준다. 모두 숫자면 False.</li>
              <li><strong>islower()</strong> : islower() 함수는 문자열이 모두 소문자로 이루어져 있다면 부울 값 True 를 돌려준다. 모두 숫자면 False.</li>
              <li><strong>startswith()</strong> : startswith() 함수는 호출한 문자열 값이 메소드에 전달된 문자열로 시작되면 True 그렇지 않으면 False 를 돌려준다.</li>
              <li><strong>endswith()</strong> : endswith() 함수는 호출한 문자열 값이 메소드에 전달된 문자열로 끝나면 True 그렇지 않으면 False 를 돌려준다.</li>
              <pre>>>> 'Hello world!'.startswith('Hello')<br>True<br>>>> 'Hello world!'.endswith('world!')<br>True</pre>
            </ul>
            <h5><strong>▶ isX 문자열 메소드</strong></h5>
            <ul>
              <li><strong>isalpha()</strong> : isalpha() 함수는 문자열이 (기호가 아닌) 문자로만 구성되어 있으며 빈칸이 없으면 True 를 반환한다.</li>
              <li><strong>isalnum()</strong> : isalnum() 함수는 문자열이 (기호가 아닌) 문자와 숫자로만 구성되어 있으며 빈칸이 없으면 True 를 반환한다.</li>
              <li><strong>isdecimal()</strong> : isdecimal() 함수는 문자열이 숫자로만 구성되어 있으며 빈칸이 없으면 True 를 반환한다.</li>
              <li><strong>isspace()</strong> : isspace() 함수는 문자열이 빈칸, 탭, 줄바꿈 문자로만 구성되어 있지만 비어 있지는 않으면 True 를 반환한다.</li>
            </ul>

            <h5><strong>▶ join() 과 split() 문자열 메소드</strong></h5>
            <ul>
              <li><strong>join()</strong> : join() 함수는 문자열로 이루어진 리스트를 하나의 문자열로 연결시켜 준다.</li>
              <pre>>>> ', '.join(['cats', 'rats', 'bats'])<br>'cats, rats, bats'<br>>>> ' '.join(['My', 'name', 'is', 'Simon'])<br>'My name is Simon'</pre>
              <li><strong>split()</strong> : split() 함수는 join() 과 반대로 문자열을 호출하여 문자열의 리스트를 돌려준다.</li>
              <pre>>>> 'My name is Simon'.split()<br>['My', 'name', 'is', 'Simon']</pre>
              <p>기본적으로 split() 에 호출되는 문자열은 빈칸, 탭, 또는 줄바꿈과 같은 공백 문자가 있는 곳에서 분리된다.</p>
            </ul>

            <h5><strong>▶ rjust(), ljust(), center() 메소드로 텍스트 정렬하기</strong></h5>
            <ul>
              <li><strong>rjust()</strong> : rjust() 함수는 이를 호출한 문자열을 오른쪽으로 정렬한 문자열을 돌려주며, 텍스트 정렬을 위해서 빈칸을 사용한다. 첫 번째 인수는 문자열 정렬을 위한 정수값 길이다. 두번째 인자가 있는 경우 빈칸을 대신해 채울 문자를 지정한다.</li>
              <li><strong>ljust()</strong> : ljust() 함수는 이를 호출한 문자열을 왼쪽으로 정렬한 문자열을 돌려주며, 텍스트 정렬을 위해서 빈칸을 사용한다. 첫 번째 인수는 문자열 정렬을 위한 정수값 길이다. 두번째 인자가 있는 경우 빈칸을 대신해 채울 문자를 지정한다.</li>
              <li><strong>center()</strong> : center() 함수는 이를 호출한 문자열을 가운데로 정렬한 문자열을 돌려주며, 텍스트 정렬을 위해서 빈칸을 사용한다. 첫 번째 인수는 문자열 정렬을 위한 정수값 길이다. 두번째 인자가 있는 경우 빈칸을 대신해 채울 문자를 지정한다.</li>
              <pre>>>> 'Hello'.rjust(10)<br>'     Hello'<br>'Hello'.ljust(10)<br>'Hello     '<br>'Hello'.center(20, '.')<br>'........Hello........'</pre>
            </ul>

            <h5><strong>▶ strip(), rstrip(), lstrip() 메소드로 공백 없애기</strong></h5>
            <ul>
              <li><strong>strip()</strong> : strip() 함수는 문자열 양쪽 끝에 있는 공백문자(빈칸, 탭, 줄 바꿈)들을 제거한다. 선택사항으로 문자열 끝에서 제거되어야 할 글자들을 지정하는 하나의 문자열 매개변수를 지정할 수 있다.</li>
              <li><strong>rstrip()</strong> : rstrip() 함수는 문자열 오른쪽에 있는 공백문자(빈칸, 탭, 줄 바꿈)들을 제거한다. 선택사항으로 문자열 끝에서 제거되어야 할 글자들을 지정하는 하나의 문자열 매개변수를 지정할 수 있다.</li>
              <li><strong>lstrip()</strong> : lstrip() 함수는 문자열 왼쪽에 있는 공백문자(빈칸, 탭, 줄 바꿈)들을 제거한다. 선택사항으로 문자열 끝에서 제거되어야 할 글자들을 지정하는 하나의 문자열 매개변수를 지정할 수 있다.</li>
              <pre>>>> spam = '     Hello World     '<br>spam.strip()<br>'Hello World'<br>>>> spam = 'SpamSpamBaconSpamEggsSpamSpam'<br>>>> spam.strip('ampS')<br>'BaconSpamEggs'</pre>
              <p>strip() 에 'ampS' 매개변수를 전달하면 spam에 저장되어 있는 문자열의 끝에 있는 a, m, p, S 를 제거하라고 지시하는 것이다. 글자의 순서는 중요치 않다. stirp('ampS')는 strip('mapS') 또는 strip('Spam')과 똑같은 일을 한다.</p>
            </ul>
          </p>
        </article>
      </section>
    </div>

    <p>&nbsp;</p>
