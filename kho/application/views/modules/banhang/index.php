<div class="row sale_index">
  <div class="x_panel">
    <div class="x_title">
      <h2>Quản lý đơn hàng<small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
       <div class="col-md-12 createbtn"><button class="btn btn-success"><i class="fa fa-plus"></i>Thêm đơn hàng</button></div>
      <div class="clearfix"></div>
    </div>
    <div class="checkTime col-md-8 p">
        <form>
        <div class="col-md-3">
          <select class="form-control checkstatus">
            <option value="2">Tình trạng</option>
            <option value="1" <?php echo (isset($checkStatus)&&$checkStatus==1)?'selected':'' ?>>Đã giao</option>
            <option value="0" <?php echo (isset($checkStatus)&&$checkStatus==0)?'selected':'' ?>>Chờ giao</option>
          </select>
        </div>
        <div class="col-md-3 timeYear">
          <select class="form-control">
            <option value="0">Chọn năm</option>
            <?php $curentYear = date('Y',now()); for($i=$curentYear;$i>=$curentYear-10;$i--): ?>
              <option value="<?=$i?>" <?php echo (isset($checkYear)&&$checkYear==$i)?'selected':'' ?>><?=$i?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-md-3 timeMonth">
          <select class="form-control">
            <option value="0">Chọn tháng</option>
            <?php for($i=1;$i<=12;$i++): ?>
              <option value="<?=$i?>" <?php echo (isset($checkMonth)&&$checkMonth==$i)?'selected':'' ?>>Tháng <?=$i?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-md-3 timeDay">
          <select class="form-control">
          <option value="0">Chọn ngày</option>
            <?php for($i=1;$i<=31;$i++): ?>
              <option value="<?=$i?>" <?php echo (isset($checkDay)&&$checkDay==$i)?'selected':'' ?>><?=$i?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="control col-md-12">
          <div class="checkbtn">
            <button class="btn btn-success"><i class="fa fa-search"></i>Lọc</button>
          </div>
          <?php if(isset($checkStatus)): ?>
          <div class="viewall">
            <button class="btn btn-warning"><i class="fa fa-paper-plane-o"></i>Xem tất cả</button>
          </div>
          <?php endif; ?>
        </div>
        </form>
      </div>
      <div class="col-md-4">
          <table class="table table-striped jambo_table bulk_action ">
            <thead>
              <tr class="headings">
                <th>SL</th>
                <th>Vốn</th>
                <th>Bán</th>
                <th>Lời</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th><?=$totalQuantity?></th>
                <th><?=number_format($totalCostprice)?></th>
                <th><?=number_format($totalPrice)?></th>
                <th><?=number_format($totalPrice-$totalCostprice)?></th>
              </tr>
            </tbody>
          </table>
      </div>
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left input_mask">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action ">
            <thead>
              <tr class="headings">
                <th class="column-title" style="width: 5%">STT</th>
                <th class="column-title" style="width: 5%">DH</th>
                <th class="column-title" style="width: 5%">SP</th>
                <th class="column-title" style="width: 20%">Tên sản phẩm</th>
                <th class="column-title" style="width: 5%">SL</th>
                <th class="column-title" style="width: 15%">Giá vốn</th>
                <th class="column-title" style="width: 15%">Giá bán</th>
                <th class="column-title">Tổng</th>
                <th class="column-title" style="width: 10%">Ngày giao</th>
                <th class="column-title" style="width: 8%">Trạng thái</th>
              </tr>
            </thead>

            <tbody>
            <?php if(isset($row)): foreach($row as $r): ?>
              <tr class="even pointer">
                <td class=""><?=$stt++?><input type="hidden" class="customer" value="<?=$r->customer?>"><input type="hidden" class="create_at" value="<?=date('m/d/Y H:i:s',$r->create_at)?>"><input type="hidden" class="note" value="<?=$r->note?>"></td>
                <td class="dh_id">DH<?=$r->id?><input type="hidden" value="<?=$r->id?>"></td>
                <td class="masp">SP<?=$r->product_id?></td>
                <td class="product_name"><?=$this->qlk->getproductname_id($r->product_id)?></td>
                <td class="quantity"><?=$r->quantity?></td>
                <td class="costprice"><?=number_format($r->costprice)?></td>
                <td class="saleprice"><?=number_format($r->price)?></td>
                <td class="saleprice"><?=number_format($r->price*$r->quantity)?></td>
                <td class="delivery_at"><?php echo (0!=$r->delivery_at)?date('m/d/Y',strtotime($r->delivery_at)):''?></td>
                <td class="status">
                  <button class="btn <?php echo (0==$r->status)?'btn-danger':'btn-primary' ?>"><?=$status[$r->status]?></button>
                  <input type="hidden" value="<?=$r->status?>">
                </td>
              </tr>
            <?php endforeach;endif; ?>
            </tbody>
          </table>
        </div>
      </form>
      <div class="pagination">
        <?=$this->pagination->create_links()?>
      </div>
    </div>
  </div>
</div>
<div id='che'></div>
<div id='divpopup' class="row" >
<form class="form-horizontal sale_index_form" method="post">
  <div class="x_panel pndetail">
  <div class="col-md-8 info">
    <div class="col-md-6">
      <p class="dh_id">Mã đơn hàng:<span></span><input type="hidden" name="dh_id"></p>
      <p class="create_at">Ngày tạo:<span></span></p>
      <p class="delivery_at">Ngày giao:<input type="text" class="form-control datepicker" name="date" readonly=""></p>
    </div> 
    <div class="col-md-6">
      <p class="customer">Khách hàng:<span></span></p>
      <p class="status">Tình trạng:
      <label><input type="radio" class="dagiao"  value="1" name="status">Đã giao</label>
      <label><input type="radio" class="chogiao" value="0" name="status">Chờ giao</label>    
      </p>    
    </div>
  </div>
  <div class="col-md-4 note">
    <textarea placeholder="Ghi chú...." name="note"></textarea>
  </div>
  <div class="col-md-12 tbdetail2">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
          <thead>
            <tr class="headings">
              <th class="column-title" style="width: 20%">Mã sản phẩm</th>
              <th class="column-title" style="">Tên sản phẩm</th>
              <th class="column-title" style="width: 10%">Số lượng</th>
              <th class="column-title" style="width: 20%">Tiền vốn</th>
              <th class="column-title" style="width: 20%">Tiền bán</th>              
            </tr>
          </thead>

          <tbody>
            <tr>
              <td class="masp"></td>
              <td class="product_name"></td>
              <td class="quantity"></td>
              <td class="costprice"></td>
              <td class="saleprice"></td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
    <div class="control">
      <button class="btn btn-danger"><i class="fa fa-reply" aria-hidden="true"></i>Đóng</button>
      <button class="btn btn-warning btnDelete"><i class="fa fa-times" aria-hidden="true"></i>Xóa</button>
      <button class="btn btn-success btnupdate"><i class="fa fa-check" aria-hidden="true"></i>Lưu</button>
    </div>
  </div>
  <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
  </form>
</div>







