<?php
  if($auth13<1) :
  	include('no_auth.php');
  else :
    if($auth13<2) {
      $submit_str="alert('이 페이지에 대한 관리 / 등록 권한이 없습니다!')";
    } else {
      if(empty($this->input->get('project'))){
        $submit_str="alert('등록할 프로젝트를 선택하여 주십시요!'); document.sel_condi.project.focus();"; $sm = "신규등록"; $cl="btn-success";
      }else{
        if(empty($this->input->get('set_sort')) OR $this->input->get('set_sort')==='1'){ $data_name="토지 기초 데이터";
        }elseif($this->input->get('set_sort')==='2'){ $data_name="소유자 관련 데이터"; }
        if(empty($this->input->get('mode')) OR $this->input->get('mode')=='1') {$sm = "신규등록"; $cl="btn-default";}elseif($this->input->get('mode')=='2') {$sm = "업데이트"; $cl="btn-warning";}
        $submit_str="if(confirm('".$data_name."를 ".$sm."하시겠습니까?')===true) submit();";
      }
    }
?>
<div class="main_start">&nbsp;</div>
<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->2. 기본정보 수정 -->
<script type="text/javascript">
  function chkArr(url){
    var opt = "1";
    if(document.ex_form.opt2.checked===true) var opt = opt+"-2"; // 소유자
    if(document.ex_form.opt3.checked===true) var opt = opt+"-3"; // 생년월일(성별)
    if(document.ex_form.opt4.checked===true) var opt = opt+"-4"; // 연락처1
    if(document.ex_form.opt5.checked===true) var opt = opt+"-5"; // 연락처2
    if(document.ex_form.opt6.checked===true) var opt = opt+"-6"; // 주소
    if(document.ex_form.opt7.checked===true) var opt = opt+"-7"; // 소유구분
    if(document.ex_form.opt8.checked===true) var opt = opt+"-8"; // 행정동
    if(document.ex_form.opt9.checked===true) var opt = opt+"-9"; // 지번
    if(document.ex_form.opt10.checked===true) var opt = opt+"-10"; // 지목
    if(document.ex_form.opt11.checked===true) var opt = opt+"-11-12"; // 공부상면적(㎡/평)
    if(document.ex_form.opt13.checked===true) var opt = opt+"-13-14"; // 환지면적(㎡/평)
    if(document.ex_form.opt15.checked===true) var opt = opt+"-15"; // 소유지분
    if(document.ex_form.opt16.checked===true) var opt = opt+"-16-17"; // 소유면적(㎡/평)
    if(document.ex_form.opt18.checked===true) var opt = opt+"-18-19-20"; // 은행계좌(은행/계좌/예금주)
    if(document.ex_form.opt21.checked===true) var opt = opt+"-21"; // 계약여부
    if(document.ex_form.opt22.checked===true) var opt = opt+"-22"; // 총 계약금액
    if(document.ex_form.opt23.checked===true) var opt = opt+"-23-24-25"; // 계약금(1차)(금액/지급일/지급여부)
    if(document.ex_form.opt26.checked===true) var opt = opt+"-26-27-28"; // 계약금(2차)(금액/지급일/지급여부)
    if(document.ex_form.opt29.checked===true) var opt = opt+"-29-30-31"; // 중도금(1차)(금액/지급일/지급여부)
    if(document.ex_form.opt32.checked===true) var opt = opt+"-32-33-34"; // 중도금(2차)(금액/지급일/지급여부)
    if(document.ex_form.opt35.checked===true) var opt = opt+"-35-36-37"; // 잔금(금액/지급일/지급여부)
    if(document.ex_form.opt38.checked===true) var opt = opt+"-38"; // 소유권 이전등기
    if(document.ex_form.opt39.checked===true) var opt = opt+"-39"; // 권리제한 사항
    if(document.ex_form.opt40.checked===true) var opt = opt+"-40"; // 상담 기록
    if(document.ex_form.opt41.checked===true) var opt = opt+"-41"; // 등기부등본 발급일

    location.href = url+"&row="+opt;
  }
</script>

