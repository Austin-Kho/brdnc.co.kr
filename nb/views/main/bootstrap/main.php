<div id="carousel-generic" class="carousel slide" data-ride="carousel" style="margin-top: -14px;">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-generic" data-slide-to="1"></li>
		<li data-target="#carousel-generic" data-slide-to="2"></li>
		<li data-target="#carousel-generic" data-slide-to="3"></li>
		<li data-target="#carousel-generic" data-slide-to="4"></li>
		<li data-target="#carousel-generic" data-slide-to="5"></li>
		<li data-target="#carousel-generic" data-slide-to="6"></li>
		<li data-target="#carousel-generic" data-slide-to="7"></li>
		<li data-target="#carousel-generic" data-slide-to="8"></li>
	</ol>
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<img src="<?php echo $this->config->base_url('static/img/111.jpg'); ?>" alt="1st slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(72)</h4><p>72 TYPE Living room</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url('static/img/222.jpg'); ?>" alt="2nd slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(72)</h4><p>72 TYPE badroom(1st)</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url('static/img/333.jpg'); ?>" alt="3rd slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(72)</h4><p>72 TYPE kitchen Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url('static/img/444.jpg'); ?>" alt="4th slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(72)</h4><p>72 TYPE 안방 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url('static/img/555.jpg'); ?>" alt="5th slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(72)</h4><p>72 TYPE 욕실 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url('static/img/666.jpg'); ?>" alt="6th slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(84C)</h4><p>84C TYPE 침실1 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url('static/img/777.jpg'); ?>" alt="7th slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(84C)</h4><p>84C TYPE 거실 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url('static/img/888.jpg'); ?>" alt="8th slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(84C)</h4><p>84C TYPE 주방 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url('static/img/999.jpg'); ?>" alt="9th slide">
			<div class="carousel-caption"><h4>양우 내안애 에르바체 - TYPE(84C)</h4><p>84C TYPE 안방 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
		</div>
	</div>
	<a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

<div class="page-header" style="margin-top: 18px;"></div>

<div class="well hidden-xs">
	<blockquote  style="margin: 0;">
		<p style="font-weight: bold; color: #7c6848;"><?php echo $saying->saying_han; ?></p>
		<footer><?php echo $saying->saying_en; ?></footer>
	</blockquote>
</div>

<?php
if($this->session->userdata('mem_level')< 30):
	include('no_auth.php');

else :

	$k = 0;
	$is_open = false;
	if (element('board_list', $view)) {
		$i=1;
    foreach (element('board_list', $view) as $key => $board) {
			if($i>2) break;
      $config = array(
        'skin' => 'bootstrap',
        'brd_key' => element('brd_key', $board),
        'limit' => 5,
        'length' => 40,
        'is_gallery' => '',
        'image_width' => '',
        'image_height' => '',
        'cache_minute' => 1,
      );
      if ($k % 2 === 0) {
        echo '<div class="row">';
        $is_open = true;
      }
      echo $this->board->latest($config);
      if ($k % 2 === 1) {
        echo '</div>';
        $is_open = false;
      }
      $k++;
			$i++;
    }
	}
	if ($is_open) {
	    echo '</div>';
	    $is_open = false;
	}
?>
<div class="page-header" style="margin-top: 0;"></div>
<div class="row font13">
	<div class="col-xs-12" style="padding: 0px;">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-success">
				<div class="panel-heading"><h4 class="panel-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 동춘1구역 청약 · 계약 현황</h4></div>
				<div class="panel-body">
					<div class="col-xs-5">신규 청약 건 (최근 7일) : </div>
					<div class="col-xs-3 right" style="color: #3404D6;"><?php echo number_format($app_7day->num)." 건" ?></div>
					<div class="col-xs-4 right "></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-5">신규 계약 건 (최근 7일) : </div>
					<div class="col-xs-3 right" style="color: #3404D6;"><?php echo number_format($cont_7day->num)." 건" ?></div>
					<div class="col-xs-4 right "><a href="/nb/cms_m1/sales/1/2?cont_sort2=2">계약 등록 →</a></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-5">전체 청약 건 : </div>
					<div class="col-xs-3 right"><?php echo number_format($app_num->num)." 건" ?></div>
					<div class="col-xs-4 right "></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-5">전체 계약 건 : </div>
					<div class="col-xs-3 right"><?php echo number_format($cont_num->num)." 건" ?></div>
					<div class="col-xs-4 right "><a href="/nb/cms_m1">계약 현황 →</a></div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h4 class="panel-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 동춘1분담금 총 납부현황</h4></div>
				<div class="panel-body">
					<div class="col-xs-6">조합 분담금 : </div>
					<div class="col-xs-6 right"><?php echo number_format($receive->receive)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">업무 대행비 : </div>
					<div class="col-xs-6 right"><?php echo  number_format($agent_cost->agent_cost)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">합 계 : </div>
					<div class="col-xs-6 right"><?php echo  number_format($receive->receive+$agent_cost->agent_cost)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6"></div>
					<div class="col-xs-6 right"><a href="/nb/cms_m1/sales/2/1">수납현황 바로가기</a></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12" style="padding: 0px;">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-info">
				<div class="panel-heading"><h4 class="panel-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 동춘1 계좌 별 납부현황 [1]</h4></div>
				<div class="panel-body">
					<div class="col-xs-6">신탁계좌[신청금] : </div>
					<div class="col-xs-6 right"><?php echo number_format($rec[1]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">신탁계좌[분담금] : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[2]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">신탁계좌[대행비] : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[3]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">김현수[분담금] : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[8]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">합 계 : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[1]->rec+$rec[2]->rec+$rec[3]->rec+$rec[8]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6"></div>
					<div class="col-xs-6 right"><a href="/nb/cms_m1/sales/2/2">수납등록 바로가기</a></div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-warning">
				<div class="panel-heading"><h4 class="panel-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 동춘1 계좌 별 납부현황 [2]</h4></div>
				<div class="panel-body">
					<div class="col-xs-6">바램계좌[외환] : </div>
					<div class="col-xs-6 right"><?php echo number_format($rec[4]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">바램계좌[국민] : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[5]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">바램계좌[신한] : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[6]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">바램계좌[농협] : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[7]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">현금수표수납 : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[0]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6">합 계 : </div>
					<div class="col-xs-6 right"><?php echo  number_format($rec[0]->rec+$rec[4]->rec+$rec[5]->rec+$rec[6]->rec+$rec[7]->rec)." 원"; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
