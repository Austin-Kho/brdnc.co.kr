    <h4 class="heading"><a>5장 사전(dictionary) 및 구조화 데이터</a></h4>
    <div class="chapter">
      <section>
        <article class="">
          <p>
            <h5><strong>■ 사전 데이터 유형</strong></h5>
            <p>리스트와 마찬가지로 사전(dictionary)은 많은 값의 모음이다. 그러나 리스트의 인덱스와는 달리 사전의 인덱스는 정수만이 아닌 다양한 데이터 유형을 사용할 수 있다.<br>사전을 위한 인덱스를 키(key)라고 하며, 키와 그에 연관된 값을 키-값 쌍(key-value pair)이라고 한다. 코드에서 사전은 중괄호 { }로 정의된다.</p>
            <pre>>>> myCat = {'size': 'fat', 'color': 'gray', 'disposition': 'loud'}<br>>>> myCat['size']<br>'fat'<br>>>> 'My cat has ' + myCat['color'] + ' fur.'<br>'My cat has gray fur.'</b></pre>
          </p>

          <p>
            <h5><strong>■ 사전과 리스트의 차이</strong></h5>
            <p>리스트와는 달리 사전의 아이템들은 순서가 없다.</p>
            <pre>>>> spam = ['cats', 'dogs', 'moose']<br>>>> bacon = ['dogs', 'moose', 'cats']<br>>>> spam == bacon<br><strong>False</strong>
              <br>>>> eggs = {'name': 'Zophie', 'species': 'cat', 'age': '8'}<br>>>> ham = {'species': 'cat', 'age': '8', 'name': 'Zophie'}<br>>>> eggs == ham<br><strong>True</strong>
            </pre>
          </p>

          <p>
            <h5><strong>■ 키 또는 값이 사전에 존재하는지 확인하기</strong></h5>
            <p>리스트에서와 같이 사전에서도 in 연산자와 not in 연산자로 특정 키 또는 값이 사전에 존재하는지 여부를 확인할 수 있다.</p>
            <pre>>>> spam = {'name': 'Zophie', 'age': 7}<br>>>> 'name' in spam.keys()<br>True<br>>>> 'Zophie' in spam.values()<br>True<br>'color' in spam.keys()<br>False<br>'color' not in spam.keys()<br>True<br>>>> 'color' in spam<br>False</pre>
          </p>

          <p>
            <h5><strong>■ get() 메소드와 setdefault() 메소드</strong></h5>
            <p><strong>▶ get()</strong> : 키의 값을 사용할 때마다 그 전에 사전에 키가 존재하는지 여부를 확인하려면 귀찮을 것이다. 다행히도 사전에는 두개의 매개변수를 가지는 get() 메소드가 있다. 하나는 가져올 값의 키이며, 다른 하나는 키가 존재하지 않을 때 대신 돌려줄 값이다.</p>
            <pre>>>> picnicItems = {'apples': 5, 'cups': 2}<br>>>> 'I am bringing ' + str(picnicItems.get('cups', 0)) + ' cups.'<br>'I am bringing 2 cups.'<br>>>> 'I am bringing ' + str(picnicItems.get('eggs', 0)) + ' eggs.'<br>'I am bringing 0 eggs.'</pre>
            <p><strong>▶ setdefault()</strong> : 사전 안의 어떤 특정한 키에 이미 값이 존재하지 않는 경우에만 그 키에 값을 설정할 때가 종종 있다.</p>
            <pre>>>> spam = {'name': 'Pooka', 'age': 5}<br>>>> if 'color' not in spam:<br>        spam['color'] = 'black'</pre>
            <p>setdefault() 메소드는 한 줄의 코드에서 이러한 작업을 수행할 수 있는 방법을 제공한다. 메소드에 전달되는 첫 번째 매개변수는 검사할 키이며, 두 번째 매개변수는 키가 존재하지 않을 때 해당 키에 설정할 수 있는 값이다. 키가 존재하는 경우 setdefault() 메소드는 키의 값을 돌려준다.</p>
            <pre>>>> spam = {'name': 'Pooka', 'age': 5}<br>>>> spam.setdefault('color', 'black')<br>'black'<br>>>> spam<br>{'color': 'black', 'age': 5, 'name': 'Pooka'}
              <br>>>> spam.setdefault('color': 'white')<br>'black'<br>>>> spam<br>{'color': 'black', 'age': 5, 'name': 'Pooka'}</pre>
          </p>

          <p>
            <h5><strong>■ 관련 모듈</strong></h5>
            <ul>
              <li><strong>import pprint</strong> : pprint.pprint(dict) 사전을 키와 값으로 정렬하여 보기 좋게 출력하여 준다.</li>
            </ul>
          </p>

          <p>
            <h5><strong>■ 관련 메소드</strong></h5>
            <ul>
              <li><strong>keys()</strong> : 사전명.keys() 형식으로 사용하며 해당 사전의 key 데이터를 추출한다.</li>
              <li><strong>values()</strong> : 사전명.values() 형식으로 사용하며 해당 사전의 value 데이터를 추출한다.</li>
              <li><strong>items()</strong> :  사전명.items() 형식으로 사용하며 해당 사전의 key와 value 데이터를 추출한다.(dict_items[('key1', 'value1'), ('key2', 'value2')]형식의 튜플로 반환)</li>
              <li><strong>get()</strong> : 사전명.get('key', 'defaultValue') 형식으로 사용하며 해당 사전의 키와 값을 가져오는데, 첫번째 인자로 가져올 값의 키, 두번째 인자로 해당 키가 없을 때 가져올 기본 값을 사용한다.</li>
              <li><strong>setdefault()</strong> : 사전명.setdefault('key', 'value') 형식으로 사용하며 해당 사전 안에 어떤 특정한 키에 값이 존재하지 않는 경우에만 그 키에 값을 설정한다. 첫 번째 매개변수는 검사할 키이며, 두 번째 매개변수는 키가 존재하지 않을 때 해당 키에 설정할 수 있는 값이다. 키가 존재하는 경우 setDefault() 메소드는 키의 값을 돌려준다.</li>
            </ul>
          </p>

          <p>
            <h5><strong>■ 연습 문제</strong></h5>
            <ul>
              <li>1. 빈 사전의 코드는 어떤 모습인가?</li>
              <li>2. 키 'foo'와 값 42인 사전 값은 어떤 모습인가?</li>
              <li>3. 사전과 리스트의 주요한 차이점은 무엇인가?</li>
              <li>4. spam 이 {'bar': 100}이라고 했을 때 spam['foo']를 사용하려고 하면 어떤 일이 일어나는가?</li>
              <li>5. 사전이 spam에 저장되어 있는 경우, 'cat' in spam과 'cat' in spam.keys()의 차이는 무엇인가?</li>
              <li>6. 사전이 spam에 저장되어 있는 경우, 'cat' in spam과 'cat' in spam.values()의 차이는 무엇인가?</li>
              <li>7. 다음 코드를 짧게 줄이는 방법은?</li>
              <pre>if 'color' not in spam:<br>    spam['color'] = 'black'</pre>
              <li>8. 사전 값을 '보기 좋게 출력하는'데 쓰일 수 있는 모듈과 함수는 무엇인가?</li>
            </ul>
          </p>
        </article>
      </section>
    </div>
