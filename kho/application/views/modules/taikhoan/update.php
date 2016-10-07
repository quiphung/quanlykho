<div class="row">
<div class="col-md-12">
<div class="" role="tabpanel" data-example-id="togglable-tabs">
  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Cập nhật tài khoản</a>
    </li>
     <li role="presentation" class=""><a href="<?=base_url()?>tonkho"  aria-expanded="false">Back</a>
  </ul>
  <div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Cập nhật<small style="color:red"><?php echo(isset($thongbao))?$thongbao:''?></small><small style="color:blue"><?php echo(isset($thongbao2))?$thongbao2:''?></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Họ tên<span>*</span></label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="text" name="hoten" class="form-control" placeholder="" required=""  value="<?php echo set_value('hoten')?set_value('hoten'):$r->name ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Email<span>*</span></label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="text" name="email" class="form-control" placeholder="" required=""  value="<?php echo set_value('email')?set_value('email'):$r->email ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Password</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="password" name="password" class="form-control" placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">New Password</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="password" name="passnew" class="form-control" placeholder="" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Re-Password</label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="password" name="repass" class="form-control" placeholder="" >
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="reset" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success" name="gohome">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
</div>
</div>