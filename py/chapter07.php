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
            <pre>Phone number found: 415-555-1011<br>Phone number found: 415-555-9999<br>Done</pre>
          </p>

          <p>
            <h5><strong>■ 정규표현식으로 텍스트 패턴 찾기</strong></h5>
            <p>위 프로그램은 잘 동작하지만 무언가 제한적인 기능을 찾기 위해 많은 코드를 사용한다. isPhoneNumber() 함수는 17줄이지만 한 가지 패턴의 전화번호만 찾아낸다. 415.555.4242 또는 (415) 555-4242 같은 형식을 찾기 위해서는 별도의 코드가 또 필요하다.</p>
            <p>더 쉬운 방법이 있다. 정규표현식(Regular Expression), 짧게는 정규식(Regexe)은 텍스트의 패턴에 대한 설명이다. 예를 들어 정규식에서 \d는 한 글자의 숫자, 즉 0부터 9까지의 숫자 하나를 뜻한다. 파이썬에서 정규식 \d\d\d-\d\d\d-\d\d\d\d는 isPhoneNumber() 함수가 했던 것과 같은 텍스트 대조 작업을 할 수 있다. 숫자와 하이픈으로 이루어진 패턴, 정규표현식은 이보다 더 정교할 수 있다. 예를 들어 패턴 뒤에 중괄호에 3을 추가하면({3}) '이 패턴을 세 번 대조하라' 고 지시하는 것과 같다. 따라서 짧게 \d{3}-\d{3}-\d{4}와 같이 써도 올바른 전화번호 형식과 일치한다.</p>
          </p>

          <p>
            <h5><strong>▶ 정규식 객체 만들기</strong></h5>
            <p>파이썬의 모든 정규식 기능은 re모듈에 있다.</p>
            <pre>>>> import re</pre>
            <p>정규표현식을 나타내는 문자열 값을 re.compile()에 전달하면 Regex 패턴 객체(또는 단순히 Regex 객체)를 돌려받는다. 다음과 같이 전화번호 패턴과 일치하는 Regex 객체를 만들 수 있다. 아래 phoneNumRegex 변수는 정규식 객체를 포함하고 있다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'\d\d\d-\d\d\d-\d\d\d\d')</pre>
            <p>❖ 파이썬은 백슬래시(\)를 이스케이프 문자로 사용하므로 실제 하나의 백슬래시를 입력하려면 이스케이프 문자를 포함한 두 개의 백슬래시(\\)를 입력해야 한다. 정규표현식은 자주 백슬래시를 사용하기 때문에, 이스케이프하기 위해 백슬래시를 하나씩 더 붙일 필요없이 re.compile() 함수에 원시 문자열을 전달하면 편리하다. r'\d\d\d-\d\d\d-\d\d\d\d'라고 입력하는 것이 '\\d\\d\\d-\\d\\d\\d-\\d\\d\\d\\d'보다는 편할 것이다.</p>
          </p>

          <p>
            <h5><strong>▶ Regex 객체 대조</strong></h5>
            <p>Regex 객체의 search() 메소드는 전달되는 문자열이 정규식과 일치하는지 검색한다. 정규식 패턴이 문자열에서 발견되지 않는다면 search() 메소드는 None 을 돌려준다. 패턴이 발견되면, search() 메소드는 Match 객체를 돌려준다. Match 객체는 검색 문자열에서 실제 일치하는 텍스트를 돌려주는 group() 메소드를 가지고 있다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'\d\d\d-\d\d\d-\d\d\d\d')<br>>>> mo = phoneNumRegex.search('My number is 415-555-4242.')<br>>>> print('Phone number found: ' + mo.group())<br>Phone number found: 415-555-4242</pre>
            <p>mo 변수는 Match 객체에 사용되는 일반적인 이름이다. 위의 코드는 원하는 패턴을 re.compile()에 전달하고 결과로 나오는 Regex 객체를 phoneNumRegex에 저장한다. <br>그 다음 phoneNumRegex의 search() 를 호출하고 일치하는 패턴이 있는지 검색할 문자열을 search()에 전달한다. 검색 결과는 mo 변수에 저장한다. 위 예제는 해당 패턴이 존재하므로 None이 아닌 Match 객체를 반환하므로 mo 에 group()함수를 호출해서 일치하는 텍스트를 돌려받을 수 있다.</p>
          </p>

          <p>
            <h5><strong>▶ 정규표현식 일치 다시 살펴보기</strong></h5>
            <p>파이썬에서 정규표현식을 사용하려면 여러 단계를 거쳐야 하지만 각 단계는 매우 간단하다.</p>
            <ul>
              <li>import re로 정규식 모듈을 가져온다.</li>
              <li>re.compile() 함수로 Regex 객체를 만든다. (원시 문자열을 사용해야 한다는 점을 기억한다.)</li>
              <li>검색할 문자열을 Regex 객체의 search() 메소드로 전달한다. 이렇게 하면 Match 객체를 돌려받는다.</li>
              <li>Match 객체의 group() 메소드를 호출해서 실제 일치하는 텍스트 문자열을 돌려받는다.</li>
            </ul>
          </p>

          <p>
            <h5><strong>■ 정규표현식을 사용한 더 많은 패턴 대조</strong></h5>
            <p>위와 같이 파이썬으로 정규표현식 객체를 만들고 검색하기 위한 기본 단계를 알았으나, 더 강력한 패턴 대조 기능 중 일부을 알아보자.</p>
          </p>

          <p>
            <h5><strong>▶ 괄호로 묶기</strong></h5>
            <p>전화번호에서 지역 코드를 나머지 번호로부터 분리하고 싶다고 가정해 보자. 다음과 같이 괄호를 추가하면 정규식에서 그룹이 만들어진다. (\d\d\d)-(\d\d\d-\d\d\d\d) 이렇게 하면 Match 객체의 group() 메소드로 일치하는 텍스트에서 단 하나의 그룹만을 가져올 수 있다. 각각의 괄호 세트는 각각 그룹1, 그룹2가 되며 필요한 부분만을 가져올 수 있다. group() 메소드에 0을 전달하거나 아무 것도 전달하지 않으면 전체 텍스트를 돌려준다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'(\d\d\d)-(\d\d\d-\d\d\d\d)')<br>>>> mo = phoneNumRegex.search('My number is 415-555-4242.')<br>>>> mo.group(1)<br>'415'<br>>>> mo.group(2)<br>'555-4242'<br>mo.group()<br>'415-555-4242'</pre>
            <p>모든 그룹을 한 번에 가져오려면 groups() 메소드를 사용한다. 이름이 복수형이라는 점에 유의하여야 한다.</p>
            <pre>>>> mo.groups()<br>('415', '555-4242')<br>>>> areaCode, mainNumber = mo.groups()<br>>>> print(areaCode)<br>415<br>>>> print(mainNumber)<br>555-4242</pre>
            <p>mo.groups() 메소드는 여러 값의 튜플을 돌려주므로 areaCode, mainNumber = mo.groups()와 같이 별개의 변수에 각각의 값을 할당하는 다중 할당 기법을 사용할 수 있다. 괄호는 정규표현식에서 특별한 의미를 가지고 있지만 텍스트에서 괄호를 찾아야 할 경우 백슬래시 문자로 '('와 ')'를 이스케이프해야 한다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'(\(\d\d\d\)) (\d\d\d-\d\d\d\d)')<br>>>> mo = phoneNumRegex.search('My number is (415) 555-4242.')<br>>>> mo.group(1)<br>'(415)'<br>>>> mo.group(2)<br>'555-4242'</pre>
            <p>re.compile() 에 전달된 원시 문자열의 \(와 \) 이스케이프 문자는 실제 괄호 글자들과 일치한다.</p>
          </p>

          <p>
            <h5><strong>▶ 파이프로 여러 그룹 대조하기</strong></h5>
            <p>'|' 글자는 파이프라고 한다. 여러 가지 표현 중 하나만 일치해도 되는 곳이라면 어디서든 이 글자를 쓸 수 있다. 예를 들어, 정규표현식 r'Batman|Tina Fey'는 'Betman' 또는 'Tina Fey' 중 하나와 일치한다. Batman 과 Tina Fey 가 모두 검색 문자열에 나타난다면 처음으로 일치하는 텍스트가 Match 객체로 반환된다.</p>
            <pre>>>> heroRegex = re.compile(r'Batman|Tina Fey')<br>>>> mo1 = heroRegex.search('Batman and Tina Fey')<br>>>> mo1.group()<br>'Batman'
            <br>>>> mo2 = heroRegex.search('Tina Fey and Batman')<br>>>> mo2.group()<br>'Tina Fey'</pre>
            <p>정규식의 일부로서 여러 패턴들 중 하나와 일치할 수 있도록 파이프를 사용할 수 있다. 예를 들어 'Batman', 'Batmobile', 'Batcopter', 'Batbat' 문자열 중 어느 것과든 일치하는 것을 찾고 싶은 경우 모든 문자열이 Bat 로 시작하기 때문에 이 접두어를 한 번만 쓸 수 있도록 지정하는 것이 좋다.</p>
            <pre>>>> batRegex = re.compile(r'Bat(man|mobile|copter|bat)')<br>>>> mo = batRegex.search('Batmobile lost a wheel')<br>>>> mo.group()<br>'Batmobile'<br>>> mo.group(1)<br>'mobile'</pre>
            <p>mo.group() 메소드는 완전히 일치하는 텍스트인 'Batmobile'을 돌려주었고, mo.group(1) 호출은 첫 번째 괄호 그룹 안에서 일치하는 텍스트 부분인 'mobile'만을 돌려주었다. 참고로 실제 파이프 글자와 일치해야 할 때에는 \|와 같이 백슬래시로 이스케이프 해야한다.</p>
          </p>

          <p>
            <h5><strong>▶ 물음표와 선택적 대조</strong></h5>
            <p>가끔 선택적으로 대조해야 할 패턴이 있다. 즉, 텍스트에서 어떤 조각이 있는지 없는지 여부를 대조해 보는 정규식 같은 것들이다. '?'글자는 그 앞에 있는 그룹이 패턴의 선택적인 부분이라는 것을 뜻한다.</p>
            <pre>>>> batRegex = re.compile(r'Bat(wo)?man')<br>>>> mo1 = batRegex.search('The Adventures of Batman')<br>>>> mo1.group()<br>'Batman'
              <br>>>> mo2 = batRegex.search('The Adventures of Batwoman')<br>>>> mo2.group<br>'Batwoman'</pre>
            <p>정규표현식의 (wo)? 부분은 패턴이 선택적 그룹이라는 것을 뜻한다. 이 정규식은 wo가 없거나 한 번 나타나는 텍스트와 일치한다. 그 때문에 이 정규식은 'Batwoman', 'Batman'과 모두 일치 한다. 이전 전화번호 예제를 사용하여 지역 코드가 있거나 없는 전화번호를 찾는 정규식을 만들 수 있다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'(\d\d\d)?\d\d\d-\d\d\d\d')<br>>>> mo1 = phoneNumRegex.search('My number is 415-555-4242.')<br>>>> mo1.group()<br>'415-555-4242'
            <br>>>> mo2 = phoneNumRegex.search('My number is 555-4242.')<br>>>> mo2.group()<br>'555-4242'</pre>
            <p>'?' 글자를 '그 앞에 있는 그룹이 0번 또는 1번 나타나면 일치한다.'는 뜻으로 볼 수 있다. 참고로 실제 물음표(?) 글자와 일치해야 할 때에는 \?로 이스케이프 시킨다. </p>
          </p>

          <p>
            <h5><strong>▶ 별표로 0개 또는 그 이상과 일치시키기</strong></h5>
            <p>*(별표라고도 함) 표시는 '0개 또는 그 이상과 일치'를 뜻한다. 곧, 별표 앞에 있는 그룹이 텍스트 안에서 몇 번이든 나타날 수 있다. 완전히 없을 수도, 몇 번이든 반복해서 나타날 수 도 있는 것이다.</p>
            <pre>>>> batRegex = re.compile(r'Bat(wo)*man')<br>>>> mo1 = batRegex.search('The Adventures of Batman')<br>>>> mo1.group()<br>'Batman'
              <br>>>> mo2 = batRegex.search('The Adventures of Batwoman')<br>>>> mo2.group()<br>'Batwoman'
              <br>>>> mo3 = batRegex.search('The Adventures of Batwowowowoman')<br>>>> mo3.group()<br>'Batwowowowoman'</pre>
            <p>위의 예제의 경우, 정규식의 (wo)* 부분은 문자열에서 wo가 0번, 1번 또는 여러 번 나타나므로 모두 일치한다. 참고로 실제 별표(*) 글자와 일치해야 할 때에는 정규식 안에 백슬래시와 함께 \*로 쓴다.</p>
          </p>

          <p>
            <h5><strong>▶ 더하기 기호로 1개 또는 그 이상과 일치시키기</strong></h5>
            <p>*(별표)표시가 '0개 이상과 일치'를 뜻하는 반면, +(더하기라고도 함) 표시는 '1개 또는 그 이상과 일치'를 뜻한다. 별표와 달리 더하기 기호는 그 앞에 나오는 그룹이 적어도 한 번 이상 나타나야 한다.</p>
            <pre>>>> batRegex = re.compile(r'Bat(wo)+man')<br>>>> mo1 = batRegex.search('The Adventures of Batwoman')<br>>>> mo1.group()<br>'Batwoman'
              <br>>>> mo2 = batRegex.search('The Adventures of Batwowowowoman')<br>>>> mo2.group()<br>'Batwowowowoman'
              <br>>>> mo3 = batRegex.search('The Adventures of Batman')<br>>>> mo3 == None<br>True</pre>
            <p>Bat(wo)+man 정규식은 'The Adventures of Batman'문자열과는 일치하지 않는다. wo뒤에 +기호가 있으므로 적어도 한 번은 나타나야 하기 때문이다. 참고로 실제 더하기(+) 글자와 일치해야 할 때에는 정규식 안에 백슬래시와 함께 \+로 쓴다.</p>
          </p>

          <p>
            <h5><strong>▶ 중괄호로 특정 횟수 반복 일치 시키기</strong></h5>
            <p>특정한 횟수동안 반복되는 그룹이 있다면 정규식 안에서 그 그룹 뒤에 중괄호와 함께 횟수를 쓴다. 예를 들면 정규식 (Ha){3}은 'HaHaHa' 문자열과 일치하지만 'HaHa' 와는 일치하지 않는다. 중괄호 안에 하나의 숫자만 쓰는 대산 최소값, 쉼표, 최대값을 씀으로써 범위를 지정할 수도 있다. 예를 들어 (Ha){3,5} 정규식은 'HaHaHa', 'HaHaHaHa', 'HaHaHaHaHa'와 일치한다. 또한 중괄호의 첫 번째 또는 두 번째 번호를 비워서 최소값 또는 최대값을 비울 수도 있다.
            <br>예를 들어 (Ha){3,} 정규식은 (Ha)그룹이 세 번 이상 나타나면 일치하며, 반면 (Ha){,5} 정규식은 그룹이 5번 이하로 나타나면 일치한다.</p>
            <pre>(Ha){3}<br>(Ha)(Ha)(Ha)</pre>
            <p>위 두 정규표현식은 같은 패턴과 일치한다.</p>
            <pre>(Ha){3,5}<br>((Ha)(Ha)(Ha)|(Ha)(Ha)(Ha)(Ha)|(Ha)(Ha)(Ha)(Ha)(Ha))</pre>
            <p>위 두 정규표현식도 같은 패턴과 일치한다.</p>
            <pre>>>> haRegex = re.compile(r'(Ha){3}')<br>>>> mo1 = haRegex.search('HaHaHa')<br>>>> mo1.group()<br>'HaHaHa'
              <br>>>> mo2 = haRegex.search('Ha')<br>>>> mo2 == None<br>True</pre>
            <p>여기서 (Ha){3}은 'HaHaHa'와는 일치하지만 'Ha'와는 일치하지 않는다. 'Ha'와는 일치하지 않으므러 search() 는 None 값을 돌려준다.</p>
          </p>

          <p>
            <h5><strong>■ 최대 일치와 최소 일치</strong></h5>
            <p>파이썬의 정규표현식은 기본적으로 최대 일치다. 즉 모호한 상황에서는 가능한 가장 긴 문자열과 일치하는 것을 뜻한다. 될 수 있는 대로 가장 짧은 문자열과 일치하는, 중괄호의 최소 일치 버전을 사용하려면 중괄호의 뒤에 물음표를 놓는다.</p>
            <pre>>>> greedyHaRegex = re.compile(r'(Ha){3,5}')<br>>>> mo1 = greedyHaRegex.search('HaHaHaHaHa')<br>>>> mo1.group()<br>'HaHaHaHaHa'
              <br>>>> nongreedyHaRegex = re.compile(r'(Ha){3,5}?')<br>>>> mo2 = nongreedyHaRegex.search('HaHaHaHaHa')<br>>>> mo2.group()<br>'HaHaHa'</pre>
              <p>물음표는 정규표현식에서 두 가지 의미를 가질 수 있다는 점에 유의한다. 물음표는 최소 일치를 의미할 수도 있고 선택적 그룹을 뜻할 수도 있다. 이들 두 가지 의미는 서로 전혀 관련이 없다.</p>
          </p>

          <p>
            <h5><strong>■ findall() 메소드</strong></h5>
            <p>Regex 객체는 search() 메소드 말고도 findall() 메소드를 가지고 있다. search() 메소드는 검색하는 문자열에서 처음으로 나타나는 일치하는 텍스트의 Match 개체를 돌려주지만 findall() 메소드는 검색 문자열에서 나타나는 일치하는 모든 문자열을 돌려준다. search() 메소드가 돌려주는 Match 객체를 보자.</p>
            <pre>>>> phoneNumRegex = re.compile(r'\d\d\d-\d\d\d-\d\d\d\d')<br>>>> mo = phoneNumRegex.search('Cell: 415-555-9999 Work: 212-555-0000')<br>>>> mo.group()<br>'415-555-9999'</pre>
            <p>한편 findall()은 Match 객체가 아니라 문자열의 리스트를 돌려준다. 정규표현식 안에 그룹이 없는 한은 그렇다. 리스트의 각 문자열은 검색 텍스트에서 정규표현식과 일치하는 부분들이다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'\d\d\d-\d\d\d-\d\d\d\d') # has no groups<br>>>> phoneNumRegex.findall('Cell: 415-555-9999 Work: 212-555-0000')<br>['415-555-9999', '212-555-0000']</pre>
            <p>정규표현식 안에 그룹이 있을 경우 findall()은 튜플의 리스트를 돌려준다. 각 튜플은 발견된 일치 부분을 뜻하고, 각 튜플의 아이템은 정규표현식의 각 그룹과 일치되는 문자열을 뜻한다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'(\d\d\)-(\d\d\d)-(\d\d\d\d)')   # has groups<br>>>> phoneNumRegex.findall('Cell: 415-555-9999 Work: 212-555-0000')<br>[('415', '555', '9999'), ('212', '555', '0000')]</pre>
            <p>위의 예와 같이 findall() 메소드는 그룹이 없는 정규식에서는 리스트를, 그룹이 있는 정규식에서는 튜플의 리스트를 돌려준다.</p>
          </p>

          <p>
            <h5><strong>■ 문자 클래스</strong></h5>
            <p>앞의 예에서 \d가 무엇이든 숫자 한 글자를 나타낸다는 것을 배웠다. 즉 \d는 (0|1|2|3|4|5|6|7|8|9)의 짧은 버전이다. 다음 표는 그와 같은 기타 문자 클래스이다.</p>

            <h5><strong>▶ 표 7-1 널리 쓰이는 짧은 버전의 문자 클래스</strong></h5>
            <table class="table table-hover table-condensed table table-bordered">
              <thead>
                <tr>
                  <td>짧은 문자</td><td>클래스 의미</td>
                </tr>
              </thead>
              <tbody>
                <tr><td>\d</td><td>0에서 9까지의 임의의 숫자 글</td></tr>
                <tr><td>\D</td><td>0에서 9까지의 숫자가 아닌 모든 글자</td></tr>
                <tr><td>\w</td><td>문자, 숫자 글자, 또는 밑줄 글자.(이 클래스를 '단어'를 이루는 글자와 일치한다고 생각하라)</td></tr>
                <tr><td>\W</td><td>문자, 숫자 글자, 또는 밑줄 글자가 아닌 모든 글자.</td></tr>
                <tr><td>\s</td><td>빈칸, 탭 또는 줄바꿈 문자.(이 클래스를 '빈칸'을 이루는 글자와 일치한다고 생각하라)</td></tr>
                <tr><td>\S</td><td>빈칸, 탭 또는 줄바꿈 문자가 아닌 모든 글자.</td></tr>
              </tbody>
            </table>
            <p>문자 클래스는 정규표현식을 단축하기 위한 좋은 수단이다. 문자 클래스[0-5]는 숫자 0에서 5까지만 일치한다. (0|1|2|3|4|5)를 입력하는 것보다 훨씬 짧다.</p>
            <pre>>>> xmasRegex = re.compile(r'\d+\s\w+')<br>>>> xmasRegex.findall('12 drummers, 11 pipers, 10 lords, 9 ladies, 8 maids, 7 swans, 6 geese, 5 rings, 4 birds, 3 hens, 2 doves, 1 partridge')
