      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="/bt/m1/work/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/1/">계약현황</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="/bt/m1/work/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/2/">계약등록</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='3') echo 'active'; ?>"><a href="/bt/m1/work/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/3/">동호수현황</a></li>
          <!-- <li role="presentation"><a href="/bt/m1/work/<?php echo $this->uri->segment(3); ?>/sd4/">은행계좌 관리</a></li> -->
        </ul>
      </div>