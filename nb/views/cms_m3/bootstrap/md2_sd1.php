<?php
  if($auth21<1) :
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

<?php if( !$this->input->get('project')) :  ?>

<div class="row table-responsive font12" style="margin: 0; padding: 0; height: 573px;">
  <div class="form-group"><!-- 타입등록/제목 -->
    <div class="col-xs-12 form-wrap">
      <div class="col-xs-12 col-sm-8 font13" style="padding: 10px 0 8px;">
        <strong>* <span style="color: #d60740;">프로젝트(현장) 리스트</span></strong>
      </div>
    </div>
  </div>
  <table class="table bo-bottom">
    <tr align="center" style="background-color: #e3e7e0;">
      <td> NO.</td>
      <td> 프로젝트(현장) 명</td>
      <td> 종류 </td>
      <td> 총 세대수(공급물량)  </td>
      <td> 건축 규모</td>
      <td> 사업 개시년월</td>
    </tr>
<?php
function sort_back($no) {
switch ($no) {
  case '1': $sort="아파트(일반분양)"; break;
  case '2': $sort="아파트(조합)"; break;
  case '3': $sort="주상복합(아파트)"; break;
  case '4': $sort="주상복합(오피스텔)"; break;
  case '5': $sort="도시형생활주택"; break;
  case '6': $sort="근린생활시설"; break;
  case '7': $sort="레저(숙박)시설"; break;
  case '8': $sort="기타"; break;
}
return $sort;
}
?>
<?php foreach($pj_list as $pj) : ?>
    <tr align="center">
      <td> <?php echo $pj->seq; ?></td>
      <td> <a href="javascript:" onclick="location.href='?project=<?php echo $pj->seq; ?>'"><?php echo $pj->pj_name; ?></a></td>
      <td> <?php echo sort_back($pj->sort); ?> </td>
      <td> <?php echo $pj->num_unit." 세대(호/실)"; ?>  </td>
      <td> <?php echo $pj->build_size; ?></td>
      <td> <?php echo $pj->biz_start_ym; ?></td>
    </tr>
<?php endforeach; ?>
  </table>
  <div class="col-md-12 center" style="margin-top: 0px; padding: 0;">
    <ul class="pagination pagination-sm"><?php echo $pagination;?></ul>
  </div>
</div>


<?php else :
    $addr = explode("|",$project_data->local_addr);
    $type_name = explode("-",$project_data->type_name);
    $type_color = explode("-",$project_data->type_color);
    $t_count=count($type_name);
    $type_quantity = explode("-",$project_data->type_quantity);
    $count_unit = explode("-",$project_data->count_unit);
    $area_exc = explode("-",$project_data->area_exc);
    $area_com = explode("-",$project_data->area_com);
    $area_sup = explode("-",$project_data->area_sup);
    $area_other =  explode("-",$project_data->area_other);
    $area_cont = explode("-",$project_data->area_cont);
    $biz_start_ym = explode("-",$project_data->biz_start_ym);
?>

<div class="row" style="margin: 0; padding: 0;">
<?php
    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
    $attributes = array('name' => 'form1', 'class' => '', 'method' => 'post');
    echo form_open(current_full_url(), $attributes);
