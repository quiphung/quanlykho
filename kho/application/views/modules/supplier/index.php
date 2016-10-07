<div class="row supplier">
  <div class="x_panel">
    <div class="x_title">
      <h2>Nhà cung cấp<small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
       <div class="col-md-12 createbtn"><button class="btn btn-success"><i class="fa fa-plus"></i>Thêm nhà cung cấp</button></div>
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
                <th class="column-title" style="width: 10%">Tên</th>
                <th class="column-title" style="width: 10%">Số điện thoại</th>
                <th class="column-title" style="width: 15%">Địa chỉ</th>
                <th class="column-title" style="width: 10%">Email</th>
                <th class="column-title" style="width: 10%">Mã số thuế</th>
                <th class="column-title" style="width: 15%">Công ty</th>
                <th class="column-title" style="">Ghi chú</th>
                <th class="column-title" style="width:10%">Action</th>
              </tr>
            </thead>

            <tbody>
            <?php foreach($row as $r): ?>
              <tr class="even pointer">
                <td class=""><?=$stt++?></td>
                <td><?=$r->name?></td>
                <td><?=$r->phone?></td>
                <td><?=cutnchar($r->address,50)?></td>
                <td><?=$r->email?></td>
                <td><?=$r->tax_code?></td>
                <td><?=$r->company?></td>
                <td><?=cutnchar($r->note,50)?></td>
                <td>
                <a href="<?=base_url()?>supplier/update/<?=$r->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                <a href="<?=base_url()?>supplier/delete/<?=$r->id?>" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')"><i class="fa fa-trash-o"></i> Delete </a>
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








