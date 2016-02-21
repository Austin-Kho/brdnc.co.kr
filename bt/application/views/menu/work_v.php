      <div style="height: 10px;"></div>

      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?if( !$this->uri->segment(3) or strpos($this->uri->segment(3), '1')) echo 'active'; else echo '';?>">
        	<a href="/bt/m1/work/md_1/"><strong>계 약 현 황</strong></a>
        </li>
        <li role="presentation" class="<?if( !strpos($this->uri->segment(3), '2')) echo ''; else echo 'active';?>">
        	<a href="/bt/m1/work/md_2/"><strong>업 무 현 황</strong></a>
        </li>
      </ul>

      <div class="page-header">
        <nav class="sd_nav" style="margin-left: -20px;">
          <ul>
            <li><a href="/bt/m1/work/<?php echo $this->uri->segment(3); ?>/sd1/" class="<?php if($this->uri->segment(4)=='sd1') {echo 'menuActive';}else{echo 'menuLink';} ?>">계약현황</a></li>
            <li>|</li>
            <li><a href="/bt/m1/work/<?php echo $this->uri->segment(3); ?>/sd2/" class="<?php if($this->uri->segment(4)=='sd2') {echo 'menuActive';}else{echo 'menuLink';} ?>">계약등록</a></li>
            <li>|</li>
            <li><a href="/bt/m1/work/<?php echo $this->uri->segment(3); ?>/sd3/" class="<?php if($this->uri->segment(4)=='sd3') {echo 'menuActive';}else{echo 'menuLink';} ?>">동호수현황</a></li>
          </ul>
        </nav>
      </div>