<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
<?php
  $attributes = array('method' => 'get', 'name' => 'sel_condi');
  $hidden = array(
    'project' => $this->input->get('project'),
    'set_sort' => $this->input->get('set_sort')
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
    <div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">사업 개시년도</div>
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
    <div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">프로젝트 선택</div>
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
    <li role="presentation" class="<?php if(empty($this->input->get('set_sort')) or $this->input->get('set_sort')==='1') echo 'active'; ?>"><a href="<?php echo $set_sort_url1; ?>">기본 토지 정보</a></li>
    <li role="presentation" class="<?php if($this->input->get('set_sort')==='2') echo 'active'; ?>"><a href="<?php echo $set_sort_url2; ?>">소유권 관련 정보</a></li>
  </ul>
</div>
<!------- 토지 기초 정보 입출력 하기 ------->
<?php if( !$this->input->get('set_sort') OR $this->input->get('set_sort')==='1') { //1. 토지 기초 정보?>
<div class="row font12" style="margin: 0; padding: 0;">
  <div class="right font11" style="margin:-13px 10px 3px; color:#9e9c9c;">※ <span style="color:#5996fe;">환지(실권리) 면적</span>은 환지 등의 사유로 공부상 면적과 실제 면적이 상이한 경우에만 입력하세요.</div>
  <!-- 입력하기 폼 -->
<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'basic_insert');
  $hidden = array(
    'mode' => $this->input->get('mode'),
    'project' => $this->input->get('project'),
    'sort' => 'basic',
    'lot_seq' => $this->input->get('lot_seq'),
    'page' => $this->input->get('page')
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-sm-12 col-md-1 center bg-info" style="line-height:38px;">토지 데이터</div>
    <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 4px 15px;">
      <label for="order_no" class="sr-only">순번</label>
      <input type="number" name="order_no" value="<?php echo set_value('order_no'); if($basic_site) echo $basic_site->order_no; ?>" placeholder="no." class="form-control input-sm" maxlength="5" required>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
      <label for="admin_dong" class="sr-only">행정동</label>
      <input type="text" name="admin_dong" value="<?php echo set_value('admin_dong'); if($basic_site) echo $basic_site->admin_dong ?>" placeholder="행정동(Lot)" class="form-control input-sm" maxlength="10" required>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
      <label for="lot_num" class="sr-only">지번</label>
      <input type="text" name="lot_num" value="<?php echo set_value('lot_num'); if($basic_site) echo $basic_site->lot_num; ?>" placeholder="지번(000-00)" class="form-control input-sm" maxlength="10" required>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 4px 15px;">
      <label for="land_mark" class="sr-only">지목</label>
      <input type="text" name="land_mark" value="<?php echo set_value('land_mark'); if($basic_site) echo $basic_site->land_mark; ?>" placeholder="지목" class="form-control input-sm" maxlength="10" required>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
      <label for="area_official" class="sr-only">공부상 면적</label>
      <input type="number" name="area_official" value="<?php echo set_value('area_official'); if($basic_site) echo $basic_site->area_official; ?>" placeholder="공부상 면적(㎡)" class="form-control input-sm" maxlength="12" required>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
      <label for="area_returned" class="sr-only">환지 면적</label>
      <input type="number" name="area_returned" value="<?php echo set_value('area_returned'); if($basic_site) echo $basic_site->area_returned; ?>" placeholder="환지(실권리) 면적(㎡)" class="form-control input-sm" maxlength="12">
    </div>
    <div class="col-xs-12 col-md-1 right" style="padding: 4px 15px;">
      <input class="btn <?php echo $cl; ?> btn-sm" type="button" value="<?php echo $sm;?>" onclick="<?php echo $submit_str; ?>">
    </div>
  </div>
</form>
  <div class="row font12" style="margin:20px 0 3px;">
    <div class="col-xs-12 col-md-6" style="padding: 0 20px 0; margin-bottom: 3px; color: #5771fb;">
      총 <?php echo $total_rows; ?> 필지 / 면적 <?php echo number_format($summary->total_area, 2); ?>㎡ (<?php echo number_format($summary->total_area*0.3025, 2) ?>평) 등록
    </div>
    <div class="hidden-xs hidden-sm col-md-6 right" style="padding: 0 20px 0; margin-bottom: 3px;">
      <a href="<?php echo base_url('/cms_download/basic_site_list/download')."?pj=".$project; ?>">
  			<img src="<?php echo base_url(); ?>static/img/excel_icon.jpg" height="14" border="0" alt="EXCEL 아이콘" style="margin-top: -3px;"/> EXCEL로 출력
  		</a>
    </div>
  </div>

  <!-- 출력 및 get으로 수정 삭제하기 -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-condensed font12">
      <thead>
        <tr class="active">
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
        <tr class="active">
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

      $modi_url = base_url("cms_m3/project/1/3?project=".$project."&mode=2&lot_seq=".$lt->seq."&page=".$this->input->get('page'));
      $del_url = base_url("cms_m3/project/1/3/?project=".$project."&mode=3&del_code=".$lt->seq."&page=".$this->input->get('page'));

      if($auth13<2) {
        $modi_btn = "alert('이 페이지에 대한 관리 권한이 없습니다.')";
        $del_btn = "alert('이 페이지에 대한 관리 권한이 없습니다.')";
      }else {
        $modi_btn = "location.href='".$modi_url."'";
        $del_btn = "if(confirm('삭제 후 데이터를 복구할 수 없습니다. 그래도 삭제 하시겠습니까?')==true) location.href='".$del_url."'";
      }
?>
        <tr class="center">
          <td><?php echo $lt->order_no; ?></td>
          <td><?php echo $lt->admin_dong; ?></td>
          <td><?php echo $lt->lot_num; ?></td>
          <td><?php echo $lt->land_mark; ?></td>
          <td class="right warning"><?php echo number_format($lt->area_official, 2); ?></td>
          <td class="right"><?php echo number_format($ao_py, 2); ?></td>
          <td class="right warning"><?php echo number_format($lt->area_returned, 2); ?></td>
          <td class="right"><?php echo number_format($ar_py, 2); ?></td>
          <td><?php echo $reg_date; ?></td>
          <td><?php echo $reg_worker; ?></td>
          <!-- <td><a href='javascript:'class="btn btn-info btn-xs" onclick="alert('준비 중입니다!')">수정</a></td> -->
          <td><a href='javascript:'class="btn btn-info btn-xs" onclick="<?php echo $modi_btn; ?>">수정</a></td>
          <td><a href='javascript:'class="btn btn-danger btn-xs" onclick="<?php echo $del_btn; ?>">삭제</a></td>
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
<div class="row font12" style="margin: 0; padding: 0;">
<?php
  $attributes = array('method'=>'get');
  $hidden = array(
      'project' => $this->input->get('project'),
      'set_sort' => '2',
      'mode' => '1'
  );
  echo form_open(current_full_url(), $attributes, $hidden);
  $close_url = base_url(
    'cms_m3/project/1/3?project='.$project
    .'&set_sort=2&mode=1'
    .'&page='.$this->input->get('page')
    .'&search_con='.$this->input->get('search_con')
    .'&search_word='.$this->input->get('search_word')
  );
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-xs-12 col-sm-12 col-md-1 center bg-info" style="line-height:39px;">입력 지번</div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
      <label for="site_lot" class="sr-only">지 번</label>
      <select class="form-control input-sm" name="site_lot" onchange="submit();">
        <option value="" <?php if(empty($this->input->get('site_lot'))) echo "selected";?>>전 체</option>
<?php foreach ($site_lot as $lt) : ?>
        <option value="<?php echo $lt->seq; ?>" <?php if($this->input->get('site_lot')==$lt->seq) echo "selected";;?>><?php echo "[".$lt->order_no."] - [".$lt->admin_dong."] - ".$lt->lot_num; ?></option>
<?php endforeach; ?>
      </select>
    </div>
    <div class="col-xs-6 col-md-3" style="padding: 4px 0; text-align:center; line-height: 30px;">
      <div class="col-xs-10">
<?php if($this->input->get('mode')=='1') : ?>
        <?php if( !empty($this->input->get('site_lot'))): ?><a type="button" class="btn btn-warning btn-xs" href="javascript:" onclick="$('#owner_input').toggle();"><?php echo $lt->lot_num." 신규 정보 입력</a>"; endif; ?>
<?php endif; ?>
      </div>
      <div class="hidden-xs col-sm-1" style="padding:5px;">
<?php if( !empty($this->input->get('site_lot'))) : ?>
        <button type="button" class="close" aria-label="Close" style="padding-left: 5px;" onclick="location.href='<?php echo $close_url; ?>'"><span aria-hidden="true">&times;</span></button>
<?php endif; ?>
      </div>
    </div>
    <!-- 검색하기 폼 시작 -->
    <div class="col-xs-12 col-sm-12 col-md-1 center bg-info" style="line-height:39px;">검색 조건</div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
      <label for="search_con" class="sr-only">조건</label>
      <select class="form-control input-sm" name="search_con">
        <option value="" <?php echo set_select('search_con', ''); if($this->input->get('search_con')=='') echo "selected"; ?>>전 체</option>
        <option value="1" <?php echo set_select('search_con', '1'); if($this->input->get('search_con')=='1') echo "selected"; ?>>지 번</option>
        <option value="2" <?php echo set_select('search_con', '2'); if($this->input->get('search_con')=='2') echo "selected"; ?>>지 주</option>
      </select>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="search_word" class="sr-only">검색어</label>
        <input type="text" name="search_word" value="<?php echo $this->input->get('search_word'); ?>" placeholder="지번 또는 지주명" class="form-control input-sm" onclick="this.value='';">
    </div>
    <div class="col-xs-12 col-sm-4 col-md-1 right" style="padding: 4px 15px;">
        <button type="button" name="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> 검색</button>
    </div>
  </div>
  <!-- 검색하기 폼 종료 -->
</form>
  <!-- 입력하기 폼 -->
<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'ownership_insert');
  $hidden = array(
    'mode' => $this->input->get('mode'),
    'project' => $this->input->get('project'),
    'sort' => 'ownership',
    'lot_seq' => $this->input->get('site_lot'),
    'lot_order' => $sel_site->order_no,
    'lot_num' => $sel_site->lot_num,
    'own_seq' => $this->input->get('own_seq'),
    'page' => $this->input->get('page'),
    'sc' => $this->input->get('search_con'),
    'sw' => $this->input->get('search_word')
  );
  echo form_open(current_full_url(), $attributes, $hidden);
  if(!empty($owner_row)){
    $owner_id = explode("-", $owner_row->owner_id_date);
    $owner_addr = explode("|", $owner_row->owner_addr);
    $payment_acc = explode('|', $owner_row->payment_acc);
  }
?>
  <div class="bo-top bo-bottom font12" id="owner_input" style="<?php if($this->input->get('mode')!=='2' && empty($this->input->post('lot_seq'))) echo"display:none;"; ?>">
    <div class="col-sm-12 bo-bottom bgfb" style="line-height:36px; padding:5px 15px;">
      <span style="color:#324cfc;"><strong><?php echo "[".$sel_site->admin_dong."] ".$sel_site->lot_num." (".number_format($sel_site->area_returned, 2)."㎡)"; ?></strong></span> - 소유자 정보 입력
    </div>
    <div class="col-sm-12 form-group" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-2 bgf8" style="line-height:36px; padding:4px 15px;">소유자 정보</div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">소유자명</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); if( !empty($owner_row)) echo $owner_row->owner; ?>" data-toggle="tooltip" data-placement="top" title="소유자명 - (필수)" placeholder="소유자명 - (필수)" class="form-control input-sm" maxlength="10" required style="background-color:#fcfcd5;">
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner_id_birth" class="sr-only">생년월일(6자리)</label>
        <input type="number" name="owner_id_birth" value="<?php echo set_value('owner_id_birth');  if( !empty($owner_row)) echo $owner_id[0]; ?>" data-toggle="tooltip" data-placement="top" title="생년월일(ex:800123)" placeholder="생년월일(ex:800123)" class="form-control input-sm" maxlength="6">
      </div>
      <div class="col-xs-12 col-sm-4 col-md-2" style="padding: 13px 10px;">
        <label class="radio-inline"><input type="radio" name="owner_id_gender" value="1" <?php echo  set_radio('owner_id_gender', '1', TRUE); if($owner_id[1]=='1') echo "checked"; ?>> 남성</label>
        <label class="radio-inline"><input type="radio" name="owner_id_gender" value="2" <?php echo  set_radio('owner_id_gender', '2'); if($owner_id[1]=='2') echo "checked"; ?>> 여성</label>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner_tel_1" class="sr-only">연락처1</label>
        <input type="text" name="owner_tel_1" value="<?php echo set_value('owner_tel_1'); if( !empty($owner_row)) echo $owner_row->owner_tel_1; ?>" data-toggle="tooltip" data-placement="top" title="연락처1 - (필수)" placeholder="연락처1 - (필수)" class="form-control input-sm" maxlength="13" required style="background-color:#fcfcd5;">
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner_tel_2" class="sr-only">연락처2</label>
        <input type="text" name="owner_tel_2" value="<?php echo set_value('owner_tel_2'); if( !empty($owner_row)) echo $owner_row->owner_tel_2; ?>" data-toggle="tooltip" data-placement="top" title="연락처2" placeholder="연락처2" class="form-control input-sm" maxlength="13">
      </div>
    </div>
    <!-- 다음 우편번호 서비스 - iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
    <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:10;-webkit-overflow-scrolling:touch;">
      <img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
    </div>
    <!-- 다음 우편번호 서비스 -------------onclick="execDaumPostcode(1)"-----postcode1-----address1_1-----address2_1------------------------>
    <div class="col-sm-12" style="padding:0; margin:0;">
      <div class="hidden-xs hidden-sm col-md-2 bgf8 bo-bottom" style="line-height:36px; padding:4px 15px;">&nbsp;</div>
      <div class="col-xs-6 col-sm-2 col-md-1 bo-bottom" style="padding: 7px 10px;">
        <label for="postcode1" class="sr-only">우편번호</label>
        <input type="number" class="form-control input-sm en_only" id="postcode1" name="postcode1" maxlength="5" value="<?php echo set_value('postcode1'); if( !empty($owner_row)) echo $owner_addr[0]; ?>" readonly>
      </div>
      <div class="col-xs-6 col-sm-2 col-md-1 bo-bottom" style="padding: 7px 10px;">
        <input type="button" class="btn btn-info btn-sm" value="우편번호" onclick="execDaumPostcode(1)">
      </div>
      <div class="col-xs-12 col-sm-4 bo-bottom" style="padding: 7px 10px;">
        <label for="address1_1" class="sr-only">소유자주소</label>
        <input type="text" class="form-control input-sm han" id="address1_1" name="address1_1" maxlength="100" value="<?php echo set_value('address1_1'); if( !empty($owner_row)) echo $owner_addr[1]; ?>" readonly>
      </div>
      <div class="col-xs-12 col-sm-4 bo-bottom" style="padding: 7px 10px;">
        <label for="address2_1" class="sr-only">소유자주소2</label>
        <input type="text" class="form-control input-sm han" id="address2_1" name="address2_1" maxlength="93" value="<?php echo set_value('address2_1'); if( !empty($owner_row)) echo $owner_addr[2]; ?>" placeholder="나머지 주소">
      </div>
    </div>
    <div class="col-sm-12 form-group" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-2 bgf8" style="line-height:36px; padding:4px 15px;">소유권 정보</div>
      <div class="col-xs-6 col-sm-3 col-md-2" style="padding: 7px 10px 0;">
        <label for="own_sort" class="sr-only">소유구분</label>
        <select class="form-control input-sm" name="own_sort" data-toggle="tooltip" data-placement="top" title="소유 구분" style="background-color:#fcfcd5;">
          <option value="">구 분</option>
          <option value="1" <?php echo set_select('own_sort', '1'); if( !$owner_row->own_sort OR $owner_row->own_sort=='1') echo "selected";?>>개 인</option>
          <option value="2" <?php echo set_select('own_sort', '2'); if($owner_row->own_sort=='2') echo "selected";?>>법 인</option>
          <option value="3" <?php echo set_select('own_sort', '3'); if($owner_row->own_sort=='3') echo "selected";?>>국/공유지</option>
        </select>
      </div>
      <div class="visible-md visible-lg col-md-1 right" style="line-height:34px; padding:5px 0;">소유지분(%)</div>
      <div class="col-xs-6 col-sm-3 col-md-2" style="padding: 7px 10px;">
        <label for="owned_percent" class="sr-only">소유지분</label>
        <input type="number" name="owned_percent" value="<?php echo set_value('owned_percent'); if( !empty($owner_row)) echo $owner_row->owned_percent; ?>" data-toggle="tooltip" data-placement="top" title="소유지분(%) - (필수)" placeholder="소유지분(%) - (필수)" class="form-control input-sm" maxlength="9" required style="background-color:#fcfcd5;">
      </div>
      <div class="visible-md visible-lg col-md-1 right" style="line-height:34px; padding:5px 0;">지분면적(㎡)</div>
      <div class="col-xs-6 col-sm-3 col-md-2" style="padding: 7px 10px;">
        <label for="owned_area" class="sr-only">지분면적</label>
        <input type="number" name="owned_area" value="<?php echo set_value('owned_area'); if( !empty($owner_row)) echo $owner_row->owned_area; ?>" data-toggle="tooltip" data-placement="top" title="지분면적(㎡) - (필수)" placeholder="지분면적(㎡) - (필수)" class="form-control input-sm" maxlength="13" required style="background-color:#fcfcd5;">
      </div>

      <div class="col-xs-6 col-sm-3 col-md-2" style="padding: 7px 10px;">
        <div class="input-group">
          <label for="dup_issue_date" class="sr-only">등기부등본 발급일</label>
          <input type="text" class="form-control input-sm" id="dup_issue_date" name="dup_issue_date" maxlength="10" value="<?php echo set_value('dup_issue_date'); if( !empty($owner_row && $owner_row->dup_issue_date!=='0000-00-00')) echo $owner_row->dup_issue_date; ?>" data-toggle="tooltip" data-placement="top" title="등기부등본 발급일" placeholder="등기부등본 발급일" onClick="cal_add(this); event.cancelBubble=true" readonly>
          <div class="input-group-addon">
            <a href="javascript:" onclick="cal_add(document.getElementById('dup_issue_date'),this); event.cancelBubble=true">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="hidden-xs hidden-sm col-md-2 bgf8" style="height:79px;">&nbsp;</div>
      <div class="col-xs-12 col-md-10" style="padding: 7px 10px;">
        <label for="rights_restrictions" class="sr-only">갑/을구 권리 제한사항</label>
        <textarea class="form-control" name="rights_restrictions" rows="3" data-toggle="tooltip" data-placement="top" title="갑/을구 권리 제한사항" placeholder="갑/을구 권리 제한사항"><?php echo set_value('rights_restrictions'); if( !empty($owner_row)) echo $owner_row->rights_restrictions; ?></textarea>
      </div>
    </div>
    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="col-xs-12 col-md-2 bgf8" style="line-height:36px; padding:4px 15px;">상담 기록 (상담일시-내용)
