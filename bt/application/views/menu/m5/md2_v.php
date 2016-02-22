      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="/bt/m5/config/<?php echo $this->uri->segment(3); ?>/1/">회사 기본정보</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="/bt/m5/config/<?php echo $this->uri->segment(3); ?>/2/">사용자 권한관리</a></li>
        </ul>
      </div>