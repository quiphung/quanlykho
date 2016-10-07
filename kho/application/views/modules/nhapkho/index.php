<div class="row warehouseindex">
  <div class="x_panel">
    <div class="x_title">
      <h2>Phiếu nhập hàng<small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="col-md-12 createbtn"><button class="btn btn-success"><i class="fa fa-plus"></i>Tạo phiếu nhập</button></div>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <?php /*
      <label class="cursorpointer">
      <input type="checkbox" class="nonhacungcap cursorpointer" <?php echo('nonhacungcap'==$this->router->fetch_method())?'checked':''?>>
      Nợ nhà cung cấp
      </label>
      <label class="cursorpointer">
      <input type="checkbox" class="dathanhtoan cursorpointer" <?php echo('dathanhtoan'==$this->router->fetch_method())?'checked':''?>>
      Đã thanh toán hoàn toàn với nhà cung cấp
      </label>
      */?>
      <form class="form-horizontal form-label-left input_mask">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action phieunhap">
            <thead>
              <tr class="headings">
                <th class="column-title" style="width: 5%">STT</th>
                <th class="column-title" style="width: 10%">Mã nhập hàng</th>
                <th class="column-title" style="">Thời gian</th>
                <th class="column-title" style="width: 15%">Người tạo</th>
                <th class="column-title" style="width: 15%">Nhà cung cấp</th>
                <th class="column-title">Tổng tiền hàng</th>
                <?php /*<th class="column-title" style="width: 15%">Tiền đã trả NCC</th>*/?>
                <th class="column-title" style="width: 15%">Trạng thái</th>
                </th>
                
              </tr>
            </thead>

            <tbody>
            <?php foreach($row as $r): ?>
              <tr class="even pointer">
                <td class=""><?=$stt++?></td>
                <td class="pn_id">PN<?=$r->id?><input type="hidden" value="<?=$r->id?>"></td>
                <td class="entry_at"><?=date('d/m/Y H:i:s',$r->entry_at)?></td>
                <td class="user"><?=$this->qlk->getuser($r->user)?></td>
                <td class="supplier"><?=$this->qlk->getsupplier($r->supplier)?></td>
                <td class="total_money"><?=number_format($r->total_money)?></td>
                <?php /*
                <td class="paid"><?=number_format($r->paid)?><input type="hidden" value="<?=number_format($r->total_money-$r->paid)?>"></td> */?>
                <td class="status last"><?=$status[$r->status]?><input type="hidden" value="<?=$r->note?>"></td>
              </tr>
            <?php endforeach; ?>
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
  <div class="x_panel pndetail">
  <div class="col-md-8 info">
    <div class="col-md-6">
      <p class="pn_id">Mã nhập hàng:<span></span><input type="hidden"></p>
      <p class="entry_at">Thời gian:<span></span></p>
      <p class="supplier">Nhà cung cấp:<span></span></p>
    </div> 
    <div class="col-md-6">
      <p class="status">Trạng thái:<span></span></p>
      <p class="user">Người tạo:<span></span></p>
    </div>
  </div>
  <div class="col-md-4 note">
    <textarea placeholder="Ghi chú...."></textarea>
  </div>
  <div class="col-md-12 tbdetail">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
          <thead>
            <tr class="headings">
              <th class="column-title" style="width: 5%">STT</th>
              <th class="column-title" style="width: 10%">Mã sản phẩm</th>
              <th class="column-title" style="">Tên sản phẩm</th>
              <th class="column-title" style="width: 20%">Số lượng</th>
              <th class="column-title" style="width: 15%">Tiền vốn</th>
              <th class="column-title" style="width: 15%">Tiền bán</th>              
            </tr>
          </thead>

          <tbody>
            
          </tbody>
        </table>
    </div>
  </div>
    <div class="money col-md-12">
      <div class="col-md-7"></div>
      <div class="col-md-5">
        <p class="quantity">Tổng số hàng<span></span></p>
        <p class="total_money">Tổng tiền hàng<span></span></p>
        <?php /*
        <p class="paid">Tiền đã trả NCC<span></span></p>
        <p class="own">Tiền còn nợ NCC<span></span></p>
        */?>
      </div>
    </div>
    <div class="control">
      <button class="btn btn-danger"><i class="fa fa-reply" aria-hidden="true"></i>Đóng</button>
      <button class="btn btn-primary pdf"><i class="fa fa-print" aria-hidden="true"></i>In</button>
      <button class="btn btn-warning btnDeleteNhapKho"><i class="fa fa-times" aria-hidden="true"></i>Xóa</button>
    </div>
  </div>
  <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
</div>







