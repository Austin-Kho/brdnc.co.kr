<?php
  if($auth13<1) :
  	include('no_auth.php');
  else :
    if($auth13<2) {
      $submit_str="alert('등록 권한이 없습니다!')";
    } else {
      if(empty($this->input->get('project'))){
        $submit_str="alert('등록할 프로젝트를 선택하여 주십시요!'); document.pj_sel.project.focus();";
      }else{
        $submit_str="if(confirm('토지 기초 데이터를 등록하시겠습니까?')===true) submit();";
      }
    }
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
<!------- 토지 기초 정보 입출력 하기 ------->
<?php if( !$this->input->get('set_sort') OR $this->input->get('set_sort')==='1') { //1. 토지 기초 정보?>
<div class="row font12" style="margin: 0; padding: 0; height: 480px;">
  <!-- 입력하기 폼 -->
<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'basic_insert');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'sort' => 'basic'
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
    <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
      <div class="col-sm-12 col-md-1 center point-sub1" style="padding: 10px; 0">토지 데이터</div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 4px 15px;">
        <label for="order_no" class="sr-only">순번</label>
        <input type="text" name="order_no" value="<?php echo set_value('order_no'); ?>" placeholder="순번" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="admin_dong" class="sr-only">행정동</label>
        <input type="text" name="admin_dong" value="<?php echo set_value('admin_dong'); ?>" placeholder="행정동(Lot)" class="form-control input-sm" maxlength="10" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="lot_num" class="sr-only">지번</label>
        <input type="text" name="lot_num" value="<?php echo set_value('lot_num'); ?>" placeholder="지번(000-00)" class="form-control input-sm" maxlength="10" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 4px 15px;">
        <label for="land_mark" class="sr-only">지목</label>
        <input type="text" name="land_mark" value="<?php echo set_value('land_mark'); ?>" placeholder="지목" class="form-control input-sm" maxlength="10" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="area_official" class="sr-only">공부상 면적</label>
        <input type="text" name="area_official" value="<?php echo set_value('area_official'); ?>" placeholder="공부상 면적(㎡)" class="form-control input-sm" maxlength="12" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="area_returned" class="sr-only">환지 면적</label>
        <input type="text" name="area_returned" value="<?php echo set_value('area_returned'); ?>" placeholder="환지(실권리) 면적(㎡)" class="form-control input-sm" maxlength="12">
      </div>
      <div class="col-xs-12 col-md-1 right" style="padding: 4px 15px;">
<?php  ?>
        <input class="btn btn-primary btn-sm" type="button" value="추가 등록" onclick="<?php echo $submit_str; ?>">
      </div>
    </div>
  </form>
  <div class="row font12" style="margin: 0 0 5px;">
    <div class="col-xs-6" style="color: #5771fb;">총 <?php echo $total_rows; ?> 필지 / 면적 <?php echo number_format($summary->total_area, 2); ?>㎡ (<?php echo number_format($summary->total_area*0.3025, 2) ?>평) 등록</div>
    <div class="col-xs-12 hidden-xs hidden-sm right" style="padding: 0 20px 0; margin-top: -18px; color: #5E81FE;">
        <!-- <a href="javascript:alert('준비 중입니다!');"> -->
        <a href="<?php echo base_url('/cms_download/basic_site_list/download')."?pj=".$project; ?>">
			<img src="<?php echo base_url(); ?>static/img/excel_icon.jpg" height="14" border="0" alt="EXCEL 아이콘" style="margin-top: -3px;"/> EXCEL로 출력
		</a>
    </div>
  </div>

  <!-- 출력 및 get으로 수정 삭제하기 -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-condensed font12">
      <thead>
        <tr class="warning">
          <th class="center" style="vertical-align:middle;" rowspan="2">no.</th>
          <th class="center" style="vertical-align:middle;" rowspan="2">행정동(Lot)</th>
          <th class="center" style="vertical-align:middle;" rowspan="2">지번</th>
          <th class="center" style="vertical-align:middle;" rowspan="2">지목</th>
          <th class="center" colspan="2">공부상 면적</th>
          <th class="center" colspan="2">환지(실권리) 면적</th>
          <th class="center" style="vertical-align:middle;" rowspan="2">등록일</th>
          <th class="center" style="vertical-align:middle;" rowspan="2">등록자</th>
          <th class="center" style="vertical-align:middle;" rowspan="2">수정</th>
          <th class="center" style="vertical-align:middle;" rowspan="2">삭제</th>
        </tr>
        <tr class="warning">
          <th class="center">면적(㎡)</th>
          <th class="center">면적(평)</th>
          <th class="center">면적(㎡)</th>
          <th class="center">면적(평)</th>
        </tr>
      </thead>
      <tbody>

<?php if(empty($site_lot_list)) :  ?>
        <tr class="center">
          <td class="center" colspan="12" style="padding: 130px 0;">조회할 데이터가 없습니다.</td>
        </tr>
