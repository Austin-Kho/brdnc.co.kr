<?php
  if($auth12<1) :
  	include('no_auth.php');
  else :
    switch ($this->input->get('set_sort')) {
      case '1': $obj = '분양 차수를'; break;
      case '2': $obj = '납입 회차를'; break;
      case '3': $obj = '층별 조건을'; break;
      case '4': $obj = '향별 조건을'; break;
      case '5': $obj = '조건별 분양가를'; break;
      case '6': $obj = '회차별 납입가를'; break;
      default: $obj = '데이터를'; break;
    }
    if($auth12<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="if(confirm('".$obj." 등록하시겠습니까?')===true) submit();";}
?>
<script type="text/javascript">
    //<![CDATA[
    function check_add__(frm, val, no, n){  // 체크박스 // 넘버  id="type_10"
    	if(frm=='1'){ var str1="add1_"; var str2="chk1_"; }
    	if(frm=='2'){ var str1="add2_"; var str2="chk2_"; }
    	if(frm=='3'){ var str1="add3_"; var str2="chk3_"; }
      if(frm=='4'){ var str1="add4_"; var str2="chk4_"; }
      if(frm=='5'){ var str1="add5_"; var str2="chk5_"; }
      if(frm=='6'){ var str1="add6_"; var str2="chk6_"; }

    	var np=parseInt(no)+1;
    	var nm=parseInt(no)-1;
    	var add_n=str1+np;
    	var chk_n=str2+nm;

    	var add_div=document.getElementById(add_n);
    	var ckbox=document.getElementById(chk_n);

    	if(val.checked===true){
    		add_div.style.display="";
    		if(!n)ckbox.disabled=true;
    	}else{
    		add_div.style.display="none";
    		if(!n)ckbox.disabled=false;
    	}
    }
    //]]>
</script>
<div class="main_start">&nbsp;</div>
<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->2. 기타 세부등록 -->

<?php
  $attributes = array('method' => 'get', 'name' => 'get_frm');
  echo form_open(current_full_url(), $attributes);
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">사업 개시년도</div>
    <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-10" style="padding: 0px;">
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
    <div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">프로젝트 선택 </div>
    <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-10" style="padding: 0px;">
        <label for="project" class="sr-only">프로젝트 선택</label>
        <select class="form-control input-sm" name="project" onchange="submit();">
          <option value="0"> 전 체</option>
<?php foreach($pj_list as $lt) : ?>
          <option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="padding: 10px; 0">설정항목 선택 </div>
    <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-10" style="padding: 0px;">
        <label for="set_sort" class="sr-only">설정항목 선택</label>
        <select class="form-control input-sm" name="set_sort" onchange="submit();">
          <option value="1" <?php if(empty($this->input->get('set_sort')) or $this->input->get('set_sort')==='1') echo "selected"; ?>>1. 분양 차수 등록</option>
          <option value="2" <?php if($this->input->get('set_sort')==='2') echo "selected"; ?>>2. 납입 회차 등록</option>
          <option value="3" <?php if($this->input->get('set_sort')==='3') echo "selected"; ?>>3. 층별 조건 등록</option>
          <option value="4" <?php if($this->input->get('set_sort')==='4') echo "selected"; ?>>4. 향별 조건 등록</option>
          <option value="5" <?php if($this->input->get('set_sort')==='5') echo "selected"; ?>>5. 조건별 분양가 등록</option>
          <option value="6" <?php if($this->input->get('set_sort')==='6') echo "selected"; ?>>6. 회차별 납입가 등록</option>
        </select>
      </div>
    </div>
  </div>
</form>
<!--||||||||||||||||||||||||||||||||||-프로젝트 /조건선택 종료-||||||||||||||||||||||||||||||||||-->
<?php
  $set_sort_url1 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&set_sort=1');
  $set_sort_url2 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&set_sort=2');
  $set_sort_url3 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&set_sort=3');
  $set_sort_url4 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&set_sort=4');
  $set_sort_url5 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&set_sort=5');
  $set_sort_url6 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&set_sort=6');