<?php if($this->agent->is_browser('Internet Explorer')): ?>
        <div class="hidden-xs hidden-sm col-md-2 bgf8" style="height:36px;">&nbsp;</div>
<?php else: ?>
        <div class="hidden-xs hidden-sm col-md-2 bgf8" style="height:45px;">&nbsp;</div>
<?php endif; ?>
      </div>
      <div class="col-xs-12 col-sm-10" style="padding: 7px 10px 17px;">
        <label for="rights_restrictions" class="sr-only">상담 기록 (상담일시-내용)</label>
        <textarea class="form-control" name="counsel_record" rows="3" data-toggle="tooltip" data-placement="top" title="상담 기록 (상담일시-내용)" placeholder="상담일시 - 상담내용"><?php echo set_value('counsel_record'); if( !empty($owner_row)) echo $owner_row->counsel_record; ?></textarea>
      </div>
      <div class="col-xs-12 col-md-2 bgf8" style="line-height:36px; padding:4px 15px;">계약 체결 여부</div>
      <div class="col-xs-12 col-md-10" style="padding:0;">
        <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 13px 10px;">
          <label class="checkbox-inline">
            <input type="checkbox" name="is_contract" value="1" <?php echo set_checkbox('is_contract', '1'); if($owner_row->is_contract=='1') echo "checked"; ?>> 계약 체결여부
          </label>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="total_price" class="sr-only">총 매매계약 금액</label>
          <input type="number" name="total_price" value="<?php echo set_value('total_price'); if($owner_row->total_price !=='0') echo $owner_row->total_price; ?>" data-toggle="tooltip" data-placement="top" title="총 매매계약 금액 (단위:원)" placeholder="총 매매계약 금액 (단위:원)" class="form-control input-sm" maxlength="12">
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <div class="input-group">
            <label for="contract_date" class="sr-only">계약 체결일</label>
            <input type="text" class="form-control input-sm" id="contract_date" name="contract_date" maxlength="10" value="<?php echo set_value('contract_date'); if( !empty($owner_row && $owner_row->contract_date!=='0000-00-00')) echo $owner_row->contract_date; ?>" data-toggle="tooltip" data-placement="top" title="계약 체결일" placeholder="계약 체결일" onClick="cal_add(this); event.cancelBubble=true" readonly>
            <div class="input-group-addon">
              <a href="javascript:" onclick="cal_add(document.getElementById('contract_date'),this); event.cancelBubble=true">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="bank_name" class="sr-only">은행선택</label>
          <select class="form-control input-sm" name="bank_name" data-toggle="tooltip" data-placement="top" title="은행선택">
            <option value="" <?php echo set_select('bank_name', ''); ?>>입금은행</option>
  <?php foreach ($bank as $lt) : ?>
            <option value="<?php echo $lt->bank_name; ?>" <?php echo set_select('bank_name', $lt->bank_name); if($payment_acc[0]==$lt->bank_name) echo "selected"; ?>><?php echo $lt->bank_name; ?></option>
  <?php endforeach; ?>
          </select>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="acc_number" class="sr-only">계좌번호</label>
          <input type="text" name="acc_number" value="<?php echo set_value('acc_number'); if( !empty($owner_row)) echo $payment_acc[1]; ?>" data-toggle="tooltip" data-placement="top" title="계좌번호" placeholder="계좌번호" class="form-control input-sm" maxlength="20">
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="acc_owner" class="sr-only">예 금 주</label>
          <input type="text" name="acc_owner" value="<?php echo set_value('acc_owner'); if( !empty($owner_row)) echo $payment_acc[2]; ?>" data-toggle="tooltip" data-placement="top" title="예 금 주" placeholder="예 금 주" class="form-control input-sm" maxlength="10">
        </div>
      </div>
    </div>
    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-2 bgf8" style="line-height:36px; padding:4px 15px;">계약금 지급 관련</div>
      <div class="col-xs-12 col-md-10" style="padding:0;">
        <div class="col-xs-5 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="down_pay1" class="sr-only">1차 계약금</label>
          <input type="number" name="down_pay1" value="<?php echo set_value('down_pay1'); if($owner_row->down_pay1 !=='0') echo $owner_row->down_pay1; ?>" data-toggle="tooltip" data-placement="top" title="1차 계약금" placeholder="1차 계약금" class="form-control input-sm" maxlength="11">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <div class="input-group">
            <label for="down_pay1_date" class="sr-only">1차 계약금 지급일</label>
            <input type="text" class="form-control input-sm" id="down_pay1_date" name="down_pay1_date" maxlength="10" value="<?php echo set_value('down_pay1_date'); if( !empty($owner_row && $owner_row->down_pay1_date!=='0000-00-00')) echo $owner_row->down_pay1_date; ?>" data-toggle="tooltip" data-placement="top" title="1차 계약금 지급일" placeholder="1차 계약금 지급일" onClick="cal_add(this); event.cancelBubble=true" readonly>
            <div class="input-group-addon">
              <a href="javascript:" onclick="cal_add(document.getElementById('down_pay1_date'),this); event.cancelBubble=true">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-2" style="padding: 13px 10px;">
          <label class="checkbox-inline">
            <input type="checkbox" name="down_pay1_is_paid" value="1" <?php echo set_checkbox('down_pay1_is_paid', '1'); if($owner_row->down_pay1_is_paid=='1') echo "checked"; ?>> 지급 여부
          </label>
        </div>
        <div class="col-xs-5 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="down_pay2" class="sr-only">2차 계약금</label>
          <input type="number" name="down_pay2" value="<?php echo set_value('down_pay2'); if($owner_row->down_pay2 !=='0') echo $owner_row->down_pay2; ?>" data-toggle="tooltip" data-placement="top" title="2차 계약금" placeholder="2차 계약금" class="form-control input-sm" maxlength="11">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <div class="input-group">
            <label for="down_pay2_date" class="sr-only">2차 계약금 지급일</label>
            <input type="text" class="form-control input-sm" id="down_pay2_date" name="down_pay2_date" maxlength="10" value="<?php echo set_value('down_pay2_date'); if( !empty($owner_row && $owner_row->down_pay2_date!=='0000-00-00')) echo $owner_row->down_pay2_date; ?>" data-toggle="tooltip" data-placement="top" title="2차 계약금 지급일" placeholder="2차 계약금 지급일" onClick="cal_add(this); event.cancelBubble=true" readonly>
            <div class="input-group-addon">
              <a href="javascript:" onclick="cal_add(document.getElementById('down_pay2_date'),this); event.cancelBubble=true">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-2" style="padding: 13px 10px;">
          <label class="checkbox-inline">
            <input type="checkbox" name="down_pay2_is_paid" value="1" <?php echo set_checkbox('down_pay2_is_paid', '1'); if($owner_row->down_pay2_is_paid=='1') echo "checked"; ?>> 지급 여부
          </label>
        </div>
      </div>

    </div>
    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-2 bgf8" style="line-height:36px; padding:4px 15px;">중도금 지급 관련 정보</div>
      <div class="col-xs-12 col-md-10" style="padding:0;">
        <div class="col-xs-5 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="inter_pay1" class="sr-only">1차 중도금</label>
          <input type="number" name="inter_pay1" value="<?php echo set_value('inter_pay1'); if($owner_row->inter_pay1 !=='0') echo $owner_row->inter_pay1; ?>" data-toggle="tooltip" data-placement="top" title="1차 중도금" placeholder="1차 중도금" class="form-control input-sm" maxlength="11">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <div class="input-group">
            <label for="inter_pay1_date" class="sr-only">1차 중도금 지급일</label>
            <input type="text" class="form-control input-sm" id="inter_pay1_date" name="inter_pay1_date" maxlength="10" value="<?php echo set_value('inter_pay1_date'); if( !empty($owner_row && $owner_row->inter_pay1_date!=='0000-00-00')) echo $owner_row->inter_pay1_date; ?>" data-toggle="tooltip" data-placement="top" title="1차 중도금 지급일" placeholder="1차 중도금 지급일" onClick="cal_add(this); event.cancelBubble=true" readonly>
            <div class="input-group-addon">
              <a href="javascript:" onclick="cal_add(document.getElementById('inter_pay1_date'),this); event.cancelBubble=true">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-2" style="padding: 13px 10px;">
          <label class="checkbox-inline">
            <input type="checkbox" name="inter_pay1_is_paid" value="1" <?php echo set_checkbox('inter_pay1_is_paid', '1'); if($owner_row->inter_pay1_is_paid=='1') echo "checked"; ?>> 지급 여부
          </label>
        </div>
        <div class="col-xs-5 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="inter_pay2" class="sr-only">2차 중도금</label>
          <input type="number" name="inter_pay2" value="<?php echo set_value('inter_pay2'); if($owner_row->inter_pay2 !=='0') echo $owner_row->inter_pay2; ?>" data-toggle="tooltip" data-placement="top" title="2차 중도금" placeholder="2차 중도금" class="form-control input-sm" maxlength="11">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <div class="input-group">
            <label for="inter_pay2_date" class="sr-only">2차 중도금 지급일</label>
            <input type="text" class="form-control input-sm" id="inter_pay2_date" name="inter_pay2_date" maxlength="10" value="<?php echo set_value('inter_pay2_date'); if( !empty($owner_row && $owner_row->inter_pay2_date!=='0000-00-00')) echo $owner_row->inter_pay2_date; ?>" data-toggle="tooltip" data-placement="top" title="2차 중도금 지급일" placeholder="2차 중도금 지급일" onClick="cal_add(this); event.cancelBubble=true" readonly>
            <div class="input-group-addon">
              <a href="javascript:" onclick="cal_add(document.getElementById('inter_pay2_date'),this); event.cancelBubble=true">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-2" style="padding: 13px 10px;">
          <label class="checkbox-inline">
            <input type="checkbox" name="inter_pay2_is_paid" value="1" <?php echo set_checkbox('inter_pay2_is_paid', '1'); if($owner_row->inter_pay2_is_paid=='1') echo "checked"; ?>> 지급 여부
          </label>
        </div>
      </div>
    </div>
    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin-bottom:0;">
      <div class="col-xs-12 col-sm-12 col-md-2 bgf8" style="line-height:36px; padding:4px 15px;">잔금 지급 관련 정보</div>
      <div class="col-xs-12 col-md-10" style="padding:0;">
        <div class="col-xs-5 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <label for="remain_pay" class="sr-only">잔금</label>
          <input type="number" name="remain_pay" value="<?php echo set_value('remain_pay'); if($owner_row->remain_pay !=='0') echo $owner_row->remain_pay; ?>" data-toggle="tooltip" data-placement="top" title="잔 금" placeholder="잔 금" class="form-control input-sm" maxlength="11">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-2" style="padding: 7px 10px;">
          <div class="input-group">
            <label for="remain_pay_date" class="sr-only">잔금 지급일</label>
            <input type="text" class="form-control input-sm" id="remain_pay_date" name="remain_pay_date" maxlength="10" value="<?php echo set_value('remain_pay_date'); if( !empty($owner_row && $owner_row->remain_pay_date!=='0000-00-00')) echo $owner_row->remain_pay_date; ?>" data-toggle="tooltip" data-placement="top" title="잔금 지급일" placeholder="잔금 지급일" onClick="cal_add(this); event.cancelBubble=true" readonly>
            <div class="input-group-addon">
              <a href="javascript:" onclick="cal_add(document.getElementById('remain_pay_date'),this); event.cancelBubble=true">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-2" style="padding: 13px 10px;">
          <label class="checkbox-inline">
            <input type="checkbox" name="remain_pay_is_paid" value="1" <?php echo set_checkbox('remain_pay_is_paid', '1'); if($owner_row->remain_pay_is_paid) echo "checked"; ?>> 지급 여부
          </label>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3" style="padding: 13px 10px;">
          <label class="checkbox-inline">
            <input type="checkbox" name="ownership_is_take" value="1" <?php echo set_checkbox('ownership_is_take', '1'); if($owner_row->ownership_is_take=='1') echo "checked"; ?>> 소유권 확보 및 등기 경료 여부
          </label>
        </div>
      </div>
    </div>
    <div class="col-xs-12 bo-bottom right bgfb" style="padding: 10px; margin-bottom:30px;">
      <input class="btn btn-sm <?php echo $cl; ?>" type="button" value="<?php echo $sm; ?>" onclick="<?php echo $submit_str; ?>">
    </div>
  </div>
