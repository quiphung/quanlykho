<div class="row product">
  <div class="x_panel">
    <div class="x_title">
      <h2>Quản lý sản phẩm<small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
       <div class="col-md-12 createbtn"><button class="btn btn-success"><i class="fa fa-plus"></i>Thêm sản phẩm</button></div>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <form class="form-horizontal form-label-left input_mask">
        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th class="column-title" style="width: 5%">STT</th>
                <th class="column-title" style="width: 10%">Mã sản phẩm</th>
                <th class="column-title" style="width: 20%">Tên sản phẩm</th>
                <?php /* <th class="column-title" style="width: 15%">Danh mục</th> */?>
                <th class="column-title" style="width: 15%">Hình ảnh</th>
                <th class="column-title" style="width: 20%">Ghi chú</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
            <?php foreach($row as $r): ?>
              <tr class="even pointer">
                <td class=""><?=$stt++?></td>
                <td>SP<?=$r->id?></td>
                <td><?=$r->name?></td>
               <?php /* <td><?=$this->qlk->getcategory_name($r->category_id)?></td> */ ?>
                <td><img src="<?=$r->image?>" width="50" height="50"></td>
                <td><?=cutnchar($r->note)?></td>
                <td>
                <a href="<?=base_url()?>product/update/<?=$r->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                <a href="<?=base_url()?>product/delete/<?=$r->id?>" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"><i class="fa fa-trash-o"></i> Delete </a>
                </td>
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








