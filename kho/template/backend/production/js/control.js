 /*
 $(document).ready(function(){
    $('.numberformat').number(true);
    /*
    //xóa 1 sản phẩm
    $('.entrywarehouse .product .action').click(function(){
      $(this).parent('.last').parent('.product').remove();
      //Cập nhật giá tiền hàng ở form thanh toán
      updateprices();
      //cập nhật tiền còn nợ
      update_owe();
      update_stt();
    }); 
    // thay đổi giá vốn hoặc số lượng
    $('.entrywarehouse .product .change').keyup(function(){
    quantity  = $(this).parent().parent('.product').find('.quantity').val();
    costprice =  $(this).parent().parent('.product').find('.costprice').val();
    sum = quantity*costprice;
    //cập nhật giá cột thành tiền
    $(this).parent().parent('.product').find('.sum').val(sum);
    //Cập nhật giá tiền hàng ở form thanh toán
    updateprices();
    });
    //Thay đổi tiền đã thành toán ở form thanh toán
    $('.thanhtoan .paid').keyup(function(){
      // Cập nhật tiền còn nợ
      update_owe();
    });
})*/  
//Cập nhật giá tiền hàng ở form thanh toán
function updateprices(){
  var total = 0;
  $('.entrywarehouse .product .sum').each(function(){
      var value = $(this).val();
      if(!isNaN(value) && value.length != 0) {
        total += parseFloat(value);
      }
  });
  $('.thanhtoan .prices').val(total);
}
//Cập nhật tiền còn nợ
function update_owe(){
  price = $('.thanhtoan input.prices').val();
  paid  = $('.thanhtoan input.paid').val(); 
  owe   = price - paid;
  $('.thanhtoan .owe').val(owe);
}
 function update_stt(){
  $('.entrywarehouse .product .stt').each(function(){
    stt = $(this).closest('tr').index();
    $(this).text(stt+1);
  });
}
function show_product(){
  url = urlck+"nhapkho/show_product";
  $(".entrywarehouse .tbproduct tbody").load(url,function(){
    loadjs();
    //Cập nhật giá tiền hàng ở form thanh toán
    updateprices();
      //cập nhật tiền còn nợ
    update_owe();
  });
}
function loadjs(){
  url = urlck+'nhapkho/loadjs';
  $('#script').load(url);
}
$(document).ready(function(){
  $('.formsearch').submit(function(){
    return false;
  });
  $('.formsearch input')
  .keyup(function(){
    if($(this).val()==''){
      $('.resultsearch').html('').hide(100);
    }
    else{
        key = $('.formsearch').serialize();
        url = urlck+'nhapkho/getproduct';
        $('.resultsearch').show(100);
        $.post(url,key,function(d){
          $('.resultsearch').show(100);
          $('.resultsearch').html(d);
          /*
          var obj = jQuery.parseJSON( d );
          $.each( obj, function( key, value ) {
            $('.resultsearch').append('<a href="#" class="alk" ><p class="product_id">SP'+key+'</p><p class="product_name">'+value+'</p></a>');
          });*/
        });
    }
  });
});
$(document).ready(function(){
  $('.submit').click(function(){
      data  = $('.entrywarehouse, .forminfo, .thanhtoan').serialize();
      url   = urlck+'nhapkho/insert_pd';
      $.post(url,data,function(){
        window.location.href = urlck+'nhapkho';
      });
      return false;
    });
  $('.thanhtoan .goback').click(function(){
    window.location.href = urlck+'nhapkho';
    return false;
  });
  $("body").click(function(e){
    if(e.target.class !== 'searchproduct' ||e.target.class !== 'supplier_input'){
      $('.formsearch input').val('');
      $('.resultsearch').hide(100);
      //$('.warehousecreate .supplier .supplier_name').reset();
      $('.warehousecreate .supplier .supplier_result').html('').hide();
    }      
  });
});
// index
$(document).ready(function(e){
    $('.phieunhap tr').click(function(){
    $('body').animate({ scrollTop: 0 }).css({'height':'100%','overflow':'hidden'});
    $('#che').fadeTo(0,0.8,hienform);
    pn_id       = $(this).find('.pn_id').text();
    entry_at    = $(this).find('.entry_at').text();
    supplier    = $(this).find('.supplier').text();
    total_money = $(this).find('.total_money').text();
    paid        = $(this).find('.paid').text();
    status      = $(this).find('.status').text();
    note        = $(this).find('.status input').val();
    user        = $(this).find('.user').text();
    own         = $(this).find('.paid input').val();
    $('.pndetail .info .pn_id span').text(pn_id);
    $('.pndetail .info .entry_at span').text(entry_at);
    $('.pndetail .info .supplier span').text(supplier);
    $('.pndetail .info .status span').text(status);
    $('.pndetail .info .user span').text(user);
    $('.pndetail .note textarea').text(note);
    $('.pndetail .money .total_money span').text(total_money);
    $('.pndetail .money .paid span').text(paid);
    $('.pndetail .money .own span').text(own);
    url = urlck+'nhapkho/ajaxpndetail';
    id = $(this).find('.pn_id input').val();
    $('#divpopup .pn_id input').val(id);
    /*
    $('.pndetail .goupdate').click(function(){
      window.location.href = urlck+'nhapkho/update/'+id;
    });*/
    $.ajax({
      method : 'post',
      url : url,
      data :{id:id},
      success: function(d){
        $('.pndetail .tbdetail table tbody').html(d);
        $('.pndetail .money .quantity span').text( $('.pndetail .tbdetail table tr').length-1);
      }
    });
    $('.goupdate, .huy').remove();
    url = urlck+'nhapkho/ajaxbtndetail';
    $.ajax({
      method : 'post',
      url : url,
      data :{id:id},
      success: function(d){
        $('.control').append(d);
      }
    });
  });
  // button tạo phiếu click
  $('.warehouseindex .createbtn button').click(function(){
    window.location.href = urlck+'nhapkho/create';
  });
  $('.pndetail .pdf').click(function(){
    url = urlck+'nhapkho/printpdf/'+id;
    window.open(url,'_blank')
  })
});
function hienform(){  
var L= (screen.width-$("#divpopup").width())/2;
$("#divpopup").css("left", L + "px");
$("#divpopup").slideDown(200);
$("#divpopup .close").css("right", L-20 + "px").show();
}
$(document).ready(function(){
  $('#divpopup .btn-danger, #divpopup .close').click(function(){
    $("#pndetail .close").hide();
    $("#divpopup").slideUp(100);   
    $("#che").hide();
    $('body').css({'height':'auto','overflow':'initial'});
  });
});
$(document).ready(function(){
  $('.warehousecreate .supplier .btn').click(function(){
    $('body').animate({ scrollTop: 0 }).css({'height':'100%','overflow':'hidden'});
    $('.create_che').fadeTo(0,0.8,show_create_popup); 
  });
  $('.create_popup .popup_close,.create_popup .close i').click(function(){
    //$(".create_popup .close").hide();
    $(".create_popup").slideUp(200);   
    $(".create_che").hide();
    $('body').css({'height':'auto','overflow':'initial'});
    return false;
  });
  $('.create_popup .popup_submit').click(function(){
    if($('.create_popup .name input').val()==''){
      alert('Bạn phải nhập tên nhà cung cấp');
    }
    else{
      data = $('.create_popup form').serialize();
      url = urlck+'nhapkho/insert_supplier'
      $.ajax({
        method : 'post',
        url : url,
        data : data,
        success : function(d){
          $(".create_popup").slideUp(200);   
          $(".create_che").hide();
          $('body').css({'height':'auto','overflow':'initial'});
        }
      });
    }
    return false;
  });
  $('.warehousecreate .supplier .supplier_name').keyup(function(){
    key = $(this).val();
    if(key == ''){
      $('.supplier .supplier_result').hide().html('');
    }
    else{
      url  = urlck+'nhapkho/getsuppliername';
      $.ajax({
        url : url,
        data : {key:key},
        method: 'post',
        success: function(d){
          $('.supplier .supplier_result').show().html(d);
        }
      });
    }
  });
  $('.btnDeleteNhapKho').click(function(){
    result = confirm('Em có chắc muốn xóa không?');
    if(result){
      id = $('#divpopup .pn_id input').val();
      url = urlck+'nhapkho/delete/'+id;
      window.location.href = url;
    }
  });
});
function show_create_popup(){ 
var L= (screen.width-$(".create_popup").width())/2;
$(".create_popup").css("left", L + "px");
$(".create_popup").slideDown(200);
//$(".create_popup .close").css("right", L-20 + "px").show();
}
//update
$(document).ready(function(){
  loadjs();
  $('.supplier_name_checked span').click(function(){
    $('.supplier_name_checked div:last-child p').text('');
    $('.supplier_name_checked').hide();
    $('.supplier .supplier_input .supplier_id').val(0);
  });
})
//tonkho index
$(document).ready(function(){
  loadjswarehouse();
  $('.warehouse_search_form').submit(function(){
      return false;
    });
    $('.warehouse_search input').keyup(function(){
      key = $(this).val();
      url = urlck+'tonkho/ajaxsearch';
      $.ajax({
        method : 'post',
        url : url,
        data : {key:key},
        success: function(d){
          $('.warehouse_search .resultsearch').show().html(d);
        }
      })
    });
    $('.warehouse_search input').blur(function(){
      if($(this).val()==''){
        location.reload();
      }
      else{
        $('.reload').show();
      }
    });
    $('.warehouse .reload span').click(function(){
      location.reload();
    });
});
function show_warehouse_popup(){
  var L= (screen.width-$(".warehouse_popup").width())/2;
  $(".warehouse_popup").css("left", L + "px");
  $(".warehouse_popup").slideDown(200);
  $(".warehouse_popup .close").css("right", L-20 + "px").show();
 }
