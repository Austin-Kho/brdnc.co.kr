<div class="main_start">&nbsp;</div>
<!-- 2. 사업관리 -> 1. 예산집행 관리 ->3. 수지 관리 -->

<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
	<form method="get" name="pj_sel" action="<?php echo current_url(); ?>">

		<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
		<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
			<div class="col-xs-12 col-sm-8" style="padding: 0px;">
				<label for="yr" class="sr-only">사업 개시년도</label>
				<select class="form-control input-sm" name="yr" onchange="submit();">
					<option value=""> 전 체
<?php
$start_year = "2015";
// if(!$yr) $yr=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
$year=range($start_year,date('Y'));
for($i=(count($year)-1); $i>=0; $i--) :
?>
					<option value="<?php echo $year[$i]?>" <?php if($this->input->get('yr')==$year[$i]) echo "selected"; ?>><?php echo $year[$i]."년"?>
<?php endfor; ?>
				</select>
			</div>
		</div>
		<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">프로젝트 선택 </div>
		<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
			<div class="col-xs-12 col-sm-8" style="padding: 0px;">
				<label for="project" class="sr-only">프로젝트 선택</label>
				<select class="form-control input-sm" name="project" onchange="submit();">
					<option value="0"> 전 체
<?php foreach($all_pj as $lt) : ?>
					<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
<?php endforeach; ?>
				</select>
			</div>
		</div>
	</form>
</div>

<div class="row">
	<div class="col-md-12">
	  <table class="table table-bordered">
	    <thead>
	      <tr>
	        <th>사업명</th>
	        <th>동춘1구역지역주택조합 공동주택사업 수지표</th>
	        <th>Last Name</th>
	        <th>Username</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td rowspan="2">1</td>
	        <td>Mark</td>
	        <td>Otto</td>
	        <td>@mdo</td>
	      </tr>
	      <tr>
	        <td>Mark</td>
	        <td>Otto</td>
	        <td>@TwBootstrap</td>
	      </tr>
	      <tr>
	        <td>2</td>
	        <td>Jacob</td>
	        <td>Thornton</td>
	        <td>@fat</td>
	      </tr>
	      <tr>
	        <td>3</td>
	        <td colspan="2">Larry the Bird</td>
	        <td>@twitter</td>
	      </tr>
	    </tbody>
	  </table>
	</div>
</div>
