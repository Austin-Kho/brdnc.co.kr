      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?if( !$this->uri->segment(3) or $this->uri->segment(3)=='1') echo 'active'; else echo '';?>">
        	<a href="<?php echo $this->config->base_url(); ?>m4/project/1/"><strong>프로젝트 관리</strong></a>
        </li>
        <li role="presentation" class="<?if( $this->uri->segment(3)=='2') echo 'active'; else echo '';?>">
        	<a href="<?php echo $this->config->base_url(); ?>m4/project/2/"><strong>신규 프로젝트</strong></a>
        </li>
      </ul>
<!-- ---------------------------------mdi-menu end------------------------------------ -->

      <div class="page-header">
        <ul class="nav nav-pills">

<?php if( !$this->uri->segment(3) or $this->uri->segment(3) ==1) {
				$len = count($s_di[0]);
				for($i=0; $i<$len; $i++) {
					$j = $i+1;
?>
					<li role="presentation" class="<?php if(( !$this->uri->segment(4) && $j==1) or $this->uri->segment(4)==$j) echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m4/project/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3).'/'.$j.'/';} else {echo '1/'.$j.'/';}?>"><?php echo $s_di[0][$i]; ?></a></li>
<?
				}
			}else{
				$len = count($s_di[1]);
				for($i=0; $i<$len; $i++) {
					$j = $i+1;
?>
					<li role="presentation" class="<?php if(( !$this->uri->segment(4) && $j==1) or $this->uri->segment(4)==$j) echo 'active'; ?>"><a href="<?php echo $this->config->base_url(); ?>m4/project/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3).'/'.$j.'/';} else {echo '1/'.$j.'/';}?>"><?php echo $s_di[1][$i]; ?></a></li>
<?
				}
			}
?>
      </div>
<!-- ---------------------------------sdi-menu end------------------------------------ -->
      <div class="page-header" id="sdi_sub">
        <span class="glyphicon glyphicon-book" aria-hidden="true" id="head_gly"></span>
        <span>
<?php
			if( !$this->uri->segment(3) or $this->uri->segment(3)==1) {$k = 2; } else { $k = 3; }
			switch ($this->uri->segment(4)) {
				case '1':
					echo $s_di[$k][0];
					break;
				case '2':
					echo $s_di[$k][1];
					break;
				case '3':
					echo $s_di[$k][2];
					break;
				case '4':
					echo $s_di[$k][3];
					break;

				default:
					echo $s_di[$k][0];
					break;
			}
 ?>
        </span>
      </div>
<!-- ---------------------------------sdi-sub end------------------------------------ -->