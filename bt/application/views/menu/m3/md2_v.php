      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="/bt/m3/capital/<?php echo $this->uri->segment(3); ?>/1/">분개장</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="/bt/m3/capital/<?php echo $this->uri->segment(3); ?>/2/">일·월계표</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='3') echo 'active'; ?>"><a href="/bt/m3/capital/<?php echo $this->uri->segment(3); ?>/3/">주요 제무제표</a></li>
        </ul>
      </div>