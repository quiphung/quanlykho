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
          <section class="login_content">
            <form method="post">
              <h1>Login Form</h1>
              <p style="color:red"><?php echo(isset($thongbao))?$thongbao:''?></p>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="username" value="<?=set_value('username')?>" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit">Log in</button>
                <a class="reset_pass" href="#" id="quen">Lost your password?</a>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <div id='che'></div>
<div id='divpopup'>
<div class="row-fluid">
<div class="login-box">
  <form class="form-horizontal" method="post" id='sendmail' onsubmit="abc()">
   <section class="login_content">
      <form method="post" id="sendmail">
        <h1>Forget Password</h1>
        <p id='thongbao' style="color:#EA3C00">Hãy nhập địa chỉ email bạn đã đăng ký</p>
        <div>
          <input type="text" class="form-control"  name="email" id="email" type="text" placeholder="Email" required="" />
        </div>
        <div class="clearfix"></div>
        <div class="separator">
          <div class="clearfix"></div>
          <br />
        </div>
      </form>
    </section>
  </form>
  <div class="button-login">  
    <button id='gui' class="btn ">Gửi</button>
    <button id='huy' class="btn ">Đóng</button>
  </div>
</div></div>
</div>
  </body>
</html>
<style type="text/css">
  #che { width:100%; height:100%; background-color:#000; 
   position:absolute; z-index:1000; top:0; left:0; display:none}
  #divpopup{position:fixed; top:100px; z-Index:1111; width:435px; 
   height:330px; display:none; border-radius: 5px;   }
   #divpopup .btn{
      margin-bottom: 15px;
   }
   #quen{
      padding-left: 10px;
   }
   #quen:hover{
    cursor: pointer;

   }
   #thongbao{
    text-shadow: none;
    font-size: 14px;
   }
   .button-login{
    text-align: right;
   }
   .login_content{
    padding-left: 10px;
    padding-right: 10px;
   }
</style>
<script type="text/javascript">
  $(document).ready(function(e){
    $('#quen').click(function(){
      $('#che').fadeTo(100,0.8,hienform);
    });
  });
  function hienform(){  
  var L= (screen.width-$("#divpopup").width())/2;
  $("#divpopup").css("left", L + "px");
  $("#divpopup").show(200);
  }
  </script>
  <script type="text/javascript">
  $("#gui").click(function abc(){
    //alert(123);
  $("#thongbao").html('Đang xử lý...');
  var data = $("#sendmail").serialize(); 
  $.post("<?=base_url()?>taikhoan/forget",data, 
      function(d) { $("#thongbao").html(d);} 
  );    
  return false;
  });
</script>
<script type="text/javascript">
  $("#huy").click(function(){
    $("#divpopup").slideUp();   
    $("#che").hide(200);
  });

</script>