      <div style="height: 10px;"></div>

      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?if( !$this->uri->segment(3) or $this->uri->segment(3)=='1') echo 'active'; else echo '';?>">
        	<a href="<?php echo $this->config->base_url(); ?>m1/work/1/"><strong>계 약 현 황</strong></a>
        </li>
        <li role="presentation" class="<?if( $this->uri->segment(3)=='2') echo 'active'; else echo '';?>">
        	<a href="<?php echo $this->config->base_url(); ?>m1/work/2/"><strong>업 무 현 황 <?php $this->config->item('base_url'); ?></strong></a>
        </li>
      </ul>