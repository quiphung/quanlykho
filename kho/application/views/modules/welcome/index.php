<div class="row welcome">
  <div class="x_panel">
    <div class="x_title">
      <h2><small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
      <p><i class="fa fa-heart" aria-hidden="true"></i>
      Hôm nay có <?php echo($today)?'<a href="'.base_url().'banhang/index/0/'.$dateToday.'"><span>'.$today.'</span></a>':0 ?> đơn hàng cần giao</p>
      <p><i class="fa fa-heart" aria-hidden="true"></i>
      Ngày mai có <?php echo($tomorrow)?'<a href="'.base_url().'banhang/index/0/'.$dateTomorrow.'"><span>'.$tomorrow.'</span></a>':0 ?> đơn hàng cần giao</p>
      
    </div>
  </div>
</div>








