    <h4 class="heading"><a>3장 함수(method)</a></h4>
    <div class="chapter">
      <section>
        <article class="">
          <p>
            <h5><strong>■ def 문과 매개변수</strong></h5>
            <p>파이썬은 여러 가지 내장 함수를 제공하지만 필요한 함수를 직접 만들어 쓸 수도 있다. 함수를 부를 때에는 괄호 안에 입력하는 방식으로 값을 전달하며, 이것을 매개변수라고 부른다.</p>
            <pre>>>> def hello(name):<br>       print('hello ' + name)<br>&nbsp;<br>>>> hello('Alice')<br>Hello Alice</pre>
          </p>

          <p>
            <h5><strong>■ 반환값과 return 문</strong></h5>
            <p>함수 호출로 평가되는 값을 함수의 반환값이라고 한다. def 문을 사용해서 함수를 만들 때 반환값이 무엇인지를 return 문으로 지정할 수 있다. return 문은 다음과 같이 구성된다.</p>
            <p><strong>▶ 구성</strong> : return 키워드 + 함수가 돌려주어야 하는 값 또는 표현식</p>
            <pre>>>> import random<br>>>> def getAnswer(answerNumber):<br>       if answerNumber == 1:<br>          <strong>return</strong> 'It is certain'<br>       elif answerNumber == 2:
          <strong>return</strong> 'It is decidedly so'<br>       elif answerNumber == 3:<br>          <strong>return</strong> 'Yes'<br>       elif answerNumber == 4:<br>          <strong>return</strong> 'Reply hazy try again'<br>       elif answerNumber == 5:
          <strong>return</strong> 'Ask again later'<br>       elif answerNumber == 6:<br>          <strong>return</strong> 'Concentrate and ask again'<br>       elif answerNumber == 7:<br>          <strong>return</strong> 'My reply is no'<br>       elif answerNumber == 8:
          <strong>return</strong> 'Outlook not so good'<br>       elif answerNumber == 9:<br>          <strong>return</strong> 'Very doubtful'
          <br>>>> r = random.randint(1, 9)<br>>>> fortune = getAnswer(r)<br>>>> print(fortune)<br>My reply is no</pre>
          </p>

          <p>
            <h5><strong>■ None 값</strong></h5>
            <p>파이썬에서 None 값은 값이 없음을 뜻하며, NoneType 데이터 유형의 유일한 값이다.(타 언어에서 null, nil 또는 undefined 등으로 쓰임) 부울 값 True 나 False 처럼 대문자로 시작되어야 한다.</p>
            <pre>>>> spam = print('Hello!')<br>Hello!<br>>>> None == spam<br>True</pre>
            <p>텍스트를 표시하지만 반환값을 돌려줘야할 필요가 없는 print() 함수는 None 값을 돌려준다. 내부적으로 파이썬은 return 문이 없는 모든 함수 정의 끝에 return None 을 추가한다. 반복문의 루프 끝이 암묵적으로 continue 문인 것과 비슷하며, 또한 값이 없이 return  문을 썼을 때에도(즉 return 키워드만 쓰면) None 이 반환된다.</p>
          </p>

          <p>
            <h5><strong>■ 키워드 매개변수와 print()</strong></h5>
            <p>print() 함수는 선택적 매개변수 end와 sep를 가지며 각각 매개변수 끝에, 매개변수 사이(구분을 위해)에 무엇이 출력되어야 하는지를 지정한다. 기본값은 각각 \n(줄바꿈문자)와 ' '(공백)이다.</p>
            <pre>>>> print('Hello')<br>>>> print('World')<br>Hello<br>World</pre>
            <pre>>>> print('Hello' <strong>end</strong>='')<br>>>> print('World')<br>HelloWorld</pre>
            <pre>>>> print('cats', 'dogs', 'mice')<br>cats dogs mice</pre>
            <pre>>>> print('cats', 'dogs', 'mice', <strong>sep</strong>=',')<br>cats,dogs,mice</pre>
          </p>

          <p>
            <h5><strong>■ 지역 및 전역 범위</strong></h5>
            <p> 함수에서 할당된 매개변수 및 변수는 그 함수의 <strong>지역 범위</strong> 안에 존재한다고 말한다. 모든 함수의 바깥에서 할당된 변수들은 <strong>전역 범위</strong>에 존재한다고 말한다.<br>
              변수는 둘 중 하나에 속하며 지역이면서 전역일 수 없다.
            </p>
            <p>
              <strong>▶ </strong> 전역 범위의 코드는 지역변수를 사용할 수 없다.<br>
              <strong>▶ </strong> 그러나 지역 범위는 전역변수를 사용할 수 있다.<br>
              <strong>▶ </strong> 함수의 지역 범위 안에 있는 코드는 다른 지역 범위의 변수를 사용할 수 없다.<br>
              <strong>▶ </strong> 범위가 서로 다르다면 같은 이름의 지역 변수를 사용할 수 있다. 즉, spam이라는 이름의 지역변수와 spam이라는 이름의 전역변수가 있을 수 있다.
            </p>
            <pre>>>> def spam():<br>       eggs = 31337<br><br>>>> spam()<br>>>> print(eggs)<br>Traceback (most recent call last):
  File "&lt;pyshell#4>", line 1, in <module>
    print(eggs)
NameError: name 'eggs' is not defined</pre>
            <p>
              <strong>▶ global 문</strong> : 함수 안에서 전역변수를 수정해야 한다면 global 문을 사용한다.<br>
              함수의 첫머리에서 global eggs와 같은 줄이 있다면 이는 파이썬에게 '이 함수에서 eggs 변수는 전역변수를 참조하는 것이며 따라서 이 이름으로는 지역변수를 만들지 말라.'고 알려 주는 것이다.<br>
              <pre>>>> def spam():<br>       globas eggs<br>       eggs = 'spam'<br><br>>>> eggs = 'global'<br>>>> spam()<br>>>> print(eggs)<br>spam</pre>
            </p>

            <p>
              <h5><strong>■ 예외 처리</strong></h5>
              <p>'0으로 나누기'오류가 나는 다음 프로그램을 보자.</p>
              <pre>>>> def spam(divideBy)<br>       return 42 / divideBy<br><br>>>> print(spam(2))<br>21.0<br>>>> print(spam(12))<br>3.5<br>>>> print(spam(0))<br>Traceback (most recent call last):
  File "&lt;stdin>", line 1, in &lt;module>
  File "&lt;stdin>", line 2, in spam
ZeroDivisionError: division by zero<br>>>> print(spam(1))<br>42.0</pre>
              <p>try 절에서 원래 실행할 코드블록을 적고 except 키워드와 에러명을 적은 절에 에러시에 실행할 코드를 적는다. </p>
              <pre>>>> def spam(divideBy)<br>       try:<br>          return 42 / divideBy<br>       except ZeroDivisionError:<br>          print('Error: Invalid argument.')<br><br>>>> print(spam(2))<br>21.0<br>>>> print(spam(12))<br>3.5<br>>>> print(spam(0))<br>Error: Invalid argument.<br>None<br>>>> print(spam(1))<br>42.0</pre>
            </p>
          </p>
        </article>
      </section>
    </div>
