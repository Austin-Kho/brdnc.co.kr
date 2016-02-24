      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m5/config/<?php echo $this->uri->segment(3); ?>/1/">회사 정보</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m5/config/<?php echo $this->uri->segment(3); ?>/2/">권한 관리</a></li>
        </ul>
      </div>

	<div class="page-header" id="sdi_sub">
		<span class="glyphicon glyphicon-blackboard" aria-hidden="true" id="glyphicon"></span>
		<span>회사 기본정보</span>
	</div>