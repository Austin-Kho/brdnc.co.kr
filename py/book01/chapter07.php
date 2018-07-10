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
            <pre>message = 'Call me at 415-555-1011 tomorrow. 415-555-9999 is my office.'<br>for i in range(len(message)):<br>    chunk = message[i:i+12]<br>    if isPhoneNumber(chunk):<br>        print('Phone number found: ' + chunk)<br>print('Done')</pre>
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
            <p>파이썬의 모든 정규식 기능은 <mark><u>re모듈</u></mark>에 있다.</p>
            <pre>>>> <strong>import re</strong></pre>
            <p><u>문정규표현식을 나타내는 자열 값을 <mark>re.compile()</mark>에 전달하면 Regex 패턴 객체(또는 단순히 Regex 객체)를 돌려받는다</u>. 다음과 같이 전화번호 패턴과 일치하는 Regex 객체를 만들 수 있다. 아래 phoneNumRegex 변수는 정규식 객체를 포함하고 있다.</p>
            <pre>>>> phoneNumRegex = <strong>re.compile(r'\d\d\d-\d\d\d-\d\d\d\d')</strong></pre>
            <div class="jumbotron" style="padding:5px;">
              <h5> 원시 문자열을 re.compile()에 전달하기</h5>
              <p style="font-size:11pt;">※ 파이썬은 백슬래시(\)를 이스케이프 문자로 사용한다. 문자열 값 '\n'은 백슬래시 다음에 소문자 n이 오는 문자열이 아니라 하나의 줄바꿈 문자를 뜻한다. 하나의 백슬래시를 출력하기 위해서는 \\를 입력해야 한다.
                따라서 '\\n'은 백슬래시 다음 소문자 n이 오는 문자열이다.
                <br>하지만 문자열 값의 첫 번째 따옴표 앞에 r을 놓으면 문자열을 원시 문자열, 즉 글자를 이스케이프하지 않는 문자열로 지정할 수 있다. 정규표현식은 자주 백슬래시를 사용하기 때문에, 백슬래시를 하나 더 붙일 필요 없이
                re.compile() 함수에 원시 문자열을 전달하면 편리하다. r'\d\d\d-\d\d\d-\d\d\d\d'라고 입력하는 것이 '\\d\\d\\d-\\d\\d\\d-\\d\\d\\d\\d'보다는 편할 것이다.</p>
            </div>

          </p>

          <p>
            <h5><strong>▶ Regex 객체 대조</strong></h5>
            <p><u>Regex 객체의 <mark>search()</mark> 메소드는 전달되는 문자열이 정규식과 일치하는지 검색한다. 정규식 패턴이 문자열에서 발견되지 않는다면 search() 메소드는 <mark>None</mark> 을 돌려준다. 패턴이 발견되면, search() 메소드는 <mark>Match 객체</mark>를 돌려준다. <mark>Match 객체</mark>는 검색 문자열에서 실제 일치하는 텍스트를 돌려주는 <mark>group()</mark> 메소드를 가지고 있다</u>.</p>
            <pre>>>> phoneNumRegex = re.compile(r'\d\d\d-\d\d\d-\d\d\d\d')<br>>>> mo = phoneNumRegex<strong>.search('My number is 415-555-4242.')</strong><br>>>> print('Phone number found: ' + <strong>mo.group()</strong>)<br>Phone number found: 415-555-4242</pre>
            <p>mo 변수는 Match 객체에 사용되는 일반적인 이름이다. 위의 코드는 원하는 패턴을 re.compile()에 전달하고 결과로 나오는 Regex 객체를 phoneNumRegex에 저장한다. 그 다음 phoneNumRegex의 search() 를 호출하고 일치하는 패턴이 있는지 검색할 문자열을 search()에 전달한다. 검색 결과는 mo 변수에 저장한다. 위 예제는 해당 패턴이 존재하므로 None이 아닌 Match 객체를 반환하므로 mo 에 group()함수를 호출해서 일치하는 텍스트를 돌려받을 수 있다.</p>
          </p>

          <p>
            <h5><strong>▶ 정규표현식 일치 다시 살펴보기</strong></h5>
            <p>파이썬에서 정규표현식을 사용하려면 여러 단계를 거쳐야 하지만 각 단계는 매우 간단하다.</p>
            <ul><u>
              <li><mark>import re로 정규식 모듈을 가져온다.</mark></li>
              <li><mark>re.compile() 함수로 Regex 객체를 만든다.</mark> (원시 문자열을 사용해야 한다는 점을 기억한다.)</li>
              <li><mark>검색할 문자열을 Regex 객체의 search() 메소드로 전달한다. 이렇게 하면 Match 객체를 돌려받는다.</mark></li>
              <li><mark>Match 객체의 group() 메소드를 호출해서 실제 일치하는 텍스트 문자열을 돌려받는다.</mark></li></u>
            </ul>
          </p>

          <p>
            <h5><strong>■ 정규표현식을 사용한 더 많은 패턴 대조</strong></h5>
            <p>위와 같이 파이썬으로 정규표현식 객체를 만들고 검색하기 위한 기본 단계를 알았으나, 더 강력한 패턴 대조 기능 중 일부을 알아보자.</p>
          </p>

          <p>
            <h5><strong>▶ 괄호로 묶기</strong></h5>
            <p>전화번호에서 지역 코드를 나머지 번호로부터 분리하고 싶다고 가정해 보자. 다음과 같이 <u>괄호를 추가하면 정규식에서 <mark>그룹</mark>이 만들어진다. <mark>(\d\d\d)-(\d\d\d-\d\d\d\d)</mark> 이렇게 하면 Match 객체의 group() 메소드로 일치하는 텍스트에서 <mark>단 하나의 그룹</mark>만을 가져올 수 있다. 각각의 괄호 세트는 각각 그룹1, 그룹2가 되며 필요한 부분만을 가져올 수 있다. <mark>group() 메소드에 0을 전달하거나 아무 것도 전달하지 않으면 전체 텍스트를 돌려준다</mark></u>.</p>
            <pre>>>> phoneNumRegex = re.compile(r'<strong>(\d\d\d)-(\d\d\d-\d\d\d\d)</strong>')<br>>>> mo = phoneNumRegex.search('My number is 415-555-4242.')<br>>>> <strong>mo.group(1)</strong><br>'415'<br>>>> <strong>mo.group(2)</strong><br>'555-4242'<br>mo.group()<br>'415-555-4242'</pre>
            <p><u>모든 그룹을 한 번에 가져오려면 <mark>groups() 메소드</mark>를 사용한다</u>. 이름이 복수형이라는 점에 유의하여야 한다.</p>
            <pre>>>> <strong>mo.groups()</strong><br>('415', '555-4242')<br>>>> <strong>areaCode, mainNumber</strong> = <strong>mo.groups()</strong><br>>>> print(<strong>areaCode</strong>)<br>415<br>>>> print(<strong>mainNumber</strong>)<br>555-4242</pre>
            <p><u><mark>mo.groups()</mark> 메소드는 여러 값의 <mark>튜플</mark>을 돌려주므로 areaCode, mainNumber = mo.groups()와 같이 별개의 변수에 각각의 값을 할당하는 다중 할당 기법을 사용할 수 있다</u>. 괄호는 정규표현식에서 특별한 의미를 가지고 있지만 텍스트에서 괄호를 찾아야 할 경우 다음과 같이 백슬래시 문자로 '\('와 '\)' 이스케이프해야 한다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'(<mark>\(</mark>\d\d\d<mark>\)</mark>) (\d\d\d-\d\d\d\d)')<br>>>> mo = phoneNumRegex.search('My number is (415) 555-4242.')<br>>>> mo.group(1)<br>'<mark>(</mark>415<mark>)</mark>'<br>>>> mo.group(2)<br>'555-4242'</pre>
            <p>re.compile() 에 전달된 원시 문자열의 <u><mark>\(와 \)</mark> 이스케이프 문자는 실제 괄호 글자들과 일치</u>한다.</p>
          </p>

          <p>
            <h5><strong>▶ 파이프로 여러 그룹 대조하기</strong></h5>
            <p><u>'<mark>|</mark>' 글자는 파이프라고 한다. 여러 가지 표현 중 하나만 일치해도 되는 곳이라면 어디서든 이 글자를 쓸 수 있다</u>. 예를 들어, 정규표현식 r'Batman|Tina Fey'는 'Betman' 또는 'Tina Fey' 중 하나와 일치한다. Batman 과 Tina Fey 가 모두 검색 문자열에 나타난다면 처음으로 일치하는 텍스트가 Match 객체로 반환된다.</p>
            <pre>>>> heroRegex = re.compile(r'<strong>Batman|Tina Fey</strong>')<br>>>> mo1 = heroRegex.search('Batman and Tina Fey')<br>>>> mo1.group()<br>'Batman'
            <br>>>> mo2 = heroRegex.search('Tina Fey and Batman')<br>>>> mo2.group()<br>'Tina Fey'</pre>
            <p><u><mark>정규식의 일부</mark>로서 여러 패턴들 중 하나와 일치할 수 있도록 파이프를 사용할 수 있다</u>. 예를 들어 'Batman', 'Batmobile', 'Batcopter', 'Batbat' 문자열 중 어느 것과든 일치하는 것을 찾고 싶은 경우 모든 문자열이 Bat 로 시작하기 때문에 이 접두어를 한 번만 쓸 수 있도록 지정하는 것이 좋다.</p>
            <pre>>>> batRegex = re.compile(r'Bat(man|mobile|copter|bat)')<br>>>> mo = batRegex.search('Batmobile lost a wheel')<br>>>> mo.group()<br>'<strong>Batmobile</strong>'<br>>> mo.group(1)<br>'<strong>mobile</strong>'</pre>
            <p><u><mark>mo.group()</mark> 메소드는 완전히 일치하는 텍스트인 '<mark>Batmobile</mark>'을 돌려주었고, <mark>mo.group(1)</mark> 호출은 첫 번째 괄호 그룹 안에서 일치하는 텍스트 부분인 '<mark>mobile</mark>'만을 돌려주었다</u>. 참고로 실제 파이프 글자와 일치해야 할 때에는 \|와 같이 백슬래시로 이스케이프 해야한다.</p>
          </p>

          <p>
            <h5><strong>▶ 물음표와 선택적 대조</strong></h5>
            <p>가끔 선택적으로 대조해야 할 패턴이 있다. 즉, 텍스트에서 어떤 조각이 있는지 없는지 여부를 대조해 보는 정규식 같은 것들이다. <u>'<mark>?</mark>'글자는 그 앞에 있는 <mark>그룹</mark>이 패턴의 선택적인 부분이라는 것을 뜻한다</u>.</p>
            <pre>>>> batRegex = re.compile(r'Bat<strong>(wo)?</strong>man')<br>>>> mo1 = batRegex.search('The Adventures of <strong>Batman</strong>')<br>>>> mo1.group()<br>'<strong>Batman</strong>'
              <br>>>> mo2 = batRegex.search('The Adventures of <strong>Batwoman</strong>')<br>>>> mo2.group<br>'<strong>Batwoman</strong>'</pre>
            <p>정규표현식의 <u><mark>(wo)?</mark> 부분은 패턴이 <mark>선택적 그룹</mark>이라는 것을 뜻한다. 이 정규식은 <mark>wo가 없거나 한 번 나타나는 텍스트와 일치</mark>한다</u>. 그 때문에 이 정규식은 'Batwoman', 'Batman'과 모두 일치 한다. 이전 전화번호 예제를 사용하여 지역 코드가 있거나 없는 전화번호를 찾는 정규식을 만들 수 있다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'<strong>(\d\d\d-)?</strong>\d\d\d-\d\d\d\d')<br>>>> mo1 = phoneNumRegex.search('My number is 415-555-4242.')<br>>>> mo1.group()<br>'<strong>415-555-4242</strong>'
            <br>>>> mo2 = phoneNumRegex.search('My number is 555-4242.')<br>>>> mo2.group()<br>'<strong>555-4242</strong>'</pre>
            <p><u>'<mark>?</mark>' 글자를 '그 앞에 있는 <mark>그룹이 0번 또는 1번</mark> 나타나면 일치한다</u>.'는 뜻으로 볼 수 있다. 참고로 실제 물음표(?) 글자와 일치해야 할 때에는 \?로 이스케이프 시킨다. </p>
          </p>

          <p>
            <h5><strong>▶ 별표로 0개 또는 그 이상과 일치시키기</strong></h5>
            <p> <u><mark>*(별표)</mark> 표시는 '<mark>0개 또는 그 이상과 일치</mark>'</u>를 뜻한다. 곧, 별표 앞에 있는 그룹이 텍스트 안에서 몇 번이든 나타날 수 있다. 완전히 없을 수도, 몇 번이든 반복해서 나타날 수 도 있는 것이다.</p>
            <pre>>>> batRegex = re.compile(r'Bat<strong>(wo)*</strong>man')<br>>>> mo1 = batRegex.search('The Adventures of <strong>Batman</strong>')<br>>>> mo1.group()<br>'<strong>Batman</strong>'
              <br>>>> mo2 = batRegex.search('The Adventures of <strong>Batwoman</strong>')<br>>>> mo2.group()<br>'<strong>Batwoman</strong>'
              <br>>>> mo3 = batRegex.search('The Adventures of <strong>Batwowowowoman</strong>')<br>>>> mo3.group()<br>'<strong>Batwowowowoman</strong>'</pre>
            <p>위의 예제의 경우, <u>정규식의 <mark>(wo)*</mark> 부분은 문자열에서 <mark>wo가 0번, 1번 또는 여러 번</mark> 나타나므로 모두 일치한다</u>. 참고로 실제 별표(*) 글자와 일치해야 할 때에는 정규식 안에 백슬래시와 함께 \*로 쓴다.</p>
          </p>

          <p>
            <h5><strong>▶ 더하기 기호로 1개 또는 그 이상과 일치시키기</strong></h5>
            <p> *(별표)표시가 '0개 또는 그 이상과 일치'를 뜻하는 반면, <u><mark>+(더하기)</mark> 표시는 '<mark>1개 또는 그 이상과 일치</mark>'를 뜻한다. 별표와 달리 더하기 기호는 그 앞에 나오는 그룹이 <mark>적어도 한 번 이상</mark> 나타나야 한다</u>.</p>
            <pre>>>> batRegex = re.compile(r'Bat<strong>(wo)+</strong>man')<br>>>> mo1 = batRegex.search('The Adventures of <strong>Batwoman</strong>')<br>>>> mo1.group()<br>'<strong>Batwoman</strong>'
              <br>>>> mo2 = batRegex.search('The Adventures of <strong>Batwowowowoman</strong>')<br>>>> mo2.group()<br>'<strong>Batwowowowoman</strong>'
              <br>>>> mo3 = batRegex.search('The Adventures of Batman')<br>>>> mo3 == <strong>None</strong><br>True</pre>
            <p>Bat(wo)+man 정규식은 'The Adventures of Batman'문자열과는 일치하지 않는다. wo뒤에 +기호가 있으므로 적어도 한 번은 나타나야 하기 때문이다. 참고로 실제 더하기(+) 글자와 일치해야 할 때에는 정규식 안에 백슬래시와 함께 \+로 쓴다.</p>
          </p>

          <p>
            <h5><strong>▶ 중괄호로 특정 횟수 반복 일치 시키기</strong></h5>
            <p><u><mark>특정한 횟수동안 반복되는 그룹</mark>이 있다면 정규식 안에서 그 그룹 뒤에 <mark>중괄호와 함께 횟수</mark>를 쓴다</u>. 예를 들면 정규식 (Ha){3}은 'HaHaHa' 문자열과 일치하지만 'HaHa' 와는 일치하지 않는다. <u>중괄호 안에 하나의 숫자만 쓰는 대신 <mark>최소값, 쉼표, 최대값</mark>을 씀으로써 범위를 지정할 수도 있다</u>. 예를 들어 (Ha){3,5} 정규식은 'HaHaHa', 'HaHaHaHa', 'HaHaHaHaHa'와 일치한다. 또한 <u>중괄호의 첫 번째 또는 두 번째 번호를 비워서 최소값 또는 최대값을 비울 수도 있다</u>.
            예를 들어 (Ha){3,} 정규식은 (Ha)그룹이 세 번 이상 나타나면 일치하며, 반면 (Ha){,5} 정규식은 그룹이 5번 이하로 나타나면 일치한다.</p>
            <pre><strong>(Ha){3}</strong><br>(Ha)(Ha)(Ha)</pre>
            <p>위 두 정규표현식은 같은 패턴과 일치한다.</p>
            <pre><strong>(Ha){3,5}</strong><br>((Ha)(Ha)(Ha)|(Ha)(Ha)(Ha)(Ha)|(Ha)(Ha)(Ha)(Ha)(Ha))</pre>
            <p>위 두 정규표현식도 같은 패턴과 일치한다.</p>
            <pre>>>> haRegex = re.compile(r'<strong>(Ha){3}</strong>')<br>>>> mo1 = haRegex.search('HaHaHa')<br>>>> mo1.group()<br>'<strong>HaHaHa</strong>'
              <br>>>> mo2 = haRegex.search('Ha')<br>>>> mo2 == <strong>None</strong><br>True</pre>
            <p>여기서 (Ha){3}은 'HaHaHa'와는 일치하지만 'Ha'와는 일치하지 않는다. 'Ha'와는 일치하지 않으므로 search() 는 None 값을 돌려준다.</p>
          </p>

          <p>
            <h5><strong>■ 최대 일치와 최소 일치</strong></h5>
            <p><u>파이썬의 정규표현식은 기본적으로 최대 일치다</u>. 즉 모호한 상황에서는 가능한 가장 긴 문자열과 일치하는 것을 뜻한다. 될 수 있는 대로 <u>가장 짧은 문자열과 일치하는, <mark>중괄호의 최소 일치</mark> 버전을 사용하려면 <mark>중괄호의 뒤에 ?(물음표)</mark>를 놓는다</u>.</p>
            <pre>>>> greedyHaRegex = re.compile(r'<strong>(Ha){3,5}</strong>')<br>>>> mo1 = greedyHaRegex.search('<strong>HaHaHaHaHa</strong>')<br>>>> mo1.group()<br>'<strong>HaHaHaHaHa</strong>'
              <br>>>> nongreedyHaRegex = re.compile(r'<strong>(Ha){3,5}?</strong>')<br>>>> mo2 = nongreedyHaRegex.search('<strong>HaHaHaHaHa</strong>')<br>>>> mo2.group()<br>'<strong>HaHaHa</strong>'</pre>
              <p><u><mark>?(물음표)</mark>는 정규표현식에서 두 가지 의미를 가질 수 있다는 점에 유의한다. 물음표는 <mark>최소 일치</mark>를 의미할 수도 있고 <mark>선택적 그룹</mark>을 뜻할 수도 있다</u>. 이들 두 가지 의미는 서로 전혀 관련이 없다.</p>
          </p>

          <p>
            <h5><strong>■ findall() 메소드</strong></h5>
            <p><u>Regex 객체는 search() 메소드 말고도 <mark>findall()</mark> 메소드를 가지고 있다. <mark>search()</mark> 메소드는 검색하는 문자열에서 <mark>처음으로 나타나는 일치하는 텍스트의 Match 객체</mark>를 돌려주지만 <mark>findall()</mark> 메소드는 검색 문자열에서 나타나는 <mark>일치하는 모든 문자열</mark>을 돌려준다</u>. search() 메소드가 돌려주는 Match 객체를 보자.</p>
            <pre>>>> phoneNumRegex = re.compile(r'\d\d\d-\d\d\d-\d\d\d\d')<br>>>> mo = phoneNumRegex.search('Cell: 415-555-9999 Work: 212-555-0000')<br>>>> mo.group()<br>'415-555-9999'</pre>
            <p>한편 <u><mark>findall()</mark>은 Match 객체가 아니라 <mark>문자열의 리스트</mark>를 돌려준다. 정규표현식 안에 그룹이 없는 한</u>은 그렇다. 리스트의 각 문자열은 검색 텍스트에서 정규표현식과 일치하는 부분들이다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'<strong>\d\d\d-\d\d\d-\d\d\d\d</strong>') # has no groups<br>>>> phoneNumRegex.<strong>findall('Cell: 415-555-9999 Work: 212-555-0000')</strong><br>[<strong>'415-555-9999', '212-555-0000'</strong>]</pre>
            <p><u>정규표현식 안에 그룹이 있을 경우 <mark>findall()</mark>은 <mark>튜플의 리스트</mark>를 돌려준다</u>. 각 튜플은 발견된 일치 부분을 뜻하고, 각 튜플의 아이템은 정규표현식의 각 그룹과 일치되는 문자열을 뜻한다.</p>
            <pre>>>> phoneNumRegex = re.compile(r'<strong>(\d\d\d)-(\d\d\d)-(\d\d\d\d)</strong>')   # has groups<br>>>> phoneNumRegex.<strong>findall('Cell: 415-555-9999 Work: 212-555-0000')</strong><br>[<strong>('415', '555', '9999'), ('212', '555', '0000')</strong>]</pre>
            <p>위의 예와 같이 findall() 메소드는 그룹이 없는 정규식에서는 리스트를, 그룹이 있는 정규식에서는 튜플의 리스트를 돌려준다.</p>
          </p>

          <p>
            <h5><strong>■ 문자 클래스</strong></h5>
            <p>앞의 예에서 \d가 무엇이든 숫자 한 글자를 나타낸다는 것을 배웠다. 즉 \d는 (0|1|2|3|4|5|6|7|8|9)의 짧은 버전이다. 다음 표는 그와 같은 기타 문자 클래스이다.</p>

            <h5><strong>•• 표 7-1 널리 쓰이는 짧은 버전의 문자 클래스</strong></h5>
            <table class="table table-hover table-condensed table table-bordered">
              <thead>
                <tr>
                  <td>짧은 문자</td><td>클래스 의미</td>
                </tr>
              </thead>
              <tbody>
                <tr><td><mark>\d</mark></td><td>0에서 9까지의 임의의 숫자 글</td></tr>
                <tr><td><mark>\D</mark></td><td>0에서 9까지의 숫자가 아닌 모든 글자</td></tr>
                <tr><td><mark>\w</mark></td><td>문자, 숫자 글자, 또는 밑줄 글자.(이 클래스를 '단어'를 이루는 글자와 일치한다고 생각하라)</td></tr>
                <tr><td><mark>\W</mark></td><td>문자, 숫자 글자, 또는 밑줄 글자가 아닌 모든 글자.</td></tr>
                <tr><td><mark>\s</mark></td><td>빈칸, 탭 또는 줄바꿈 문자.(이 클래스를 '빈칸'을 이루는 글자와 일치한다고 생각하라)</td></tr>
                <tr><td><mark>\S</mark></td><td>빈칸, 탭 또는 줄바꿈 문자가 아닌 모든 글자.</td></tr>
              </tbody>
            </table>
            <p>문자 클래스는 정규표현식을 단축하기 위한 좋은 수단이다. 문자 클래스[0-5]는 숫자 0에서 5까지만 일치한다. (0|1|2|3|4|5)를 입력하는 것보다 훨씬 짧다.</p>
            <pre>>>> xmasRegex = re.compile(r'\d+\s\w+')<br>>>> xmasRegex.findall('12 drummers, 11 pipers, 10 lords, 9 ladies, 8 maids, 7 swans, 6 geese, 5 rings, 4 birds, 3 hens, 2 doves, 1 partridge')
