<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentallela Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>template/backend/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>template/backend/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>template/backend/production/css/custom.css" rel="stylesheet">
    <script type="text/javascript" src="<?=base_url()?>template/backend/vendors/jquery/jquery-1.12.3.min.js"></script>
  </head>

  <body style="background:#F7F7F7;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>

      <div id="wrapper">
        <div id="login" class=" form">
          <?php
            if(isset($thongbao))
            {
          ?>
            <p style="color: red"><?=$thongbao?> hãy <a href="<?=base_url()?>taikhoan/login"><b>gửi</b></a> lại mail</p>
          <?php   
            }
            else{
          ?>
          <h2>Mật khẩu của bạn là: <span style="font-weight: bold; font-size: 20px"><?=$passnew?></span></h2>   
          <p>Hãy <a href="<?=base_url()?>taikhoan/login"><b>đăng nhập</b></a> lại và đổi mật khẩu mới.</p>   
          <?php } ?> 
        </div>
      </div>
    </div>
  </body>
</html>
