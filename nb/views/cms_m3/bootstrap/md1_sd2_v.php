<?php
  if($auth12<1) :
  	include('no_auth.php');
  else :
    switch ($this->input->get('reg_sort')) {
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
  echo form_open(current_url(), $attributes);
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
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
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">프로젝트 선택 </div>
    <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-10" style="padding: 0px;">
        <label for="project" class="sr-only">프로젝트 선택</label>
        <select class="form-control input-sm" name="project" onchange="submit();">
          <option value="0"> 전 체</option>
<?php foreach($all_pj as $lt) : ?>
          <option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">설정항목 선택 </div>
    <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
      <div class="col-xs-12 col-sm-10" style="padding: 0px;">
        <label for="reg_sort" class="sr-only">설정항목 선택</label>
        <select class="form-control input-sm" name="reg_sort" onchange="submit();">
          <option value="1" <?php if(empty($this->input->get('reg_sort')) or $this->input->get('reg_sort')==='1') echo "selected"; ?>>1. 분양 차수 등록</option>
          <option value="2" <?php if($this->input->get('reg_sort')==='2') echo "selected"; ?>>2. 납입 회차 등록</option>
          <option value="3" <?php if($this->input->get('reg_sort')==='3') echo "selected"; ?>>3. 층별 조건 등록</option>
          <option value="4" <?php if($this->input->get('reg_sort')==='4') echo "selected"; ?>>4. 향별 조건 등록</option>
          <option value="5" <?php if($this->input->get('reg_sort')==='5') echo "selected"; ?>>5. 조건별 분양가 등록</option>
          <option value="6" <?php if($this->input->get('reg_sort')==='6') echo "selected"; ?>>6. 회차별 납입가 등록</option>
        </select>
      </div>
    </div>
  </div>
</form>
<!--||||||||||||||||||||||||||||||||||-프로젝트 /조건선택 종료-||||||||||||||||||||||||||||||||||-->
<?php
  $reg_sort_url1 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&reg_sort=1');
  $reg_sort_url2 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&reg_sort=2');
  $reg_sort_url3 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&reg_sort=3');
  $reg_sort_url4 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&reg_sort=4');
  $reg_sort_url5 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&reg_sort=5');
  $reg_sort_url6 = htmlspecialchars(base_url('cms_m3/project/1/2').'?yr='.$this->input->get('yr').'&project='.$project.'&reg_sort=6');
?>


<div class="row font12" style="margin: 0 0 20px;">
  <ul class="nav nav-tabs">
    <li role="presentation" class="<?php if(empty($this->input->get('reg_sort')) or $this->input->get('reg_sort')==='1') echo 'active'; ?>"><a href="<?php echo $reg_sort_url1; ?>">분양 차수 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('reg_sort')==='2') echo 'active'; ?>"><a href="<?php echo $reg_sort_url2; ?>">납입 회차 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('reg_sort')==='3') echo 'active'; ?>"><a href="<?php echo $reg_sort_url3; ?>">층별 조건 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('reg_sort')==='4') echo 'active'; ?>"><a href="<?php echo $reg_sort_url4; ?>">향별 조건 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('reg_sort')==='5') echo 'active'; ?>"><a href="<?php echo $reg_sort_url5; ?>">조건별 분양가 등록</a></li>
    <li role="presentation" class="<?php if($this->input->get('reg_sort')==='6') echo 'active'; ?>"><a href="<?php echo $reg_sort_url6; ?>">회차별 납입가 등록</a></li>
  </ul>
</div>
<!--||||||||||||||||||||||||||||||||||-조건별 제목 종료-||||||||||||||||||||||||||||||||||-->

