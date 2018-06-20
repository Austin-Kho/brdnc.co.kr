
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

        </article>
      </section>
    </div>
