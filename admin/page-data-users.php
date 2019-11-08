<?php 
  include_once "../includes/Users-class.php";
  include_once "../assets/plugins/Crypt.php";
  $crypt = new Crypt;
  $crypt->setKey('pL,mKoiJnbHuyGvcFtrDxzSewAq');
  $class_user = new Users($pdo);
?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Member users</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2></i> Users <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_admin" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Admin</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_admin" aria-labelledby="admin-tab">
                  <?php include "section-admin.php" ?>
                </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>