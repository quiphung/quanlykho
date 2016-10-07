<div class="row cate_update">
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
      <div class="form-group name">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên danh mục<span class="required">*</span></label>
        <div class="col-md-10 col-sm-10 col-xs-12">
          <input type="text" class="form-control" name="name" value="<?php echo (set_value('name'))?set_value('name'):''; ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Danh mục cha</label>
        <div class="col-md-10 col-sm-10 col-xs-12">
          <select class="form-control" name="cate">
          <option value="0">--Chọn danh mục cha--</option>
          <?php foreach($row as $k => $v): ?>
            <option value="<?=$k?>"><?=$v?></option>
          <?php endforeach; ?>
          </select>
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








