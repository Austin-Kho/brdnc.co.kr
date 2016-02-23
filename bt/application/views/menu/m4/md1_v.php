      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m4/project/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/1/">데이터 등록</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m4/project/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/2/">데이터 변경</a></li>
        </ul>
      </div>