<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quản lý kho</title>
    <!-- Bootstrap -->
    <link href="<?=base_url()?>template/backend/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>template/backend/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=base_url()?>template/backend/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url()?>template/backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
    <link href="<?=base_url()?>template/backend/production/css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>
    <link href="<?=base_url()?>template/backend/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?=base_url()?>template/backend/vendors/bootstrap-select-master/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?=base_url()?>template/backend/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?=base_url()?>template/backend/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="<?=base_url()?>template/backend/vendors/dist/css/bootstrap-tagsinput.css">
    <link href="<?=base_url()?>template/backend/production/css/custom.css" rel="stylesheet">
    <link href="<?=base_url()?>template/backend/production/js/jquery-ui/jquery-ui.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?=base_url()?>template/backend/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url()?>template/backend/vendors/bootstrap-select-master/dist/js/bootstrap-select.min.js"></script>
    <script src="<?=base_url()?>template/backend/production/js/jquery.number.min.js"></script>
    <script src="<?=base_url()?>template/backend/production/js/control.js"></script>
    <script src="<?=base_url()?>template/backend/production/js/jquery-ui/jquery-ui.js"></script>
    <script type="text/javascript">
      var urlck = "<?=base_url()?>";
    </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?=base_url()?>" class="site_title"><i class="fa fa-paw"></i> <span>Quản lý kho</span></a>
            </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$this->session->userdata('warehouse_hoten');?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <div class="clearfix"></div>
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="<?=base_url()?>welcome"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <?php /*
                   <li><a href="<?=base_url()?>category"><i class="fa fa-folder-o" aria-hidden="true"></i> Danh mục</a>
                  </li>
                  */ ?>
                  <li><a href="<?=base_url()?>product"><i class="fa fa-square-o" aria-hidden="true"></i>Sản phẩm</a>
                  </li>
                  <li><a href="<?=base_url()?>nhapkho"><i class="fa fa-sign-in" aria-hidden="true"></i>Nhập kho</a>
                  </li>
                  <li><a href="<?=base_url()?>tonkho"><i class="fa fa-bars" aria-hidden="true"></i>Tồn kho</a>
                  </li>
                  <li><a href="<?=base_url()?>banhang"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đơn hàng</a>
                  </li>
                  <li><a href="<?=base_url()?>supplier"><i class="fa fa-truck" aria-hidden="true"></i>Nhà cung cấp</a>
                  </li>
                <?php if($this->session->warehouse_id && $this->session->warehouse_level == 0):?>
                  <li><a href="<?=base_url()?>user"><i class="fa fa-users" aria-hidden="true"></i>Nhân viên</a>
                  </li>
                <?php endif; ?>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?=$this->session->warehouse_hoten?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?=base_url()?>taikhoan/update">  Profile</a>
                    </li>
                    <li><a href="<?=base_url()?>taikhoan/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <?php $this->load->view($view);?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright <a href="#">Lê Qui Phụng</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
  </body>
</html>
 <!-- Bootstrap -->
    <script src="<?=base_url()?>template/backend/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>template/backend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
     <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url()?>template/backend/vendors/bootstrap/dist/js/bootstrap-tagsinput.min.js"></script>
    <script src="<?=base_url()?>template/backend/vendors/bootstrap/dist/js/bootstrap-tagsinput-angular.min.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?=base_url()?>template/backend/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <script src="<?=base_url()?>template/backend/vendors/switchery/dist/switchery.min.js"></script>
    <script src="<?=base_url()?>template/backend/vendors/select2/dist/js/select2.full.min.js"></script>
    

    <script src="<?=base_url()?>template/backend/vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="<?=base_url()?>template/backend/vendors/starrr/dist/starrr.js"></script>
    <!-- iCheck -->
    <script src="<?=base_url()?>template/backend/vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>template/backend/production/js/custom.js"></script>