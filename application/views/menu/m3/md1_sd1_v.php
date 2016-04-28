      <div class="main_start">&nbsp;</div>
<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->1. 데이터 등록 -->
			<div class="row font12" style="margin: 0; padding: 0;">
				<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
<?php
$attributes = array('name' => 'form1', 'method' => 'get');
echo form_open('/m3/project/1/1/', $attributes);
?>
						<div class="col-xs-12 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">사업 개시년도</div>
						<div class=" form-wrap col-xs-12 col-sm-8 col-md-2" style="padding: 3px;">
							<label for="class1" class="sr-only">구분1</label>
							<select class="form-control input-sm" name="class1" onChange="inoutSel(this.form);">
								<option value="0">선 택</option>
								<option value="1" <?php if($this->input->get('class1')==1) echo 'selected'; ?>>입 금</option>
								<option value="2" <?php if($this->input->get('class1')==2) echo 'selected'; ?>>출 금</option>
								<option value="3" <?php if($this->input->get('class1')==3) echo 'selected'; ?>>대 체</option>
							</select>
						</div>

						<div class="col-xs-12 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">미등록현장 [<span style="color: #0c04ab;">신규등록</span>]</div>
						<div class="form-wrap col-xs-12 col-sm-8 col-md-2" style="padding: 3px;">
							<label for="class1" class="sr-only">구분1</label>
							<select class="form-control input-sm" name="class1" onChange="inoutSel(this.form);">
								<option value="0">선 택</option>
								<option value="1" <?php if($this->input->get('class1')==1) echo 'selected'; ?>>입 금</option>
								<option value="2" <?php if($this->input->get('class1')==2) echo 'selected'; ?>>출 금</option>
								<option value="3" <?php if($this->input->get('class1')==3) echo 'selected'; ?>>대 체</option>
							</select>
						</div>

						<div class="col-xs-12 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">기등록현장 [<span style="color: #be032a;">데이터수정</span>]</div>
						<div class="form-wrap col-xs-12 col-sm-8 col-md-2" style="padding: 3px;">
							<label for="class1" class="sr-only">구분1</label>
							<select class="form-control input-sm" name="class1" onChange="inoutSel(this.form);">
								<option value="0">선 택</option>
								<option value="1" <?php if($this->input->get('class1')==1) echo 'selected'; ?>>입 금</option>
								<option value="2" <?php if($this->input->get('class1')==2) echo 'selected'; ?>>출 금</option>
								<option value="3" <?php if($this->input->get('class1')==3) echo 'selected'; ?>>대 체</option>
							</select>
						</div>
					</form>
				</div>


				<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
					<div class="col-xs-4 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">프로젝트 명</div>
					<div class="col-xs-8 col-sm-8 col-md-4" style="padding: 9px;">
						<span style="color: #0c04ab;"><?php echo '현장명';?></span>
					</div>

					<div class="col-xs-4 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">프로젝트 종류</div>
					<div class="col-xs-8 col-sm-8 col-md-4" style="padding: 9px;">
						<span style="color: #0c04ab;"><?php echo '현장종류';?></span>
					</div>
				</div>

				<div class="row" style="margin: 0;">
					<div class="col-xs-12" style="padding: 9px 0 9px 15px;"><strong><span class="red">*</span> 라인(동) 별 데이터 등록</strong></div>
				</div>

				<div class="row table-responsive" style="margin: 0 0 20px 0;">
					<table class="table">
			            <thead class="bo-top" style="background-color: #F0F0E8;">
				            <tr>
				                <th>#</th>
				                <th>기본정보 수정</th>
				                <th>Last Name</th>
				                <th>Username</th>
								<th>Username</th>
			            	</tr>
			            </thead>
			            <tbody class="bo-bottom">
			            <tr>
			                <td>1</td>
			                <td>Mark</td>
			                <td>Otto</td>
			                <td>@mdo</td>
							<td>@mdo</td>
			            </tr>
						<tr>
			                <td>1</td>
			                <td>Mark</td>
			                <td>Otto</td>
			                <td>@mdo</td>
							<td>@mdo</td>
			            </tr>
						<tr>
			                <td>1</td>
			                <td>Mark</td>
			                <td>Otto</td>
			                <td>@mdo</td>
							<td>@mdo</td>
			            </tr>
						<tr>
			                <td>1</td>
			                <td>Mark</td>
			                <td>Otto</td>
			                <td>@mdo</td>
							<td>@mdo</td>
			            </tr>
						<tr>
			                <td>1</td>
			                <td>Mark</td>
			                <td>Otto</td>
			                <td>@mdo</td>
							<td>@mdo</td>
			            </tr>
						<tr>
			                <td>1</td>
			                <td>Mark</td>
			                <td>Otto</td>
			                <td>@mdo</td>
							<td>@mdo</td>
			              </tr>
						</tbody>
					</table>
				</div>
				<div class="row font12" style="margin: 0; padding: 0 15px; 0; text-align:center; color:#3e3e3e; line-height:180%;">
					<p style="padding: 0px;">각 동의 <font color="#cc0000">1개 라인별로 정보를 입력</font> 하십시요! 공급가격 정보가 다른 층 (예를 들어 1,2층의 공급가격이 기준층과 다른 경우) 은 층별로
					개별 등록하고 같은 라인의 기준층과 같이 타입이나 공급가격이 동일한 호수의 경우 최저층부터 최고층까지 일괄등록 할 수 있습니다. (<font color="#7A7A7A">단, 이 경우 1, 2층을 개별 등록하였다면, 3층부터 입력하여야 중복이 되지 않으며 3층부터 15층까지로 설정하였다면 해당 구간의 모든 층이 등록됩니다.</font>)</p>
				</div>
				<div class="row font12" style="margin: 0; padding: 20px 0; text-align:center; color:#3e3e3e; line-height:180%;">
					<?
						// if($_m4_1_1_row[_m4_1_1]<2){
						// 	$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
						// }else{
						// 	$submit_str="pj_data_put_0()";
						// }
					?>
					<div style="row" style="margin: 0; padding: 0;">
						<input type="button" value="데이터 입력" onclick="<?//=$submit_str?>" class="btn btn-primary btn-sm">
					</div>
				</div>



      </div>
