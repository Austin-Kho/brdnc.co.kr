      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m2/local/<?php echo $this->uri->segment(3); ?>/1/">인원 현황</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m2/local/<?php echo $this->uri->segment(3); ?>/2/">인원 등록</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='3') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m2/local/<?php echo $this->uri->segment(3); ?>/3/">소속 관리</a></li>
        </ul>
      </div>