?>


<div class="row font12" style="margin: 0 0 20px;">
  <ul class="nav nav-tabs">
    <li role="presentation" class="<?php if(empty($this->input->get('set_sort')) or $this->input->get('set_sort')==='1') echo 'active'; ?>"><a href="<?php echo $set_sort_url1; ?>">분양 차수 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('set_sort')==='2') echo 'active'; ?>"><a href="<?php echo $set_sort_url2; ?>">납입 회차 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('set_sort')==='3') echo 'active'; ?>"><a href="<?php echo $set_sort_url3; ?>">층별 조건 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('set_sort')==='4') echo 'active'; ?>"><a href="<?php echo $set_sort_url4; ?>">향별 조건 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('set_sort')==='5') echo 'active'; ?>"><a href="<?php echo $set_sort_url5; ?>">조건별 분양가 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('set_sort')==='6') echo 'active'; ?>"><a href="<?php echo $set_sort_url6; ?>">회차별 납입가 등록</a></li>
  </ul>
</div>
<!--||||||||||||||||||||||||||||||||||-조건별 제목 종료-||||||||||||||||||||||||||||||||||-->

<?php if( !$this->input->get('set_sort') OR $this->input->get('set_sort')==='1') { //1. 분양 차수 등록?>

<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'set_sort_1');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'set_sort' => '1'
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-4 col-sm-2 center label-wrap">등록차수</div>
        <div class="col-xs-5 col-sm-4 center label-wrap">차수명</div>
        <div class="hidden-xs col-sm-2 center label-wrap">등록(수정)일</div>
        <div class="hidden-xs col-sm-2 center label-wrap">등록자</div>
        <div class="col-xs-3 col-sm-2 center label-wrap">&nbsp;</div>

<?php if(empty($con_diff)): ?>
        <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>
<?php endif; ?>

<?php for($a=0; $a<5; $a++): ?>
        <input type='hidden' name="<?php echo "seq_".$a; ?>" value="<?php echo $con_diff[$a]->seq; ?>">
        <div class="col-xs-12" style="padding:0; display:<?php if($a!==0 && $a>count($con_diff)) echo "none;"; ?>">
          <div class="col-xs-4 col-sm-2 center bo-top" style="padding:5px; color: #B00448;">
            <input type="text" class="form-control input-sm" name="<?php echo "diff_no_".$a; ?>" value="<?php if($this->input->post('diff_no_'.$a)) echo set_value('diff_no_'.$a); else echo $con_diff[$a]->diff_no; ?>" placeholder="등록차수">
          </div>
          <div class="col-xs-5 col-sm-4 center bo-top" style="padding:5px; color: #B00448;">
            <input type="text" class="form-control input-sm" name="<?php echo "diff_name_".$a; ?>" value="<?php if($this->input->post('diff_name_'.$a)) echo set_value('diff_name_'.$a); else echo $con_diff[$a]->diff_name; ?>" placeholder="차수명">
          </div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding-top:12px;"><?php if(isset($con_diff[$a]->reg_date)) echo $con_diff[$a]->reg_date; ?></div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding-top:12px;"><?php if(isset($con_diff[$a]->reg_worker)) echo $con_diff[$a]->reg_worker; ?></div>
          <div class="col-xs-3 col-sm-2 center bo-top" style="padding:0;"></div>
        </div>
<?php endfor; ?>
      </div>
      <div class="col-xs-12 btn-wrap" style="margin-top: 30px;">
          <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="등록하기">
          <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $set_sort_url2; ?>'" value="다음설정 >>">
      </div>
    </div>
  </fieldset>
</form>