</form>
  <div class="row font12" style="margin:20px 0 3px;">
    <div class="col-xs-12 col-md-6" style="padding: 0 20px 0; margin-bottom: 3px; color: #5771fb;">
      총 <?php echo number_format($own_total->num); ?>건
      (<?php echo number_format($own_total->area*0.3025, 2); ?>평) 등록
      | 계약 건 <?php echo number_format($own_cont->num); ?>건
      (<?php echo number_format($own_cont->area*0.3025, 2); ?>평 -
      <?php echo number_format(($own_cont->area/$own_total->area)*100, 2) ?>%) 계약
    </div>
    <div class="hidden-xs hidden-sm col-md-6 right" style="padding: 0 20px 0; margin-bottom: 3px;">
      <a href="javascript:" onclick="$('#output_option').toggle();"  style="margin: 0 10px;">[엑셀 출력항목 선택]</a>
      <!-- <a href="javascript:alert('준비 중입니다!');"> -->
      <?php $url = base_url('/cms_download/site_owner_data/download')."?pj=".$project."&search_con=".$this->input->get('search_con')."&search_word=".$this->input->get('search_word') ?>
			<a href="javascript:" onclick="<?php echo 'chkArr(\''.$url.'\')' ?>">
        <img src="<?php echo base_url(); ?>static/img/excel_icon.jpg" height="14" border="0" alt="EXCEL 아이콘" style="margin-top: -3px;"/> EXCEL로 출력
      </a>
    </div>
