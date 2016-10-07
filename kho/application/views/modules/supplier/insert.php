<div class="row supplier_update">
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên nhà cung cấp<span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="name" value="<?php echo (set_value('name'))?set_value('name'):''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Điện thoại</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="phone" value="<?php echo (set_value('phone'))?set_value('phone'):''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="email" value="<?php echo (set_value('email'))?set_value('email'):''; ?>">
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Mã số thuế</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="tax_code" value="<?php echo (set_value('tax_code'))?set_value('tax_code'):''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Công ty</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="company" value="<?php echo (set_value('company'))?set_value('company'):''; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="address" value="<?php echo (set_value('address'))?set_value('address'):''; ?>">
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <textarea class="form-control" rows="5" placeholder="Ghi chú" name="note"><?php echo (set_value('note'))?set_value('note'):''; ?></textarea>
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








