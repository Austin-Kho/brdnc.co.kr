<?php
  if($auth21<1) :
  	include('no_auth.php');
  else :
    redirect(base_url('board/spare_project_m3'));
  endif ?>