<!--||||||||||||||||||||||||||||||||||-1. 분양 차수 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('set_sort')==='2') { //2. 납입 회차 등록 ?>

<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'set_sort_2');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'set_sort' => '2'
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 col-sm-1 center label-wrap">납부구분</div>
        <div class="hidden-xs col-sm-1 center label-wrap">회차코드</div>
        <div class="col-xs-3 col-sm-1 center label-wrap">납부순서</div>
        <div class="col-xs-4 col-sm-2 center label-wrap">회차명칭</div>
        <div class="hidden-xs col-sm-2 center label-wrap">부가설명</div>
        <div class="hidden-xs col-sm-2 center label-wrap">납부기한</div>
        <div class="hidden-xs col-sm-2 center label-wrap">등록(수정)일</div>
        <div class="col-xs-2 col-sm-1 center label-wrap">등록자</div>

<?php if(empty($pay_time)): ?>
      <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>
<?php endif; ?>

<?php for($b=0; $b<15; $b++): ?>
        <div class="col-xs-12" style="padding:0; display:<?php if($b!==0 && $b>count($pay_time)) echo "none;"; ?>">
        <input type='hidden' name="<?php echo "seq_".$b; ?>" value="<?php echo $pay_time[$b]->seq; ?>">
          <div class="col-xs-3 col-sm-1 center bo-top" style="padding-top:5px; color: #B00448;">
            <label for="<?php echo "pay_sort_".$b ?>" class="sr-only">납부구분 선택</label>
            <select class="form-control input-sm" name="<?php echo "pay_sort_".$b ?>">
              <option value="0"> 전 체</option>
              <option value="1" <?php if($this->input->post("pay_sort_".$b)) echo set_select("pay_sort_".$b, '1'); else if($pay_time[$b]->pay_sort=='1') echo "selected"; ?>>계약금</option>
              <option value="2" <?php if($this->input->post("pay_sort_".$b)) echo set_select("pay_sort_".$b, '2'); else if($pay_time[$b]->pay_sort=='2') echo "selected"; ?>>중도금</option>
              <option value="3" <?php if($this->input->post("pay_sort_".$b)) echo set_select("pay_sort_".$b, '3'); else if($pay_time[$b]->pay_sort=='3') echo "selected"; ?>>잔 금</option>
            </select>
          </div>
          <div class="hidden-xs col-sm-1 center bo-top" style="padding-top:5px; color: #B00448;">
            <input type="number" class="form-control input-sm" name="<?php echo "pay_code_".$b; ?>" value="<?php if($this->input->post("pay_code_".$b)) echo set_value("pay_code_".$b); else echo $pay_time[$b]->pay_code; ?>" placeholder="납부코드">
          </div>
          <div class="col-xs-3 col-sm-1 center bo-top" style="padding-top:5px; color: #B00448;">
            <input type="number" class="form-control input-sm" name="<?php echo "pay_time_".$b; ?>" value="<?php if($this->input->post("pay_time_".$b)) echo set_value("pay_time_".$b); else echo $pay_time[$b]->pay_time; ?>" placeholder="납부순서">
          </div>
          <div class="col-xs-4 col-sm-2 center bo-top" style="padding-top:5px; color: #B00448;">
            <input type="text" class="form-control input-sm" name="<?php echo "pay_name_".$b; ?>" value="<?php if($this->input->post("pay_name_".$b)) echo set_value("pay_name_".$b); else echo $pay_time[$b]->pay_name; ?>" placeholder="회차명칭">
          </div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding-top:5px; color: #B00448;">
            <input type="text" class="form-control input-sm" name="<?php echo "pay_disc_".$b; ?>" value="<?php if($this->input->post("pay_disc_".$b)) echo set_value("pay_disc_".$b); else echo $pay_time[$b]->pay_disc; ?>" placeholder="부가설명">
          </div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding-top:5px;">
            <div class="input-group" style="color: #B00448;">
              <input type="text" class="form-control input-sm" id="<?php echo "pay_due_date_".$b; ?>" name="<?php echo "pay_due_date_".$b; ?>" maxlength="10" value="<?php if($pay_time[$b]->pay_due_date!=='0000-00-00') echo $pay_time[$b]->pay_due_date; ?>" onClick="cal_add(this); event.cancelBubble=true" placeholder="납부기한">
              <div class="input-group-addon">
                <a href="javascript:" onclick="cal_add(document.getElementById('<?php echo "pay_due_date_".$b; ?>'),this); event.cancelBubble=true">
                  <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
                </a>
              </div>
            </div>
          </div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding:12px;"><?php echo $pay_time[$b]->reg_date; ?>&nbsp;</div>
          <div class="col-xs-2 col-sm-1 center bo-top" style="padding:12px;"><?php echo $pay_time[$b]->reg_worker; ?>&nbsp;</div>
        </div>
