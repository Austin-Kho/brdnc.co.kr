
    <h4 class="heading"><a>2장 흐름 제어</a></h4>
    <div class="chapter">
      <section>
        <article class="">
          <p>
            <h5><strong>■ 부울 값</strong></h5>
            <p>True(참)와 False(거짓) 두 가지 값만 있으며, 따옴표를 두르지 않고, 첫 글자를 대문자로 그 뒤의 글자는 소문자로 쓴다. </p>
            <pre class="brush:xml">>>> spam = True<br>>>> spam<br>True</pre>
            <p>다른 값과 마찬가지로 부울 값은 표현식에 사용되며 변수에 저장될 수 있으나 변수 이름으로 사용될 수 없다. </p>
          </p>

          <p>
            <h5><strong>■ 표 2-1 비교 연산자</strong></h5>
            <table class="table table-hover table-condensed table table-bordered">
              <thead>
                <tr><td>연산자</td><td>의미</td></tr>
              </thead>
              <tbody>
                <tr><td>==</td><td>같음</td></tr>
                <tr><td>!=</td><td>같지 않음</td></tr>
                <tr><td><</td><td>작다</td></tr>
                <tr><td>></td><td>크다</td></tr>
                <tr><td><=</td><td>작거나 같다</td></tr>
                <tr><td>>=</td><td>크거나 같다</td></tr>
              </tbody>
            </table>
            <p><h5><strong>※ == 와 = 연산자의 차이</strong></h5>▶ ==(같음) 연산자는 두 값이 서로 같은지 여부를 묻는다.<br>▶ = (할당) 연산자는 오른쪽 있는 값을 왼쪽에 있는 변수에 저장한다.</p>
          </p>

          <p>
            <h5><strong>■ 부울 연산자</strong></h5>
            <p>세 가지 부울 연산자(and, or, not)는 부울 값을 비교하기 위해 사용된다.</p>
          </p>

          <p>
            <h5><strong>■ 표 2-2 and 연산자의 진리표</strong></h5>
            <table class="table table-hover table-condensed table table-bordered">
              <thead>
                <tr><td>표현식</td><td>평가 결과</td></tr>
              </thead>
              <tbody>
                <tr><td>True and True</td><td>True</td></tr>
                <tr><td>True and False</td><td>False</td></tr>
                <tr><td>False and True</td><td>False</td></tr>
                <tr><td>False and False</td><td>False</td></tr>
              </tbody>
            </table>
          </p>

          <p>
            <h5><strong>■ 표 2-3 or 연산자의 진리표</strong></h5>
            <table class="table table-hover table-condensed table table-bordered">
              <thead>
                <tr><td>표현식</td><td>평가 결과</td></tr>
              </thead>
              <tbody>
                <tr><td>True or True</td><td>True</td></tr>
                <tr><td>True or False</td><td>True</td></tr>
                <tr><td>False or True</td><td>True</td></tr>
                <tr><td>False or False</td><td>False</td></tr>
              </tbody>
            </table>
          </p>

          <p>
            <h5><strong>■ 표 2-4 not 연산자의 진리표</strong></h5>
            <table class="table table-hover table-condensed table table-bordered">
              <thead>
                <tr><td>표현식</td><td>평가 결과</td></tr>
              </thead>
              <tbody>
                <tr><td>not True</td><td>False</td></tr>
                <tr><td>not False</td><td>True</td></tr>
              </tbody>
            </table>
          </p>

          <p>
            <h5><strong>■ 흐름 제어 요소</strong></h5>
            <p>흐름 제어문은 종종 조건으로 시작하고, 절(clause)이라고 하는 코드의 블록이 항상 그 뒤를 뒤따른다.</p>
            <p><h5><strong>▶ 조건</strong></h5>부울 표현식은 모두 조건으로 간주될 수 있으며, 조건은 표현식과 같은 것이다. 조건은 항상 True 또는 False인 하나의 부울 값으로 평가된다.</p>
            <p><h5><strong>▶ 코드 블록</strong></h5>1. 블록은 들여쓰기가 증가할 때 시작된다.<br>2. 블록은 다른 블록을 포함할 수 있다.<br>3. 블록은 들여쓰기가 없거나 그 블록을 포함한 블록의 들여쓰기 수준으로 감소할 때 끝난다.</p>
          </p>

          <p>
            <h5><strong>■ if 문</strong></h5>
            <p><strong>▶ 구성</strong> : if 키워드 + 조건 (즉, True 또는 False로 평가되는 표현식) + 콜론 + 다음 줄에서 시작되는, 들여쓰기 된 코드 블록 (if 절이라고 부른다.)</p>
            <pre>>>> if name == 'Alice':<br>        print('Hi, Alice.')</pre>
          </p>

          <p>
            <h5><strong>■ else 문</strong></h5>
            <p><strong>▶ 구성</strong> : else 키워드 + 콜론 + 다음 줄에서 시작되는, 들여쓰기 된 코드 블록 (else 절이라고 부른다.)</p>
            <pre>>>> if name == 'Alice':<br>        print('Hi, Alice.')<br>    else:<br>        print('Hello, stranger.')</pre>
          </p>

          <p>
            <h5><strong>■ elif 문</strong></h5>
            <p><strong>▶ 구성</strong> : elif 키워드 + 조건 (즉, True 또는 False로 평가되는 표현식) + 콜론 + 다음 줄에서 시작되는, 들여쓰기 된 코드 블록 (elif 절이라고 부른다.)</p>
            <pre>>>> if name == 'Alice':<br>        print('Hi, Alice.')<br>    elif age < 12:<br>        print('You are not Alice, kiddo.')</pre>
          </p>

          <p>
            <h5><strong>■ while 루프문</strong></h5>
            <p><strong>▶ 구성</strong> : while 키워드 + 조건 (True 또는 False로 평가되는 표현식) + 콜론 + 다음 줄에서 시작되는, 들여쓰기 된 코드 블록 (while 절이라고 부른다.)</p>
            <pre>>>> spam = 0<br>>>> while spam < 5:<br>        print('Hello, world.')<br>        spam = spam + 1</pre>
          </p>

          <p>
            <h5><strong>■ break 문</strong></h5>
            <p>▶ 반복문 루프에서 break 문에 다다르면 즉시 루프문에서 빠져 나온다. 단순히 break 키워드만 쓰면 된다.</p>
            <pre>>>> while True:<br>        print('Please type your name.')<br>        name = input()<br>        if name == 'your name':<br>           break<br>        print('Thank you!')</pre>
          </p>

          <p>
            <h5><strong>■ continue 문</strong></h5>
            <p>▶ break 문과 같이 루프 안에서 사용된다. 루프에서 continue 문에 다다르면 프로그램 실행은 즉시 루프의 시작 부분으로 되돌아가서 루프의 조건을 다시 판단한다.(실행이 루프의 끝에 다다를 때 일어나는 일과 똑같다.) 단순히 continue 키워드만 쓰면 된다.</p>
            <pre>>>> while True:<br>        print('Who are you?')<br>        name = input()<br>        if name != 'Joe':<br>           continue<br>        print('Hello, Joe. What is the password? (I is a fish.)')<br>        password = input()<br>        if password == 'swordfish':<br>           break<br>        print('Access granted.')</pre>
          </p>

          <p>
            <h5><strong>■ for 루프와 range() 함수</strong></h5>
            <p><strong>▶ 구성</strong> : for 키워드 + 변수이름 + in 키워드 + 최대 세 개의 정수를 포함하는 range() 메소드 호출 + 콜론 + 다음 줄에서 시작되는, 들여쓰기 된 코드 블록 (for 절이라고 부른다.)</p>
            <pre>>>> print('My name is ')<br>>>> for i in range(5):<br>        print('Jimmy Five Times (' + str(i) + ')')</pre>
            <p>※ for 루프 안에서도 break 와 continue 문을 사용할 수 있다. continue 문은 for 루프의 카운터를 다음 값으로 진행 시킨다.마치 프로그램 실행이 루프의 끝에 다다른 것과도 같다. 사실 continue 와 break 문은 while 과 for 루프 안에서만 사용할 수 있다.</p>
            <p><strong>▶ range()</strong> 메소드 : range(시작 값, 종료 값(자신을 포함하지 않음), 증감 값)와 같이 인자를 사용하며, 첫번째(생략 시 0)와 세번째 인자(생략 시 1)는 생략할 수 있다.</p>
            <pre>>>> for i in range(5):<br>        print(i)<br>0<br>1<br>2<br>3<br>4<br>>>> for i in range(12, 16):<br>        print(i)<br>12<br>13<br>14<br>15<br>>>> for i in range(0, 10, 2):<br>        print(i)<br>0<br>2<br>4<br>6<br>8<br>>>> for i in range(5, -1, -1):<br>        print(i)<br>5<br>4<br>3<br>2<br>1<br>0</pre>
          </p>

          <p>
            <h5><strong>■ 모듈 가져오기</strong></h5>
            <p><strong>▶ 구성</strong> : import 키워드 + 모듈의 이름 + 쉼표로 구분하면 더 많은 모듈 이름을 넣을 수도 있다.</p>
            <pre>>>> import random<br>>>> for i in range(5):<br>        print(random.randint(i, 10))</pre>
            <p>※ 다음은 네 가지 모듈을 가져오는 import 문의 예다.</p>
            <pre>>>> import random, sys, os, math</pre>
            <p>이제 이들 4개의 모듈에 있는 함수를 사용할 수 있다.</p>
          </p>

          <p>
            <h5><strong>■ from import 문</strong></h5>
            <p>import 명령문의 다른 형태는 from 키워드를 쓰고 그 뒤에 모듈 이름, import 키워드와 별표(*)를 쓰는 것이다. (ex: from random import *)</p>
            <p>이 형식의 import 문에서는 random 함수에 random.이라는 접두사를 필요로 하지 않는다. <br>하지만 전체 이름을 쓰는 것이 코드를 더 이해하기 쉽게 만들 수 있으므로 import 문의 일반적인 형식을 사용하는 것이 좋다.</p>
          </p>

          <p>
            <h5><strong>■ sys.exit() 함수로 프로그램을 일찍 끝내기</strong></h5>
            <p>마지막으로 다룰 흐름 제어 개념은 프로그램의 종료다. <br>프로그램 실행이 명령의 끝에 다다르면 항상 일어나는 일이지만 sys.exit() 함수를 호출해서 프로그램을 종료시킬 수 있다. 이 기능은 sys 모듈에 들어 있다.</p>
            <pre>>>> import sys<br>>>><br>>>> while True:<br>       print('Type exit to exit.')<br>       response = input()<br>       if response == 'exit':<br>          sys.exit()<br>       print('You typed ' + response + '.')</pre>
          </p>

        </article>
      </section>
    </div>
