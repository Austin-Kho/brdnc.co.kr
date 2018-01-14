			<footer class="footer">
				<div class="container" style="padding-top: 10px;">
					<div style="float: left; margin: 0 15px 5px 0;"><img src="<?php echo $this->config->base_url(); ?>static/img/cms_box_logo.png" width="120px"></div>
					<div style="float: left;">
						<span class="text-muted"><!-- <strong>[주] 바램디앤씨</strong> -->
							<small>
								<address>| 인천광역시 연수구 인천타워대로323 B-1506(송도동, 송도센트로드오피스)
									| 전화 : 032-858-9556 | 문의하기 : <a href='mailto:admin@brinc.co.kr' class='under'>admin@brinc.co.kr</a><br>
									&nbsp;&nbsp;Copyright 2015-<?php echo date('Y')?> by BARAEM D&C Co.,LTD All rights reserved.
								</address>
							</small>
						</span>
					</div>
				</div>
			</footer>
		</div> <!-- /container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="<?php echo $this->config->base_url(); ?>static/lib/bootstrap/js//bootstrap.min.js"></script>
		<script src="<?php echo $this->config->base_url(); ?>static/js/docs.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<!-- <script src="<?php echo $this->config->base_url(); ?>static/js/ie10-viewport-bug-workaround.js"></script> -->
		<script type="text/javascript">
			$(document).ready(function() {
		      	$('[data-toggle="tooltip"]').tooltip();
				$('[data-toggle="popover"]').popover();
			});
			// 다음 우편번호 서비스 -3 --/ 우편번호 찾기 화면을 넣을 element
			var element_layer = document.getElementById('layer');
		</script>
	</body>
</html>
