      <div style="height: 10px;"></div>

      <!-- <div class="page-header">
        <h1>Navs</h1>
      </div> -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?if( !$this->uri->segment(3) or $this->uri->segment(3)=='1') echo 'active'; else echo '';?>">
          <a href="/bt/m2/local/1/"><strong>전도금 관리</strong></a>
        </li>
        <li role="presentation" class="<?if( $this->uri->segment(3)=='2') echo 'active'; else echo '';?>">
          <a href="/bt/m2/local/2/"><strong>투입자원 관리</strong></a>
        </li>
      </ul>