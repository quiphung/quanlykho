<div class="row product">
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên sản phẩm<span class="required">*</span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="name" value="<?php echo (set_value('name'))?set_value('name'):''; ?>">
          </div>
        </div>
        <?php /*
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select class="form-control" name="cate">
            <?php foreach($row as $k=>$v): ?>
              <option value="<?=$k?>"><?=$v?></option>
            <?php endforeach; ?>
            </select>
          </div>
        </div>
        */ ?>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Ảnh đại diện<span></span></label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="hinh" name="avatar" type="text" size="60" value="<?=set_value('avatar')?>" />
            <input type="button" value="Browse Server" onclick="BrowseServer( 'Images:/', 'hinh' );" />
            <p><small>File types hợp lệ: png, jpg, gif.</small></p>
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
<script type="text/javascript" src="<?=base_url()?>lib/ckfinder/ckfinder.js"></script>
<script type="text/javascript">

function BrowseServer( startupPath, functionData )
{
  // You can use the "CKFinder" class to render CKFinder in a page:
  var finder = new CKFinder();

  // The path for the installation of CKFinder (default = "/ckfinder/").
  finder.basePath = '../';

  //Startup path in a form: "Type:/path/to/directory/"
  finder.startupPath = startupPath;

  // Name of a function which is called when a file is selected in CKFinder.
  finder.selectActionFunction = SetFileField;

  // Additional data to be passed to the selectActionFunction in a second argument.
  // We'll use this feature to pass the Id of a field that will be updated.
  finder.selectActionData = functionData;

  // Name of a function which is called when a thumbnail is selected in CKFinder.
  finder.selectThumbnailActionFunction = ShowThumbnails;

  // Launch CKFinder
  finder.popup();
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl, data )
{
  document.getElementById( data["selectActionData"] ).value = fileUrl;
}

// This is a sample function which is called when a thumbnail is selected in CKFinder.
function ShowThumbnails( fileUrl, data )
{
  // this = CKFinderAPI
  var sFileName = this.getSelectedFile().name;
  document.getElementById( 'thumbnails' ).innerHTML +=
      '<div class="thumb">' +
        '<img src="' + fileUrl + '" />' +
        '<div class="caption">' +
          '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
        '</div>' +
      '</div>';

  document.getElementById( 'preview' ).style.display = "";
  // It is not required to return any value.
  // When false is returned, CKFinder will not close automatically.
  return false;
}
  </script>







