      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="/bt/m4/project/<?php echo $this->uri->segment(3); ?>/1/">검토 프로젝트</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="/bt/m4/project/<?php echo $this->uri->segment(3); ?>/2/">프로젝트 등록</a></li>
        </ul>
      </div>