?>
    <fieldset class="font12">
      <label for="project" class="sr-only">모드</label>
      <input type="hidden" name="project" value="<?php echo $this->input->get('project'); ?>">
      <div class="form-group"><!-- 프로젝트명/종류 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="pj_name">프로젝트 명 <span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-12 col-sm-8">
            <input type="text" class="form-control input-sm han" id="pj_name" name="pj_name" maxlength="30" value="<?php if($this->input->post('pj_name')) echo set_value('pj_name'); else echo $project_data->pj_name; ?>" required placeholder="프로젝트 명">
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="sort">프로젝트 종류 <span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-12 col-sm-8">
            <select class="form-control input-sm" id="sort" name="sort" required>
                <option value="">선택</option>
                <option value="1" <?php if($this->input->post('sort')) echo set_select('sort', '1'); else if($project_data->sort==1) echo "selected"; ?>> 아파트(일반분양)</option>
                <option value="2" <?php if($this->input->post('sort')) echo set_select('sort', '2'); else if($project_data->sort==2) echo "selected"; ?>> 아파트(조합)</option>
                <option value="3" <?php if($this->input->post('sort')) echo set_select('sort', '3'); else if($project_data->sort==3) echo "selected"; ?>> 주상복합(아파트)</option>
                <option value="4" <?php if($this->input->post('sort')) echo set_select('sort', '4'); else if($project_data->sort==4) echo "selected"; ?>> 주상복합(오피스텔)</option>
                <option value="5" <?php if($this->input->post('sort')) echo set_select('sort', '5'); else if($project_data->sort==5) echo "selected"; ?>> 도시형생활주택</option>
                <option value="6" <?php if($this->input->post('sort')) echo set_select('sort', '6'); else if($project_data->sort==6) echo "selected"; ?>> 근린생활시설</option>
                <option value="7" <?php if($this->input->post('sort')) echo set_select('sort', '7'); else if($project_data->sort==7) echo "selected"; ?>> 레저(숙박)시설</option>
                <option value="8" <?php if($this->input->post('sort')) echo set_select('sort', '8'); else if($project_data->sort==8) echo "selected"; ?>> 기 타</option>
            </select>
          </div>
        </div>
      </div>

      <!-- 다음 우편번호 서비스 - iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
      <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
        <img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
      </div>
      <!-- 다음 우편번호 서비스 -------------onclick="execDaumPostcode(1)"-----postcode1-----address1_1-----address2_1------------------------>

      <div class="form-group"><!-- 대지주소 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label>대지위치(주소) <span class="red">*</span></label>
          <div class="visible-sm" style="height:41px;">&nbsp;</div>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-10 form-wrap bo-top">
          <div class="col-xs-3 col-sm-5 col-md-1" style="padding-right: 0;">
            <label for="postcode1" class="sr-only">우편번호</label>
            <input type="number" class="form-control input-sm en_only" id="postcode1" name="postcode1" maxlength="5" value="<?php if($this->input->post('zipcode')) echo set_value('zipcode'); else echo $addr[0]; ?>" readonly required>
          </div>
          <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
            <input type="button" class="btn btn-info btn-sm" value="우편번호" onclick="execDaumPostcode(1)">
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
            <label for="address1_1" class="sr-only">회사주소1</label>
            <input type="text" class="form-control input-sm han" id="address1_1" name="address1_1" maxlength="100" value="<?php if($this->input->post('address1')) echo set_value('address1'); else echo $addr[1]; ?>" readonly required>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
            <label for="address2_1" class="sr-only">회사주소2</label>
            <input type="text" class="form-control input-sm han" id="address2_1" name="address2_1" maxlength="93" value="<?php if($this->input->post('address2')) echo set_value('address2'); else echo $addr[2]; ?>" name="address2" placeholder="나머지 주소">
          </div>
        </div>
      </div>

      <div class="form-group"><!-- 매입면적/계획면적 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="buy_land_extent">대지 매입면적 <span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="buy_land_extent" name="buy_land_extent" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('buy_land_extent')) echo set_value('buy_land_extent'); else echo $project_data->buy_land_extent; ?>" required placeholder="대지 매입면적 (㎡)">
          </div>
                <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
            <label for="donation_land_extent">기부채납 면적</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
            <div class="col-xs-10 col-sm-8">
                <input type="number" class="form-control input-sm en_only" id="donation_land_extent" name="donation_land_extent" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('donation_land_extent')) echo set_value('donation_land_extent'); else echo $project_data->donation_land_extent; ?>" placeholder="기부채납 면적 (㎡)">
            </div>
                        <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
        </div>
      </div>

      <div class="form-group"><!-- 계획면적/용도지역지구 -->
          <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
            <label for="scheme_land_extent">계획 대지면적 <span class="red">*</span></label>
          </div>
          <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
            <div class="col-xs-10 col-sm-8">
              <input type="number" class="form-control input-sm en_only" id="scheme_land_extent" name="scheme_land_extent" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('scheme_land_extent')) echo set_value('scheme_land_extent'); else echo $project_data->scheme_land_extent; ?>" required placeholder="계획 대지면적 (㎡)">
            </div>
                  <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
              <label for="area_usage">용도지역·지구</label>
          </div>
          <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
              <div class="col-xs-10 col-sm-8">
                  <input type="text" class="form-control input-sm" id="area_usage" name="area_usage" maxlength="30" value="<?php if($this->input->post('area_usage')) echo set_value('area_usage'); else echo $project_data->area_usage; ?>" placeholder="용도지역 · 지구">
              </div>
              <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
          </div>
      </div>

      <div class="form-group"><!-- 건축규모/세대수 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="build_size">건축 규모</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-12 col-sm-8">
            <input type="text" class="form-control input-sm han" id="build_size" name="build_size" maxlength="60" value="<?php if($this->input->post('build_size')) echo set_value('build_size'); else echo $project_data->build_size; ?>" placeholder="건축 규모 (동수/최고층 등)">
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="num_unit">세대(호/실) 수 <span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="num_unit" name="num_unit" onkeydown="onlyNum(this);" maxlength="6" value="<?php if($this->input->post('num_unit')) echo set_value('num_unit'); else echo $project_data->num_unit; ?>" required placeholder="세대(호/실) 수">
          </div>
                <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>세대(호/실)</span></div>
        </div>
      </div>

      <div class="form-group"><!-- 건축면적/총연면적 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="build_area">건축 면적</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="build_area" name="build_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('build_area')) echo set_value('build_area'); else echo $project_data->build_area; ?>"  placeholder="건축 면적 (㎡)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="gr_floor_area">총 연면적 <span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="gr_floor_area" name="gr_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('gr_floor_area')) echo set_value('gr_floor_area'); else echo $project_data->gr_floor_area; ?>" required placeholder="총 연면적 (㎡)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
        </div>
      </div>

      <div class="form-group"><!-- 지상/지하연면적 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="on_floor_area">지상 연면적 <span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="on_floor_area" name="on_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('on_floor_area')) echo set_value('on_floor_area'); else echo $project_data->on_floor_area; ?>" required placeholder="지상 연면적 (㎡)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="ba_floor_area">지하 연면적 <span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="ba_floor_area" name="ba_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('ba_floor_area')) echo set_value('ba_floor_area'); else echo $project_data->ba_floor_area; ?>" required placeholder="지하 연면적 (㎡)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
        </div>
      </div>

      <div class="form-group"><!-- 용적율/건폐율 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="floor_ar_rat">용적율 (%) <span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="floor_ar_rat" name="floor_ar_rat" maxlength="8" value="<?php if($this->input->post('floor_ar_rat')) echo set_value('floor_ar_rat'); else echo $project_data->floor_ar_rat; ?>" required placeholder="용적율 (%)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>%</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="bu_to_la_rat">건폐율</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="bu_to_la_rat" name="bu_to_la_rat" maxlength="8" value="<?php if($this->input->post('bu_to_la_rat')) echo set_value('bu_to_la_rat'); else echo $project_data->bu_to_la_rat; ?>"  placeholder="건폐율 (%)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>%</span></div>
        </div>
      </div>

      <div class="form-group"><!-- 법정/계획주차대수 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="law_num_parking">법정 주차대수</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="law_num_parking" name="law_num_parking" onkeydown="onlyNum(this);" maxlength="6" value="<?php if($this->input->post('law_num_parking')) echo set_value('law_num_parking'); else echo $project_data->law_num_parking; ?>"  placeholder="법정 주차대수">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>대</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="plan_num_parking">계획 주차대수</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="plan_num_parking" name="plan_num_parking" onkeydown="onlyNum(this);" maxlength="6" value="<?php if($this->input->post('plan_num_parking')) echo set_value('plan_num_parking'); else echo $project_data->plan_num_parking; ?>"  placeholder="계획 주차대수">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>대</span></div>
        </div>
      </div>

      <div class="form-group"><!-- 타입등록/제목 -->
        <div class="col-xs-12 form-wrap bo-top">
          <div class="col-xs-12 col-sm-8 font13" style="padding: 25px 0 5px 15px;">
            <strong>* <span style="color: #d60740;">타입 등록</span></strong>
          </div>
        </div>
      </div>

