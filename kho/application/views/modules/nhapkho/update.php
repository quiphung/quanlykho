<div class="row warehousecreate">
  <div class="col-md-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Thông tin phiếu nhập<small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="searchproduct">
        <form class="formsearch">
          <input class="form-control" type="text" name="search" placeholder="Nhập mã hoặc tên sản phẩm">
        </form>
        <div class="resultsearch">
        </div>
      </div>
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left input_mask entrywarehouse">
          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action tbproduct">
              <thead>
                <tr class="headings">
                  <th class="column-title" style="width: 5%">STT </th>
                  <th class="column-title">Mã SP</th>
                  <th class="column-title" style="width: 20%">Tên SP</th>
                  <th class="column-title" style="width: 10%">Số Lượng</th>
                  <th class="column-title" style="width: 15%">Giá Vốn</th>
                  <th class="column-title" style="width: 20%">Thành Tiền</th>
                  <th class="column-title" style="width: 15%">Giá Bán</th>
                  <th class="column-title">Action</span>
                  </th>
                  
                </tr>
              </thead>

              <tbody>
                <?php /* ?>
                <tr class="even pointer product">
                  <td class="stt"><?=$stt++?></td>
                  <td class="idsp"><?=$id?><input type="hidden" name="idsp" value="<?=$id?>"></td>
                  <td class=" "><?=$name?></td>
                  <td class=""><input type="text" name="quantity[]" class="form-control numberformat quantity change" value="1" min="1"></td>
                  <td class=""><input type="text" name="costprice[]" class="form-control numberformat costprice change" min="0"></td>
                  <td ><input class="form-control sum numberformat" readonly=""></td>
                  <td class="price"><input type="text" name="price[]" class="form-control numberformat"  min="0"></td>
                  <td class="last"><a class="action" href="#"><i class="fa fa-times"></i></a>
                  </td>
                </tr>
                <?php */ ?>
                <?php 
                  $stt = 1;
                  foreach($detail as $r):
                ?>
                <tr class="even pointer product">
                  <td class="stt"><?=$stt++?></td>
                  <td class="idsp">SP<?=$r->product_id?><input type="hidden" name="idsp[]" value="SP<?=$r->product_id?>"></td>
                  <td class=" "><?=$this->qlk->getproductname_id($r->product_id)?></td>
                  <td class=""><input type="text" name="quantity[]" class="form-control numberformat quantity change" value="<?=$r->quantity?>" min="1"></td>
                  <td class=""><input type="text" name="costprice[]" class="form-control numberformat costprice change" value="<?=$r->costprice?>" min="0"></td>
                  <td><input class="form-control sum numberformat" readonly="" value="<?php echo $r->quantity*$r->costprice; ?>"></td>
                  <td class="price"><input type="text" name="price[]" class="form-control numberformat" min="0" value="<?=$r->price?>"></td>
                  <td class="last"><a class="action" href="#"><i class="fa fa-times"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Thông tin hóa đơn<small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left forminfo">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mã hóa đơn</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" disabled="disabled" placeholder="Hệ thống tự sinh" value="PN<?=$enter->id?>">
            </div>
          </div>
          <div class="form-group supplier">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 p">Nhà cung cấp</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="input-group supplier_input">
              <input type="text" class="form-control supplier_name" value="<?=$this->qlk->getsupplier($enter->supplier)?>">
              <input type="hidden" name="supplier" class="supplier_id" value="<?=$enter->supplier?>"> 
              <span class="input-group-btn">
                  <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
              </span>
              <div class="supplier_result">
              </div>
            </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 supplier_name_checked">
            <div class="col-md-3 col-sm-3 col-xs-12"></div>
            <div class="col-md-9 col-sm-9 col-xs-12"><p></p><span class="glyphicon glyphicon-remove"></span></div>
          </div>       
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Người nhập</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" disabled="disabled" value="<?=$this->qlk->getuser($enter->user)?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ghi chú</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <textarea class="form-control" rows="4" name="note"><?=$enter->note?></textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="x_panel">
      <div class="x_title">
        <h2>Thông tin thanh toán<small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left thanhtoan">
        <?php /*
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 p">Hình thức</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <label>
                <input type="radio"  value="1" name="hinhthuc" <?php echo(1==$enter->hinhthuc)?'checked':'' ?>>
                Tiền mặt
              </label>
              <label>
                <input type="radio" value="2" name="hinhthuc" <?php echo(2==$enter->hinhthuc)?'checked':'' ?>>
                Thẻ
              </label>
              <label>
                <input type="radio" value="3" name="hinhthuc" <?php echo(3==$enter->hinhthuc)?'checked':'' ?>>
                Chuyển khoản
              </label>
            </div>
          </div>
          */?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 p">Tiền hàng</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="prices form-control numberformat" name="total_money" readonly="" value="<?=$enter->total_money?>">
            </div>
          </div>
          <?php /*
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 p">Đã thanh toán</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control paid numberformat" name="paid" value="<?=$enter->paid?>" >
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 p">Còn nợ</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" readonly="" class="form-control owe numberformat" value="<?=$enter->total_money-$enter->paid?>">
            </div>
          </div>
          */?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12 p">Tình trạng</label>
            <div class="col-md-9 col-sm-9 col-xs-12 status">
              <label>
                <input type="radio"  value="1" name="status" <?php echo (1==$enter->status)?'checked':'' ?>>
                Hoàn thành
              </label>
              <label>
                <input type="radio" value="0" name="status" <?php echo (0==$enter->status)?'checked':'' ?>>
                Lưu tạm
              </label>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-primary goback">Trở lại</button>
              <button type="submit" class="btn btn-success update">Update</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div> 
</div>
<div id="script"></div>
<div class="create_che"></div>
<div class="create_popup row">
<div class="title">
  <h3>Nhà cung cấp</h3>
  <div class="close"><i class="fa fa-times-circle"></i></div>
</div>
  <div class="x_panel">
    <div class="col-md-12">
      <form class="form-horizontal ">
      <div class="col-md-6 col-xs-12">
        <div class="form-group name">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên nhà cung cấp<span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="name">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Điện thoại</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="phone">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="email">
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Mã số thuế</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="tax_code">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Công ty</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="company">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="address">
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <textarea class="form-control" rows="5" placeholder="Ghi chú" name="note"></textarea>
        </div>
      </div>
      <div class="form-group col-md-12 control">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <button type="submit" class="btn btn-primary popup_close">Cancel</button>
          <button type="submit" class="btn btn-success popup_submit">Create</button>
        </div>
      </div>
      </form>
    </div>  
  </div>
</div>
<script type="text/javascript">
  $('.update').click(function(){
    data  = $('.entrywarehouse, .forminfo, .thanhtoan').serialize();
    url   = urlck+'nhapkho/ajax_update/<?=$id?>';
    $.post(url,data,function(d){
      window.location.href = urlck+'nhapkho';
    });
    return false;
  })
</script>






