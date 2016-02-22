     <div style="height: 10px;"></div>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?if( !$this->uri->segment(3) or $this->uri->segment(3)=='1') echo 'active'; else echo '';?>">
        	<a href="/bt/m4/project/1/"><strong>프로젝트 관리</strong></a>
        </li>
        <li role="presentation" class="<?if( $this->uri->segment(3)=='2') echo 'active'; else echo '';?>">
        	<a href="/bt/m4/project/2/"><strong>신규 프로젝트</strong></a>
        </li>
      </ul>