<?php endfor; ?>
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
          <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo $set_sort_url1; ?>'" value="<< 이전설정">
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
          <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="등록하기">
          <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $set_sort_url3; ?>'" value="다음설정 >>">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-2. 납입 회차 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('set_sort')==='3') { //3. 층별 조건 등록 ?>

<?php
echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
$attributes = array('name' => 'set_sort_3');
$hidden = array(
    'year' => $this->input->get('yr'),
    'project' => $this->input->get('project'),
    'set_sort' => '3'
);
echo form_open(current_full_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 col-sm-2 center label-wrap">층 범위(시작)</div>
        <div class="col-xs-3 col-sm-2 center label-wrap">층 범위(종료)</div>
        <div class="col-xs-4 col-sm-2 center label-wrap">층 범위 명칭</div>
        <div class="hidden-xs col-sm-2 center label-wrap">등록(수정)일</div>
        <div class="col-xs-2 col-sm-2 center label-wrap">등록자</div>
        <div class="hidden-xs col-sm-2 center label-wrap">&nbsp;</div>

<?php if(empty($con_floor)): ?>
      <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>
<?php endif; ?>

<?php
  for($c=0; $c<10; $c++):
    $fl_range = explode("-", $con_floor[$c]->floor_range);
?>
        <div class="col-xs-12" style="padding:0; display:<?php if($c!==0 && $c>count($con_floor)) echo "none;"; ?>">
        <input type='hidden' name="<?php echo "seq_".$c; ?>" value="<?php echo $con_floor[$c]->seq; ?>">
          <div class="col-xs-3 col-sm-2 center bo-top" style="padding-top:3px; color: #B00448;">
            <input type="number" class="form-control input-sm" name="<?php echo "s_range_".$c; ?>" value="<?php if($this->input->post("s_range_".$c)) echo set_value("s_range_".$c); else echo $fl_range[0]; ?>" placeholder="시작 층">
          </div>
          <div class="col-xs-3 col-sm-2 center bo-top" style="padding-top:3px; color: #B00448;">
            <input type="number" class="form-control input-sm" name="<?php echo "e_range_".$c; ?>" value="<?php if($this->input->post("e_range_".$c)) echo set_value("e_range_".$c); else echo $fl_range[1]; ?>" placeholder="종료 층">
          </div>
          <div class="col-xs-4 col-sm-2 center bo-top" style="padding-top:3px; color: #B00448;">
            <input type="text" class="form-control input-sm" name="<?php echo "floor_name_".$c; ?>" value="<?php if($this->input->post("floor_name_".$c)) echo set_value("floor_name_".$c); else echo $con_floor[$c]->floor_name; ?>" placeholder="층 범위 명">
          </div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $con_floor[$c]->reg_date; ?></div>
          <div class="col-xs-2 col-sm-2 center bo-top" style="padding:10px;"><?php echo $con_floor[$c]->reg_worker; ?></div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;">&nbsp;</div>
        </div>
  <?php endfor; ?>
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
          <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo $set_sort_url2; ?>'" value="<< 이전설정">
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
          <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="등록하기">
          <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $set_sort_url4; ?>'" value="다음설정 >>">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-3. 층별 조건 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('set_sort')==='4') { //4. 향별 조건 등록 ?>

<?php
echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
$attributes = array('name' => 'set_sort_4');
$hidden = array(
    'year' => $this->input->get('yr'),
    'project' => $this->input->get('project'),
    'set_sort' => '4'
);
echo form_open(current_full_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 center label-wrap">향별 조건코드</div>
        <div class="col-xs-3 center label-wrap">향별 조건명</div>
        <div class="col-xs-2 center label-wrap">등록(수정)일</div>
        <div class="col-xs-2 center label-wrap">등록자</div>
        <div class="col-xs-2 center label-wrap">&nbsp;</div>

  <?php if(empty($con_direction)): ?>
      <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>
  <?php endif; ?>

  <?php for($d=0; $d<15; $d++): ?>
        <div class="col-xs-12" style="padding:0; display:<?php if($d!==0 && $d>count($con_direction)) echo "none;"; ?>">
        <input type='hidden' name="<?php echo "seq_".$d; ?>" value="<?php echo $con_direction[$d]->seq; ?>">
          <div class="col-xs-3 center bo-top" style="padding-top:3px; color: #B00448;">
            <input type="text" class="form-control input-sm" name="<?php echo "dir_no_".$d; ?>" value="<?php if($this->input->post("dir_no_".$d)) echo set_value("dir_no_".$d); else echo $con_direction[$d]->dir_no; ?>" placeholder="향별 조건코드">
          </div>
          <div class="col-xs-3 center bo-top" style="padding-top:3px; color: #B00448;">
            <input type="text" class="form-control input-sm" name="<?php echo "dir_name_".$d; ?>" value="<?php if($this->input->post("dir_name_".$d)) echo set_value("dir_name_".$d); else echo $con_direction[$d]->dir_name; ?>" placeholder="향별 조건명">
          </div>
          <div class="col-xs-2 center bo-top" style="padding:10px;"><?php echo $con_direction[$d]->reg_date; ?></div>
          <div class="col-xs-2 center bo-top" style="padding:10px;"><?php echo $con_direction[$d]->reg_worker; ?></div>
          <div class="col-xs-2 center bo-top" style="padding:10px;">&nbsp;</div>
        </div>
  <?php endfor; ?>
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
          <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo $set_sort_url3; ?>'" value="<< 이전설정">
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
          <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="등록하기">
          <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $set_sort_url5; ?>'" value="다음설정 >>">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-4. 향별 조건 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('set_sort')==='5') { //5. 조건별 분양가 등록

  $attributes = array('method' => 'get', 'name' => 'get_frm');
  $hidden = array('yr' => $this->input->get('yr'), 'project' => $this->input->get('project'), 'set_sort' => '5');
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-xs-4 col-sm-3 col-md-2 center bg-info" style="padding: 10px; 0">차수구분 선택</div>
    <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-10" style="padding: 0px;">
        <label for="con_diff" class="sr-only">차수구분 선택</label>
        <select class="form-control input-sm" name="con_diff" onchange="submit();">
          <option value="">선 택</option>
<?php foreach($con_diff as $lt) : ?>
          <option value="<?php echo $lt->diff_no; ?>" <?php if($this->input->get('con_diff')==$lt->diff_no) echo "selected"; ?>><?php echo $lt->diff_name; ?></option>
<?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>
</form>
<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'set_sort_5');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'set_sort' => '5',
      'con_diff' => $this->input->get('con_diff')
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12" style="margin: 0; padding: 0;">
      <div class="col-xs-12 table-responsive" style="padding: 0;">
        <table class="table table-bordered center">
          <thead>
            <tr class="active">
<?php if($this->input->get('con_diff')): ?><th class="center">차수</th><?php endif;?>
              <th class="center">타입</th>
              <th class="center">층별 조건</th>
              <th class="center">분양(모집)가격 [단위:원]</th>
              <th class="center">해당조건 세대수</th>
              <th class="center">등록(수정)일</th>
              <th class="center">등록(수정)자</th>
            </tr>
          </thead>
          <tbody>
<?php
  $type = explode("-", $type_info->type_name);
  $k=0;
  for($i=0; $i<count($type); $i++) :
    for($j=0; $j<count($con_floor); $j++):
      for($l=0; $l<count($con_direction); $l++):

?>
            <tr>
<?php if($i==0 && $j==0): ?>
              <?php if($this->input->get('con_diff')): ?><td class="center" rowspan="<?php echo count($type)*count($con_floor); ?>" width="10%"><?php echo $diff->diff_name; ?></td><?php endif;?>
<?php endif; if($j==0): ?>
              <td style="vertical-align:middle;" rowspan="<?php echo count($con_floor); ?>"  width="10%"><?php echo $type[$i]; ?></td>
<?php endif; ?>
              <td style="vertical-align:middle;"><?php echo $con_floor[$j]->floor_name; ?></td>

              <input type="hidden" name="<?php echo "diff_no_".$k; ?>" value="<?php echo $this->input->get('con_diff'); ?>">
              <input type="hidden" name="<?php echo "type_no_".$k; ?>" value="<?php echo $i+1; ?>">
              <input type="hidden" name="<?php echo "type_".$k; ?>" value="<?php echo $type[$i]; ?>">
              <input type="hidden" name="<?php echo "dir_no_".$k; ?>" value="<?php echo $con_direction[$l]->dir_no; // 향별 실제 입력 시 추후 적용 ?>">
              <input type="hidden" name="<?php echo "fl_no_".$k; ?>" value="<?php echo $con_floor[$j]->seq; ?>">

              <td>
                <div style="color: #B00448;">
                  <input type="number" name="<?php echo "price_".$k; ?>" value="<?php if($this->input->post("price_".$k)) echo set_value("price_".$k); else echo $price[$k]->unit_price; ?>" placeholder="해당 타입 층별 가격" class="form-control input-sm">
                  <input type="hidden" name="<?php echo "price_".$k."_h"; ?>" value="<?php if( !empty($price[$k]->pr_seq)) echo "1"; else echo "0"; ?>">
                </div>
              </td>
              <td>
                <div style="color: #B00448;">
                  <input type="number" name="<?php echo "num_".$k; ?>" value="<?php if($this->input->post("num_".$k)) echo set_value("num_".$k); else echo $price[$k]->unit_num; ?>" placeholder="해당 타입 층별 세대수" class="form-control input-sm">
                </div>
              </td>
              <td style="vertical-align:middle;"><?php if($price[$k]->pr_reg_date!=='0000-00-00') echo $price[$k]->pr_reg_date; ?></td>
              <td style="vertical-align:middle;"><?php echo $price[$k]->pr_reg_worker; ?></td>
            </tr>
<?php
        $k++;
      endfor;
    endfor;
  endfor;
?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
        <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo $set_sort_url4; ?>'" value="<< 이전설정">
    </div>
    <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
        <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="등록하기">
        <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $set_sort_url6; ?>'" value="다음설정 >>">
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-5. 조건별 분양가 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('set_sort')==='6') { //6. 회차별 납입가 등록

  $attributes = array('method' => 'get', 'name' => 'get_frm');
  $hidden = array('yr' => $this->input->get('yr'), 'project' => $this->input->get('project'), 'set_sort' => '6');
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-xs-4 col-sm-3 col-md-2 center bg-info" style="padding: 10px; 0">차수구분 선택</div>
    <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-10" style="padding: 0px;">
        <label for="con_diff" class="sr-only">차수구분 선택</label>
        <select class="form-control input-sm" name="con_diff" onchange="submit();">
          <option value="">선 택</option>
<?php foreach($con_diff as $lt) : ?>
          <option value="<?php echo $lt->diff_no; ?>" <?php if($this->input->get('con_diff')==$lt->diff_no) echo "selected"; ?>><?php echo $lt->diff_name; ?></option>
<?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-xs-4 col-sm-3 col-md-2 center bg-info" style="padding: 10px; 0">회차구분 선택</div>
    <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-10" style="padding: 0px;">
        <label for="pay_sort" class="sr-only">회차구분 선택</label>
        <select class="form-control input-sm" name="pay_sort" onchange="submit();">
          <option value="">선 택</option>
          <option value="1" <?php if($this->input->get('pay_sort')=='1') echo "selected"; ?>>계약금</option>
          <option value="2" <?php if($this->input->get('pay_sort')=='2') echo "selected"; ?>>중도금</option>
          <option value="3" <?php if($this->input->get('pay_sort')=='3') echo "selected"; ?>>잔 금</option>
        </select>
      </div>
    </div>
  </div>
</form>

<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'set_sort_6');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'set_sort' => '6',
      'con_diff' => $this->input->get('con_diff'),
      'pay_sort' => $this->input->get('pay_sort')
  );
  echo form_open(current_full_url(), $attributes, $hidden);
