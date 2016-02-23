      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m3/capital/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/1/">자금 일보</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m3/capital/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/2/">입출금 내역</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='3') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m3/capital/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/3/">입출금 등록</a></li>
        </ul>
      </div>