function loadjswarehouse(){
  $(document).ready(function(){
  $('.tonkho tr').click(function(){
    $('body').animate({ scrollTop: 0 }).css({'height':'100%','overflow':'hidden'});
    $('.warehouse_che').fadeTo(0,0.8,show_warehouse_popup);
    product_id = $(this).find('.product_id').text();
    product_id_val = $(this).find('.product_id').children('input').val();
    product_name = $(this).find('.product_name').text();
    $('.warehouse_popup .product_id span').html(product_id);
    $('.warehouse_popup .product_id input').val(product_id_val);
    $('.warehouse_popup .product_name span').html(product_name);
    url = urlck+'tonkho/ajaxwarehousedetail';
    id  = $(this).find('.product_id input').val();
    $.ajax({
      method : 'post',
      url : url,
      data : {id:id},
      success : function(d){
        $('.warehouse_popup table tbody').html(d);
      }
    }) 
  });

  $('.warehouse_popup .btn-danger, .warehouse_popup .close').click(function(){
    $(".warehouse_popup .close").hide();
    $(".warehouse_popup").slideUp(100);   
    $(".warehouse_che").hide();
    $('body').css({'height':'auto','overflow':'initial'});
  });
  $('.warehouse_popup .control .btnDelete').click(function(){
    result = confirm('Em có chắc chắn muốn xóa?');
    if(result){
      result2 = confirm('Chắc chưa? đừng hối hận đó');
      if(result2){
        id =  $('.warehouse_popup .product_id input').val();
        window.location.href = urlck+'tonkho/delete/'+id;
      }
    }
  });
});
}
//supplier
$(document).ready(function(){
  $('.supplier .createbtn').click(function(){
    window.location.href = urlck+'supplier/insert';
  });
  $('.supplier_update .goback').click(function(){
    window.location.href = urlck+'supplier';
    return false;
  });
})
//user
$(document).ready(function(){
  $('.user .createbtn').click(function(){
    window.location.href = urlck+'user/insert';
  });
  $('.user .goback').click(function(){
    window.location.href = urlck+'user';
    return false;
  });
})

