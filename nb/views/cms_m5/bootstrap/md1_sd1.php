<?php
if ( $auth11 < 1 ) :
    include ('no_auth.php');
else :
    ?>
    <div class="main_start">&nbsp;</div>
    <!-- 5. 환경설정 -> 1. 기본정보관리 ->1. 부서 정보 관리 페이지 -->

    <?php if ( !$this->input->get ( 'ss_di' ) or $this->input->get ( 'ss_di' ) == 1 ) : ?>
    <div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
        <!-- <form name="list_frm" method="get" action=""> -->
        <?php
        $attributes = array('method' => 'get', 'name' => 'list_frm');
        echo form_open ( current_full_url (), $attributes );
        ?>

        <div class="col-xs-4 col-md-2 center bg-info" style="height: 40px; line-height: 40px;">회사 정보</div>
        <div class="col-xs-8 col-md-2" style="height: 40px; line-height: 40px;">
            <div class="col-xs-12" style="padding: 0;">
                <select class="form-control input-sm" name="com_sel" onchange="submit();">
                    <option value='0'>선 택</option>
                    <?php foreach ($com_list as $lt) : ?>
                        <option value="<?php echo $lt->seq; ?>" <? if ( $lt->seq == $this->input->get ( 'com_sel' ) ) echo "selected"; ?>><?php echo $lt->co_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-xs-4 col-md-2 bg-success center" style="height: 40px; line-height: 40px;">부서 정보</div>
        <div class="col-xs-8 col-sm-3 col-md-2" style="height: 40px; line-height: 40px;">
            <div class="col-xs-12" style="padding: 0;">
                <select class="form-control input-sm" name="div_sel"
                        onchange="submit();" <?php if ( !$this->input->get ( 'com_sel' ) ) echo 'disabled' ?>>
                    <option value=''>전 체</option>
                    <?php foreach ($all_div as $lt) : ?>
                        <option value="<?php echo $lt->div_code; ?>" <? if ( $lt->div_code == $this->input->get ( 'div_sel' ) ) echo "selected"; ?>><?php echo $lt->div_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-3" style="height: 40px; padding-top: 5px;">
            <input type="text" class="form-control input-sm" name="div_search" placeholder="부서 검색"
                   value="<?php if ( $this->input->get ( 'div_search' ) ) echo $this->input->get ( 'div_search' ); ?>"
                   onkeydown="if(event.keyCode==13)submit();">
        </div>
        <div class="col-xs-12 col-sm-1 col-md-1 right"
             style="background-color: #F4F4F4; height: 40px; line-height: 40px;">
            <button class="btn btn-primary btn-sm"> 검 색</button>
        </div>
        </form>
    </div>

    <div class="row">
        <div class="col-xs-12" style="<?php if ( !$this->agent->is_mobile () ) echo 'height: 420px;'; ?>">
            <div class="row table-responsive" style="margin: 0;">
                <table class="table table-bordered table-condensed table-hover font12">
                    <thead style="background-color: #F2F2F9;">
                    <tr>
                        <th class="col-md-1 center"><input type="checkbox"></th>
                        <th class="col-md-2 center bo-left">회사명</th>
                        <th class="col-md-1 center bo-left">부서코드</th>
                        <th class="col-md-2 center bo-left">부서명</th>
                        <th class="col-md-3 center bo-left">담당업무</th>
                        <th class="col-md-3 center bo-left">비 고</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $lt) : ?>
                        <tr>
                            <td class="center"><input type="checkbox"></td>
                            <td class="center"><?php echo $com_now->co_name ?></td>
                            <td class="center bo-left">
                                <a href="javascript:"
                                   onclick="location.href='?ss_di=2&amp;mode=modify&amp;seq=<?php echo $lt->seq; ?>&amp;com=<?php echo $com_now->seq ?>'"><?php echo $lt->div_code; ?></a>
                            </td>
                            <td class="center bo-left"><a href="javascript:"
                                                          onclick="location.href='?ss_di=2&amp;mode=modify&amp;seq=<?php echo $lt->seq; ?>&amp;com=<?php echo $com_now->seq ?>'"><?php echo $lt->div_name; ?></a>
                            </td>
                            <td class="bo-left" style="padding-left: 15px;"><?php echo $lt->res_work; ?></td>
                            <td class="bo-left" style="padding-left: 15px;"><?php echo $lt->note; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if ( empty( $list ) ) : ?>
                    <div class="center" style="padding: 100px 0;">등록된 데이터가 없습니다.</div>
                <?php endif; ?>
            </div>
            <div class="col-md-12 center" style="margin-top: 0px; padding: 0;">
                <ul class="pagination pagination-sm"><?php echo $pagination; ?></ul>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 0 15px;">
        <div class="col-md-12"
             style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
            <?
            if ( $auth11 < 2 ) {
                $submit_str = "alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
                $del_str = "alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
            } else {
                if ( !$this->input->get ( 'com_sel' ) ) {
                    $submit_str = "alert('회사 정보를 선택하여 주십시요!'); document.list_frm.com_sel.focus();";
                } else {
                    $submit_str = "location.href='?ss_di=2&amp;mode=reg&amp;com=" . $this->input->get ( 'com_sel' ) . "' ";
                }
                $del_str = "alert('준비중..! 현재 해당 부서에 대한 수정 화면에서 개별 삭제처리만 가능합니다.')";
            }
            ?>
            <div class="col-xs-6">
                <button class="btn btn-success btn-sm" onclick="<?php echo $submit_str; ?>">신규등록</button>
            </div>
            <div class="col-xs-6" style="text-align: right;">
                <button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">선택삭제</button>
            </div>
        </div>
    </div>


