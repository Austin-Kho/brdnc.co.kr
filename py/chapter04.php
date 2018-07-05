    <h4 class="heading"><a>4장 리스트(list)</a></h4>
    <div class="chapter">
      <section>
        <article class="">
          <p>
            <h5><strong>■ 리스트 데이터 유형</strong></h5>
            <p>리스트는 순서를 가진 여러 가지 값의 배열이다. 리스트는 여는 대괄호로 시작하고 닫는 대괄호로 끝난다. 즉 []안에 들어간다. 리스트 안의 값들은 아이템이라고 하며 쉼표로 구분한다.</p>
            <pre>>>> [1, 2, 3]<br>[1, 2, 3]<br>>>> ['cat', 'bat', 'rat', 'elephant']<br>['cat', 'bat', 'rat', 'elephant']<br>>>> ['hello', 3.1415, True, None, 42]
['hello', 3.1415, True, None, 42]<br>>>> spam = ['cat', 'bat', 'rat', 'elephant']<br>>>> spam<br>['cat', 'bat', 'rat', 'elephant']</pre>
          </p>

          <p>
            <h5><strong>■ 인덱스로 리스트에서 개별 값 얻기</strong></h5>
            <p>리스트는 쉼표로 구분하는 아이템(원소)에 대하여 0부터 시작하여 순서대로 1씩 증가하는 인덱스를 가진다. 인덱스는 정수 값만이 올 수 있으며 부동소수점 값은 올 수 없다.</p>
            <pre>>>> spam = ['cat', 'bat', 'rat', 'elephant']<br>>>> spam[0]<br>'cat'<br>>>> spam[1]<br>'bat'<br>>>> spam[2]<br>'rat'<br>>>> spam[3]<br>'elephant'</pre>
            <p>리스트는 다른 리스트 값을 포함할 수 있다. 리스트의 리스트 값은 다음 예와 같이 여러개의 인덱스로 사용할 수 있다.</p>
            <pre>>>> spam = [['cat', 'bat'], [10, 20, 30, 40, 50]]<br>>>> spam[0]<br>['cat', 'bat']<br>>>> spam[0][1]<br>'bat'<br>>>> spam[1][4]<br>50</pre>
          </p>

          <p>
            <h5><strong>■ 음수 인덱스</strong></h5>
            <p>인덱스는 0에서 시작해서 값이 올라기자만 인덱스로 음의 정수를 쓸 수도 있다. 정수 값 -1은 리스트의 마지막 값을 뜻하며, 값 -2는 리스트의 끝에서 두번째 값을 지정하는 식으로 이어진다.</p>
            <pre>>>> spam = ['cat', 'bat', 'rat', 'elephant']<br>>>> spam[-1]<br>'elephant'<br>>>> spam[-3]<br>'bat'<br>>>> 'The ' + spam[-1] + ' is afraid of the ' + spam[-3] + '.'<br>'The elephant is afraid of the bat.'</pre>
          </p>

          <p>
            <h5><strong>■ 슬라이스로 부분 리스트 얻기</strong></h5>
            <p>인덱스로 리스트의 단일 원소를 얻을 수 있는 것처럼, 슬라이스는 리스트에서 여러 값을 새로운 리스트 형태로 얻을 수 있다.</p>
            <p><strong>▶ spam[1:4:2]</strong> 콜론으로 구분하며 첫번째 정수는 시작 인덱스(첫번째인 경우 0부터 시작), 두번째 정수는 자신을 포함하지 않는 종료 인덱스, 세번째 정수는 증감값으로 모두 생략할 수 있다. 생략 시 각각 기본값은 [처음:끝:1]이다.</p>
            <pre>>>> spam = ['cat', 'bat', 'rat', 'elephant']<br>>>> spam[0:4]<br>['cat', 'bat', 'rat', 'elephant']<br>>>> spam[1:3]<br>['bat', 'rat']<br>>>> spam[0:-1]<br>['cat', 'bat', 'rat']</pre>
          </p>

          <p>
            <h5><strong>■ len()으로 리스트 길이 얻기</strong></h5>
            <p>len() 함수는 단일 문자열에 있는 글자의 수를 셀 수 있는 것처럼, 리스트를 전달 받으면 전달 리스트에 있는 원소의 개수를 반환한다.</p>
            <pre>>>> spam = ['cat', 'dog', 'moose']<br>>>> len(spam)<br>3</pre>
          </p>

          <p>
            <h5><strong>■ 인덱스로 리스트 안의 값 변경하기</strong></h5>
            <p>리스트 안의 원소 값을 바꾸려면 해당 원소의 인덱스를 함께 사용한다.</p>
            <pre>>>> spam = ['cat', 'bat', 'rat', 'elephant']<br>>>> spam[1] = 'aardvark'<br>>>> spam<br>['cat', 'aardvark', 'rat', 'elephant']<br>>>> spam[2] = spam[1]<br>>>> spam<br>['cat', 'aardvark', 'aardvark', 'elephant']
