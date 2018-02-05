<?php
  if($auth12<1) :
  	include('no_auth.php');
  else :
?>
<div class="main_start">&nbsp;</div>
<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->2. 기타 세부설정 -->

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
          <option value=""> 전 체
          <option value="1" <?php if($this->input->get('reg_sort')==='1') echo "selected"; ?>>1. 분양 차수 설정</option>
          <option value="2" <?php if($this->input->get('reg_sort')==='2') echo "selected"; ?>>2. 납입 회차 설정</option>
          <option value="3" <?php if($this->input->get('reg_sort')==='3') echo "selected"; ?>>3. 층별 조건 설정</option>
          <option value="4" <?php if($this->input->get('reg_sort')==='4') echo "selected"; ?>>4. 향별 조건 설정</option>
          <option value="5" <?php if($this->input->get('reg_sort')==='5') echo "selected"; ?>>5. 조건별 분양가 설정</option>
          <option value="6" <?php if($this->input->get('reg_sort')==='6') echo "selected"; ?>>6. 회차별 납입가 설정</option>
        </select>
      </div>
    </div>
  </div>
</form>
<!--||||||||||||||||||||||||||||||||||-프로젝트 /조건선택 종료-||||||||||||||||||||||||||||||||||-->

<?php
  if( !$this->input->get('reg_sort') OR $this->input->get('reg_sort')==='1') : $sub_title = "1. 분양 차수 설정";
  elseif($this->input->get('reg_sort')==='2') :$sub_title = "2. 납입 회차 설정";
  elseif($this->input->get('reg_sort')==='3') :$sub_title = "3. 층별 조건 설정";
  elseif($this->input->get('reg_sort')==='4') :$sub_title = "4. 향별 조건 설정";
  elseif($this->input->get('reg_sort')==='5') :$sub_title = "5. 조건별 분양가 설정";
  elseif($this->input->get('reg_sort')==='6') :$sub_title = "6. 회차별 납입가 설정";
  endif;
?>

<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
  <div class="col-xs-12 font14" style="padding: 0;">
    <p class="bg-success" style="padding: 13px 30px; margin: 0;"><?php echo $sub_title; ?></p>
  </div>
</div>
<!--||||||||||||||||||||||||||||||||||-조건별 제목 종료-||||||||||||||||||||||||||||||||||-->

