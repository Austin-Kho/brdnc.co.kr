<!-- Main jumbotron for a primary marketing message or call to action -->
<!-- <div class="jumbotron">
<h2>美정부, 아이폰 잠금해제 또 요청…"해제거부는 마케팅전략"</h2>
<p>애플 "고객보안이 최우선" (샌프란시스코 AFP=연합뉴스) 팀 쿡 애플 최고경영자(CEO)는 17일(현지시간) '고객에게 드리는 메시지'를 통해 "미국 정부는 애플이 우리 고객의 보안을 위협하는 전에 없는 조처를 받아들이라고 요구해 왔다"며 "...</p>
</div> -->
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
			<img src="<?php echo $this->config->base_url(); ?>static/img/111.jpg" alt="First slide">
			<div class="carousel-caption"><h3>양우내안애 Ervache</h3><p>72Type 거실 --- Nulla vitae elit libero, a pharetra augue mollis interdum.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url(); ?>static/img/222.jpg" alt="Second slide">
			<div class="carousel-caption"><h3>Second slide label</h3><p>72Type 침실1 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url(); ?>static/img/333.jpg" alt="Third slide">
			<div class="carousel-caption"><h3>Third slide label</h3><p>72Type 주방 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url(); ?>static/img/444.jpg" alt="4th slide">
			<div class="carousel-caption"><h3>양우내안애 Ervache</h3><p>72Type 안방 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url(); ?>static/img/555.jpg" alt="5th slide">
			<div class="carousel-caption"><h3>양우내안애 Ervache</h3><p>72Type 욕실 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url(); ?>static/img/666.jpg" alt="6th slide">
			<div class="carousel-caption"><h3>양우내안애 Ervache</h3><p>84C Type 침실1 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url(); ?>static/img/777.jpg" alt="7th slide">
			<div class="carousel-caption"><h3>양우내안애 Ervache</h3><p>84C Type 거실 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url(); ?>static/img/888.jpg" alt="8th slide">
			<div class="carousel-caption"><h3>양우내안애 Ervache</h3><p>84C Type 주방 Praesent commodo cursus magna, vel scelerisque nisl<br> consectetur.</p></div>
		</div>
		<div class="item">
			<img src="<?php echo $this->config->base_url(); ?>static/img/999.jpg" alt="9th slide">
			<div class="carousel-caption"><h3>양우내안애 Ervache</h3><p>84C Type 안방 Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
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
<div class="page-header">
	<!-- <h1>Wells</h1><!-- 영문 h1-->
	<!-- <h3>공지사항</h3><!-- 한글 h3-->
</div>
<div class="well hidden-xs">
	<blockquote  style="margin: 0;">
		<p style="font-weight: bold; color: #7c6848;"><?php echo $saying->saying_han; ?></p>
		<footer><?php echo $saying->saying_en; ?></footer>
	</blockquote>
</div>
<!-- <div class="page-header">
<h1>Panels</h1>
</div> -->
<div class="row font13">
	<div class="col-xs-12" style="padding: 0;">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-success">
				<div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 동춘1구역 청약 · 계약 현황</h3></div>
				<div class="panel-body">
					<div class="col-xs-5" style="padding: 0;">신규 청약 건 (최근 7일) : </div>
					<div class="col-xs-3 right" style="padding: 0; color: #3404D6;"><?php echo number_format($app_7day->num)." 건" ?></div>
					<div class="col-xs-4 right " style="padding: 0;"></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-5" style="padding: 0;">신규 계약 건 (최근 7일) : </div>
					<div class="col-xs-3 right" style="padding: 0; color: #3404D6;"><?php echo number_format($cont_7day->num)." 건" ?></div>
					<div class="col-xs-4 right " style="padding: 0;"><a href="/ns/m1/sales/1/2?cont_sort2=2">계약 등록 →</a></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-5" style="padding: 0;">전체 청약 건 : </div>
					<div class="col-xs-3 right" style="padding: 0;"><?php echo number_format($app_num->num)." 건" ?></div>
					<div class="col-xs-4 right " style="padding: 0;"></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-5" style="padding: 0;">전체 계약 건 : </div>
					<div class="col-xs-3 right" style="padding: 0;"><?php echo number_format($cont_num->num)." 건" ?></div>
					<div class="col-xs-4 right " style="padding: 0;"><a href="/ns/m1">계약 현황 →</a></div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 동춘1분담금 총 납부현황</h3></div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">조합 분담금 : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo number_format($receive->receive)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">업무 대행비 : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($agent_cost->agent_cost)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">합 계 : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($receive->receive+$agent_cost->agent_cost)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;"></div>
					<div class="col-xs-6 right" style="padding: 0;"><a href="/ns/m1/sales/2/1">수납현황 바로가기</a></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12" style="padding: 0;">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-info">
				<div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 동춘1 계좌 별 납부현황 [1]</h3></div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">신탁계좌[신청금] : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo number_format($rec[1]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">신탁계좌[분담금] : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($rec[2]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">신탁계좌[대행비] : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($rec[3]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">합 계 : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($rec[1]->rec+$rec[2]->rec+$rec[3]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;"></div>
					<div class="col-xs-6 right" style="padding: 0;"><a href="/ns/m1/sales/2/2">수납등록 바로가기</a></div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-warning">
				<div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> 동춘1 계좌 별 납부현황 [2]</h3></div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">바램계좌[외환] : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo number_format($rec[4]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">바램계좌[국민] : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($rec[5]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">바램계좌[신한] : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($rec[6]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">현금수표수납 : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($rec[0]->rec)." 원"; ?></div>
				</div>
				<div class="panel-body">
					<div class="col-xs-6" style="padding: 0;">합 계 : </div>
					<div class="col-xs-6 right" style="padding: 0;"><?php echo  number_format($rec[0]->rec+$rec[4]->rec+$rec[5]->rec+$rec[6]->rec)." 원"; ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12" style="padding: 0;">
		<div class="col-xs-12 col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-headphones" aria-hidden="true"></span> 사 내 공 지</h3></div>
<?php foreach($current_rec1 as $lt) :  ?>
				<div class="panel-body">
					<div class="col-xs-8" style="padding: 0;">게시물이 없습니다.</div>
					<div class="col-xs-4" style="padding: 0;"></div>
				</div>
<?php endforeach; ?>
			</div>
		</div>
	</div>

	<!-- <div class="col-xs-12" style="padding: 0;">
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-info">
				<div class="panel-heading"><h3 class="panel-title">동춘1 최근 입금 거래 현황 [1]</h3></div>
<?php foreach($current_rec1 as $lt) :  ?>
				<div class="panel-body">
					<div class="col-xs-4" style="padding: 0;"><?php echo $lt->paid_who; ?></div>
					<div class="col-xs-4" style="padding: 0;"><?php echo $lt->paid_date; ?></div>
					<div class="col-xs-4 right" style="padding: 0;"><?php echo number_format($lt->paid_amount)." 원"; ?></div>
				</div>
<?php endforeach; ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="panel panel-info">
				<div class="panel-heading"><h3 class="panel-title">동춘1 최근 입금 거래 현황 [2]</h3></div>
<?php foreach($current_rec2 as $lt) :  ?>
				<div class="panel-body">
					<div class="col-xs-4" style="padding: 0;"><?php echo $lt->paid_who; ?></div>
					<div class="col-xs-4" style="padding: 0;"><?php echo $lt->paid_date; ?></div>
					<div class="col-xs-4 right" style="padding: 0;"><?php echo number_format($lt->paid_amount)." 원"; ?></div>
				</div>
<?php endforeach; ?>
			</div>
		</div>
	</div> -->
</div>
