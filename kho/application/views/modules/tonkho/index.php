<div class="row warehouse">
  <div class="x_panel">
    <div class="x_title">
      <h2>Hàng tôn kho<small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="warehouse_search col-md-6 col-xs-12">
      <form class="warehouse_search_form">
        <input class="form-control" type="text" name="search" placeholder="Nhập mã hoặc tên sản phẩm">
      </form> 
      <div class="resultsearch">
      </div>
    </div>
    <div class="col-md-2 reload"><span class="glyphicon glyphicon-remove"></span></div>
    <div class="col-md-4">
        <table class="table table-striped jambo_table bulk_action ">
          <thead>
            <tr class="headings">
              <th>Tổng sản phẩm</th>
              <th>Tổng số lượng sp</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th><?=$totalProducts?></th>
              <th><?=$totalQuantity?></th>
            </tr>
          </tbody>
        </table>
    </div>
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left input_mask">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action tonkho">
            <thead>
              <tr class="headings">
                <th class="column-title" style="width: 5%">STT</th>
                <th class="column-title" style="width: 10%">Mã sản phẩm</th>
                <th class="column-title" style="width: 30%">Tên sản phẩm</th>
                <th class="column-title" style="width: 20%">Giá vốn</th>
                <th class="column-title" style="width: 20%">Giá bán</th>
                <th class="column-title">Tồn kho</th>
                </th>
              </tr>
            </thead>

            <tbody>
            <?php foreach($row as $r): ?>
              <tr class="even pointer">
                <td class=""><?=$stt++?></td>
                <td class="product_id">SP<?=$r->product_id?><input type="hidden" value="<?=$r->product_id?>"></td>
                <td class="product_name"><?=$this->qlk->getproductname_id($r->product_id)?></td>
                <td class=""><?=number_format($r->costprice)?></td>
                <td class=""><?=number_format($r->price)?></td>
                <td class=" last"><?=$r->quantity?></td>
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
<div class='warehouse_che'></div>
<div class="warehouse_popup row" >
  <div class="x_panel pninfo">
  <div class="title col-md-12"><h3>Thông tin nhập hàng</h3></div>
  <div class="col-md-12 pdinfo">
    <p class="product_id">Mã sản phẩm: <span></span><input type="hidden" ></p>
    <p class="product_name">Tên sản phẩm: <span></span></p>
  </div>
  <div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
          <thead>
            <tr class="headings">
              <th class="column-title" style="width: 5%">STT</th>
              <th class="column-title" style="width: 20%">Phiếu nhập</th>
              <th class="column-title" style="width: 20%">Thời gian</th>
              <th class="column-title" style="width: 20%">Giá vốn</th>
              <th class="column-title" style="width: 20%">Giá bán</th>
              <th class="column-title" style="width: 15%">Số lượng</th>           
            </tr>
          </thead>

          <tbody>
            
          </tbody>
        </table>
    </div>
  </div>
  <div class="control col-md-12">
    <button class="btn btn-danger"><i class="fa fa-reply" aria-hidden="true"></i>Đóng</button>
    <button class="btn btn-warning btnDelete"><i class="fa fa-times" aria-hidden="true"></i>Xóa</button>
  </div>
  </div>
  <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
</div>







