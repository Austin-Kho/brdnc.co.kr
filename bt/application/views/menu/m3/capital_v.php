     <div style="height: 10px;"></div>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?if( !$this->uri->segment(3) or $this->uri->segment(3)=='1') echo 'active'; else echo '';?>">
        	<a href="<?php echo $this->config->base_url(); ?>m3/capital/1/"><strong>자 금 현 황</strong></a>
        </li>
        <li role="presentation" class="<?if( $this->uri->segment(3)=='2') echo 'active'; else echo '';?>">
        	<a href="<?php echo $this->config->base_url(); ?>m3/capital/2/"><strong>회 계 관 리</strong></a>
        </li>
      </ul>