<?php
  elseif( !empty($site_lot_list)) :
    $a=1;
    foreach($site_lot_list as $lt) :
      $ao_py = $lt->area_official*0.3025;
      $ar_py = $lt->area_returned*0.3025;
      $reg_date = (empty($lt->modi_date) or $lt->modi_date==='0000-00-00') ? $lt->reg_date : $lt->modi_date;
      $reg_worker = empty($lt->modi_worker) ? $lt->reg_worker : $lt->modi_worker;
      $del_url = base_url('cms_m3/project/1/3/?del_code=').$lt->seq;
      if($auth13<2) { $del_submit = "alert('삭제 관리 권한이 없습니다.');";  }else { $del_submit = "if(confirm('이후 해당 데이터를 복구할 수 없습니다. 정말 삭제하시겠습니까?')===true) location.href='".$del_url."'"; }
?>
        <tr class="center">
          <td><?php echo $lt->order_no; ?></td>
          <td><?php echo $lt->admin_dong; ?></td>
          <td><?php echo $lt->lot_num; ?></td>
          <td><?php echo $lt->land_mark; ?></td>
          <td class="right"><?php echo number_format($lt->area_official, 2); ?></td>
          <td class="right"><?php echo number_format($ao_py, 2); ?></td>
          <td class="right"><?php echo number_format($lt->area_returned, 2); ?></td>
          <td class="right"><?php echo number_format($ar_py, 2); ?></td>
          <td><?php echo $reg_date; ?></td>
          <td><?php echo $reg_worker; ?></td>
          <td><a href='javascript:'class="btn btn-info btn-xs" onclick="alert('준비 중입니다!')">수정</a></td>
          <!-- <td><a href='javascript:'class="btn btn-info btn-xs" onclick="popUp_size('<?php echo base_url('/cms_popup/Capital_cash_book/cash_book/'.$lt->seq); ?>','cash_book','500','670')">수정</a></td> -->
          <td><a href='javascript:'class="btn btn-danger btn-xs" onclick="<?php echo $del_submit; ?>">삭제</a></td>
        </tr>
<?php
      $a++;
    endforeach;
  endif;
?>
      </tbody>
    </table>
  </div>
  <div class="col-md-12 center" style="margin:padding: 0;">
    <ul class="pagination pagination-sm"><?php echo $pagination;?></ul>
  </div>
</div>

<!------- 소유권 관련 정보 입출력 하기 ------->
<?php }elseif($this->input->get('set_sort')==='2'){  // 2. 소유권 관련 정보 ?>
<div class="row table-responsive font12" style="margin: 0; padding: 0; height: 480px;">
  <!-- 입력하기 폼 -->
<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'ownership_insert');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'sort' => 'ownership'
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
    <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
      <div class="col-sm-12 col-md-1 center point-sub1" style="padding: 10px; 0">토지 데이터</div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="admin_dong" class="sr-only">행정동</label>
        <input type="text" name="admin_dong" value="<?php echo set_value('admin_dong'); ?>" placeholder="행정동(Lot)" class="form-control input-sm" maxlength="10" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="lot_num" class="sr-only">지번</label>
        <input type="text" name="lot_num" value="<?php echo set_value('lot_num'); ?>" placeholder="지번(000-00)" class="form-control input-sm" maxlength="10" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="land_mark" class="sr-only">지목</label>
        <input type="text" name="land_mark" value="<?php echo set_value('land_mark'); ?>" placeholder="지목(ex:대)" class="form-control input-sm" maxlength="10" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="area_official" class="sr-only">공부상 면적</label>
        <input type="text" name="area_official" value="<?php echo set_value('area_official'); ?>" placeholder="공부상 면적(㎡)" class="form-control input-sm" maxlength="12" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="area_returned" class="sr-only">환지 면적</label>
        <input type="text" name="area_returned" value="<?php echo set_value('area_returned'); ?>" placeholder="환지 면적(㎡)" class="form-control input-sm" maxlength="12">
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1 right" style="padding: 4px 15px;">
        <input class="btn btn-primary btn-sm" type="button" value="추가하기" onclick="if(confirm('등록하시겠습니까?')===true) submit();">
      </div>
    </div>
  </form>

  <!-- 출력 및 get으로 수정 삭제하기 -->
  <div class="row table-responsive font12">

  </div>
    no. / {지번ID} 행정동 지번 / 소(공)유자 / 소유지분 / 소유면적 / 소유구분(개인, 법인, 국, 공유지) / 계약여부 / 총 매매대금 / 대금지급 관련 사항 / 소유자에게 국한되는 권리제한사항 및 비고</br></br></br>


    <strong>대금지급 관련 사항</strong></br>
    지급계좌(은행/계좌번호/예금주) / 계약금1 / 계약금1 지급일자 / 계약금1 지급여부 / 계약금2 / 계약금2 지급일자 / 계약금2 지급여부 / 중도금1 / 중도금1 지급일자 / 중도금1 지급여부
    / 중도금2 / 중도금2 지급일자 / 중도금2 지급여부 /  잔금 / 잔금지급일자 / 잔금 지급여부

</div>
<?php } ?>



<?php endif ?>
