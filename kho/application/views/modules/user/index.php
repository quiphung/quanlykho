<div class="row user">
  <div class="x_panel">
    <div class="x_title">
      <h2>Quản lý nhân viên<small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
       <div class="col-md-12 createbtn"><button class="btn btn-success"><i class="fa fa-plus"></i>Thêm nhân viên</button></div>
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
                <th class="column-title" style="width: 10%">Username</th>
                <th class="column-title" style="width: 20%">Họ tên</th>
                <th class="column-title" style="width: 15%">Chức vụ</th>
                <th class="column-title" style="width: 20%">Email</th>
                <th class="column-title" style="width: 15%">Điện thoại</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
            <?php foreach($row as $r): ?>
              <tr class="even pointer">
                <td class=""><?=$stt++?></td>
                <td><?=$r->username?></td>
                <td><?=$r->name?></td>
                <td><?=$level[$r->level]?></td>
                <td><?=$r->email?></td>
                <td><?=$r->phone?></td>
                <td>
                <a href="<?=base_url()?>user/update/<?=$r->id?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                <a href="<?=base_url()?>user/delete/<?=$r->id?>" class="btn btn-danger btn-xs" onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?')"><i class="fa fa-trash-o"></i> Delete </a>
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