<?php for($j=1; $j<=11; $j++): ?>

    <div class="form-group" id="<?php echo "type2_".$j; ?>" style="<?php if($j>1 && $t_count<$j) echo "display:none";?>">
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
            <label for="<?php echo "type_name_".$j; ?>"><?php echo "타입별 정보등록(".$j.") "; ?><span class="red">*</span></label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
                <input type="text" class="form-control input-sm eng" id="<?php echo "type_name_".$j; ?>" name="<?php echo "type_name_".$j; ?>" maxlength="10" value="<?php if($this->input->post("type_name_".$j)) echo set_value("type_name_".$j); else if($t_count>0) echo $type_name[$j-1]; ?>" required placeholder="타입">
            </div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
                <label for="<?php echo "type_color_".$j; ?>" class="sr-only">컬러</span></label>
                <input type="color" class="form-control input-sm en_only" id="<?php echo "type_color_".$j; ?>" name="<?php echo "type_color_".$j; ?>" maxlength="7" value="<?php if($this->input->post("type_color_".$j)) echo set_value("type_color_".$j); else if($t_count>0) echo $type_color[$j-1]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>0) echo $type_color[$j-1]; ?>">
            </div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
                <label for="<?php echo "type_quantity_".$j; ?>" class="sr-only">수량</span></label>
                <input type="number" class="form-control input-sm en_only" id="<?php echo "type_quantity_".$j; ?>" name="<?php echo "type_quantity_".$j; ?>" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post("type_quantity_".$j)) echo set_value("type_quantity_".$j); else if($t_count>0) echo $type_quantity[$j-1]; ?>" required placeholder="타입별 단위 수량">
            </div>
            <div class="col-xs-3 col-sm-1 col-md-2" style="padding-right: 0;">
                <label for="<?php echo "count_unit_".$j; ?>" class="sr-only">단위</span></label>
                <select class="form-control input-sm" id="<?php echo "count_unit_".$j; ?>" name="<?php echo "count_unit_".$j; ?>">
                    <option value="0">단위</option>
                    <option value="1" <?php if($this->input->post("count_unit_".$j)) echo set_select("count_unit_".$j, '1'); else if($t_count>0 && $count_unit[$j-1]==1) echo "selected"; ?>>세대</option>
                    <option value="2" <?php if($this->input->post("count_unit_".$j)) echo set_select("count_unit_".$j, '2'); else if($t_count>0 && $count_unit[$j-1]==2) echo "selected"; ?>>실</option>
                    <option value="3" <?php if($this->input->post("count_unit_".$j)) echo set_select("count_unit_".$j, '3'); else if($t_count>0 && $count_unit[$j-1]==3) echo "selected"; ?>>호</option>
                    <option value="4" <?php if($this->input->post("count_unit_".$j)) echo set_select("count_unit_".$j, '4'); else if($t_count>0 && $count_unit[$j-1]==4) echo "selected"; ?>>㎡(면적)</option>
                </select>
            </div>
            <div class="col-xs-3 hidden-sm col-md-1"></div>
        </div>

        <div class="hidden-xs col-sm-3 col-md-2 label-wrap">
          <label><?php echo "( 면적 / 단위 / ㎡ )"; ?></label>
          <div class="visible-sm col-sm-12" style="height:42px;">&nbsp;</div>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding: 11px 0 0 8px; text-align:right;"><span>전용면적 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
                <label for="<?php echo "area_exc_".$j; ?>" class="sr-only">전용면적</span></label>
                <input type="number" class="form-control input-sm eng" id="<?php echo "area_exc_".$j; ?>" name="<?php echo "area_exc_".$j; ?>" maxlength="10" value="<?php if($this->input->post("area_exc_".$j)) echo set_value("area_exc_".$j); else if($t_count>0) echo $area_exc[$j-1]; ?>" placeholder="전용면적">
            </div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding: 11px 0 0 8px; text-align:right;"><span>주거공용 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
                <label for="<?php echo "area_com_".$j; ?>" class="sr-only">주거공용</span></label>
                <input type="number" class="form-control input-sm eng" id="<?php echo "area_com_".$j; ?>" name="<?php echo "area_com_".$j; ?>" maxlength="10" value="<?php if($this->input->post("area_com_".$j)) echo set_value("area_com_".$j); else if($t_count>0) echo $area_com[$j-1]; ?>" placeholder="주거공용">
            </div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding: 11px 0 0 8px; text-align:right;"><span>공급면적 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
                <label for="<?php echo "area_sup_".$j; ?>" class="sr-only">공급면적</span></label>
                <input type="number" class="form-control input-sm eng" id="<?php echo "area_sup_".$j; ?>" name="<?php echo "area_sup_".$j; ?>" maxlength="10" value="<?php if($this->input->post("area_sup_".$j)) echo set_value("area_sup_".$j); else if($t_count>0) echo $area_sup[$j-1]; ?>" placeholder="공급면적">
            </div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding: 11px 0 0 8px; text-align:right;"><span>기타공용 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
                <label for="<?php echo "area_other_".$j; ?>" class="sr-only">기타공용</span></label>
                <input type="number" class="form-control input-sm eng" id="<?php echo "area_other_".$j; ?>" name="<?php echo "area_other_".$j; ?>" maxlength="10" value="<?php if($this->input->post("area_other_".$j)) echo set_value("area_other_".$j); else if($t_count>0) echo $area_other[$j-1]; ?>" placeholder="기타공용">
            </div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding: 11px 0 0 8px; text-align:right;"><span>계약면적 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
                <label for="<?php echo "area_cont_".$j; ?>" class="sr-only">계약면적</span></label>
                <input type="number" class="form-control input-sm eng" id="<?php echo "area_cont_".$j; ?>" name="<?php echo "area_cont_".$j; ?>" maxlength="10" value="<?php if($this->input->post("area_cont_".$j)) echo set_value("area_cont_".$j); else if($t_count>0) echo $area_cont[$j-1]; ?>" placeholder="계약면적">
            </div>
