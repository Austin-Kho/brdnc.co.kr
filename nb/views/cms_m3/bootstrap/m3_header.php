<ul class="nav nav-tabs" role="tablist">
<?php for($i=0; $i<count($sec_menu); $i++) : ?>
	<li role="presentation" class="<?if(( !$this->uri->segment(3) && $i===0) or $this->uri->segment(3)===(string)($i+1)) echo 'active'; else echo '';?>">
		<a href="<?php echo $sec_menu[$i]->men_link; ?>"><strong><?php echo $sec_menu[$i]->men_name; ?></strong></a>
	</li>
<?php endfor; ?>
</ul>
<!-- ---------------------------------mdi-menu end------------------------------------ -->

<div class="page-header">
  <ul class="nav nav-pills">

<?php if( !$this->uri->segment(3) or $this->uri->segment(3) ==1) :
	$len = count($s_di[0]);
	for($i=0; $i<$len; $i++) :
		$j = $i+1;
?>
		<li role="presentation" class="<?php if(( !$this->uri->segment(4) && $j==1) or $this->uri->segment(4)==$j) echo 'active'; ?>">
			<a href="<?php echo $this->config->base_url('cms_m3/project'); ?>/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3).'/'.$j;} else {echo '1/'.$j;}?>"><?php echo $s_di[0][$i]; ?></a>
		</li>
<?
	endfor;
else :
	$len = count($s_di[1]);
	for($i=0; $i<$len; $i++) :
		$j = $i+1;
?>
		<li role="presentation" class="<?php if(( !$this->uri->segment(4) && $j==1) or $this->uri->segment(4)==$j) echo 'active'; ?>">
			<a href="<?php echo $this->config->base_url('cms_m3/project'); ?>/<?php if($this->uri->segment(3)) {echo $this->uri->segment(3).'/'.$j;} else {echo '1/'.$j;}?>"><?php echo $s_di[1][$i]; ?></a>
		</li>
<?
  	endfor;
  endif;
?>
  </ul>
</div>
<!-- ---------------------------------sdi-menu end------------------------------------ -->
<div class="page-header sdi_sub">
  <span class="glyphicon glyphicon-book head_gly" aria-hidden="true"></span>
  <h4 class="sdi">
<?php
  $k = ( !$this->uri->segment(3) or $this->uri->segment(3)==='1') ? 2 : 3;
  switch ($this->uri->segment(4)) :
  	case '1': echo $s_di[$k][0]; break;
  	case '2': echo $s_di[$k][1]; break;
  	case '3': echo $s_di[$k][2]; break;
  	case '4': echo $s_di[$k][3]; break;
  	default: echo $s_di[$k][0]; break;
  endswitch;
?>
  </h4>
</div>
<!-- ---------------------------------sdi-sub end------------------------------------ -->
<?php
	if($this->uri->segment(3, 1)=='1' && $this->uri->segment(4, 1)=='1') :
		include('md1_sd1.php');
	elseif ($this->uri->segment(3, 1)=='1' && $this->uri->segment(4)=='2') :
		include('md1_sd2.php');
  elseif ($this->uri->segment(3, 1)=='1' && $this->uri->segment(4)=='3') :
  	include('md1_sd3.php');
	elseif ($this->uri->segment(3)=='2' && $this->uri->segment(4, 1)=='1') :
		include('md2_sd1.php');
	elseif ($this->uri->segment(3)=='2' && $this->uri->segment(4)=='2') :
		include('md2_sd2.php');
	elseif ($this->uri->segment(3)=='2' && $this->uri->segment(4)=='3') :
		include('md2_sd3.php');
	endif
?>