<?php
  $attributes = array('method' => 'get', 'name' => 'ex_form');
  echo form_open(current_full_url(), $attributes);
?>
    <div class="hidden-xs col-sm-12 form-inline center bg-info" id="output_option" style="padding: 8px; display:none;">
			<div class="checkbox"><label><input type="checkbox" name="opt2" checked> 소유자&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt3"> 생년월일(성별)&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt4"> 연락처[1]&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt5"> 연락처[2]&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt6"> 주 소&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt7" checked> 소유구분&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt8" checked> 행정동&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt9" checked> 지 번&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt10" checked> 지 목&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt11" checked> 공부상 면적&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt13" checked> 환지 면적&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt15" checked> 소유지분&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt16" checked> 소유면적&nbsp;</label></div>
			<div class="checkbox"><label><input type="checkbox" name="opt18"> 은행계좌정보&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt21" checked> 계약여부&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt22" checked> 총 계약금액&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt23"> 계약금(1차)&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt26"> 계약금(2차)&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt29"> 중도금(1차)&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt32"> 중도금(2차)&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt35"> 잔 금&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt38"> 소유권이전등기&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt39"> 권리제한사항&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt40"> 상담 기록&nbsp;</label></div>
      <div class="checkbox"><label><input type="checkbox" name="opt41"> 등기부등본 발급일&nbsp;</label></div>

		</div>
  </div>