$(document).ready(function(){
  $('.category .createbtn').click(function(){
    window.location.href = urlck+'category/insert';
  });
  $('.cate_update .goback').click(function(){
    window.location.href = urlck+'category';
    return false;
  });
  $('.product .createbtn').click(function(){
    window.location.href = urlck+'product/insert';
  });
  $('.product .goback').click(function(){
    window.location.href = urlck+'product';
    return false;
  });
  $('.nonhacungcap').click(function(){
    if($(this).attr('checked')){
      //$(this).attr('checked',false);
       window.location.href = urlck+'nhapkho';
    }
    else{
      //$(this).attr('checked',true);
      window.location.href = urlck+'nhapkho/nonhacungcap';
    }
  });
  $('.dathanhtoan').click(function(){
    if($(this).attr('checked')){
      //$(this).attr('checked',false);
       window.location.href = urlck+'nhapkho';
    }
    else{
      //$(this).attr('checked',true);
      window.location.href = urlck+'nhapkho/dathanhtoan';
    }
  });
})
$(document).ready(function(){
  $('.numberformat').number(true);
  $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      minDate: 0,
  });
  $('.sale_formsearch').submit(function(){
    return false;
  });
  $('.sale .sale_formsearch input')
  .keyup(function(){
    if($(this).val()==''){
      $('.resultsearch').html('').hide(100);
    }
    else{
        key = $('.sale_formsearch').serialize();
        url = urlck+'banhang/getproduct';
        $('.resultsearch').show(100);
        $.post(url,key,function(d){
          $('.resultsearch').show(100);
          $('.resultsearch').html(d);
        });
    }
  });
  $('.sale .sale_quantity').keyup(function(){
    sale_tongtien();
    /*
    quantity = $(this).val();
    price   = $('.sale .sale_price').val();
    money = quantity*price;
    $('.sale .sale_money').val(money);
    */
  });
  $('.sale .sale_quantity').blur(function(){
    sale_tongtien();
  });
  $('.sale .sale_price').keyup(function(){
    sale_tongtien();
    /*
    price = $(this).val();
    quantity   = $('.sale .sale_quantity').val();
    money = quantity*price;
    $('.sale .sale_money').val(money);
    */
  });
  sale_tongtien();
   $('.sale .product_costprice').blur(function(){
    $('.sale .product_costprice_real').val($(this).val());
   });
  $('.sale .goback').click(function(){
    window.location.href = urlck+'banhang';
  });
  function sale_tongtien(){
    price   = $('.sale .sale_price').val();
    $('.sale .sale_price_real').val(price);
    quantity   = $('.sale .sale_quantity').val();
    money = quantity*price;
    $('.sale .sale_money').val(money);
  }
   $('.sale_index tr.pointer').click(function(){
    $('body').animate({ scrollTop: 0 }).css({'height':'100%','overflow':'hidden'});
    status = $(this).children('.status').children('input').val();
    $('#che').fadeTo(0,0.8,saleShowform(status));
    $('#divpopup .dh_id span').text($(this).children('.dh_id').text());
    $('#divpopup .dh_id input').val($(this).children('.dh_id').children('input').val());
    $('#divpopup .create_at span').text($(this).children('td').children('.create_at').val());
    $('#divpopup .delivery_at input').val($(this).children('.delivery_at').text());
    $('#divpopup .customer span').text($(this).children('td').children('.customer').val());
    $('#divpopup .note textarea').val($(this).children('td').children('.note').val());
    $('#divpopup .masp').text($(this).children('.masp').text());
    $('#divpopup .product_name').text($(this).children('.product_name').text());
    $('#divpopup .quantity').text($(this).children('.quantity').text());
    $('#divpopup .costprice').text($(this).children('.costprice').text());
    $('#divpopup .saleprice').text($(this).children('.saleprice').text());
    if(1==status){
      $('input:radio[name=status][value=1]').prop('checked', true);
    }
    if(0==status){
      $('input:radio[name=status][value=0]').prop('checked', true);
    }
  });
   function saleShowform(status){
    var L= (screen.width-$("#divpopup").width())/2;
    $("#divpopup").css("left", L + "px");
    $("#divpopup").slideDown(200);
    $("#divpopup .close").css("right", L-20 + "px").show();
    if(1==status){
      $('#divpopup .btnupdate').hide();
    }
    if(0==status){
     $('#divpopup .btnupdate').show();
    }
    /*
    if($('input:radio[name=status]:checked').val()==1){
      alert(1);
      $('#divpopup .btnupdate').hide();
    }
    else if($('input:radio[name=status]:checked').val()==0){
      alert(0);
      $('#divpopup .btnupdate').show();
    } */
   }
   $('#divpopup .btnupdate').click(function(){
    url = urlck+'banhang/update';
    data = $('#divpopup .sale_index_form').serialize();
    status = 1;
    $.ajax({
      method: 'post',
      url: url,
      data :data,
      success:function(){
        location.reload();
      }
    });
   });
   $('#divpopup .btnDelete').click(function(){
    result = confirm('Em có chắc muốn xóa đơn hàng này không?');
    if(result){
      url = urlck+'banhang/delete';
      id = $('#divpopup .dh_id input').val();
      status = 0;
      $.ajax({
        method: 'post',
        url: url,
        data :{id:id},
        success:function(){
          location.reload();
        }
      });
    }
   });
   $('.sale_index .createbtn .btn').click(function(){
    window.location.href = urlck+'banhang/insert';
   });
   $('#divpopup .sale_index_form').submit(function(){
    return false;
   });
   /*
   $('.sale_index .checkTime .timeYear select').change(function(){
    if($(this).val()==0){
      $('.sale_index .checkTime .timeMonth').hide(200);
    }else{
      $('.sale_index .checkTime .timeMonth').show(200);
    }
   });
   $('.sale_index .checkTime .timeMonth select').change(function(){
    if($(this).val()==0){
      $('.sale_index .checkTime .timeDay').hide(200);
    }else{
      $('.sale_index .checkTime .timeDay').show(200);
    }
   });*/
   $('.sale_index .checkTime form').submit(function(){
    return false;
   });
   $('.sale_index .checkbtn .btn').click(function(){
    status = $('.sale_index .checkTime .checkstatus').val();
    year = $('.sale_index .checkTime .timeYear select').val();
    month = $('.sale_index .checkTime .timeMonth select').val();
    day = $('.sale_index .checkTime .timeDay select').val();
    window.location.href = urlck+'banhang/index/'+status+'/'+year+'-'+month+'-'+day;
   });
   $('.sale_index .viewall .btn').click(function(){
    window.location.href = urlck+'banhang';
   });
})
