      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="/bt/m2/local/<?php echo $this->uri->segment(3); ?>/1/">현장 인원현황</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="/bt/m2/local/<?php echo $this->uri->segment(3); ?>/2/">현장 인원등록</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='3') echo 'active'; ?>"><a href="/bt/m2/local/<?php echo $this->uri->segment(3); ?>/3/">사용자 소속관리</a></li>
        </ul>
      </div>