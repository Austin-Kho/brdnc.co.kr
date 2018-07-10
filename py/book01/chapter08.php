    <h4 class="heading"><a>8장 파일 읽기 및 쓰기</a></h4>
    <div class="chapter" id="no8">
      <section>
        <article class="">
          <p>
            <h4><strong>■ 파일과 파일 경로</strong></h4>
            <p>파일은 '파일 이름'과 '파일 경로' 두 가지 핵심 속성이 있다. 이 중 파일 이름은 그 가운데 점 다음에 있는 부분을 파일의 확장자라고 하며 파일의 유형을 알려준다.
            윈도우의 루트 폴더는 'C:\' 이고 OS X와 리눅스는 '/'가 루트이다. 윈도우와 OS X는 폴더 이름과 파일 이름의 대소문자를 구분하지 않는 반면 리눅스는 구분한다.</p>
          </p>

          <p>
            <h5><strong>▶ 윈도우에서는 백슬래시, OS X와 리눅스에서는 슬래시</strong></h5>
            <p>윈도우 경로에서는 폴더이름 사이의 구분 기로호 백슬래시(\)를 사용한다. 그러나 OS X와 리눅스는 경로 구분 기호로 슬래시(/)를 사용한다. 프로그램이 모든 운영체제에서 잘 돌아가도록 하고 싶다면
            두 가지 경우 모두를 처리하는 파이썬 스크립트를 만들어야 한다.</p>
            <pre>>>> import os<br>>>> os.path.join('usr', 'bin', 'spam')<br>'usr/bin/spam'</pre>
            <p>OS X환경에서 대화형 쉘을 실행시켰으므로 위 예제는 'usr/bin/spam'를 돌려준다. 윈도우 환경이었더라면 'usr\\bin\\spam'이었을 것이다. 각각의 백슬래시는 백슬래시 문자로 이스케이프할 필요가 있으므로 이중으로 되어 있다는 점에 유의한다.</p>
            <p>파일 이름에 대한 문자열을 만들어야 하는 경우 os.path.join() 함수가 도움이 된다.</p>
            <pre>>>> myFiles = ['accounts.txt', 'details.csv', 'invite.docx']<br>>>> for filename in myFiles:<br>        print(os.path.join('C:\\Users\\asweigart', filename))
            <br>C:\Users\asweigart\accounts.txt<br>C:\Users\asweigart\details.csv<br>C:\Users\asweigart\invite.docx</pre>
          </p>

          <p>
            <h5><strong>▶ 현재 작업 디렉토리</strong></h5>
            <p>컴퓨터에서 실행되는 모든 프로그램은 현재 작업 디렉토리 또는 CWD가 있다. 루트폴더로 시작하지 않는 모든 파일 이름이나 경로는 현재 작업 디렉토리에 있는 것으로 가정한다.
            os.getcwd() 함수로 현재 작업 디렉토리 문자열 값으로 얻을 수 있으며 os.chdir() 로는 현재 작업 디렉토리를 바꿀 수 있다.</p>
            <pre>>>> import os<br>>>> os.getcwd()<br>'C:\\Python34'<br>>>> os.chdir('C:\\Windows\\System32')<br>'C:\\Windows\\System32'</pre>
            <p>존재하지 않는 디렉토리로 변경하려고 하면 파이썬은 오류(FileNotFoundError)를 표시한다.</p>
          </p>

          <p>
            <h5><strong>▶ 상대 경로 대 절대 경로</strong></h5>
            <p>파일 경로를 지정하는 방법은 두 가지가 있다.</p>
            <ul>
              <li>절대 경로 : 항상 루트 폴더로부터 시작한다.</li>
              <li>상대 경로 : 프로그램의 현재 작업 디렉토리를 기준으로 한다.</li>
            </ul>
            <p>또한 점(.) 그리고 점-점(..) 폴더가 있다. 이들은 진짜 폴더는 아니지만 경로에서 쓰일 수 있는 특별한 이름이다. 점 하나(.)는 '이 디렉토리'를 짧게 쓴 폴더 이름이다. 점 두 개(..)는 '부모 디렉토리'를 뜻한다.
            상대경로를 .\시작하는 것은 선택사항이다. 에를 들어 .\spam.txt 와 spam.txt 는 같은 파일을 가리킨다.</p>
          </p>

          <p>
            <h5><strong>▶ os.makedirs() 에 새 폴더 만들기</strong></h5>
            <p>프로그램은 os.makedirs() 함수를 사용하여 새 폴더(디렉토리)를 만들 수 있다.</p>
            <pre>>>> import os<br>>>> os.makedirs('C:\\delicious\\walnut\\waffles')</pre>
            <p>위 예제는 C:\\delicious 폴더만을 만드는 게 아니라 그 안에 walnut 폴더를 만들고 다시 그안에는 waffles 폴더를 만든다. 즉 os.makedirs() 는 전체 경로가 존재하도록 보장하기 위해 필요한 중간 폴더를 모두 만든다.</p>
          </p>

          <p>
            <h4><strong>■ os.path 모듈</strong></h4>
            <p>os.path 모듈은 파일 이름과 파일 경로에 관련된 많은 유용한 기능을 포함하고 있다. 앞에서 이 모든 운영체제에서 동작하는 방식으로 경로를 만드는 os.path.join() 를 사용했다.
              os.path는 os 모듈의 내부 모듈이기 때문에 import os만 실행하면 가져올 수 있다. 프로그램이 파일, 폴더 또는 파일 경로에 관한 작업을 해야 할 때마다 이 모듈을 사용할 수 있다.
              os.path 모듈의 전체 문서는 파이썬 웹사이트의 <a href="http://docs.python.org/3/library/os.path.html" target="_blank">http://docs.python.org/3/library/os.path.html</a>에 있다.</p>
          </p>

          <p>
            <h5><strong>▶ 절대 및 상대 경로 다루기</strong></h5>
            <p>os.path 모듈은 상대 경로의 절대 경로를 돌려주는 함수와 전달 받은 경로가 절대 경로인지 여부를 검사하는 함수를 제공한다.</p>
            <ul>
              <li>os.path.abspath(path) 함수를 호출하면 매개변수의 절대 경로 문자열을 돌려준다. 이는 상대경로를 절대경로로 변환하는 쉬운 방법이다.</li>
              <li>os.path.isabs(path) 함수를 호출하면 매개변수가 절대 경로일 때 True를, 상대 경로일 때 False를 돌려준다.</li>
              <li>os.path.relpath(path, start) 함수를 호출하면 start 경로로 시작하는 path의 상대 경로 문자열을 돌려준다. start가 제공되지 않으면, 현재 작업 디렉토리가 시작 경로로 사용된다.</li>
            </ul>
            <pre>>>> os.path.abspath('.')<br>'C:\\Python34'<br>>>> os.path.abspath('.\\Scripts')<br>'C:\\Python34\\scripts'<br>>>> os.path.isabs('.')<br>False<br>>>> os.path.isabs(os.path.abspath('.'))<br>True</pre>
            <p>os.path.abspath() 함수가 호출되었을 때 C:\\Python34가 작업 디렉토리였으므로 '점 한 개(.)' 폴더는 절대 경로 'C:\\Python34'를 뜻한다.</p>
            <pre>>>> os.path.relpath('C:\\Windows', 'C:\\')<br>'Windows'<br>>>> os.path.relpath('C:\\Windows', 'C:\\spam\\eggs')<br>'..\\..\\Windows'<br>>>> os.getcwd()<br>'C:\\Python34'</pre>
            <p>os.path.dirname(path)를 호출하면 path 매개변수의 마지막 ㅣ슬래시 앞에 오는 모든 문자열을 돌려준다. os.path.basename(path)를 호출하면 path 인수의 마지막 슬래시 뒤에 오는 모든 문자열을 돌려준다.</p>
            <pre>>>> path = 'C:\\Windows\\System32\\calc.exe'<br>>>> os.path.basename(path)<br>'calc.exe'<br>>>> os.path.dirname(path)<br>'C:\\Windows\\System32'</pre>
            <p>경로의 디렉토리 이름과 기본 이름이 함께 필요하면 다음과 같이 os.path.split() 함수를 호출해서 두 개의 문자열 튜플 값을 얻을 수 있다.</p>
            <pre>>>> calcFilePath = 'C:\\Windows\\System32\\calc.exe'<br>>>> os.path.split(calcFilePath)<br>('C:\\Windows\\System32', 'calc.exe')</pre>
            <p>os.path.dirname()과 os.path.basename()을 호출하고 돌려받은 값을 튜플에 넣으면 같은 튜플을 만들 수 있다는 것을 알 수 있다.</p>
            <pre>>>> (os.path.dirname(calcFilePath), os.path.basename(calcFilePath))<br>('C:\\Windows\\System32', 'calc.exe')</pre>
            <p>os.path.split()는 두 값이 모두 필요할 때의 좋은 지름길이다. 또한 os.path.split()는 파일 경로를 받아서 각 폴더의 문자열 리스트 값을 돌려주지 않는다는 점에 유의한다. 그와 같은 리스트를 받으려면
            split() 문자열 메소드를 사용할 때 os.sep에 있는 문자열로 분리해야 한다. 앞에서 os.sep 변수가 프로그램을 실행하는 컴퓨터에 대한 올바른 폴더 분리 슬래시로 설정되어 있단ㄴ, 것을 보았던 사실을 떠올려 보자.</p>
            <pre>>>> calcFilePath.split(os.path.sep)<br>['C:', 'Windows', 'System32', 'calc.exe']</pre>
            <p>OS X와 리눅스 시스템의 경우, 돌려받는 리스트의 시작에는 빈 문자열이 있을 것이다.</p>
            <pre>>>> '/usr/bin'.split(os.path.sep)<br>['', 'usr', 'bin']</pre>
            <p>split() 문자열 메소드는 경로의 각 부분으로 구성된 리스트를 돌려준다. 여기에 os.path.sep을 전달하면 모든 운영체제에서 잘 될 것이다.</p>
          </p>

          <p>
            <h5><strong>▶ 파일 크기와 폴더 내용 찾기</strong></h5>
            <p>os.path 모듈은 파일의 바이트 단위 크기를 알아내고 지정된 폴더 안에 있는 파일과 폴더를 찾는 기능을 제공한다.</p>
            <ul>
              <li>os.path.getsize(path) 함수를 호출하면 path 매개변수 안에 있는 파일의 크기를 바이트 단위로 돌려준다.</li>
              <li>os.listdir(path) 함수를 부르면 path 매개변수의 각 파일에 대한 파일 이름 문자열의 리스트를 돌려준다. (이 기능은 os.path 모듈이 아니라 os 모듈에 있다.)</li>
            </ul>
            <pre>>>> os.path.getsize('C:\\Windows\\System32\\calc.exe')<br>776192<br>>>> os.listdir('C:\\Windows\\System32')<br>['0049', '12520437.cpx', '12520850.cpx', '5U877.ax', 'aaclient.dll,<br>--snip--<br>'xwtpdui.dll', 'xwtpw32.dll', 'zh-CN', 'zh-HK', 'zh-TW', 'zipfldr.dll']</pre>
          </p>
        </article>
      </section>
    </div>
