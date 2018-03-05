<?php
  if($auth13<1) :
  	include('no_auth.php');
  else :
?>
<div class="main_start">&nbsp;</div>
<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->2. 기본정보 수정 -->

<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
<?php
  $attributes = array('method' => 'get', 'name' => 'pj_sel');
  echo form_open(current_full_url(), $attributes);
?>
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
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">프로젝트 선택</div>
    <div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-8" style="padding: 0px;">
        <label for="project" class="sr-only">사업 개시년도</label>
        <select class="form-control input-sm" name="project" onchange="submit();">
          <option value=""> 전 체
<?php foreach($pj_list as $lt) : ?>
          <option value="<?php echo $lt->seq; ?>" <?php if($this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
<?php endforeach; ?>
        </select>
      </div>
    </div>
  </form>
</div>

<?php
  $set_sort_url1 = htmlspecialchars(base_url('cms_m3/project/1/3').'?yr='.$this->input->get('yr').'&project='.$project.'&set_sort=1');
  $set_sort_url2 = htmlspecialchars(base_url('cms_m3/project/1/3').'?yr='.$this->input->get('yr').'&project='.$project.'&set_sort=2');
?>

<div class="row font12" style="margin: 0 0 20px;">
  <ul class="nav nav-tabs">
    <li role="presentation" class="<?php if(empty($this->input->get('set_sort')) or $this->input->get('set_sort')==='1') echo 'active'; ?>"><a href="<?php echo $set_sort_url1; ?>">토지 기초 정보</a></li>
    <li role="presentation" class="<?php if($this->input->get('set_sort')==='2') echo 'active'; ?>"><a href="<?php echo $set_sort_url2; ?>">소유권 관련 정보</a></li>
  </ul>
</div>
<?php if( !$this->input->get('set_sort') OR $this->input->get('set_sort')==='1') { //1. 토지 기초 정보?>
<div class="row table-responsive font12" style="margin: 0; padding: 0; height: 480px;">

    no. / 행정동(Lot) / 지번 / 지목 / 면적 / 환지면적 / 주 소유자명 및 공유자 수 / 전체 토지에 해당 되는 권리 제한 사항 및 비고

</div>

<?php }elseif($this->input->get('set_sort')==='2'){  // 2. 소유권 관련 정보 ?>
<div class="row table-responsive font12" style="margin: 0; padding: 0; height: 480px;">

    no. / {지번ID} 행정동 지번 / 소(공)유자 / 소유지분 / 소유면적 / 소유구분(개인, 법인, 국, 공유지) / 계약여부 / 총 매매대금 / 대금지급 관련 사항 / 소유자에게 국한되는 권리제한사항 및 비고</br></br></br>

    <strong>대금지급 관련 사항</strong></br>
    지급계좌(은행/계좌번호/예금주) / 계약금1 / 계약금1 지급일자 / 계약금1 지급여부 / 계약금2 / 계약금2 지급일자 / 계약금2 지급여부 / 중도금1 / 중도금1 지급일자 / 중도금1 지급여부
    / 중도금2 / 중도금2 지급일자 / 중도금2 지급여부 /  잔금 / 잔금지급일자 / 잔금 지급여부

</div>
<?php } ?>



<?php endif ?>