<?php if($j<11): ?>
            <div class="col-xs-3 col-sm-4 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
                  <input type="checkbox" name="<?php echo "ck2_".$j; ?>" id="<?php echo "ck2_".$j; ?>" onclick=<?php echo "type_reg('2',this,".$j.")" ?> <?php if( !empty($type_name[$j])){echo " checked ";} if( !empty($type_name[$j+1])){echo " disabled ";}?>>
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
            </div>
<?php endif; ?>
        </div>
    </div>
<?php endfor; ?>

      <div class="form-group"><!-- 추가정보등록/제목 -->
        <div class="col-xs-12 form-wrap bo-top">
          <div class="col-xs-12 col-sm-8 font13" style="padding: 25px 0 5px 15px;">
            <strong>* <span style="color: #d60740;">추가 정보</span></strong>
          </div>
        </div>
      </div>

      <div class="form-group"><!-- 토지매입비/평당건축비 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="land_cost">토지 매입비</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="land_cost" name="land_cost" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('land_cost')) echo set_value('land_cost'); else echo $project_data->land_cost; ?>" placeholder="토지 매입비 (단위:천원)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="build_cost">평당 건축비</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm en_only" id="build_cost" name="build_cost" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('build_cost')) echo set_value('build_cost'); else echo $project_data->build_cost; ?>" placeholder="평당 건축비 (단위:천원)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
        </div>
      </div>

      <div class="form-group"><!-- 단지내 상가면적 / 매각가 -->
          <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
              <label for="inside_arcade_area">단지내 상가 면적</label>
          </div>
          <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
              <div class="col-xs-10 col-sm-8">
                  <input type="number" class="form-control input-sm en_only" id="inside_arcade_area" name="inside_arcade_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('inside_arcade_area')) echo set_value('inside_arcade_area'); else echo $project_data->inside_arcade_area; ?>" placeholder="단지내 상가 면적 (단위:㎡)">
              </div>
  <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
              <label for="inside_arcade_price">단지내 상가 매각가</label>
          </div>
          <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
              <div class="col-xs-10 col-sm-8">
                  <input type="number" class="form-control input-sm en_only" id="inside_arcade_price" name="inside_arcade_price" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('inside_arcade_price')) echo set_value('inside_arcade_price'); else echo $project_data->inside_arcade_price; ?>" placeholder="단지내 상가 매각가 (단위:천원)">
              </div>
  <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
          </div>
      </div>

      <div class="form-group"><!-- 설계용역비/감리용역비 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="arc_design_cost">설계 용역비</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm  en_only" id="arc_design_cost" name="arc_design_cost" onkeydown="onlyNum(this);" maxlength="8" value="<?php if($this->input->post('arc_design_cost')) echo set_value('arc_design_cost'); else echo $project_data->arc_design_cost; ?>" placeholder="설계 용역비 (단위:천원)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="supervision_cost">감리 용역비</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm  en_only" id="supervision_cost" name="supervision_cost" onkeydown="onlyNum(this);" maxlength="8" value="<?php if($this->input->post('supervision_cost')) echo set_value('supervision_cost'); else echo $project_data->supervision_cost; ?>" placeholder="감리 용역비 (단위:천원)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
        </div>
      </div>
      <div class="form-group"><!-- 시행사 초기투자금/시대행 용역비 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="initial_inves">시행사 초기투자금</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm  en_only" id="initial_inves" name="initial_inves" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('initial_inves')) echo set_value('initial_inves'); else echo $project_data->initial_inves; ?>" placeholder="시행사 초기 투자금 (단위:천원)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="dev_agency_charge">시행대행 용역비 (세대당)</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm  en_only" id="dev_agency_charge" name="dev_agency_charge" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('dev_agency_charge')) echo set_value('dev_agency_charge'); else echo $project_data->dev_agency_charge; ?>" placeholder="시행대행 용역비 (단위:천원)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
        </div>
      </div>
      <div class="form-group"><!-- 브리지 차입규모/PF차입규모 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="bridge_loan">브리지 차입규모</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm  en_only" id="bridge_loan" name="bridge_loan" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('bridge_loan')) echo set_value('bridge_loan'); else echo $project_data->bridge_loan; ?>" placeholder="브리지 차입규모 (단위:천원)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="pf_loan">PF 차입규모</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm  en_only" id="pf_loan" name="pf_loan" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('pf_loan')) echo set_value('pf_loan'); else echo $project_data->pf_loan; ?>" placeholder="PF 차입규모 (단위:천원)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
        </div>
      </div>
      <div class="form-group"><!-- 공사소요기간/사업개시년 -->
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="con_lead_time">공사 소요기간</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-10 col-sm-8">
            <input type="number" class="form-control input-sm  en_only" id="con_lead_time" name="con_lead_time" onkeydown="onlyNum(this);" maxlength="4" value="<?php if($this->input->post('con_lead_time')) echo set_value('con_lead_time'); else echo $project_data->con_lead_time; ?>" placeholder="공사 소요기간 (개월)">
          </div>
          <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>개월</span></div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 label-wrap bo-top">
          <label for="biz_start_year">사업 개시 년</label>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-4 form-wrap bo-top">
          <div class="col-xs-5 col-sm-4">
            <input type="number" class="form-control input-sm en_only" id="biz_start_year" name="biz_start_year" onkeydown="onlyNum(this);" maxlength="4" value="<?php if($this->input->post('biz_start_year')) echo set_value('biz_start_year'); else echo $biz_start_ym[0]; ?>" placeholder="YYYY">
          </div>
          <div class="col-xs-1" style="padding: 11px 0;"><span>년</span></div>
          <div class="col-xs-4 col-sm-3">
            <label for="biz_start_month" class="sr-only">사업개시 월</span></label>
            <input type="number" class="form-control input-sm en_only" id="biz_start_month" name="biz_start_month" onkeydown="onlyNum(this);" maxlength="2" value="<?php if($this->input->post('biz_start_month')) echo set_value('biz_start_month'); else echo $biz_start_ym[1]; ?>" placeholder="MM">
          </div>
          <div class="col-xs-1 col-sm-2" style="padding: 11px 0;"><span>월</span></div>
        </div>
      </div>
      <div class="form-group" style="color: red;">&nbsp;</div>

<?php if($auth21<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="con_formck();";} ?>
      <div class="form-group btn-wrap" style="margin: 0;">
        <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="수정하기">
      </div>
    </fieldset>
  </form>
</div>
<?php endif ?>
<?php endif ?>
