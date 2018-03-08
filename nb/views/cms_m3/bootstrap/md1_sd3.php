<?php
  if($auth13<1) :
  	include('no_auth.php');
  else :
    if($auth13<2) {
      $submit_str="alert('등록 권한이 없습니다!')";
    } else {
      if(empty($this->input->get('project'))){
        $submit_str="alert('등록할 프로젝트를 선택하여 주십시요!'); document.sel_condi.project.focus();";
      }else{
        $submit_str="if(confirm('토지 기초 데이터를 등록하시겠습니까?')===true) submit();";
      }
    }
?>
<div class="main_start">&nbsp;</div>
<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->2. 기본정보 수정 -->

<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
<?php
  $attributes = array('method' => 'get', 'name' => 'sel_condi');
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
<div class="right font11" style="margin:-13px 10px 3px; color:#9e9c9c;">※ <span style="color:#5996fe;">환지(실권리) 면적</span>은 환지 등의 사유로 공부상 면적과 실제 면적이 상이한 경우에만 입력하세요.</div>
  <!-- 입력하기 폼 -->
<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'basic_insert');
  $hidden = array(
      'project' => $this->input->get('project'),
      'sort' => 'basic'
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
    <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
      <div class="col-sm-12 col-md-1 center point-sub1" style="padding: 10px; 0">토지 데이터</div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 4px 15px;">
        <label for="order_no" class="sr-only">순번</label>
        <input type="text" name="order_no" value="<?php echo set_value('order_no'); ?>" placeholder="no." class="form-control input-sm" maxlength="5" required>
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
        <input class="btn btn-warning btn-sm" type="button" value="추가 등록" onclick="<?php echo $submit_str; ?>">
      </div>
    </div>
  </form>
  <div class="row font12" style="margin-bottom:3px;">
    <div class="col-xs-6" style="color: #5771fb;">총 <?php echo $total_rows; ?> 필지 / 면적 <?php echo number_format($summary->total_area, 2); ?>㎡ (<?php echo number_format($summary->total_area*0.3025, 2) ?>평) 등록</div>
    <div class="col-xs-12 hidden-xs hidden-sm right" style="padding: 0 20px; margin: -18px 0 3px;">
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
<div class="row font12" style="margin: 0; padding: 0; height: 480px;">
<?php
  $attributes = array('method'=>'get');
  $hidden = array(
      'project' => $this->input->get('project'),
      'set_sort' => '2'
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-sm-12 col-md-1 center point-sub1" style="padding: 10px; 0">입력 지번</div>
    <div class="col-xs-3 col-sm-2 col-md-2" style="padding: 4px 15px;">
      <label for="site_lot" class="sr-only">지 번</label>
      <select class="form-control input-sm" name="site_lot" onchange="submit();">
        <option value="" <?php if(empty($this->input->get('site_lot'))) echo "selected";?>>전 체</option>
<?php foreach ($site_lot as $lt) : ?>
        <option value="<?php echo $lt->seq; ?>" <?php if($this->input->get('site_lot')==$lt->seq) echo "selected";;?>><?php echo "[".$lt->order_no."] - [".$lt->admin_dong."] - ".$lt->lot_num; ?></option>
<?php endforeach; ?>
      </select>
    </div>
    <div class="col-xs-3 col-sm-2 col-md-3" style="padding: 4px 15px; text-align:center; line-height: 30px;">
      <div class="col-xs-10" style="">
        <?php if( !empty($this->input->get('site_lot'))): ?><a type="button" class="btn btn-info btn-xs" href="javascript:" onclick="$('#owner_input').toggle();"><?php echo $lt->lot_num." 신규 정보 입력</a>"; endif; ?>
      </div>
      <div class="col-xs-2" style="padding-top:5px;">
<?php if( !empty($this->input->get('site_lot'))) : ?>
        <button type="button" class="close" aria-label="Close" style="padding-left: 5px;" onclick="location.href='<?php echo base_url('cms_m3/project/1/3?project='.$project.'&set_sort=2') ?>'"><span aria-hidden="true">&times;</span></button>
<?php endif; ?>
      </div>
    </div>
    <!-- 검색하기 폼 시작 -->
    <div class="col-sm-12 col-md-1 center point-sub1" style="padding: 10px; 0">검색 조건</div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
      <label for="search_con" class="sr-only">조건</label>
      <select class="form-control input-sm" name="search_con">
        <option value="1" <?php echo set_select('search_con', '1');?>>전 체</option>
        <option value="2" <?php echo set_select('search_con', '2');?>>지 번</option>
        <option value="3" <?php echo set_select('search_con', '3');?>>지 주</option>
      </select>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 15px;">
        <label for="search_word" class="sr-only">검색어</label>
        <input type="text" name="search_word" value="<?php echo $this->input->get('search_word'); ?>" placeholder="Search" class="form-control input-sm" onclick="this.value='';">
    </div>
    <div class="col-xs-6 col-sm-4 col-md-1 right" style="padding: 4px 15px;">
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
      'project' => $this->input->get('project'),
      'sort' => 'ownership',
      'lot_seq' => $this->input->get('site_lot')
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <div class="bo-top bo-bottom font12" id="owner_input" style="display:none;">
    <div class="col-sm-12 bo-bottom point-sub3" style="line-height:36px; padding:5px 15px;">
      <span style="color:#324cfc;"><strong><?php echo "[".$sel_site->admin_dong."] ".$sel_site->lot_num." (".number_format($sel_site->area_returned, 2)."㎡)"; ?></strong></span> - 소유자 정보 입력
    </div>
    <div class="col-sm-12 form-group" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-4 col-md-2 point-sub" style="line-height:36px; padding:4px 15px;">소유자 정보</div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">소유자명</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="소유자명 - (필수)" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">소유자명</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="생년월일(ex:800123)" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 11px 10px 0;">
        <label class="radio-inline"><input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 남성</label>
        <label class="radio-inline"><input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 여성</label>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">소유자명</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="연락처1 - (필수)" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">소유자명</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="연락처2" class="form-control input-sm" maxlength="5" required>
      </div>
    </div>
    <!-- 다음 우편번호 서비스 - iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
    <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
      <img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
    </div>
    <!-- 다음 우편번호 서비스 -------------onclick="execDaumPostcode(1)"-----postcode1-----address1_1-----address2_1------------------------>
    <div class="col-sm-12" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-4 col-md-2 point-sub bo-bottom" style="line-height:36px; padding:4px 15px;">&nbsp;</div>
      <div class="col-xs-3 col-sm-5 col-md-1 bo-bottom" style="padding: 7px 10px;">
        <label for="postcode1" class="sr-only">우편번호</label>
        <input type="text" class="form-control input-sm en_only" id="postcode1" name="postcode1" maxlength="5" value="<?php if($this->input->post('zipcode')) echo set_value('zipcode'); else echo $addr[0]; ?>" readonly required>
      </div>
      <div class="col-xs-3 col-sm-2 col-md-1 bo-bottom" style="padding: 7px 10px;">
        <input type="button" class="btn btn-info btn-sm" value="우편번호" onclick="execDaumPostcode(1)">
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4 bo-bottom" style="padding: 7px 10px;">
        <label for="address1_1" class="sr-only">소유자주소</label>
        <input type="text" class="form-control input-sm han" id="address1_1" name="address1_1" maxlength="100" value="<?php if($this->input->post('address1')) echo set_value('address1'); else echo $addr[1]; ?>" readonly required>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-2 bo-bottom" style="padding: 7px 10px;">
        <label for="address2_1" class="sr-only">소유자주소2</label>
        <input type="text" class="form-control input-sm han" id="address2_1" name="address2_1" maxlength="93" value="<?php if($this->input->post('address2')) echo set_value('address2'); else echo $addr[2]; ?>" name="address2" placeholder="나머지 주소">
      </div>

      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <div class="input-group">
          <label for="owner" class="sr-only">등기부등본 발급일</label>
          <input type="text" class="form-control input-sm" id="ref_date" name="ref_date" maxlength="10" value="<?php echo $ref_date;?>" placeholder="등기부등본 발급일" onClick="cal_add(this); event.cancelBubble=true">
          <div class="input-group-addon">
            <a href="javascript:" onclick="cal_add(document.getElementById('ref_date'),this); event.cancelBubble=true">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12 form-group" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-4 col-md-2 point-sub1" style="line-height:36px; padding:4px 15px;">소유권 정보</div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 7px 10px 0;">
        <label for="search_con" class="sr-only">조건</label>
        <select class="form-control input-sm" name="search_con">
          <option value="" <?php echo set_select('search_con', '');?>>구 분</option>
          <option value="1" <?php echo set_select('search_con', '1');?>>개 인</option>
          <option value="2" <?php echo set_select('search_con', '2');?>>법 인</option>
          <option value="3" <?php echo set_select('search_con', '3');?>>국/공유지</option>
        </select>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">소유지분</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="소유지분 - (필수)" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">지분면적</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="지분면적(㎡) - (필수)" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 7px 10px 0;">
        <label for="search_con" class="sr-only">조건</label>
        <select class="form-control input-sm" name="search_con">
          <option value="" <?php echo set_select('search_con', '');?>>은행선택</option>
          <option value="1" <?php echo set_select('search_con', '1');?>>개 인</option>
          <option value="2" <?php echo set_select('search_con', '2');?>>법 인</option>
          <option value="3" <?php echo set_select('search_con', '3');?>>국/공유지</option>
        </select>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">계좌번호</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="계좌번호" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">예 금 주</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="예 금 주" class="form-control input-sm" maxlength="5" required>
      </div>
    </div>

    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-4 col-md-2 point-sub1" style="line-height:36px; padding:4px 15px;">&nbsp;</div>
      <div class="col-xs-6 col-sm-4 col-md-10" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">소유자에게 국한되는 권리 제한사항</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="갑/을구 권리 제한사항" class="form-control input-sm" maxlength="5" required>
      </div>
    </div>
    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-4 col-md-2 point-sub1" style="line-height:36px; padding:4px 15px; height:80px;">상담 기록 (상담일시-내용)</div>
      <div class="col-xs-12 col-sm-8 col-md-7" style="padding: 7px 10px;">
        <textarea class="form-control" rows="3"></textarea>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 11px 10px;">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" value="option1"> 계약 여부
        </label>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">계약금액</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="계약금액" class="form-control input-sm" maxlength="5" required>
      </div>
      <!-- <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">평당단가</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="평당단가" class="form-control input-sm" maxlength="5" required>
      </div> -->
    </div>

    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-4 col-md-2 point-sub1" style="line-height:36px; padding:4px 15px;">계약금 지급 관련</div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">1차 계약금</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="1차 계약금" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <div class="input-group">
          <label for="owner" class="sr-only">1차 계약금 지급일</label>
          <input type="text" class="form-control input-sm" id="ref_date" name="ref_date" maxlength="10" value="<?php echo $ref_date;?>" placeholder="1차 계약금 지급일" onClick="cal_add(this); event.cancelBubble=true">
          <div class="input-group-addon">
            <a href="javascript:" onclick="cal_add(document.getElementById('ref_date'),this); event.cancelBubble=true">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 11px 10px;">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" value="option1"> 지급 여부
        </label>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">2차 계약금</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="2차 계약금" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <div class="input-group">
          <label for="owner" class="sr-only">2차 계약금 지급일</label>
          <input type="text" class="form-control input-sm" id="ref_date" name="ref_date" maxlength="10" value="<?php echo $ref_date;?>" placeholder="2차 계약금 지급일" onClick="cal_add(this); event.cancelBubble=true">
          <div class="input-group-addon">
            <a href="javascript:" onclick="cal_add(document.getElementById('ref_date'),this); event.cancelBubble=true">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 11px 10px;">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" value="option1"> 지급 여부
        </label>
      </div>
    </div>
    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-4 col-md-2 point-sub1" style="line-height:36px; padding:4px 15px;">중도금 지급 관련 정보</div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">1차 중도금</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="1차 중도금" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <div class="input-group">
          <label for="owner" class="sr-only">1차 중도금 지급일</label>
          <input type="text" class="form-control input-sm" id="ref_date" name="ref_date" maxlength="10" value="<?php echo $ref_date;?>" placeholder="1차 중도금 지급일" onClick="cal_add(this); event.cancelBubble=true">
          <div class="input-group-addon">
            <a href="javascript:" onclick="cal_add(document.getElementById('ref_date'),this); event.cancelBubble=true">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 11px 10px;">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" value="option1"> 지급 여부
        </label>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">2차 중도금</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="2차 중도금" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <div class="input-group">
          <label for="owner" class="sr-only">2차 중도금 지급일</label>
          <input type="text" class="form-control input-sm" id="ref_date" name="ref_date" maxlength="10" value="<?php echo $ref_date;?>" placeholder="2차 중도금 지급일" onClick="cal_add(this); event.cancelBubble=true">
          <div class="input-group-addon">
            <a href="javascript:" onclick="cal_add(document.getElementById('ref_date'),this); event.cancelBubble=true">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 11px 10px;">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" value="option1"> 지급 여부
        </label>
      </div>
    </div>
    <div class="col-sm-12 form-group bo-bottom" style="padding:0; margin:0;">
      <div class="col-xs-12 col-sm-4 col-md-2 point-sub1" style="line-height:36px; padding:4px 15px;">잔금 지급 관련 정보</div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <label for="owner" class="sr-only">잔금</label>
        <input type="text" name="owner" value="<?php echo set_value('owner'); ?>" placeholder="잔금" class="form-control input-sm" maxlength="5" required>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 7px 10px;">
        <div class="input-group">
          <label for="owner" class="sr-only">잔금 지급일</label>
          <input type="text" class="form-control input-sm" id="ref_date" name="ref_date" maxlength="10" value="<?php echo $ref_date;?>" placeholder="잔금 지급일" onClick="cal_add(this); event.cancelBubble=true">
          <div class="input-group-addon">
            <a href="javascript:" onclick="cal_add(document.getElementById('ref_date'),this); event.cancelBubble=true">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
            </a>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-1" style="padding: 11px 10px;">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" value="option1"> 지급 여부
        </label>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-3" style="padding: 11px 10px;">
        <label class="checkbox-inline">
          <input type="checkbox" id="inlineCheckbox1" value="option1"> 소유권 확보 및 이전등기 경료 여부
        </label>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-2 right" style="padding: 7px 10px;">
        <input class="btn btn-success btn-sm" type="button" value="등록 하기" onclick="<?php echo $submit_str; ?>">
      </div>
    </div>
  </div>
</form>
  <div class="row font12" style="margin:20px 0 3px;">
    <div class="col-xs-12 hidden-xs hidden-sm right" style="padding: 0 20px 0; margin-bottom: 3px;">
      <a href="javascript:alert('준비 중입니다!');">
      <!-- <a href="<?php echo base_url('/cms_download/basic_site_list/download')."?pj=".$project; ?>"> -->
        <img src="<?php echo base_url(); ?>static/img/excel_icon.jpg" height="14" border="0" alt="EXCEL 아이콘" style="margin-top: -3px;"/> EXCEL로 출력
      </a>
    </div>
  </div>

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
          <th class="center" colspan="2">지분면적</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">소유구분</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">계약여부</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">사용승낙</th>
          <th class="center" rowspan="2" style="vertical-align:middle;">매매대금</th>
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
  if(empty($owner_list)) :  ?>
        <tr class="center">
          <td class="center" colspan="14" style="padding: 130px 0;">조회할 데이터가 없습니다.</td>
        </tr>
<?php
  else:
    foreach ($owner_list as $lt) :
?>
        <tr class="center">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
<?php endforeach; ?>
<?php endif;?>
      </tbody>
    </table>
  </div>
  <div class="col-md-12 center" style="margin:padding: 0;">
    <ul class="pagination pagination-sm"><?php echo $pagination;?></ul>
  </div>
</div>
<?php } ?>



<?php endif ?>
