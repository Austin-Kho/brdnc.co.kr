     <div style="height: 10px;"></div>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?if( !$this->uri->segment(3) or $this->uri->segment(3)=='1') echo 'active'; else echo '';?>">
        	<a href="<?php echo $this->config->base_url(); ?>m5/config/1/"><strong>기본 정보관리</strong></a>
        </li>
        <li role="presentation" class="<?if( $this->uri->segment(3)=='2') echo 'active'; else echo '';?>">
        	<a href="<?php echo $this->config->base_url(); ?>m5/config/2/"><strong>회사 정보관리</strong></a>
        </li>
      </ul>
<!-- ---------------------------------mdi-menu------------------------------------ -->



      <div class="page-header">
        <ul class="nav nav-pills">

          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m5/config/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/1/">부서 관리</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m5/config/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/2/">직원 관리</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='3') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m5/config/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/3/">거래처 정보</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='4') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m5/config/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3);} else {echo '1';}?>/4/">계좌 관리</a></li>
        </ul>
      </div>

      <div class="page-header" id="sdi_sub">
        <span class="glyphicon glyphicon-blackboard" aria-hidden="true" id="glyphicon"></span>
        <span>부서정보 관리 <?php var_dump($md_bt->md1_sd_bt); ?></span>
      </div>