    <h4 class="heading"><a>5장 사전(dictionary) 및 구조화 데이터</a></h4>
    <div class="chapter">
      <section>
        <article class="">
          <p>
            <h5><strong>■ 사전 데이터 유형</strong></h5>
            <p>리스트와 마찬가지로 사전(dictionary)은 많은 값의 모음이다. 그러나 리스트의 인덱스와는 달리 사전의 인덱스는 정수만이 아닌 다양한 데이터 유형을 사용할 수 있다.<br>사전을 위한 인덱스를 키(key)라고 하며, 키와 그에 연관된 값을 키-값 쌍(key-value pair)이라고 한다. 코드에서 사전은 중괄호 { }로 정의된다.</p>
            <pre class="brush:xml">>>> myCat = {'size': 'fat', 'color': 'gray', 'disposition': 'loud'}</pre>
            <p>위 코드는 myCat 변수에 사전을 할당한다. 사전의 키는 'size', 'color', 'disposition' 이다. 이들키에 대한 값은 각각 'fat', 'gray', 'loud'다. 이들 키를 통해 값을 사용할 수 있다.</p>
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
