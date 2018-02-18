<?php
if($auth21<1) :
	include('no_auth.php');
else :
	redirect(base_url('board/project_doc_m2'));
endif ?>