['12 drummers', '11 pipers', '10 lords', '9 ladies', '8 maids', '7 swans', '6 geese', '5 rings', '4 birds', '3 hens', '2 doves', '1 partridge']</pre>
            <p>정규표현식 \d+\s\w+는 하나 또는 그보다 많은 숫자 글자(\d+), 그 다음에 공백문자(\s), 그 다음에 하나 또는 그보다 많은 믄자/숫자/밑줄 글자(\w+)를 가진 텍스트와 일치한다. findall() 메소드는 정규식 패턴과 일치하는 모든 문자열을 리스트에 담아 돌려준다.</p>
          </p>

          <p>
            <h5><strong>■ 사용자 정의 문자 클래스 만들기</strong></h5>
            <p>어떤 문자의 집합과 대조할 때 짧은 버전의 문자 클래스(\d,\w,\s 같은 것들)는 너무 광범위할 수 있다. 대괄호를 사용하면 사용자 정의 문자 클래스를 정의할 수 있다. 예를 들어 문자 클래스 [aeiouAEIOU]는 대문자든 소문자든 모든 영어 모음과 일치한다.</p>
            <pre>>>> vowelRegex = re.compile(r'[aeiouAEIOU]')<br>>>> vowelRegex.findall('RoboCop eats baby food. BABY FOOD.')<br>['o', 'o', 'o', 'e', 'a', 'a', 'o', 'o', 'A', 'O', 'O']</pre>
            <p>또한 하이픈을 사용하여 문자 또는 숫자의 범위를 포함할 수도 있다. 예를 들어 [a-zA-Z0-9]문자 클래스는 소문자, 대문자, 숫자와 모두 일치한다. 대괄호 안에서는 일반 정규식 기호가 그 기호의 뜻으로 해석되지 않는다는 점에 유의한다. 즉, *, ? 또는 ()글자 앞에 백슬래시를 두어 이스케이프할 필요가 없다는 뜻이다. 예를 들어 문자 클래스 [0-5.]는 숫자 0에서 5까지, 그리고 마침표와 일치한다. [0-5/.]처럼 할 필요는 없다.
            <br>여는 괄호 뒤에 캐럿 문자(^)를 두면 부정형 문자 클래스를 만들 수 있다. 부정형 문자 클래스는 문자 클래스에 없는 모든 문자와 일치한다.</p>
            <pre>>>> consonantRegex = re.compile(r'[^aeiouAEIOU]')<br>>>> consonantRegex.findall('RoboCop eats baby food. BABY FOOD.')<br>['R', 'b', 'c', 'p', ' ', 't', 's', ' ', 'b', 'b', 'y', ' ', 'f', 'd', '.', ' ', 'B', 'B', 'Y', ' ', 'F', 'D', '.']</pre>
            <p>이제 모든 모음과 일치하는 패턴 대신 모음이 아닌 모든 글자와 일치하는 패턴이 되었다.</p>
          </p>

          <p>
            <h5><strong>■ 캐럿과 달러 기호 글자</strong></h5>
            <p>검색 텍스트의 시작 부분에서 일치하는 텍스트가 나타나야 한다는 것을 주문하기 위해 정규식 앞머리에 캐럿 기호(^)를 사용할 수 있다. 마찬가지로 문자열이 정규식 패턴으로 끝나야 한다는 것을 지시하기 위해 정규식의 끝에 달러 기호($)를 붙일 수 있다. 또한 전체 문자열이 정구식과 일치해야 한다는 것을 지시하기 위해 ^기호와 $기호를 함께 쓸 수도 있다. 즉 문자열의 일부 부분만이 일치하는 것으로는 부족하다는 뜻이다. r'^Hello' 정규표현식 문자열은 'Hello'로 시작되는 문자열과 일치한다.</p>
            <pre>>>> beginsWithHello = re.compile(r'^Hello')<br>>>> beginsWithHello.search('Hello world')<br><_sre.SRE_Match object; span=(0, 5), match='Hello'><br>>>> beginsWithHello.search('He said hello.') == None<br>True</pre>
            <p>r'\d$' 정규표현식 문자열은 0에서 9까지의 숫자 글자로 끝나는 문자열과 일치한다.</p>
            <pre>>>> endWithNumber = re.compile(r'\d+$')<br>>>> endWithNumber.search('Your number is 42')<br><_sre.SRE_Match object; span=(16, 17), match='2'><br>>>> endWithNumber.search('Your number is forty two.') == None<br>True</pre>
            <p>r'^\d$' 정규표현식 문자열은 하나 또는 그보다 많은 숫자 글자로 시작하고 끝나는 문자열과 일치한다.</p>
            <pre>>>> wholeStringIsNum = re.compile(r'^\d+$')<br>>>> wholeStringIsNum.search('1234567890')<br><_sre.SRE_Match object; span=(0, 10), match='1234567890'><br>>>> wholeStringIsNum.search('12345xyz67890') == None<br>True<br>>>> wholeStringIsNum.search('12  34567890') == None<br>True</pre>
            <p>위 예제의 두 search() 호출은 ^와 $를 함께 사용하는 경우 전체 문자열이 정규식과 일치해야 한다는 것을 보여준다.</p>
          </p>

          <p>
            <h5><strong>■ 와일드카드 문자</strong></h5>
            <p>정규식에서 '.'글자(또는 점)는 와일드카드라고 하며 줄바꿈을 제외한 모든 문자와 일치한다.</p>
            <pre>>>> atRegex = re.compile(r'.at')<br>>>> atRegex.findall('The cat in the hat sat on the flat mat.')<br>['cat', 'hat', 'sat', 'lat', 'mat']</pre>
            <p>점(.) 글자는 한 글자와만 일치한다는 것을 기억하라. 위 예제에서 텍스트 flat이 lat하고만 일치한 이유다. 실제 점 글자와 일치시키려면, 백슬래시로 점글자를 이스케이프 시켜야 한다. 즉 \.이 된다.</p>
          </p>

          <p>
            <h5><strong>▶ 점-별표로 모든 것을 일치시키기</strong></h5>
            <p>가끔 모든 것, 그리고 어느 것과든 일치시킬 필요가 있다. 이 때 '무엇이든'을 표현하기 위해 점과 별표(.*)를 사용할 수 있다. 점글자는 '줄바꿈을 제외한 모든 한 개의 글자'를 뜻하며, 별표는 '앞에 있는 글자가 없거나 한 번 이상 나오는 것' 을 뜻한다.</p>
            <pre>>>> nameRegex = re.compile(r'First Name: (.*) Last Name: (.*)')<br>>>> mo = nameRegex.search('First Name: Al Last Name: Sweigart')<br>>>> mo.group(1)<br>'Al'<br>>>> mo.group(2)<br>'Sweigart'</pre>
            <p>점-별표는 최대 일치 모드를 사용한다. 항상 될 수 있는 대로 많은 텍스트와 일치시키려고 한다. 만약 최소 일치 방식을 사용하려면 점-별표, 그 다음 물음표(?)를 사용한다. 중괄호와 마찬가지로, 물음펴는 파이썬에게 최소 일치 방식을 사용하라고 지시한다. 최대 일치와 최소일치 버전 사이의 차이를 보자.</p>
            <pre>>>> nongreedyRegex = re.compile(r'<.*?>')<br>>>> mo = nongreedyRegex.search('&lt;To serve man> for dinner.>')<br>>>> mo.group()<br>'&lt;To serve man>'
              <br>>>> greedyRegex = re.compile(r'<.*>')<br>>>> mo = greedyRegex.search('&lt;To serve man> for dinner.>')<br>>>> mo.group()<br>'&lt;To serve man> for dinner.>'</pre>
            <p>두 정규표현식 모두 대략 '여는 부등호, 그 다음에는 무엇이든, 그 다음에는 닫는 부등호와 일치한다' 고 해석할 수 있다. 그러나 '&lt;To serve man> for dinner.>'문자열은 닫는 부등호에 관해서는 두가지 가능한 일치가 있다. 최소 일치 버전에서는 '&lt;To serve man>'과 일치하고 최대 일치 버전에서는 '&lt;To serve man> for dinner.>'와 일치한다.</p>
          </p>

          <p>
            <h5><strong>▶ 점 문자로 줄바꿈 문자와 일치시키기</strong></h5>
            <p>점-별표는 줄바꿈을 제외한 모든 글자와 일치한다. re.compile()에 re.DOTALL을 두 번째 매개변수로 전달하면 점 문자가 줄바꿈 문자를 포함한 모든 글자와 일치하도록 만들 수 있다.</p>
            <pre>>>> noNewlineRegex = re.compile('.*')<br>>>> noNewlineRegex.search('Serve the public trust.\nProtect the innocent.\nUphold the law.').group()<br>'Serve the public trust.'
            <br>>>> newlineRegex = re.compile('.*', re.DOTALL)<br>NewlineRegex.search('Serve the public trust.\nProtect the innocent.\nUphold the law.').group()<br>'Serve the public trust.\nProtect the innocent.\nUphold the law.'</pre>
            <p>re.compile()을 호출해서 만들 때 re.DOTALL 이 없다면 정규식 noNewlineRegex는 첫 번째 줄바꿈 문자까지 모든 글자와 일치하고 반면, re.compile()에 re.DOTALL을 전달해서 만든 newlineRegex는 모든 글자와 일치한다.</p>
          </p>

          <p>
            <h5><strong>■ 정규식 기호 복습하기</strong></h5>
            <p>정규식에서 '.'글자(또는 점)는 와일드카드라고 하며 줄바꿈을 제외한 모든 문자와 일치한다.</p>
            <ul>
              <li>? 는 그 앞의 그룹이 0번 또는 한 번 나타나는 것과 일치한다.</li>
              <li>* 는 그 앞의 그룹이 0번 또는 한 번 또는 그 보다 많이 나타나는 것과 일치한다.</li>
              <li>+ 는 그 앞의 그룹이 한 번 이상 나타나는 것과 일치한다.</li>
              <li>{n}은 그 앞의 그룹이 정확히 n 번 나타나는 것과 일치한다.</li>
              <li>{n,}은 그 앞의 그룹이 n번 이상 나타나는 것과 일치한다.</li>
              <li>{, m}은 그 앞의 그룹이 0번에서 m번까지 나타나는 것과 일치한다.</li>
              <li>{n, m}은 그 앞의 그룹이 적어도 n번, 많게는 m번까지 나타나는 것과 일치한다.</li>
              <li>{n, m}? 또는 *? 또는 +? 는 그 앞의 그룹에 대해 최소 일치를 수행한다.</li>
              <li>^spam은 문자열이 spam으로 시작해야 한다는 것을 뜻한다.</li>
              <li>spam$는 문자열이 spam오로 끝나야 한다는 것을 뜻한다.</li>
              <li>.은 줄바꿈 문자를 제외한 모든 글자와 일치한다.</li>
              <li>\d, \w, \s는 각각 숫자, 단어, 또는 공백 문자와 일치한다.</li>
              <li>\D, \W, \S는 각각 숫자, 단어, 또는 공백 문자를 제외한 모든 글자와 일치한다.</li>
              <li>[abc]는 대괄호 안의 모든 글자와 일치한다. (이 예에서는 a, b 또는 c)</li>
              <li>[^abc]는 대괄호 안에 있지 않은 모든 글자와 일치한다.</li>
            </ul>
          </p>

          <p>
            <h5><strong>■ 대소문자를 구분하지 않고 일치시키기</strong></h5>
            <p>일반적으로, 정규표현식은 사용자가 지정한 대소문자를 정허ㅘㄱ히 구분해서 텍스트를 대조한다. 예를 들어 다음과 같은 정규표현식들은 완전히 다른 문자열과 일치한다.</p>
            <pre>>>> regex1 = re.compile('RoboCop')<br>>>> regex2 = re.compile('ROBOCOP')<br>>>> regex3 = re.compile('robOcop')<br>>>> regex4 = re.compile('RobocOp')</pre>
            <p>그러나 때로 대문자든 소문자든 구분 없이 글자들을 대조하고 싶을 수도 있다. 정규식이 대소문자를 구분하지 않게 하기 위해 re.IGNORECASE 또는 re.I를 re.compile()의 두 번째 매개변수로 전달할 수 있다.</p>
            <pre>>>> robocop = re.compile(r'robocop', re.I)<br>>>> robocop.search('RoboCop is part man, part machine, all cop.').group()<br>'RoboCop'
            <br>>>> robocop.search('ROBOCOP protects the innocent.').group()<br>'ROBOCOP'
            <br>>>> robocop.search('Al, why does your programming book talk about roboop so much?').group()<br>'robocop'</pre>
          </p>

        </article>
      </section>
    </div>