?>
  <div class="row font12" style="margin: 0; padding: 0;">
    <div class="col-xs-12 table-responsive" style="padding: 0;">
      <table class="table table-bordered center">
        <thead>
          <tr class="active">
            <td width="5%">차수</td>
            <td width="5%">타입</td>
            <td width="8%">층별</td>
            <td width="10%">분양가</td>
<?php if(count($pay_sche)==0) : echo "<td>납부회차</td>";
else :
foreach($pay_sche as $lt) : ?>
            <td><?php if($lt->pay_disc!=='') echo $lt->pay_disc; else echo $lt->pay_name; ?></td>
<?php endforeach; endif;?>
          </tr>
        </thead>
        <tbody>
<?php
  $type = explode("-", $type_info->type_name); // 타입정보
  $total_row = count($type)*count($con_floor); // 총 행수 구하기(제목행 제외)
  $p=0; // 총 행에 대한 연번호
  for($i=0; $i<count($type); $i++) : // 타입 수만큼 반복
    for($m=0; $m<count($con_floor); $m++) : // 층별 구분수 만큼 반복

  $diff_name = empty($pr_diff[$i]->diff_name) ? "차수명" : $pr_diff[$i]->diff_name; // 차수이름 불러오기
  $diff_td = ($i===0 && $m===0) ?  "<td rowspan='".($total_row)."'>".$diff_name."</td>" : ""; // 차수명
  $type_td = (($total_row-$m)%count($con_floor)===0) ? "<td rowspan='".count($con_floor)."'>".$type[$i]."</td>" : ""; // 타입명
  $unit_price = $price[$p]->unit_price == 0 ? "-" : number_format($price[$p]->unit_price); // 분양가 정보