>>> spam[-1] = 12345<br>['cat', 'aardvark', 'aardvark', 12345]</pre>
          </p>

          <p>
            <h5><strong>■ 리스트의 병합 및 복제</strong></h5>
            <p>리스트는 문자열과 같이 + 연산자로 두 리스트를 결합해서 새로운 리스트 값을 만들고 * 연산자는 리스트와 정수값으로 리스트를 복제하는데 사용할 수 있다.</p>
            <pre>>>> [1, 2, 3] + ['A', 'B', 'C']<br>[1, 2, 3, 'A', 'B', 'C']<br>>>> ['X', 'Y', 'Z'] * 3<br>['X', 'Y', 'Z', 'X', 'Y', 'Z', 'X', 'Y', 'Z']<br>>>> spam = [1, 2, 3]<br>>>> spam = spam + ['A', 'B', 'C']<br>>>> spam<br>[1, 2, 3, 'A', 'B', 'C']</pre>
          </p>

          <p>
            <h5><strong>■ del 문으로 리스트에서 값 제거하기</strong></h5>
            <p>del 문은 리스트에서 인덱스에 해당하는 값을 삭제한다. 삭제한 값 뒤에 있는 모든 값들은 인덱스가 하나씩 앞으로 이동한다.</p>
            <pre>>>> spam = ['cat', 'bat', 'rat', 'elephant']<br>>>> del spam[2]<br>>>> spam<br>['cat', 'bat', 'elephant']<br>>>> del spam[2]<br>spam<br>['cat', 'bat']</pre>
          </p>

          <p>
            <h5><strong>■ 리스트와 함께 루프 사용하기</strong></h5>
            <p><strong>▶</strong> for 문의 지정 변수(i)로 리스트 요소를 출력하는 루프</p>
            <pre>>>> for i in ['A', 'B', 'C',]:<br>       print(i)<br>A<br>B<br>C</pre>
            <p><strong>▶</strong> for 문의 지정 변수(i)로 숫자를 출력하고 리스트[변수]로 리스트 요소를 출력하는 루프</p>
            <pre>>>> list = ['A', 'B', 'C',]<br>>>> for i in range(len(list)):<br>       print(i, list[i])<br>0 A<br>1 B<br>2 C</pre>
            <p><strong>▶</strong> for 문의 첫번째 지정 변수(i)로 숫자를 출력하고 두번째 지정 변수(v)로 리스트 요소를 출력하는 루프</p>
            <pre>>>> list = ['A', 'B', 'C',]<br>>>> for i, v in enumerate(list):<br>       print(i, v)<br>0 A<br>1 B<br>2 C</pre>
          </p>

          <p>
            <h5><strong>■ in 연산자와 not in 연산자</strong></h5>
            <p>in 연산자 not in 연산자를 쓰면 어떤 값이 리스트 안에 있는지 혹은 없는지 확인할 수 있다. 각각 두개의 값을 연결하는 표현식으로 하나는 리스트 안에서 찾을 값이며, 다른 하나는 리스트다. 이 표현식은 부울 값으로 평가된다.</p>
            <pre>>>> 'howdy' in ['hello', 'hi', 'howdy', 'heyas']<br>True<br>>>> spam = ['hello', 'hi', 'howdy', 'heyas']<br>>>> 'cat' in spam<br>False<br>>>> 'howdy' not in spam<br>False<br>>>> 'cat' not in spam<br>True</pre>
          </p>

          <p>
            <h5><strong>■ 다중 할당 기법</strong></h5>
            <p>다중 할당 기법은 한 줄의 코드로 리스트 안에 있는 값을 여러 변수에 할달할 수 있는 지름길이다.</p>
            <pre>>>> cat = ['fat', 'black', 'loud']<br>>>> size = cat[0]<br>>>> color = cat[1]<br>>>> disposition = cat[2]</pre>
            <p>위와 같이 하는 대신, 이래처럼 짧게 할 수 있다.</p>
            <pre>>>> cat = ['fat', 'black', 'loud']<br>>>> size, color, disposition = cat</pre>
            <p>변수의 개수와 리스트의 길이는 정확하게 일치해야 한다. 그렇지 않을 경우 파이썬은 ValueError 를 낼 것이다.</p>
          </p>

          <p>
            <h5><strong>■ 표 4-1 증강 할당 연산자</strong></h5>
            <table class="table table-hover table-condensed table table-bordered">
              <thead>
                <tr>
                  <td>증강 할당문</td><td>상응하는 할당문</td>
                </tr>
              </thead>
              <tbody>
                <tr><td>spam = spam + 1</td><td>spam += 1</td></tr>
                <tr><td>spam = spam - 1</td><td>spam -= 1</td></tr>
                <tr><td>spam = spam * 1</td><td>spam *= 1</td></tr>
                <tr><td>spam = spam / 1</td><td>spam /= 1</td></tr>
                <tr><td>spam = spam % 1</td><td>spam %= 1</td></tr>
              </tbody>
            </table>
          </p>

          <p>
            <h5><strong>■ 리스트와 유사한 데이터 : 문자열과 튜플</strong></h5>
            <p><strong>▶ 리스트와 문자열의 공통점</strong></p>
            <ul>
              <li>인덱스와 슬라이스를 사용할 수 있다.</li>
              <li>for 루프에서 활용할 수 있다.</li>
              <li>len() 함수를 사용할 수 있다.</li>
              <li>in 과 not in 연산자를 사용할 수 있다.</li>
            </ul>
            <p><strong>▶ 리스트와 문자열의 차이점</strong></p>
            <ul>
              <li>리스트의 값은 변경 가능한 데이터 유형이다. 즉, 값을 추가, 제거 또는 변경할 수 있다.</li>
              <li>문자열은 변경 불가능하다.</li>
            </ul>
            <p><strong>▶ 튜플 데이터 형식</strong></p>
            <ul>
              <li>튜플 데이터 형식은 두 가지 메소드를 제외하고는 리스트 데이터 유형과 거의 같다.</li>
              <li>대괄호[] 대신 괄호()로 유형이 정의된다.</li>
              <li>리스트와의 중요한 차이점은 문자열처럼 변경이 불가능하다는 점이다. 튜플은 값(요소)을 수정, 추가, 삭제할 수 없다.</li>
              <li>튜플에 값이 하나만 있을 경우 괄호 안의 값 다음을 쉼표로 끝내서 이를 표시할 수 있다. [('요소',) 이 경우 쉼표는 파이썬에게 이 데이터가 문자열이 아닌 튜플이라는 것을 알려준다.]</li>
            </ul>
            <p><strong>▶ list() 와 tuple() 함수로 유형 변환하기</strong></p>
            <pre>>>> tuple(['cat', 'dog', 5])<br>('cat', 'dog', 5)<br>>>> list(('cat', 'dog', 5))<br>['cat', 'dog', 5]<br>>>> list('hello')<br>['h', 'e', 'l', 'l', 'o']</pre>
          </p>

          <p>
            <h5><strong>■ 참조</strong></h5>
            <p>변수는 문자열과 정수값을 저장한다. 아래의 경우 spam 과 cheese 는 서로 다른 값을 저장하는 다른 변수이다.</p>
            <pre>>>> spam = 42<br>>>> cheese = spam<br>>>> spam = 100<br>>>> spam<br>100<br>>>> cheese<br>42</pre>
            <p>그러나 리스트는 위와 같이 되지 않는다. 변수에 리스트를 할당하면 실제로는 변수에 리스트의 참조를 할당하는 것이다. 참조는 어떤 데이터를 가리키는 값이며 리스트 참조는 리스트를 가리키는 값이다.</p>
            <pre>>>> spam = [0, 1, 2, 3, 4, 5]<br>>>> cheese = spam<br>>>> cheese[1] = 'Hello!'<br>>>> spam<br>[0, 'Hello!', 2, 3, 4, 5]<br>>>> cheese<br>[0, 'Hello!', 2, 3, 4, 5]</pre>
            <p>코드는 cheese 리스트만을 변경했지만 cheese 와 spam 리스트가 같이 변한 것처럼 보인다. spam 과 cheese 는 리스트에 대한 참조를 복사했을 뿐 리스트 값 자체를 복사한 것은 아니다. 이것은 cheese 와 spam 에 저장된 값은 둘 다 같은 리스트를 참조한다는 뜻이다.</p>
          </p>

          <p>
            <h5><strong>■ copy 모듈의 copy() 와 deepcopy() 함수</strong></h5>
            <p>참조를 전달하는 것은 리스트와 사전 데이터를 다루는 가장 편리한 방법일 수 있지만, 함수가 전달된 리스트나 사전을 수정하는 경우, 원래 리스트나 사전 값이 이러한 영향을 미치지 않는 것이 좋을 때도 있다. 이를 위해 파이썬은 copy() 와 deepcopy() 함수를 제공하는 copy라는 이름의 모듈을 제공한다. </p>
            <p>copy.copy() 함수는 리스트 또는 사전과 같은 변경 가능한 값의 참조를 복사하는 것이 아니라 리스트 또는 사전 자체의 사본을 만드는 데 쓰인다.</p>
            <pre>>>> import copy<br>>>> spam = ['A', 'B', 'C', 'D']<br>>>> cheese = copy.copy(spam)<br>>>> cheese[1] = 42<br>>>> spam<br>['A', 'B', 'C', 'D']<br>>>> cheese<br>['A', 42, 'C', 'D']</pre>
          </p>

          <p>
            <h5><strong>■ 관련 메소드</strong></h5>
            <ul>
              <li><strong>index()</strong> : list.indet(요소) 형식으로 사용. 리스트 값은 index() 메소드를 통해 값을 전달할 수 있으며, 해당 리스트 안에 값이 있을 경우 그 값의 인덱스를 반환하고, 그렇지 않을 경우 ValueError 를 반환한다.</li>
              <li><strong>append()</strong> : list.append(값) 형식으로 사용. 리스트에 새 값을 추가하려면 이 메소드를 사용한다. 이 메소드의 매개변수를 리스트의 마지막에 추가한다. </li>
              <li><strong>insert()</strong> : list.insert(인덱스, 값) 형식으로 사용. insert() 함수의 첫번째 매개변수는 추가할 값의 인덱스이고, 두번째 매개변수는 추가할 값이다.</li>
              <li><strong>remove()</strong> : list.remove(값) 형식으로 사용. 이 메소드를 부르면 리스트에서 제거할 값을 전달한다. 존재하지 않는 값을 전달할 경우 ValueError 를 반환하며 동일한 값이 여러번 나타날 경우 첫번째 값만 삭제한다. 참고로 del 문은 del list[index] 형식으로 제거할 값의 인덱스를 알고 있을 때 사용한다.</li>
              <li><strong>sort()</strong> : list.sort() 형식으로 사용. 숫자 또는 문자열의 리스트를 정렬한다. 오름차순 정렬이 기본값이며, 내림차순으로 정렬하려면 list.sort(reverse=True) 와 같이 매개변수를 전달한다. <br> - 주의 1. 호출한 리스트 자체를 정렬하므로 spam = spam.sort() 와 같이 반환값을 저장할 수 없으며, 정렬 값의 반환이 필요할 경우 sorted() 함수를 사용한다. <br> - 주의 2. 리스트에 숫자와 문자열이 함께 들어 있을 떼에는 정렬할 수 없다.(TypeError) <br> - 주의 3. sort() 는 문자열을 정렬할 때 실제 알파벳 순서가 아니라 'ASCII 코드 순서'를 사용한다. 그러므로 대문자들이 소문자들 앞에 온다.(a>Z) 만일 알파벳 순서로 값을 정렬해야 할 경우 list.sort(key=str.lower) 와 같이 매개변수를 전달한다.</li>
              <li><strong>list()</strong> : list(값) 형식으로 사용. 문자열 또는 튜플형식의 매개변수 데이터를 리스트 버전으로 반환한다.</li>
              <li><strong>tuple()</strong> : tuple(값) 형식으로 사용. 문자열 또는 리스트형식의 매개변수 데이트를 튜플 버전으로 반환한다.</li>
            </ul>
          </p>

          <p>
            <h5><strong>■ 연습 문제</strong></h5>
            <ul>
              <li>1. [] 기호는 무엇인가?</li>
              <li>2. spam 이라는 변수에 저장된 리스트의 세 번째 값에 'hello' 값을 할당하려면 어떻게 해야 하는가?(spam = [2, 3, 4, 8, 10]이라고 가정)</li>
              <li>3. spam = ['A', 'B', 'C', 'D']일때, spam[int('3'*2)/11]은 어떻게 평가되는가?</li>
              <li>4. spam = ['A', 'B', 'C', 'D']일때, spam[-1] 은 어떻게 평가되는가?</li>
              <li>5. spam = ['A', 'B', 'C', 'D']일때, spam[:2] 는 어떻게 평가되는가?</li>
              <li>6. bacon = [3.14, 'cat', 11, 'cat', True]일때, bacon.index('cat') 은 어떻게 평가되는가?</li>
              <li>7. bacon = [3.14, 'cat', 11, 'cat', True]일때, bacon.append(99)는  bacon 안에 있는 리스트 값을 어떻게 보이게 만드는가?</li>
              <li>8. bacon = [3.14, 'cat', 11, 'cat', True]일때, bacon.remove('cat')은 bacon 안에 있는 리스트 값을 어떻게 보이게 만드는가?</li>
              <li>9. 리스트 연결과 리스트 복제를 위한 연산자는 무엇인가?</li>
              <li>10. append()와 insert() 리스트 메소드의 차이는 무엇인가?</li>
              <li>11. 리스트에서 값을 제거하는 두 가지 방법은 무엇인가?</li>
              <li>12. 리스트 값과 문자열 값이 비슷한 점 몇가지를 이야기해 보라.</li>
              <li>13. 리스트와 튜플의 차이점은 무엇인가?</li>
              <li>14. 정수값 42 하나만 가지는 튜플은 어떻게 만드는가?</li>
              <li>15. 어떻게 리스트 값의 튜플 형식을 얻을 수 있는가? 어떻게 튜플 값의 리스트 형식을 얻을 수 있는가?</li>
              <li>16. 리스트 값을 "포함"하는 변수는 실제로는 리스트를 직접 포함하지 않는다. 대신에 어떤 값을 포함하고 있는가?</li>
              <li>17. copy.copy()와 copy.deepcopy()의 차이점은 무엇인가?</li>
            </ul>
          </p>

        </article>
      </section>
    </div>
