      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="/bt/m5/config/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/1/">부서정보 관리</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="/bt/m5/config/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/2/">직원정보 관리</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='3') echo 'active'; ?>"><a href="/bt/m5/config/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/3/">거래처 정보</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='4') echo 'active'; ?>"><a href="/bt/m5/config/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/4/">은행계좌 관리</a></li>
        </ul>
      </div>