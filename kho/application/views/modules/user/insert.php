<div class="row user">
  <div class="x_panel">
  <div class="x_title">
        <h2>Thêm mới<small><?php echo isset($thongbao)?$thongbao:'' ?></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
    <div class="col-md-12">
      <form class="form-horizontal" method="post">
      <div class="col-md-6 col-xs-12">
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Họ tên<span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="name" value="<?php echo (set_value('name'))?set_value('name'):''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên đăng nhập<span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="username" value="<?php echo (set_value('username'))?set_value('username'):''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Mật khẩu<span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control" name="password" >
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nhập lại mật khẩu<span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="password" class="form-control" name="repass">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Phân quyền<span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="level">
              <option value="1">Nhân viên kho</option>
              <option value="2">Nhân viên bán hàng</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="email" value="<?php echo (set_value('email'))?set_value('email'):''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Điện thoại</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="phone" value="<?php echo (set_value('phone'))?set_value('phone'):''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
             <textarea class="form-control" rows="6" name="address"><?php echo (set_value('address'))?set_value('address'):''; ?></textarea>
          </div>
        </div>
      </div>
      <div class="form-group col-md-12 control">
        <div class="col-md-12 col-sm-12 col-xs-12">
         <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
          <button type="submit" class="btn btn-primary goback">Trở về</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
      </form>
    </div>  
  </div>
</div>








