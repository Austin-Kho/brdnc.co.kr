    <h4 class="heading"><a>■ 부록-A 타사 모듈 설치</a></h4>
    <div class="chapter">
      <section>
        <article class="">
          <p>파이썬과 함께 배포되는 표준 라이브러리 말고도 여러 개발자들이 파이썬의 기능을 더욱 확장하기 위해 모듈을 만들었다. 타사 모듈을 설치하는 기본 방법은 파이썬의 pip도구다.
          <br>이 도구는 파이썬 소프트웨어 재단의 웹사이트인 <a href="https://pypi.python.org/" target="blank">https://pypi.python.org/</a>에서 파이썬 모듈을 안전하게 다운로드 미 설치할 수 있다. PyPI, 또는 파이썬 패키지 인덱스 - 파이썬 모듈을 위한 일종의 무료 앱스토어다. </p>

          <p>
            <h5><strong>■ pip 도구</strong></h5>
            <p>pip 도구의 실행 파일은 윈도우에서는 pip이고 OS X 및 리눅스에서는 pip3이라고 한다. 윈도우라면 C:\Python34\Script\pip.exe에서 pip를 찾을 수 있다.
              <br>OS X 에서는 /Library/Frameworks/Python/.framework/Versions/3.4/bin/pip3에 있다. 리눅스에서는 /usr/bin/pip3에 있다. 윈도우와 OS X 에서는 파이썬 3.4를 설치하면 자동으로 딸려 오지만 리눅스에서는 따로 설치해야 한다.
            <br>우분투나 데비안 리눅스에 pip3 를 설치하려면 터미널에서 sudo apt-get install python3-pip를 입력하여 실행한다.페도라 리눅스에 pip3를 설치하려면 터미널에서 sudo yum install python3-pip를 입력하여 실행한다.</p>
          </p>

          <p>
            <h5><strong>■ 타사 모듈 설치하기</strong></h5>
            <p>pip 도구는 윈도우의 경우 CMD창이나 OS X 또는 리눅스의 경우 터미널과 같은 콘솔에서 pip install ModuleName 과 같은 명령 형태로 입력 실행하는 방식으로 설치한다.
            <br>ModuleName은 모듈의 이름이며, OS X 및 리눅스에서는 sudo를 붙여서 관리자 권한으로 모듈을 설치해야 한다. 설치후에는 대화형 쉘에서 import ModuleName을 입력해서 설치가 잘 되었는지 확인할 수 있다.
            <br>다음 목록에 있는 명령을 실행하여 여기에서 다루는 모든 모듈을 설치할 수 있다. (OS X 또는 리눅스라면 pip를 pip3로 바꾸어야 한다.)
            <!-- <pre> -->
              <ul>
                  <li>pip install send2trash</li>
                  <li>pip install requests</li>
                  <li>pip install beautifulsoup4</li>
                  <li>pip install selenium</li>
                  <li>pip install PyPDF2</li>
                  <li>pip install python-docx (docx가 아니라 python-docx를 설치해야 한다.)</li>
                  <li>pip install imapclient</li>
                  <li>pip install pyzmail</li>
                  <li>pip install twilio</li>
                  <li>pip install pillow</li>
                  <li>pip install pyobjc-core (OS X에서만)</li>
                  <li>pip install pyobjc (OS X에서만)</li>
                  <li>pip install python3-xlib (Linux에서만)</li>
                  <li>pip install pyautogui</li>
                  <li>pip install pyperclip</li>
              </ul>
            <!-- </pre> -->
          </p>
          </p>
        </article>
      </section>
    </div>
