<div class="row product">
  <div class="x_panel sale">
  <div class="x_title">
        <h2>Tạo đơn hàng <small><p><?php echo isset($thongbao)?$thongbao:'' ?></small></p></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
        <div class="searchproduct">
        <form class="sale_formsearch">
          <input class="form-control" type="text" name="search" placeholder="Nhập mã hoặc tên sản phẩm">
        </form>
        <div class="resultsearch">
        </div>
      </div>
      </div>
    <div class="col-md-12">
      <form class="form-horizontal" method="post">
      <div class="col-md-6 col-xs-12">
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên sản phẩm<span class="required"></span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control product_name" name="name" value="<?php echo (set_value('name'))?set_value('name'):''; ?>" readonly>
            <input type="hidden" class="product_id" name="product_id" value="<?php echo (set_value('product_id'))?set_value('product_id'):''; ?>">
          </div>
        </div>
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Giá vốn</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control numberformat product_costprice" name="costprice" value="<?php echo (set_value('costprice'))?set_value('costprice'):''; ?>" >
            <input type="hidden" class="form-control product_costprice product_costprice_real" name="costprice_real" value="<?php echo (set_value('costprice_real'))?set_value('costprice_real'):''; ?>" >
          </div>
        </div>
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tồn kho</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control product_quantity" name="tonkho" value="<?php echo (set_value('tonkho'))?set_value('tonkho'):''; ?>" readonly="">
          </div>
        </div>
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Số lượng</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="number" class="form-control sale_quantity" name="quantity" min="1" required="" value="<?php echo (set_value('quantity'))?set_value('quantity'):''; ?>">
          </div>
        </div>
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Giá bán</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control numberformat sale_price" required="" value="<?php echo (set_value('price'))?set_value('price'):''; ?>">
            <input type="hidden" class="form-control sale_price_real sale_price" name="price" value="<?php echo (set_value('price'))?set_value('price'):''; ?>">
          </div>
        </div>
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Thành tiền</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control numberformat sale_money" value="" readonly="">
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Khách hàng</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="customer" value="<?php echo (set_value('customer'))?set_value('customer'):''; ?>">
          </div>
        </div>
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày giao dự kiến</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control datepicker" name="datepicker" value="" readonly="">
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 p">Tình trạng</label>
            <div class="col-md-9 col-sm-9 col-xs-12 status">
              <label>
                <input type="radio"  value="1" name="status" >
                Đã giao
              </label>
              <label>
                <input type="radio" value="0" name="status" checked="">
                Chờ giao
              </label>
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
          <button type="submit" class="btn btn-success">Create</button>
        </div>
      </div>
      </form>
    </div>  
  </div>
</div>