<?php elseif ( $this->input->get ( 'ss_di' ) == 2 ) : ?>
    <div class="row">

        <?php
        $attributes = array('name' => 'form1');
        if ( $this->input->get ( 'seq' ) ) :
            $hidden = array('mode' => $this->input->get ( 'mode' ), 'com_seq' => $this->input->get ( 'com' ), 'seq' => $sel_div->seq);
        else :
            $hidden = array('mode' => $this->input->get ( 'mode' ), 'com_seq' => $this->input->get ( 'com' ));
        endif;
        echo form_open ( current_full_url (), $attributes, $hidden );
        ?>
        <fieldset class="font12">
            <div class="col-md-12" style="<?php if ( !$this->agent->is_mobile () ) echo 'height: 490px;'; ?>">
                <div style="height:60px; line-height: 60px; padding-left: 20px; margin: 5px 0 30px; font-size: 11pt; background-color: #f2f2f2;">
                    <?php
                    $co_name = $this->cms_main_model->sql_row ( "SELECT * FROM cb_cms_com WHERE seq={$this->input->get('com')}" );
                    ?>
                    ◼︎ 회사명 : <strong><span style="color:#122699; "><?php echo $co_name->co_name; ?></span></strong>
                </div>
                <div style="height: 36px; padding: 8px 0 0 10px; margin-bottom: 10px;">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: green;"></span>
                    <strong>부서정보 <?php if ( $this->input->get ( 'mode' ) == 'reg' ) echo '신규';
                        else echo '수정'; ?>등록</strong>
                </div>
                <div class="row bo-top">
                    <div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
                        <label for="div_code">부서코드 <span class="red">*</span></label>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-4 form-wrap2">
                        <input type="text" class="form-control input-sm" id="div_code" name="div_code" maxlength="30"
                               value="<?php if ( $this->input->get ( 'seq' ) ) echo $sel_div->div_code; ?>" required
                               autofocus>
                    </div>
                    <div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
                        <label for="div_name">부서명 <span class="red">*</span></label>
                    </div>
                    <div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
                        <input type="text" class="form-control input-sm han" id="div_name" name="div_name"
                               maxlength="30"
                               value="<?php if ( $this->input->get ( 'seq' ) ) echo $sel_div->div_name; ?>" required
                               autofocus>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #ddd;">
                    <div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
                        <label for="manager">부서책임자</label>
                    </div>
                    <div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
                        <input type="text" class="form-control input-sm" id="manager" name="manager" maxlength="30"
                               value="<?php if ( $this->input->get ( 'seq' ) ) echo $sel_div->manager; ?>">
                    </div>
                    <div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
                        <label for="div_tel">부서전화</label>
                    </div>
                    <div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
                        <input type="text" class="form-control input-sm han" id="div_tel" name="div_tel" maxlength="30"
                               value="<?php if ( $this->input->get ( 'seq' ) ) echo $sel_div->div_tel; ?>">
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #ddd;">
                    <div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
                        <label for="res_work">담당업무 <span class="red">*</span></label>
                    </div>
                    <div class=" col-xs-8 col-sm-8 col-md-10 form-wrap2">
                        <input type="text" class="form-control input-sm" id="res_work" name="res_work" maxlength="30"
                               value="<?php if ( $this->input->get ( 'seq' ) ) echo $sel_div->res_work; ?>" required
                               autofocus>
                    </div>
                </div>
                <div class="row" style="border-top: 1px solid #ddd;">
                    <div class=" col-xs-12 col-sm-12 col-md-2 label-wrap2 bo-bottom" style="height: 80px;">
                        <label for="note">비 고</label>
                    </div>
                    <div class=" col-xs-12 col-sm-12 col-md-10 form-wrap2 bo-bottom" style="height: 80px;">
                        <textarea class="form-control input-sm" id="note" name="note" rows="3"
                                  cols="114"><?php if ( $this->input->get ( 'seq' ) ) echo $sel_div->note; ?></textarea>
                    </div>
                </div>
            </div>

        </fieldset>
        </form>

        <div class="row" style="margin: 0 15px;">
            <div class="col-md-12"
                 style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
                <?
                if ( $auth11 < 2 ) {
                    $submit_str = "alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
                    $del_str = "alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
                } else {
                    $submit_str = "div_submit('" . $this->input->get ( 'mode' ) . "');";
                    $del_str = "form1_seq_del(" . $this->input->get ( 'seq' ) . ");";
                }
                ?>
                <div class="col-xs-6">
                    <button class="btn btn-success btn-sm"
                            onclick="<?php echo $submit_str; ?>"><?php if ( $this->input->get ( 'mode' ) == 'modify' ) echo '수정하기';
                        else echo '등록하기'; ?></button>
                    <button class="btn btn-info btn-sm"
                            onclick="location.href='?ss_di=1&amp;com_sel=<?php echo $this->input->get ( 'com' ) ?>' ">
                        목록으로
                    </button>
                </div>
                <div class="col-xs-6" style="text-align: right;">
                    <?php if ( $this->input->get ( 'seq' ) ) : ?>
                        <button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">선택삭제</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php endif ?>