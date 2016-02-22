      <div class="page-header">
        <ul class="nav nav-pills">
          <li role="presentation" class="<?php if( !$this->uri->segment(4) or $this->uri->segment(4)=='1') echo 'active'; ?>"><a href="/bt/m1/work/<?php echo $this->uri->segment(3); ?>/1/">고객 상담일지</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='2') echo 'active'; ?>"><a href="/bt/m1/work/<?php echo $this->uri->segment(3); ?>/2/">업무일지</a></li>
          <li role="presentation" class="<?php if($this->uri->segment(4)=='3') echo 'active'; ?>"><a href="/bt/m1/work/<?php echo $this->uri->segment(3); ?>/3/">업무보고</a></li>
          <!-- <li role="presentation"><a href="/bt/m1/work/<?php echo $this->uri->segment(3); ?>/sd4/">은행계좌 관리</a></li> -->
        </ul>
      </div>