['12 drummers', '11 pipers', '10 lords', '9 ladies', '8 maids', '7 swans', '6 geese', '5 rings', '4 birds', '3 hens', '2 doves', '1 partridge']</pre>
            <p><u>정규표현식 <mark>\d+\s\w+</mark>는 <mark>하나 또는 그보다 많은 숫자 글자(\d+)</mark>, 그 다음에 <mark>하나의 공백문자(\s)</mark>, 그 다음에 <mark>하나 또는 그보다 많은 문자/숫자/밑줄 글자(\w+)</mark>를 가진 텍스트와 일치한다</u>. findall() 메소드는 정규식 패턴과 일치하는 모든 문자열을 리스트에 담아 돌려준다.</p>
          </p>

          <p>
            <h5><strong>■ 사용자 정의 문자 클래스 만들기</strong></h5>
            <p>어떤 문자의 집합과 대조할 때 짧은 버전의 문자 클래스(\d,\w,\s 같은 것들)는 너무 광범위할 수 있다. <u><mark>[](대괄호)</mark>를 사용하면 사용자 정의 문자 클래스를 정의</u>할 수 있다. 예를 들어 <u>문자 클래스 <mark>[aeiouAEIOU]</mark>는 대문자든 소문자든 <mark>모든 영어 모음</mark>과 일치한다</u>.</p>
            <pre>>>> vowelRegex = re.compile(r'<strong>[aeiouAEIOU]</strong>')<br>>>> vowelRegex.findall('RoboCop eats baby food. BABY FOOD.')<br>['o', 'o', 'o', 'e', 'a', 'a', 'o', 'o', 'A', 'O', 'O']</pre>
            <p>또한 <u><mark>하이픈(-)</mark>을 사용하여 문자 또는 숫자의 범위</u>를 포함할 수도 있다. 예를 들어 [a-zA-Z0-9]문자 클래스는 소문자, 대문자, 숫자와 모두 일치한다. <u>대괄호 안에서는 일반 정규식 기호가 그 기호의 뜻으로 해석되지 않는다는 점에 유의한다</u>. 즉, *, ? 또는 ()글자 앞에 백슬래시를 두어 이스케이프할 필요가 없다는 뜻이다. 예를 들어 문자 클래스 [0-5.]는 숫자 0에서 5까지, 그리고 마침표와 일치한다. [0-5/.]처럼 할 필요는 없다.
            <br><u>여는 대괄호([) 뒤에 <mark>캐럿 문자(^)</mark>를 두면 부정형 문자 클래스를 만들 수 있다. 부정형 문자 클래스는 문자 클래스에 없는 모든 문자와 일치</u>한다.</p>
            <pre>>>> consonantRegex = re.compile(r'<strong>[^aeiouAEIOU]</strong>')<br>>>> consonantRegex.findall('RoboCop eats baby food. BABY FOOD.')<br>['R', 'b', 'c', 'p', ' ', 't', 's', ' ', 'b', 'b', 'y', ' ', 'f', 'd', '.', ' ', 'B', 'B', 'Y', ' ', 'F', 'D', '.']</pre>
            <p>이제 모든 모음과 일치하는 패턴 대신 모음이 아닌 모든 글자와 일치하는 패턴이 되었다.</p>
          </p>

          <p>
            <h5><strong>■ 캐럿과 달러 기호 글자</strong></h5>
            <p><u>검색 텍스트의 <mark>시작 부분</mark>에서 일치하는 텍스트가 나타나야 한다는 것을 주문하기 위해 정규식 앞머리에 <mark>캐럿 기호(^)</mark></u>를 사용할 수 있다. 마찬가지로 <u>문자열이 <mark>정규식 패턴으로 끝나야 한다는 것</mark>을 지시하기 위해 정규식의 끝에 <mark>달러 기호($)</mark></u>를 붙일 수 있다. 또한 <u><mark>전체 문자열</mark>이 정규식과 일치해야 한다는 것을 지시하기 위해 <mark>^기호와 $기호를 함께</mark> 쓸 수도 있다.</u> 즉 문자열의 일부 부분만이 일치하는 것으로는 부족하다는 뜻이다. </p>
            <p><u><mark>r'^Hello'</mark> 정규표현식 문자열은 'Hello'로 시작되는 문자열과 일치</u>한다.</p>
            <pre>>>> beginsWithHello = re.compile(r'<strong>^Hello</strong>')<br>>>> beginsWithHello.search('Hello world')<br>&lt;re.Match object; span=(0, 5), match='<strong>Hello</strong>'><br>>>> beginsWithHello.search('He said hello.') == <strong>None</strong><br>True</pre>
            <p><u><mark>r'\d$'</mark> 정규표현식 문자열은 0에서 9까지의 숫자 글자로 끝나는 문자열과 일치</u>한다.</p>
            <pre>>>> endWithNumber = re.compile(r'<strong>\d$</strong>')<br>>>> endWithNumber.search('Your number is 42')<br>&lt;re.Match object; span=(16, 17), match='<strong>2</strong>'><br>>>> endWithNumber.search('Your number is forty two.') == <strong>None</strong><br>True</pre>
            <p><u><mark>r'^\d$'</mark> 정규표현식 문자열은 하나 또는 그보다 많은 숫자 글자로 시작하고 끝나는 문자열과 일치</u>한다.</p>
            <pre>>>> wholeStringIsNum = re.compile(r'<strong>^\d+$</strong>')<br>>>> wholeStringIsNum.search('1234567890')<br>&lt;re.Match object; span=(0, 10), match='<strong>1234567890</strong>'><br>>>> wholeStringIsNum.search('12345xyz67890') == <strong>None</strong><br>True<br>>>> wholeStringIsNum.search('12  34567890') == <strong>None</strong><br>True</pre>
            <p>위 예제의 두 search() 호출은 ^와 $를 함께 사용하는 경우 전체 문자열이 정규식과 일치해야 한다는 것을 보여준다.</p>
          </p>

          <p>
            <h5><strong>■ 와일드카드 문자</strong></h5>
            <p><u>정규식에서 <mark>'.'글자(또는 점)</mark>는 와일드카드라고 하며 <mark>줄바꿈을 제외한 모든 문자(한글자)와 일치</mark></u>한다.</p>
            <pre>>>> atRegex = re.compile(r'<strong>.at</strong>')<br>>>> atRegex.findall('The cat in the hat sat on the flat mat.')<br>['cat', 'hat', 'sat', 'lat', 'mat']</pre>
            <p><u><mark>점('.')</mark> 글자는 한 글자와만 일치한다</u>는 것을 기억하라. 위 예제에서 텍스트 flat이 lat하고만 일치한 이유다. 실제 점 글자와 일치시키려면, 백슬래시로 점글자를 이스케이프 시켜야 한다. 즉 \.이 된다.</p>
          </p>

          <p>
            <h5><strong>▶ 점-별표로 모든 것을 일치시키기</strong></h5>
            <p>가끔 모든 것, 그리고 어느 것과든 일치시킬 필요가 있다. 이 때 <u>'무엇이든'을 표현하기 위해 <mark>점과 별표(.*)</mark>를 사용</u>할 수 있다. 점글자는 '줄바꿈을 제외한 모든 한 개의 글자'를 뜻하며, 별표는 '앞에 있는 글자가 없거나 한 번 이상 나오는 것' 을 뜻한다.</p>
            <pre>>>> nameRegex = re.compile(r'First Name: (<strong>.*</strong>) Last Name: (.*)')<br>>>> mo = nameRegex.search('First Name: <strong>Al</strong> Last Name: <strong>Sweigart</strong>')<br>>>> mo.group(1)<br>'<strong>Al</strong>'<br>>>> mo.group(2)<br>'<strong>Sweigart</strong>'</pre>
            <p><u><mark>점-별표(.*)</mark>는 최대 일치 모드를 사용한다</u>. 항상 될 수 있는 대로 많은 텍스트와 일치시키려고 한다. 만약 <u>최소 일치 방식을 사용하려면 <mark>점-별표, 그 다음 물음표(?)</mark>를 사용</u>한다. 중괄호와 마찬가지로, 물음표는 파이썬에게 최소 일치 방식을 사용하라고 지시한다. 최대 일치와 최소일치 버전 사이의 차이를 보자.</p>
            <pre>>>> nongreedyRegex = re.compile(r'<<strong>.*?</strong>>')<br>>>> mo = nongreedyRegex.search('&lt;To serve man> for dinner.>')<br>>>> mo.group()<br>'<strong>&lt;To serve man></strong>'
              <br>>>> greedyRegex = re.compile(r'<<strong>.*</strong>>')<br>>>> mo = greedyRegex.search('&lt;To serve man> for dinner.>')<br>>>> mo.group()<br>'<strong>&lt;To serve man> for dinner.></strong>'</pre>
            <p>두 정규표현식 모두 대략 '여는 부등호, 그 다음에는 무엇이든, 그 다음에는 닫는 부등호와 일치한다' 고 해석할 수 있다. 그러나 '&lt;To serve man> for dinner.>'문자열은 닫는 부등호에 관해서는 두가지 가능한 일치가 있다. 최소 일치 버전에서는 '&lt;To serve man>'과 일치하고 최대 일치 버전에서는 '&lt;To serve man> for dinner.>'와 일치한다.</p>
          </p>

          <p>
            <h5><strong>▶ 점 문자로 줄바꿈 문자와 일치시키기</strong></h5>
            <p><u>점-별표(.*)는 <mark>줄바꿈을 제외</mark>한 모든 글자와 일치</u>한다. <u>re.compile()에 <mark>re.DOTALL</mark>을 두 번째 매개변수로 전달하면 점 문자가 <mark>줄바꿈 문자를 포함</mark>한 모든 글자와 일치</u>하도록 만들 수 있다.</p>
            <pre>>>> noNewlineRegex = re.compile('.*')<br>>>> noNewlineRegex.search('Serve the public trust.\nProtect the innocent.\nUphold the law.').group()<br>'Serve the public trust.'
            <br>>>> newlineRegex = re.compile('.*', <strong>re.DOTALL</strong>)<br>>>> newlineRegex.search('Serve the public trust.\nProtect the innocent.\nUphold the law.').group()<br>'<strong>Serve the public trust.\nProtect the innocent.\nUphold the law.</strong>'</pre>
            <p>re.compile()을 호출해서 만들 때 re.DOTALL 이 없다면 정규식 noNewlineRegex는 첫 번째 줄바꿈 문자까지 모든 글자와 일치하고 반면, re.compile()에 re.DOTALL을 전달해서 만든 newlineRegex는 모든 글자와 일치한다.</p>
          </p>

          <p>
            <h5><strong>■ 정규식 기호 복습하기</strong></h5>
            <ul><u>
              <li><mark>? 는 그 앞의 그룹이 0번 또는 한 번 나타나는 것과 일치한다.</mark></li>
              <li><mark>* 는 그 앞의 그룹이 0번 또는 한 번 또는 그 보다 많이 나타나는 것과 일치한다.</mark></li>
              <li><mark>+ 는 그 앞의 그룹이 한 번 이상 나타나는 것과 일치한다.</mark></li>
              <li><mark>{n}은 그 앞의 그룹이 정확히 n 번 나타나는 것과 일치한다.</mark></li>
              <li><mark>{n,}은 그 앞의 그룹이 n번 이상 나타나는 것과 일치한다.</mark></li>
              <li><mark>{, m}은 그 앞의 그룹이 0번에서 m번까지 나타나는 것과 일치한다.</mark></li>
              <li><mark>{n, m}은 그 앞의 그룹이 적어도 n번, 많게는 m번까지 나타나는 것과 일치한다.</mark></li>
              <li><mark>{n, m}? 또는 *? 또는 +? 는 그 앞의 그룹에 대해 최소 일치를 수행한다.</mark></li>
              <li><mark>^spam은 문자열이 spam으로 시작해야 한다는 것을 뜻한다.</mark></li>
              <li><mark>spam$는 문자열이 spam오로 끝나야 한다는 것을 뜻한다.</mark></li>
              <li><mark>.은 줄바꿈 문자를 제외한 모든 (한)글자와 일치한다.</mark></li>
              <li><mark>\d, \w, \s는 각각 숫자, 단어, 또는 공백 문자와 일치한다.</mark></li>
              <li><mark>\D, \W, \S는 각각 숫자, 단어, 또는 공백 문자를 제외한 모든 글자와 일치한다.</mark></li>
              <li><mark>[abc]는 대괄호 안의 모든 글자와 일치한다. (이 예에서는 a, b 또는 c)</mark></li>
              <li><mark>[^abc]는 대괄호 안에 있지 않은 모든 글자와 일치한다.</mark></li></u>
            </ul>
          </p>

          <p>
            <h5><strong>■ 대소문자를 구분하지 않고 일치시키기</strong></h5>
            <p>일반적으로, <u>정규표현식은 사용자가 지정한 <mark>대소문자를 정확히 구분</mark>해서 텍스트를 대조</u>한다. 예를 들어 다음과 같은 정규표현식들은 완전히 다른 문자열과 일치한다.</p>
            <pre>>>> regex1 = re.compile('RoboCop')<br>>>> regex2 = re.compile('ROBOCOP')<br>>>> regex3 = re.compile('robOcop')<br>>>> regex4 = re.compile('RobocOp')</pre>
            <p>그러나 때로 대문자든 소문자든 구분 없이 글자들을 대조하고 싶을 수도 있다. <u>정규식이 <mark>대소문자를 구분하지 않게</mark> 하기 위해 <mark>re.IGNORECASE 또는 re.I</mark>를 re.compile()의 두 번째 매개변수로 전달</u>할 수 있다.</p>
            <pre>>>> robocop = re.compile(r'robocop', <strong>re.I</strong>)<br>>>> robocop.search('RoboCop is part man, part machine, all cop.').group()<br>'<strong>RoboCop</strong>'
            <br>>>> robocop.search('ROBOCOP protects the innocent.').group()<br>'<strong>ROBOCOP</strong>'
            <br>>>> robocop.search('Al, why does your programming book talk about robocop so much?').group()<br>'<strong>robocop</strong>'</pre>
          </p>

          <p>
            <h5><strong>■ sub() 메소드로 문자열 대체하기</strong></h5>
            <p><u>정규표현식은 텍스트 패턴을 찾을 수 있을 뿐만 아니라 <mark>패턴을 새로운 텍스트로 대체</mark>할 때에도 쓸 수 있다. Regex 객체의 <mark>sub()</mark> 메소드는 두 개의 매개변수를 전달한다. <mark>첫 번째 매개변수는 어떤 일치하는 텍스트든 이를 대체할 문자열</mark>이다. <mark>두 번째는 정규표현식과 대조할 문자열</mark>이다. sub() 메소드는 대체가 적용된 문자열을 돌려준다.</u></p>
            <pre>>>> namesRegex = re.compile(r'Agent \w+')<br>>>> namesRegex.<strong>sub</strong>('<strong>CENSORED</strong>', 'Agent Alice gave the secret documents to Agent Bob.')<br>'<strong>CENSORED</strong> gave the secret documents to <strong>CENSORED</strong>.'</pre>
            <p>때로는 <u>일치하는 텍스트 그 자체를 대체할 텍스트의 일부로 사용해야 할 수도 있다. <mark>sub()</mark> 의 첫 번째 매개변수에 <mark>\1, \2, \3</mark>과 같이 입력할 수 있다. 이는 "<mark>그룹 1, 2, 3...의 텍스트를 대체 텍스트에 넣어라</mark>."는 뜻</u>이다. 예를 들어 비밀 요원의 이름을 검열 삭제(censor)하되 이름의 첫 글자만 보여주고 싶다고 가정해 보자. 이를 위해서는 Agent(\w)\w* 정규식을 사용하고 r'\1****' 문자열을 sub()의 첫 번째 매개변수로 넘긴다. 이 문자열에서 \1은 무엇이든 그룹1과 일치하는 텍스트로 대체된다.</p>
            <pre>>>> agentNameRegex = re.compile(r'Agent (\w)\w*')<br>>>> agentNameRegex.<strong>sub</strong>(r'<strong>\1****</strong>', 'Agent Alice told Agent Carol that Agent Eve knew Agent Bob was a double agent.')<br>'<strong>A****</strong> told <strong>C****</strong> that <strong>E****</strong> knew <strong>B****</strong> was a double agent.'</pre>
          </p>

          <p>
            <h5><strong>■ 복잡한 정규표현식 관리하기</strong></h5>
            <p>일치해야 하는 텍스트 패턴이 단순하지 않고 복잡한 경우 길고 복잡한 정규표현식을 써야 할 수도 있다. re.compile() 함수에게 정규표현식 문자열 안에 있는 공백과 주석을 무시하도록 지시함으로써 어려움을 덜어낼 수 있다. 이 <u>"<mark>상세 모드</mark>"는 re.compile()의 두 번째 매개변수로 <mark>re.VERBOSE</mark>를 전달함으로서 사용할 수 있게 된다</u>.
            <br>이제 다음과 같이 읽기 어려운 정규표현식을,</p>
            <pre>phoneRegex = re.compile(r'((\d{3}|\(\d{3}\))?(\s|-|\.)?\d{3}(\s|-|\.)\d{4}(\s*(ext|x|ext.)\s*\d{2,5})?)')</pre>
            <p>여러 줄에 걸쳐 주석을 붙인 정규표현식으로 나눌 수 있다.</p>
            <pre>phoneRegex = re.compile(r<strong>'''</strong>(
    (\d{3}|\(\d{3}\))?             # area code
    (\s|-|\.)?                     # separator
    \d{3}                          # first 3 digits
    (\s|-|\.)                      # separator
    \d{4}                          # last 4 digits
    (\s*(ext|x|ext.)\s*\d{2,5})?   # extension
    )<strong>''', re.VERBOSE</strong>)</pre>
            <p>위 예제에서 <u>여러 줄 문자열을 만들기 위해 <mark>홑따옴표 세개(''')</mark>를 사용한 것에 유의</u>하라. 이렇게 하면 정규표현식을 여러 줄에 걸쳐서 정의할 수 있어서 읽기가 더 좋아진다. 정규표현식 안에 있는 주석의 규칙은 일반 파이썬 코드와 같다. 위의 경우 <u>여러줄 텍스트 안에 있는 여분의 빈칸은 대조할 텍스트 패턴의 일부로 간주되지 않는다</u>.</p>
          </p>

          <p>
            <h5><strong>■ IGNORECASE, re.DOTALL, re.VERBOSE 결합하기</strong></h5>
            <p>정규표현식에 주석을 쓰기 위해 re.VERBOSE와 대소문자 구분을 무시하기 위해 re.IGNORECASE를 같이 사용하고 싶다면? re.compile() 함수는 두 번째 인수로 단 하나의 값만 가질 수 있다.
              <br>하지만 <u>re.IGNORECASE, re.DOTALL, re.VERBOSE 변수들을 <mark>파이프 문자(|)로 결합</mark> 할 수 있다. 여기서 <mark>|문자</mark>는 비트 단위 or 연산자라고 부른다</u>.</p>
            <pre>>>> someRegexValue = re.compile('foo', <strong>re.IGNORECASE | re.DOTALL | re.VERBOSE</strong>)</pre>
            <p>이 구문은 파이썬의 초기 버전에서 유래되었다. 비트단위 연산자에 관한 자세한 내용은 <a href="http://nostarch.com/automatestuff/" target="_blank">http://nostarch.com/automatestuff/</a>에서 볼 수 있다.</p>
          </p>

          <p>
            <h5><strong>■ 프로젝트 : 전화번호와 이메일 주소 추출하기</strong></h5>
            <p>긴 웹페이지 또는 문서에서 모든 전화번호 및 이메일 주소를 찾는 작업을 해야 한다가 가정해 보다. 전화번호와 이메일 주소를 추출하려면 먼저 다음과 같은 일을 해야 한다.</p>
            <ul>
              <li>클립보드로부터 텍스트를 가져온다.</li>
              <li>텍스트에서 모든 전화번호와 이메일 주소를 찾는다.</li>
              <li>이들을 클립보드에 붙여 넣는다.</li>
            </ul>
            <p>이제 이런 일을 어떻게 코드로 할 수 있을지 생각한다. 코드는 다음과 같은 일을 해야 한다.</p>
            <ul>
              <li>문자열 복사하기와 붙여넣기를 위해 pyperclip 모듈을 사용한다.</li>
              <li>두 개의 정규표현식을 만든다. 하나는 전화번호를 위해, 하나는 이메일 주소를 위해서다.</li>
              <li>두 정규표현식 모두 첫 번째 일치하는 것만이 아닌 일치하는 모든 것을 찾아야 한다.</li>
              <li>일치하는 문자열들을 깔끔한 형식으로 만들고, 붙여넣기를 위해 한 문자열로 묶어야 한다.</li>
              <li>텍스트에서 일치하는 것을 찾을 수 없다면 뭔가 메세지를 표시한다.</li>
            </ul>
          </p>

          <p>
            <h5><strong>▶ 1단계: 전화번호에 대한 정규식 만들기</strong></h5>
            <p>다음 내용을 입력한 후 phoneAndEmail.py로 저장하자.</p>
            <pre>#! python3<br>#  phoneAndEmail.py - Finds phone numbers and email addresses on the clipboard.
            <br>import pyperclip, re
            <br>phoneRegex = re.compile(r'''(
    (\d{3}|\(\d{3}\))?             # area code / 세 자리 숫자, 혹은 괄호 안의 세자리 숫자 이므로 파이프로 결합하고 지역번호 자체가 선택적이므로 ?가 붙는다.
    (\s|-|\.)?                     # separator / 빈칸(\s), 하이픈(-) 또는 점(.)일 수 있으므로 이 부분도 파이프(|)로 결합 후 선택적이므로 ?가 붙는다.
    (\d{3})                        # first 3 digits / 세 자리 숫자
    (\s|-|\.)                      # separator / 빈칸, 하이픈, 또는 점
    (\d{4})                        # last 4 digits / 네 자리 숫자
    (\s*(ext|x|ext.)\s*(\d{2,5}))? # extension / 선택적인 내선번호로 몇 개든 숫자가 나온 후 ext, x 또는 ext가 나오고 그 뒤에 2-5개의 숫자가 나온다.
    )''', re.VERBOSE)
            <br># TODO : Create email regex.
            <br># TODO : Find matches in clipboard text.
            <br># TODO : Copy results to the clipboard.</pre>
            <p>TODO 주석은 프로그램의 골격을 나타낸다. 이들은 실제 코드를 작성해 가면서 대체될 것이다.</p>
          </p>

          <p>
            <h5><strong>▶ 2단계: 이메일 주소에 대한 정규식 만들기</strong></h5>
            <p>이메일 주소를 찾기 위해서도 정규표현식이 필요하다. </p>
            <pre>#! python3<br>#  phoneAndEmail.py - Finds phone numbers and email addresses on the clipboard.
            <br>import pyperclip, re
            <br>phoneRegex = re.compile(r'''(
--snip--
            <br><strong># Create email regex.<br>emailRegex = re.compile(r'''(
    [a-zA-Z0-9._%+-]+     # username
    @                     # @ symbol
    [a-zA-Z0-9.-]+        # domain name
    (\.[a-zA-Z]{2,4})     # dot-something
    )''', re.VERBOSE)</strong>
            <br># TODO : Find matches in clipboard text.
            <br># TODO : Copy results to the clipboard.</pre>
            <p>위 정규표현식은 가능한 모든 유효한 이메일 주소와 일치하지는 못하지만 실제로 보게 되는 거의 모든 일반적인 이메일 주소와는 일치할 것이다.</p>
          </p>

          <p>
            <h5><strong>▶ 3단계: 클립보드 텍스트에서 일치하는 모든 것을 찾기</strong></h5>
            <p>이제 전화번호와 이메일 주소의 정규표현식을 지정했으므로 파이썬의 re 모듈이 클립보드에 있는 모든 일치되는 것을 찾기 위해 동작하도록 할 수 있다.
            <br>pyperclip.paste() 함수는 클립보드에 있는 텍스트 문자열 값을 가져온다. findall() 정규식 메소드는 튜플의 리스트를 돌려준다.</p>
            <pre>#! python3<br>#  phoneAndEmail.py - Finds phone numbers and email addresses on the clipboard.
            <br>import pyperclip, re
            <br>phoneRegex = re.compile(r'''(
--snip--
            <br><strong># Find matches in clipboard text.<br>text = str(pyperclip.paste())<br>matches = []<br>for groups in phoneRegex.findall(text):
    phoneNum = '-'.join([groups[1], groups[3], groups[5]])
    if groups[8] != '':
        phoneNum += ' x' + groups[8]
    matches.append(phoneNum)<br>for groups in emailRegex.findall(text):<br>    matches.append(groups[0])</strong>
            <br># TODO : Copy results to the clipboard.</pre>
            <p>각각의 일치가 하나의 튜플이며, 각 튜플은 정규식의 각 그룹에 대한 문자열을 포함하고 있다. 그룹 0은 전체 정규표현식과 일치하므로 튜플의 인덱스 0에 있는 그룹이 우리가 관심을 가질 만한 것이다.</p>
          </p>

          <p>
            <h5><strong>▶ 4단계: 일치하는 텍스트들을 하나의 문자열로 클립보드에 붙이기</strong></h5>
            <p>이제 matches 에 있는 문자열 리스트에 이메일 주소와 전화번호가 있으므로 이들을 클립보드에 붙여야 한다. pyperclip.copy() 함수는 문자열의 리스트가 아니라 하나의 문자열 값만을 받는다.</p>
            <pre>#! python3<br>#  phoneAndEmail.py - Finds phone numbers and email addresses on the clipboard.
            <br>import pyperclip, re
            <br>phoneRegex = re.compile(r'''(
--snip--
for groups in emailRegex.findall(text):<br>    matches.append(groups[0])
            <br><strong># Copy results to the clipboard.<br>if len(matches) > 0:<br>    pyperclip.copy('\n'.join(matches))<br>    print('Copied to clipboard: ')
    print('\n'.join(matches))<br>else:<br>    print('No phone numbers or email addresses found.')</strong></pre>
            <p>특정 페이지나 문서를 열고 Ctrl-A 를 눌러 모든 텍스트를 선택한 다음 Ctrl-C 를 눌러서 이들을 클립보드에 붙이고 이 프로그램을 실행한다.</p>
          </p>

          <p>
            <h5><strong>■ 연습 문제</strong></h5>
            <ul>
              <li>1. Regex 객체를 만드는 함수는 무엇인가?</li>
              <li>2. 정규식 객체를 생성할 때 원시 문자열을 자주 사용하는 이유는 무엇인가?</li>
              <li>3. search() 메소드는 무엇을 돌려주는가?</li>
              <li>4. Match 객체에서 패턴과 일치하는 실제 문자열을 어떻게 받을 수 있는가?</li>
              <li>5. r'(\d\d\d)-(\d\d\d-\d\d\d\d)'로부터 만든 정규식에서 그룹0은 무엇과 일치하는가? 그룹1과 그룹2는 각각 무엇과 일치하는가?</li>
              <li>6. 괄호와 마침표는 정규표현식 구문에서 특정한 의미를 가진다. 정규식이 실제 괄호, 마침표와 일치하도록 지정하려면 어떻게 해야 하는가?</li>
              <li>7. findall() 메소드는 문자열 리스트 또는 문자열 튜플의 리스트를 돌려준다. 각각은 어떤 경우인가?</li>
              <li>8. | 문자는 정규표현식에서 무엇을 의미 하는가?</li>
              <li>9. ? 문자는 정규표현식에서 무엇을 의미 하는가></li>
              <li>10. 정규표현식에서 + 와 * 문자의 차이점은 무엇인가?</li>
              <li>11. 정규표현식에서 {3}과 {3,5}의 차이점은 무엇인가?</li>
              <li>12. 정규표현식에서 \d, \w, \s 단축 문자 클래스는 무엇을 의미하는가?</li>
              <li>13. 정규표현식에서 \D, \W, \S 단축 문자 클래스는 무엇을 의미하는가?</li>
              <li>14. 정규표현식에서 대소문자를 구분하지 않게 하려면 어떻게 해야 하는가?</li>
              <li>15. 문자는 보통 무엇과 일치 하는가? re.DOTALL을 re.compile()의 두 번째 매개변수로 전달하면 무엇과 일치 하는가?</li>
              <li>16. .* 과 .*? 사이의 차이는 무엇인가?</li>
              <li>17. 모든 숫자 및 소문자와 일치하는 문자 클래스 구문은 무엇인가/></li>
              <li>18. 만약 numRegex = re.compile(r'\d+')라면, numRegex.sub('X', '12 drummers, 11 pipers, five rings, 3 hens')는 무엇을 돌려주는가?</li>
              <li>19. re.VERBOSE 를 re.compile()의 두 번째 매개변수로 전달하면 무엇이 가능해지는가?</li>
              <li>20. 세 자릿수마다 쉼표를 찍는 숫자와 일치하는 정규식은 어떻게 만드는가? 이 정규식은 다음과 일치해야 한다.</li>
              <pre>'42'<br>'1,234'<br>'6,368,745'</pre><p>그러나 다음과 일치해서는 안된다.</p>
              <pre>'12,34,567' (which has only two digits between commas)<br>'1234' (which lacks commas)</pre>
              <li>21. 성이 Nakamoto(나카모토)인 어떤 사람이 전체 이름과 일치하는 정규식은 어떻게 만드는가? 이름은 성 앞에 나오고 언제나 대문자로 시작하는 한 개의 단어라고 가정할 수 있다. 정규식은 다음과 일치해야 한다.</li>
              <pre>'Satoshe Nakamoto'<br>'Alice Nakamoto'<br>'RoboCop Nakamoto'</pre><p>그러나 다음과 일치해서는 안된다.</p>
              <pre>'satoshe Nakamoto' (이름의 첫글자가 대문자가 아니기 때문에)<br>'Mr. Nakamoto' (앞에 있는 단어에 문자가 아닌 기호가 있기 때문에)<br>'Nakamoto' (이름이 없기 때문에)<br>'Satoshi nakamoto' (nakamoto의 첫 글자가 대문자가 아니기 때문에)</pre>
              <li>22. 다음과 같은 문장과 일치하는 정규식은 어떻게 만드는가? 첫 번째 단어는 Alice, Bob, Carol이며, 두 번째 단어는 eats, pets, throws이고, 세 번째 단어는 apples, cats, baseball이어야 한다. 또한 문장은 마침표로 끝나야 한다. 이 정규식은 대소문자를 구분하지 않는다. 정규식은 다음과 일치해야 한다.</li>
              <pre>'Alice eats apples.'<br>'Bob pets cats.'<br>'Carol throws baseballs'<br>'Alice throws Apples.'<br>'BOB EATS CATS.'</pre><p>그러나 다음과 일치해서는 안된다.</p>
              <pre>'RoboCop eats apples.'<br>'ALICE THROWS FOOTBALLS.'<br>'Carol eats 7 cats.'</pre>
          </p>

        </article>
      </section>
    </div>