</form>
  <!-- 출력 및 get으로 수정 삭제하기 -->
  <div class="table-responsive font12">
    <table class="table table-bordered table-hover table-condensed font12">
      <thead>
        <tr class="warning">
          <th class="center" rowspan="2" style="vertical-align:middle;">no</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">소유자</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">행정동</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">지 번</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">지 목</th>
          <th class="center" colspan="2">실권리 면적</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">소유지분</th>
          <th class="center" colspan="2">지분 면적</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">소유구분</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">계약여부</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">매매대금</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">수정</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">삭제</th>
        </tr>
        <tr class="warning">
          <th class="center">면적(㎡)</th>
          <th class="center">면적(평)</th>
          <th class="center">면적(㎡)</th>
          <th class="center">면적(평)</th>
        </tr>
      </thead>
      <tbody>
<?php
  if(empty($owners_list)) :  ?>
        <tr class="center">
          <td class="center" colspan="15" style="padding: 130px 0;">조회할 데이터가 없습니다.</td>
        </tr>
<?php
  else:
    foreach ($owners_list as $lt) :

      switch ($lt->own_sort) {
        case '1': $own_sort = "개인"; break;
        case '2': $own_sort = "법인"; break;
        case '3': $own_sort = "국공유지"; break;
        default: $own_sort = ""; break;
      }
      $modi_url = base_url("cms_m3/project/1/3?project=".$project."&set_sort=2&mode=2&site_lot=".$lt->lot_seq."&own_seq=".$lt->seq."&page=".$this->input->get('page')."&search_con=".$this->input->get('search_con')."&search_word=".$this->input->get('search_word')); //project=1&set_sort=2&mode=1&site_lot=&search_con=&search_word=김영구
      $del_url = base_url("cms_m3/project/1/3?project=".$project."&set_sort=2&mode=3&site_lot=".$lt->lot_seq."&own_seq=".$lt->seq."&page=".$this->input->get('page'));
      if($auth13<2) {
        $modi_btn = "alert('이 페이지에 대한 관리 권한이 없습니다.')";
        $del_btn = "alert('이 페이지에 대한 관리 권한이 없습니다.')";
      }else {
        $modi_btn = "location.href='".$modi_url."'";
        $del_btn = "if(confirm('삭제 후 데이터를 복구할 수 없습니다. 그래도 삭제 하시겠습니까?')==true) location.href='".$del_url."'";
      }