?>
          <tr>
            <?php echo $diff_td; // 차수명 ?>
            <?php echo $type_td; // 타입명 ?>
            <td><?php echo $con_floor[$m]->floor_name; ?></td>
            <td class="right"><?php echo $unit_price; ?></td>
<?php
  $p_seq = $price[$p]->pr_seq; // $p++ 시키기 전에 seq 미리 정의
  $p++;
  $sche_num = count($pay_sche)==0 ? 1 : count($pay_sche);
  for($j=0; $j<$sche_num; $j++) :
    if ($this->input->get('pay_sort')!=='') :
      $pmt = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_payment WHERE pj_seq='$project' AND price_seq='".$p_seq."' AND pay_sche_seq='".$pay_sche[$j]->seq."' ");
    endif;
?>
            <td style="background-color: ; padding: 3px;">
              <div style="color: #B00448;">
                <input type="number" class="form-control input-sm" name="<?php echo "pmt_".$p_seq."_".$pay_sche[$j]->seq; ?>" value="<?php if($this->input->post("pmt_".$p_seq."_".$pay_sche[$j]->seq)) echo set_value("pmt_".$p_seq."_".$pay_sche[$j]->seq); else echo $pmt->payment; ?>" placeholder="회차별 납부액">
                <input type="hidden" name="<?php echo "pmt_".$p_seq."_".$pay_sche[$j]->seq."_h"; ?>" value="<?php if( !empty($pmt->seq)) echo "1"; else echo "0"; ?>">
              </div>
            </td>
<?php endfor; ?>
          </tr>
<?php endfor; endfor; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php // endif; ?>
  <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
      <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo $set_sort_url5; ?>'" value="<< 이전설정">
  </div>
  <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
      <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="등록하기">
  </div>
</form>

<?php }; ?>
<!--||||||||||||||||||||||||||||||||||-6. 회차별 납입가 등록 종료-||||||||||||||||||||||||||||||||||-->
<?php endif ?>
