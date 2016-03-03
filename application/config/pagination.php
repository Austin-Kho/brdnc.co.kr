<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
/*
| -------------------------------------------------------------------
| PAGINATION CONFIG
| -------------------------------------------------------------------
| pagination 라이브러리의 각 페이지별 공통 설정.
| 이 페이지 설정 이외에 개별페이지에서 별도의 설정이 없다면
| $this->pagination->initialize() 함수의 호출이 불필요함.
|
*/
	$config['num_links'] = 3;

	$config['first_link'] = "<span class='glyphicon glyphicon-triangle-left' aria-hidden='true'></span> 처음";
	$config['first_tag_open'] = " <li>";
	$config['first_tag_close'] = " </li>";

	$config['last_link'] = "끝 <span class='glyphicon glyphicon-triangle-right' aria-hidden='true'></span>";
	$config['last_tag_open'] = "<li>";
	$config['last_tag_close'] = " </li>";

	$config['next_link'] ="<span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span>";
	$config['next_tag_open'] = " <li>";
	$config['next_tag_close'] = " </li>";

	$config['prev_link'] = "<span class='glyphicon glyphicon-menu-left' aria-hidden='true'></span>";
	$config['prev_tag_open'] = " <li>";
	$config['prev_tag_close'] = " </li>";

	$config['cur_tag_open'] = "<li class='active'><a>";
	$config['cur_tag_close'] = "</a></li>";

	$config['num_tag_open'] = "<li>";
	$config['num_tag_close'] = "</li>";

	$config['attributes']['rel'] = FALSE;
	$config['use_page_numbers'] = TRUE;

// End of this File