?>
        <tr class="center">
          <td><?php echo $lt->lot_order."-".$lt->seq; ?></td>
          <td><?php echo $lt->owner; ?></td>
          <td><?php echo $lt->admin_dong; ?></td>
          <td><?php echo $lt->lot_num; ?></td>
          <td><?php echo $lt->land_mark; ?></td>
          <td class="right active"><?php echo number_format($lt->area_returned, 4); ?></td>
          <td class="right"><?php echo number_format($lt->area_returned*0.3025, 4); ?></td>
          <td class="right"><?php echo number_format($lt->owned_percent, 2)."%"; ?></td>
          <td class="right active"><?php echo number_format($lt->owned_area, 4); ?></td>
          <td class="right"><?php echo number_format($lt->owned_area*0.3025, 4); ?></td>
          <td><?php echo $own_sort; ?></td>
          <td><?php if($lt->is_contract=='1') echo "완료"; ?></td>
          <td class="right"><?php if($lt->is_contract=='1') echo number_format($lt->total_price); ?></td>
          <td><a href="javascript:" onclick="<?php echo $modi_btn; ?>" type="button" class="btn btn-success btn-xs">수정</a></td>
          <td><a href="javascript:" onclick="<?php echo $del_btn; ?>" type="button" class="btn btn-danger btn-xs">삭제</a></td>
        </tr>
<?php
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
<?php } ?>



<?php endif ?>