<?php if( !$this->input->get('reg_sort') OR $this->input->get('reg_sort')==='1') { //1. 분양 차수 등록?>

<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'reg_sort_1');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'reg_sort' => '1'
  );
  echo form_open(current_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-4 col-sm-2 center label-wrap" style="padding:10px;">등록차수</div>
        <div class="col-xs-5 col-sm-4 center label-wrap" style="padding:10px;">차수명</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">등록(수정)일</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">등록자</div>
        <div class="col-xs-3 col-sm-2 center label-wrap" style="padding:10px;">&nbsp;</div>

<?php if(empty($con_diff)): ?>
        <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>
<?php endif; ?>

<?php for($a=0; $a<5; $a++): ?>
        <input type='hidden' name="<?php echo "seq_".$a; ?>" value="<?php echo $con_diff[$a]->seq; ?>">
        <div class="col-xs-12" style="padding:0; display:<?php if($a!==0 && $a>count($con_diff)) echo "none;"; ?>">
          <div class="col-xs-4 col-sm-2 center bo-top" style="padding:5px;">
            <input type='text' class="form-control input-sm" name="<?php echo "diff_no_".$a; ?>" value="<?php if($this->input->post('diff_no_'.$a)) echo set_value('diff_no_'.$a); else echo $con_diff[$a]->diff_no; ?>" placeholder="등록차수">
          </div>
          <div class="col-xs-5 col-sm-4 center bo-top" style="padding:5px;">
            <input type='text' class="form-control input-sm" name="<?php echo "diff_name_".$a; ?>" value="<?php if($this->input->post('diff_name_'.$a)) echo set_value('diff_name_'.$a); else echo $con_diff[$a]->diff_name; ?>" placeholder="차수명">
          </div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding-top:12px;"><?php if(isset($con_diff[$a]->reg_date)) echo $con_diff[$a]->reg_date; ?></div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding-top:12px;"><?php if(isset($con_diff[$a]->reg_worker)) echo $con_diff[$a]->reg_worker; ?></div>
          <div class="col-xs-3 col-sm-2 center bo-top" style="padding:0;"></div>
        </div>
<?php endfor; ?>
      </div>
      <div class="col-xs-12 btn-wrap" style="margin-top: 30px;">
          <button type="submit" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>">등록하기</button>
          <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $reg_sort_url2; ?>'" value="다음설정 >>">
      </div>
    </div>
  </fieldset>
</form>

<!--||||||||||||||||||||||||||||||||||-1. 분양 차수 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='2') { //2. 납입 회차 등록 ?>

<?php
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'reg_sort_2');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'reg_sort' => '2'
  );
  echo form_open(current_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 col-sm-2 center label-wrap" style="padding:10px;">구분</div>
        <div class="hidden-xs col-sm-1 center label-wrap" style="padding:10px;">코드</div>
        <div class="col-xs-3 col-sm-1 center label-wrap" style="padding:10px;">납부순서</div>
        <div class="col-xs-4 col-sm-2 center label-wrap" style="padding:10px;">회차명칭</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">설명</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">납부기한</div>
        <div class="hidden-xs col-sm-1 center label-wrap" style="padding:10px;">등록(수정)일</div>
        <div class="col-xs-2 col-sm-1 center label-wrap" style="padding:10px;">등록자</div>

<?php if(empty($pay_time)): ?>
      <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>
<?php endif; ?>

<?php for($b=0; $b<15; $b++): ?>
        <div class="col-xs-12" style="padding:0; display:<?php if($b!==0 && $b>count($pay_time)) echo "none;"; ?>">
        <input type='hidden' name="<?php echo "seq_".$b; ?>" value="<?php echo $pay_time[$b]->seq; ?>">
          <div class="col-xs-3 col-sm-2 center bo-top" style="padding-top:5px;">
            <label for="<?php echo "pay_sort_".$b ?>" class="sr-only">납부구분 선택</label>
            <select class="form-control input-sm" name="<?php echo "pay_sort_".$b ?>">
              <option value="0"> 전 체</option>
              <option value="1" <?php if($pay_time[$b]->pay_sort=='1') echo "selected"; ?>>계약금</option>
              <option value="2" <?php if($pay_time[$b]->pay_sort=='2') echo "selected"; ?>>중도금</option>
              <option value="3" <?php if($pay_time[$b]->pay_sort=='3') echo "selected"; ?>>잔 금</option>
            </select>
          </div>
          <div class="hidden-xs col-sm-1 center bo-top" style="padding-top:5px;"><input type='text' class="form-control input-sm" name="<?php echo "pay_code_".$b ?>" value="<?php echo $pay_time[$b]->pay_code; ?>" placeholder="납부코드"></div>
          <div class="col-xs-3 col-sm-1 center bo-top" style="padding-top:5px;"><input type='text' class="form-control input-sm" name="<?php echo "pay_time_".$b ?>" value="<?php echo $pay_time[$b]->pay_time; ?>" placeholder="납부순서"></div>
          <div class="col-xs-4 col-sm-2 center bo-top" style="padding-top:5px;"><input type='text' class="form-control input-sm" name="<?php echo "pay_name_".$b ?>" value="<?php echo $pay_time[$b]->pay_name; ?>" placeholder="회차명칭"></div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding-top:5px;"><input type='text' class="form-control input-sm" name="<?php echo "pay_disc_".$b ?>" value="<?php echo $pay_time[$b]->pay_disc; ?>" placeholder="부가설명"></div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding-top:5px;">
            <!-- <input type='text' class="form-control input-sm" name="<?php echo "pay_due_date_".$b; ?>" value="<?php if($pay_time[$b]->pay_due_date!=='0000-00-00') echo $pay_time[$b]->pay_due_date; ?>" placeholder="납부기한"> -->
            <div class="input-group">
              <input type="text" class="form-control input-sm" id="<?php echo "pay_due_date_".$b; ?>" name="<?php echo "pay_due_date_".$b; ?>" maxlength="10" value="<?php if($pay_time[$b]->pay_due_date!=='0000-00-00') echo $pay_time[$b]->pay_due_date; ?>" onClick="cal_add(this); event.cancelBubble=true" placeholder="납부기한">
              <div class="input-group-addon">
                <a href="javascript:" onclick="cal_add(document.getElementById('<?php echo "pay_due_date_".$b; ?>'),this); event.cancelBubble=true">
                  <span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
                </a>
              </div>
            </div>
          </div>
          <div class="hidden-xs col-sm-1 center bo-top" style="padding:12px;"><?php echo $pay_time[$b]->reg_date; ?>&nbsp;</div>
          <div class="col-xs-2 col-sm-1 center bo-top" style="padding:12px;"><?php echo $pay_time[$b]->reg_worker; ?>&nbsp;</div>
        </div>
<?php endfor; ?>
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
          <input type="button" class="btn btn-default btn-sm" onclick="location.href='<?php echo $reg_sort_url1; ?>'" value="<< 이전설정">
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
          <button type="submit" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>">등록하기</button>
          <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $reg_sort_url3; ?>'" value="다음설정 >>">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-2. 납입 회차 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='3') { //3. 층별 조건 등록 ?>

<?php
echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
$attributes = array('name' => 'reg_sort_3');
$hidden = array(
    'year' => $this->input->get('yr'),
    'project' => $this->input->get('project'),
    'reg_sort' => '3'
);
echo form_open(current_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 col-sm-2 center label-wrap" style="padding:10px;">층 범위(시작)</div>
        <div class="col-xs-3 col-sm-2 center label-wrap" style="padding:10px;">층 범위(종료)</div>
        <div class="col-xs-4 col-sm-2 center label-wrap" style="padding:10px;">층 범위 명칭</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">등록(수정)일</div>
        <div class="col-xs-2 col-sm-2 center label-wrap" style="padding:10px;">등록자</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">&nbsp;</div>

<?php if(empty($con_floor)): ?>
      <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>
<?php endif; ?>

<?php
  for($c=0; $c<15; $c++):
    $fl_range = explode("-", $con_floor[$c]->floor_range);
?>
        <div class="col-xs-12" style="padding:0; display:<?php if($c!==0 && $c>count($con_floor)) echo "none;"; ?>">
        <input type='hidden' name="<?php echo "seq_".$c; ?>" value="<?php echo $con_floor[$c]->seq; ?>">
          <div class="col-xs-3 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" name="<?php echo "s_range_".$c; ?>" value="<?php echo $fl_range[0]; ?>" placeholder="시작 층"></div>
          <div class="col-xs-3 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" name="<?php echo "e_range_".$c; ?>" value="<?php echo $fl_range[1]; ?>" placeholder="종료 층"></div>
          <div class="col-xs-4 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" name="<?php echo "floor_name_".$c; ?>" value="<?php echo $con_floor[$c]->floor_name; ?>" placeholder="층 범위 명"></div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $con_floor[$c]->reg_date; ?></div>
          <div class="col-xs-2 col-sm-2 center bo-top" style="padding:10px;"><?php echo $con_floor[$c]->reg_worker; ?></div>
          <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;">&nbsp;</div>
        </div>
  <?php endfor; ?>
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
          <input type="button" class="btn btn-default btn-sm" onclick="location.href='<?php echo $reg_sort_url2; ?>'" value="<< 이전설정">
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
          <button type="submit" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>">등록하기</button>
          <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $reg_sort_url4; ?>'" value="다음설정 >>">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-3. 층별 조건 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='4') { //4. 향별 조건 등록 ?>

<?php
echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
$attributes = array('name' => 'reg_sort_4');
$hidden = array(
    'year' => $this->input->get('yr'),
    'project' => $this->input->get('project'),
    'reg_sort' => '4'
);
echo form_open(current_url(), $attributes, $hidden);
?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 center label-wrap" style="padding:10px;">향별 조건코드</div>
        <div class="col-xs-3 center label-wrap" style="padding:10px;">향별 조건명</div>
        <div class="col-xs-2 center label-wrap" style="padding:10px;">등록(수정)일</div>
        <div class="col-xs-2 center label-wrap" style="padding:10px;">등록자</div>
        <div class="col-xs-2 center label-wrap" style="padding:10px;">&nbsp;</div>

  <?php if(empty($con_direction)): ?>
      <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>
  <?php endif; ?>

  <?php for($d=0; $d<15; $d++): ?>
        <div class="col-xs-12" style="padding:0; display:<?php if($d!==0 && $d>count($con_direction)) echo "none;"; ?>">
        <input type='hidden' name="<?php echo "seq_".$d; ?>" value="<?php echo $con_direction[$d]->seq; ?>">
          <div class="col-xs-3 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" name="<?php echo "dir_no_".$d; ?>" value="<?php echo $con_direction[$d]->dir_no; ?>" placeholder="향별 조건코드"></div>
          <div class="col-xs-3 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" name="<?php echo "dir_name_".$d; ?>" value="<?php echo $con_direction[$d]->dir_name; ?>" placeholder="향별 조건명"></div>
          <div class="col-xs-2 center bo-top" style="padding:10px;"><?php echo $con_direction[$d]->reg_date; ?></div>
          <div class="col-xs-2 center bo-top" style="padding:10px;"><?php echo $con_direction[$d]->reg_worker; ?></div>
          <div class="col-xs-2 center bo-top" style="padding:10px;">&nbsp;</div>
        </div>
  <?php endfor; ?>
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
          <input type="button" class="btn btn-default btn-sm" onclick="location.href='<?php echo $reg_sort_url3; ?>'" value="<< 이전설정">
      </div>
      <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
          <button type="submit" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>">등록하기</button>
          <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $reg_sort_url5; ?>'" value="다음설정 >>">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-4. 향별 조건 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='5') { //5. 조건별 분양가 등록

  $attributes = array('method' => 'get', 'name' => 'get_frm');
  $hidden = array('yr' => $this->input->get('yr'), 'project' => $this->input->get('project'), 'reg_sort' => '5');
  echo form_open(current_url(), $attributes, $hidden);
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub1" style="padding: 10px; 0">차수구분 선택</div>
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
  $attributes = array('name' => 'reg_sort_5');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'reg_sort' => '5',
      'con_diff' => $this->input->get('con_diff')
  );
  echo form_open(current_url(), $attributes, $hidden);
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
              <th class="center">분양(모집)가격</th>
              <th class="center">조건해당 세대수</th>
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
                <div style="color: #B00448;"><?php echo form_error("price_".$k); ?>
                  <input type="text" name="<?php echo "price_".$k; ?>" class="form-control input-sm" value="<?php echo $price[$k]->unit_price; ?>" placeholder="해당 타입 층별 가격">
                  <input type="hidden" name="<?php echo "price_".$k."_h"; ?>" value="<?php if( !empty($price[$k]->pr_seq)) echo "1"; else echo "0"; ?>">
                </div>
              </td>
              <td>
                <div style="color: #B00448;"><?php echo form_error("num_".$k); ?>
                  <input type="text" name="<?php echo "num_".$k; ?>" class="form-control input-sm" value="<?php echo $price[$k]->unit_num; ?>" placeholder="해당 타입 층별 세대수">
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
        <input type="button" class="btn btn-default btn-sm" onclick="location.href='<?php echo $reg_sort_url4; ?>'" value="<< 이전설정">
    </div>
    <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
        <button type="submit" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>">등록하기</button>
        <input type="button" class="btn btn-info btn-sm" onclick="location.href='<?php echo $reg_sort_url6; ?>'" value="다음설정 >>">
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-5. 조건별 분양가 등록 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='6') { //6. 회차별 납입가 등록

  $attributes = array('method' => 'get', 'name' => 'get_frm');
  $hidden = array('yr' => $this->input->get('yr'), 'project' => $this->input->get('project'), 'reg_sort' => '6');
  echo form_open(current_url(), $attributes, $hidden);
?>
  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub1" style="padding: 10px; 0">차수구분 선택</div>
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
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub1" style="padding: 10px; 0">회차구분 선택</div>
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
// if( !$this->input->get('con_diff') OR !$this->input->get('pay_sort'))  :
  // if( !$this->input->get('con_diff')) :  $msg = "차수구분을 선택하여 주십시요.";
  // elseif( !$this->input->get('pay_sort')) :  $msg = "회차구분을 선택하여 주십시요.";
  // endif;
?>
<!-- <div class="row font12" style="margin: 0; padding: 0;">
  <div class="col-xs-12 center" style="padding: 180px 0;"><?php echo $msg; ?></div>
</div> -->

<?php // else :
  echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
  $attributes = array('name' => 'reg_sort_6');
  $hidden = array(
      'year' => $this->input->get('yr'),
      'project' => $this->input->get('project'),
      'reg_sort' => '6'
  );
  echo form_open(current_url(), $attributes, $hidden);
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
<?php foreach($pay_sche as $lt) :  ?>
            <td><?php if($lt->pay_disc!=='') echo $lt->pay_disc; else echo $lt->pay_name; ?></td>
<?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
<?php for($i=0; $i<count($price); $i++) :
  $diff_td = ($i===0) ?  "<td rowspan='".($pr_row)."'>".$pr_diff[$i]->diff_name."</td>" : ""; // 차수명
  $type_td = (($pr_row-$i)%$pr_floor[0]->num_floor===0) ? "<td rowspan='".$pr_floor[0]->num_floor."'>".$price[$i]->con_type."</td>" : ""; // 타입명
?>
          <tr>
            <?php echo $diff_td; ?>
            <?php echo $type_td; ?>
            <td><?php echo $price[$i]->floor_name; ?></td>
            <td class="right"><?php echo number_format($price[$i]->unit_price); ?></td>
<?php
  for($j=0; $j<count($pay_sche); $j++) :
  $pmt = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_payment WHERE pj_seq='$project' AND price_seq='".$price[$i]->pr_seq."' AND pay_sche_seq='".$pay_sche[$j]->seq."' ");
?>
            <td style="background-color: ; padding: 3px;">
              <div style="color: #B00448;"><?php echo form_error("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq); ?>
                <input type="text" name="<?php echo "pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq; ?>" value="<?php if( !empty($pmt)) echo $pmt->payment; else echo set_value("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq) ?>" placeholder="회차별 납부액" class="form-control input-sm">
                <input type="hidden" name="<?php echo "pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq."_h"; ?>" value="<?php if( !empty($pmt)) echo "1"; else echo "0"; ?>">
              </div>
            </td>
<?php endfor; ?>
          </tr>
<?php endfor; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php // endif; ?>
  <div class="col-xs-6 btn-wrap" style="margin-top: 30px; text-align:left; padding-left:20px;">
      <input type="button" class="btn btn-default btn-sm" onclick="location.href='<?php echo $reg_sort_url5; ?>'" value="<< 이전설정">
  </div>
  <div class="col-xs-6 btn-wrap" style="margin-top: 30px;">
      <button type="submit" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>">등록하기</button>
  </div>
</form>

<?php }; ?>
<!--||||||||||||||||||||||||||||||||||-6. 회차별 납입가 등록 종료-||||||||||||||||||||||||||||||||||-->
<?php endif ?>