<?php if( !$this->input->get('reg_sort') OR $this->input->get('reg_sort')==='1') { //1. 분양 차수 설정?>

<?php echo form_open(current_url()); ?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 center label-wrap" style="padding:10px;">등록차수</div>
        <div class="col-xs-5 col-sm-3 center label-wrap" style="padding:10px;">차수명</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">등록일</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">등록자</div>
        <div class="col-xs-2 col-sm-2 center label-wrap" style="padding:10px;">수정</div>
    <?php if(empty($con_diff)): ?>

        <div class="col-xs-3 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->diff_no; ?>" placeholder="등록차수"></div>
        <div class="col-xs-5 col-sm-3 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->diff_name; ?>" placeholder="차수명"></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo date('Y-m-d'); ?></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $this->session->userdata('mem_username'); ?></div>
        <div class="col-xs-2 col-sm-2 center bo-top" style="padding:10px;">수정</div>

        <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>

    <?php else: foreach($con_diff as $lt) : ?>
        <div class="col-xs-3 center bo-top" style="padding:10px;"><?php echo $lt->diff_no; ?></div>
        <div class="col-xs-5 col-sm-3 center bo-top" style="padding-top:3px;">
          <input type='text' class="form-control input-sm" value="<?php echo $lt->diff_name; ?>" placeholder="차수명">
        </div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $lt->reg_date; ?></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $lt->reg_worker; ?></div>
        <div class="col-xs-2 col-sm-2 center bo-top" style="padding:10px;">수정</div>
    <?php endforeach; endif; ?>

      </div>
      <div class="col-xs-12 btn-wrap" style="margin-top: 30px;">
        <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="추가하기">
      </div>
    </div>
  </fieldset>
</form>

<!--||||||||||||||||||||||||||||||||||-1. 분양 차수 설정 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='2') { //2. 납입 회차 설정 ?>

<?php echo form_open(current_url()); ?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 col-sm-2 center label-wrap" style="padding:10px;">구분</div>
        <div class="hidden-xs col-sm-1 center label-wrap" style="padding:10px;">코드</div>
        <div class="col-xs-3 col-sm-1 center label-wrap" style="padding:10px;">납부순서</div>
        <div class="col-xs-4 col-sm-2 center label-wrap" style="padding:10px;">회차명칭</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">설명</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">납부기한</div>
        <div class="col-xs-2 col-sm-2 center label-wrap" style="padding:10px;">수정</div>
    <?php if(empty($pay_time)): ?>
        <div class="col-xs-3 col-sm-2 center" style="padding-top:3px;">
            <label for="pay_sort" class="sr-only">납부구분 선택</label>
            <select class="form-control input-sm" name="pay_sort">
                <option value="0"> 전 체</option>
                <option value="1" <?php if($lt->pay_sort=='1') echo "selected"; ?>>계약금</option>
                <option value="2" <?php if($lt->pay_sort=='2') echo "selected"; ?>>중도금</option>
                <option value="3" <?php if($lt->pay_sort=='3') echo "selected"; ?>>잔 금</option>
            </select>
        </div>
      <div class="hidden-xs col-sm-1 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="납부코드"></div>
      <div class="col-xs-3 col-sm-1 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="납부순서"></div>
      <div class="col-xs-4 col-sm-2 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="회차명칭"></div>
      <div class="hidden-xs col-sm-2 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="부가설명"></div>
      <div class="hidden-xs col-sm-2 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="납부기한"></div>
      <div class="col-xs-2 col-sm-2 center" style="padding:10px;">수정</div>
        <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>

    <?php else: foreach($pay_time as $lt) : ?>
        <div class="col-xs-3 col-sm-2 center" style="padding-top:3px;">
          <label for="pay_sort" class="sr-only">납부구분 선택</label>
          <select class="form-control input-sm" name="pay_sort">
            <option value="0"> 전 체</option>
            <option value="1" <?php if($lt->pay_sort=='1') echo "selected"; ?>>계약금</option>
            <option value="2" <?php if($lt->pay_sort=='2') echo "selected"; ?>>중도금</option>
            <option value="3" <?php if($lt->pay_sort=='3') echo "selected"; ?>>잔 금</option>
          </select>
        </div>
        <div class="hidden-xs col-sm-1 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->pay_code; ?>" placeholder="납부코드"></div>
        <div class="col-xs-3 col-sm-1 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->pay_time; ?>" placeholder="납부순서"></div>
        <div class="col-xs-4 col-sm-2 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->pay_name; ?>" placeholder="회차명칭"></div>
        <div class="hidden-xs col-sm-2 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->pay_disc; ?>" placeholder="부가설명"></div>
        <div class="hidden-xs col-sm-2 center" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->due_date; ?>" placeholder="납부기한"></div>
        <div class="col-xs-2 col-sm-2 center" style="padding:10px;">수정</div>
    <?php endforeach; endif; ?>

      </div>
      <div class="col-xs-12 btn-wrap" style="margin-top: 30px;">
        <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="추가하기">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-2. 납입 회차 설정 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='3') { //3. 층별 조건 설정 ?>

<?php echo form_open(current_url()); ?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-4 col-sm-2 center label-wrap" style="padding:10px;">층 범위(시작)</div>
        <div class="col-xs-4 col-sm-2 center label-wrap" style="padding:10px;">층 범위(종료)</div>
        <div class="col-xs-4 col-sm-2 center label-wrap" style="padding:10px;">층 범위 명칭</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">등록(수정)일</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">(변경)등록자</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">&nbsp;</div>
    <?php if(empty($con_floor)): ?>

        <div class="col-xs-4 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="시작 층"></div>
        <div class="col-xs-4 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="종료 층"></div>
        <div class="col-xs-4 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="층 범위 명"></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo date('Y-m-d'); ?></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $this->session->userdata('mem_username'); ?></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;">&nbsp;</div>
        <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>

    <?php else: foreach($con_floor as $lt) :
        $fl_range = explode("-", $lt->floor_range);
    ?>
        <div class="col-xs-3 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $fl_range[0]; ?>" placeholder="시작 층"></div>
        <div class="col-xs-3 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $fl_range[1]; ?>" placeholder="종료 층"></div>
        <div class="col-xs-4 col-sm-2 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->floor_name; ?>" placeholder="층 범위 명"></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $lt->reg_date; ?></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $lt->reg_worker; ?></div>
        <div class="col-xs-2 center bo-top" style="padding:10px;">asdfasdf</div>
    <?php endforeach; endif; ?>

      </div>
      <div class="col-xs-12 btn-wrap" style="margin-top: 30px;">
        <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="추가하기">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-3. 층별 조건 설정 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='4') { //4. 향별 조건 설정 ?>

<?php echo form_open(current_url()); ?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-4 center label-wrap" style="padding:10px;">향별 조건명</div>
        <div class="col-xs-2 center label-wrap" style="padding:10px;">등록일</div>
        <div class="col-xs-2 center label-wrap" style="padding:10px;">등록자</div>
        <div class="col-xs-2 center label-wrap" style="padding:10px;">수정</div>
        <div class="col-xs-2 center label-wrap" style="padding:10px;">삭제</div>
    <?php if(empty($con_direction)): ?>

        <div class="col-xs-4 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="" placeholder="향별 조건명"></div>
        <div class="col-xs-2 center bo-top" style="padding:10px;"><?php echo date('Y-m-d'); ?></div>
        <div class="col-xs-2 center bo-top" style="padding:10px;"><?php echo $this->session->userdata('mem_username'); ?></div>
        <div class="col-xs-2 center bo-top" style="padding:10px;">수정</div>
        <div class="col-xs-2 center bo-top" style="padding:10px;">삭제</div>
        <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>

    <?php else: foreach($con_direction as $lt) : ?>
        <div class="col-xs-4 center bo-top" style="padding-top:3px;"><input type='text' class="form-control input-sm" value="<?php echo $lt->diff_name; ?>" placeholder="차수명"></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $lt->reg_date; ?></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $lt->reg_worker; ?></div>
        <div class="col-xs-2 col-sm-1 center bo-top" style="padding:10px;">수정</div>
        <div class="col-xs-2 col-sm-1 center bo-top" style="padding:10px;">삭제</div>
    <?php endforeach; endif; ?>

      </div>
      <div class="col-xs-12 btn-wrap" style="margin-top: 30px;">
        <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="추가하기">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-4. 향별 조건 설정 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='5') { //5. 조건별 분양가 설정 ?>

<?php echo form_open(current_url()); ?>
  <fieldset>
    <div class="row font12 form-group" style="margin: 0 0 50px;">
      <div class="col-xs-12 col-md-8 bo-top bo-bottom" style="padding:0;">
        <div class="col-xs-3 center label-wrap" style="padding:10px;">등록차수</div>
        <div class="col-xs-5 col-sm-3 center label-wrap" style="padding:10px;">차수명</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">등록일</div>
        <div class="hidden-xs col-sm-2 center label-wrap" style="padding:10px;">등록자</div>
        <div class="col-xs-2 col-sm-1 center label-wrap" style="padding:10px;">수정</div>
        <div class="col-xs-2 col-sm-1 center label-wrap" style="padding:10px;">삭제</div>
    <?php if(empty($con_diff)): ?>

        <div class="col-xs-12 center bo-top" style="padding:60px;">등록된 데이터가 없습니다.</div>

    <?php else: foreach($con_diff as $lt) : ?>
        <div class="col-xs-3 center bo-top" style="padding:10px;"><?php echo $lt->diff_no; ?></div>
        <div class="col-xs-5 col-sm-3 center bo-top" style="padding-top:3px;">
          <input type='text' class="form-control input-sm" value="<?php echo $lt->diff_name; ?>" placeholder="차수명">
        </div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $lt->reg_date; ?></div>
        <div class="hidden-xs col-sm-2 center bo-top" style="padding:10px;"><?php echo $lt->reg_worker; ?></div>
        <div class="col-xs-2 col-sm-1 center bo-top" style="padding:10px;">수정</div>
        <div class="col-xs-2 col-sm-1 center bo-top" style="padding:10px;">삭제</div>
    <?php endforeach; endif; ?>

      </div>
      <div class="col-xs-12 col-md-8 btn-wrap" style="margin-top: 30px;">
        <div class="col-xs-3 center" style="padding-top:3px;">
          <input type='text' class="form-control input-sm" value="" placeholder="등록차수">
        </div>
        <div class="col-xs-3 center" style="padding-top:3px;">
          <input type='text' class="form-control input-sm" value="" placeholder="차수명">
        </div>
        <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="추가하기">
      </div>
    </div>
  </fieldset>
</form>
<!--||||||||||||||||||||||||||||||||||-5. 조건별 분양가 설정 종료-||||||||||||||||||||||||||||||||||-->

<?php }elseif($this->input->get('reg_sort')==='6') { //6. 회차별 납입가 설정

  $attributes = array('method' => 'get', 'name' => 'get_frm');
  echo form_open(current_url(), $attributes);
?>
  <input type="hidden" name="yr" value="<?php echo $this->input->get('yr'); ?>">
  <input type="hidden" name="project" value="<?php echo $this->input->get('project'); ?>">
  <input type="hidden" name="reg_sort" value="<?php echo $this->input->get('reg_sort'); ?>">

  <div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">차수구분 선택</div>
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
    <div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">회차구분 선택</div>
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
if( !$this->input->get('con_diff') OR  !$this->input->get('pay_sort'))  :
  if( !$this->input->get('con_diff')) :  $msg = "차수구분을 선택하여 주십시요.";
  elseif( !$this->input->get('pay_sort')) :  $msg = "회차구분을 선택하여 주십시요.";
endif;
?>
<div class="row font12" style="margin: 0; padding: 0;">
  <div class="col-xs-12 center" style="padding: 180px 0;"><?php echo $msg; ?></div>
</div>
<?php else :
  echo form_open(current_url());
?>
  <div class="row font12" style="margin: 0; padding: 0;">
    <div class="col-xs-12 table-responsive" style="padding: 0;">
      <table class="table table-bordered center">
        <thead>
          <tr class="active">
            <td width="3%">No.</td>
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
              <div style="color: #B00447;"><?php echo form_error("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq); ?>
                <input type="text" name="<?php echo "pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq; ?>" value="<?php if( !empty($pmt)) echo $pmt->payment; else echo set_value("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq) ?>" size="15" placeholder="회차별 납부액">
                <input type="hidden" name="<?php echo "pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq."_h"; ?>" value="<?php if( !empty($pmt)) echo "1"; else "0"; ?>">
              </div>
            </td>
<?php endfor; ?>
          </tr>
<?php endfor; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php endif; ?>
<?php if($auth12<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="if(confirm('납입금 내역을 등록하시겠습니까?')===true) submit();";} ?>
  <div class="form-group btn-wrap" style="margin: ;">
    <input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str?>" value="등록 하기">
  </div>
</form>

<?php }; ?>
<!--||||||||||||||||||||||||||||||||||-6. 회차별 납입가 설정 종료-||||||||||||||||||||||||||||||||||-->
<?php endif ?>
