<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banhang extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('string');
		$this->load->model('qlk');
		$this->load->helper('date');
		$this->load->helper('paginationconfig');
		if(!$this->session->warehouse_id){
			redirect('taikhoan/login');
		}
	}
	public function index()
	{
		$seg = $this->uri->segment_array();
		if(isset($seg[4])){
			$date = explode('-', $seg[4]);
			$data['checkStatus']	=	$seg[3];
			$data['checkYear'] 		= 	$date[0];
			$data['checkMonth'] 	= 	$date[1];
			$data['checkDay'] 		= 	$date[2];
			if($seg[3]==2){
				if($date[2]!=0){
					$rsall = $this->db->get_where('sale',array('delivery_at'=>$seg[4]));
					$currentPage 	= 	$this->uri->segment(5,1);
					$config 		=	paginationConfig();
					$config['uri_segment'] = 5;
					$config['base_url'] = base_url().'banhang/index/'.$seg[3].'/'.$seg[4].'/';
					$config['total_rows'] = $rsall->num_rows();
					$this->pagination->initialize($config);
					$rs = $this->db->order_by('id','desc')->get_where('sale',array('delivery_at'=>$seg[4]),$config['per_page'],($currentPage-1)*$config['per_page']);
				}elseif($date[1]!=0){
					$rsall = $this->db->get_where('sale',array('month(delivery_at)'=>$date[1],'year(delivery_at)'=>$date[0]));
					$currentPage 	= 	$this->uri->segment(5,1);
					$config 		=	paginationConfig();
					$config['uri_segment'] = 5;
					$config['base_url'] = base_url().'banhang/index/'.$seg[3].'/'.$seg[4].'/';
					$config['total_rows'] = $rsall->num_rows();
					$this->pagination->initialize($config);
					$rs = $this->db->order_by('id','desc')->get_where('sale',array('month(delivery_at)'=>$date[1],'year(delivery_at)'=>$date[0]),$config['per_page'],($currentPage-1)*$config['per_page']);
				}elseif($date[0]!=0){
					$rsall = $this->db->get_where('sale',array('year(delivery_at)'=>$date[0]));
					$currentPage 	= 	$this->uri->segment(5,1);
					$config 		=	paginationConfig();
					$config['uri_segment'] = 5;
					$config['base_url'] = base_url().'banhang/index/'.$seg[3].'/'.$seg[4].'/';
					$config['total_rows'] = $rsall->num_rows();
					$this->pagination->initialize($config);
					$rs = $this->db->order_by('id','desc')->get_where('sale',array('year(delivery_at)'=>$date[0]),$config['per_page'],($currentPage-1)*$config['per_page']);
				}else{
					$rsall = $this->db->get('sale');
					$currentPage 	= 	$this->uri->segment(5,1);
					$config 		=	paginationConfig();
					$config['uri_segment'] = 5;
					$config['base_url'] = base_url().'banhang/index/'.$seg[3].'/'.$seg[4].'/';
					$config['total_rows'] = $rsall->num_rows();
					$this->pagination->initialize($config);
					$rs = $this->db->order_by('id','desc')->get_where('sale',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
				}
			}
			else{
				if($date[2]!=0){
					$rsall = $this->db->get_where('sale',array('delivery_at'=>$seg[4],'status'=>$seg[3]));
					$currentPage 	= 	$this->uri->segment(5,1);
					$config 		=	paginationConfig();
					$config['uri_segment'] = 5;
					$config['base_url'] = base_url().'banhang/index/'.$seg[3].'/'.$seg[4].'/';
					$config['total_rows'] = $rsall->num_rows();
					$this->pagination->initialize($config);
					$rs = $this->db->order_by('delivery_at')->get_where('sale',array('delivery_at'=>$seg[4],'status'=>$seg[3]),$config['per_page'],($currentPage-1)*$config['per_page']);
				}elseif($date[1]!=0){
					$rsall = $this->db->get_where('sale',array('month(delivery_at)'=>$date[1],'year(delivery_at)'=>$date[0],'status'=>$seg[3]));
					$currentPage 	= 	$this->uri->segment(5,1);
					$config 		=	paginationConfig();
					$config['uri_segment'] = 5;
					$config['base_url'] = base_url().'banhang/index/'.$seg[3].'/'.$seg[4].'/';
					$config['total_rows'] = $rsall->num_rows();
					$this->pagination->initialize($config);
					$rs = $this->db->order_by('delivery_at')->get_where('sale',array('month(delivery_at)'=>$date[1],'year(delivery_at)'=>$date[0],'status'=>$seg[3]),$config['per_page'],($currentPage-1)*$config['per_page']);
				}elseif($date[0]!=0){
					$rsall = $this->db->get_where('sale',array('year(delivery_at)'=>$date[0],'status'=>$seg[3]));
					$currentPage 	= 	$this->uri->segment(5,1);
					$config 		=	paginationConfig();
					$config['uri_segment'] = 5;
					$config['base_url'] = base_url().'banhang/index/'.$seg[3].'/'.$seg[4].'/';
					$config['total_rows'] = $rsall->num_rows();
					$this->pagination->initialize($config);
					$rs = $this->db->order_by('delivery_at')->get_where('sale',array('year(delivery_at)'=>$date[0],'status'=>$seg[3]),$config['per_page'],($currentPage-1)*$config['per_page']);
				}else{
					$rsall = $this->db->get_where('sale',array('status'=>$seg[3]));
					$currentPage 	= 	$this->uri->segment(5,1);
					$config 		=	paginationConfig();
					$config['uri_segment'] = 5;
					$config['base_url'] = base_url().'banhang/index/'.$seg[3].'/'.$seg[4].'/';
					$config['total_rows'] = $rsall->num_rows();
					$this->pagination->initialize($config);
					$rs = $this->db->order_by('delivery_at')->get_where('sale',array('status'=>$seg[3]),$config['per_page'],($currentPage-1)*$config['per_page']);
				}
			}
		}
		else{
			$rsall 			=	$this->db->get('sale');
			$currentPage 	= 	$this->uri->segment(3,1);
			$config 		=	paginationConfig();
			$config['uri_segment'] = 3;
			$config['base_url'] = base_url().'banhang/index/';
			$config['total_rows'] = $rsall->num_rows();
			$this->pagination->initialize($config);
			$rs = $this->db->order_by('id','desc')->get_where('sale',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
		}	
		$data['totalCostprice'] = 0;
		$data['totalPrice'] = 0;
		$data['totalQuantity'] = 0;
		if($rsall->num_rows()>0){
			foreach($rsall->result() as $v){
				$data['totalCostprice'] += $v->costprice*$v->quantity;
				$data['totalPrice'] += $v->price*$v->quantity;
				$data['totalQuantity']+=$v->quantity;
			}
		}
		if($rs->num_rows()>0){
			foreach($rs->result() as $v){
				$data['row'][] =	$v;
			}
		}
		$data['status'] =array(0=>'Chờ giao',1=>'Đã giao',2=>'Đã hủy');
		$data['stt']	= 1;
		$data['view'] = 'modules/banhang/index';
		$this->load->view('layout/home',$data);
	}
	function insert(){
		if($this->input->post('name')){
			$this->form_validation->set_rules('product_id', 'Mã sản phẩm', 'trim|required|is_numeric');
			$this->form_validation->set_rules('quantity', 'Số lượng', 'trim|required|is_numeric');
			$this->form_validation->set_rules('costprice_real', 'Giá vốn', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('price', 'Giá bán', 'trim|required|xss_clean|html_escape');
			$this->form_validation->set_rules('customer', 'Khách hàng', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('datepicker', 'Ngày giao', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('status', 'Trạng thái', 'trim|is_numeric|xss_clean|html_escape');
			$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
			$this->form_validation->set_message(array(
				'required' => '%s không được để trống',
				'is_numeric' => '%s phải là một số',
			));
			if ($this->form_validation->run() == false) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
				# code...
				$uploadOK = 1;
				if($this->input->post('tonkho')<$this->input->post('quantity')){
					$data['thongbao'] = "Số lượng bán không thể vượt quá số lượng tồn kho";
					$uploadOK = 0;
				}
				if(1==$this->input->post('status')){
					$delivery_at = date('Y/m/d',now());
				}
				else{
					if($this->input->post('datepicker')!=''){
						$delivery_at = date('Y/m/d',strtotime($this->input->post('datepicker')));
					}
					else{
						$delivery_at = 0;
					}
				}
				if($uploadOK == 1){
					$dataInsert = array(
					'product_id' 	=> 	$this->input->post('product_id'),
					'costprice'		=>	$this->input->post('costprice_real'),
					'price'			=>	$this->input->post('price'),
					'quantity'		=>	$this->input->post('quantity'),
					'status'		=>	$this->input->post('status'),
					'customer'		=>	$this->input->post('customer'),
					'create_at'		=> now(),
					'delivery_at'	=> $delivery_at,
					'note'			=> $this->input->post('note')
					);
					if(!$this->db->insert('sale',$dataInsert)){
						$data['thongbao'] = 'Đã xảy ra lỗi, thêm mới không thành công';
					}
					else{
						if(1==$this->input->post('status')){
							$this->db->set('quantity','quantity -'.$this->input->post('quantity'),false)
										->where('product_id',$this->input->post('product_id'))
										->update('warehouse');
						}
						redirect('banhang');
					}
				}
			}
		}
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view'] = 'modules/banhang/insert';
		$this->load->view('layout/home',$data);
	}
	function update(){
		if($this->input->post('dh_id')){
			//print_r($_POST);
			$this->form_validation->set_rules('dh_id', '', 'trim|required|is_numeric');
			$this->form_validation->set_rules('date', '', 'trim|xss_clean');
			$this->form_validation->set_rules('status', '', 'trim|required|xss_clean');
			$this->form_validation->set_rules('note', '', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == true) {
				# code...
				$qp = $this->qlk->getQuantity_ProductIdStatus0($this->input->post('dh_id'));
				if($qp){
					$delivery_at = date('Y/m/d',strtotime($this->input->post('date')));
				if(1==$this->input->post('status')&&$this->input->post('date')==''){
					$delivery_at = date('Y/m/d',now());
					}
					$dataUpdate = array(
						'delivery_at' 	=> $delivery_at,
						'status'		=> $this->input->post('status'),
						'note'			=> $this->input->post('note'),
					);
					if($this->db->update('sale',$dataUpdate,array('id'=>$this->input->post('dh_id')))){
						$this->db->set('quantity','quantity -'.$qp->quantity,false)
										->where('product_id',$qp->product_id)
										->update('warehouse');
					}
				}
			} 
		}
	}
	function delete(){
		if($this->input->post('id')){
			//echo $this->input->post('id');die();
			$this->db->delete('sale',array('id'=>$this->input->post('id')));
		}
	}
	function create(){
		$this->remove_all();
		$data['view'] = 'modules/nhapkho/create';
		$this->load->view('layout/home',$data);
	}
	function getproduct(){
		if($this->input->post('search')){
			$this->form_validation->set_rules('search', 'Search', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == TRUE) {
				# code...
				$key = $this->input->post('search');
				$partern = '/sp(.*)/i';
				preg_match($partern, $key,$m); 
				if(count($m)>0){
					$rs = $this->qlk->getWarehouse_id($m[1]);
					if(is_array($rs)&&count($rs)>0){
						$data = '';
						foreach($rs as $k=>$v){
							$data 	.= 	'<a href="#">';
							$data	.=	'<p>SP'.$v->product_id.'<input type="hidden" value="'.$v->product_id.'"></p>';
							$data	.=	'<input class="product_id" type="hidden" value="'.$v->product_id.'">';
							$data	.=	'<input class="product_costprice" type="hidden" value="'.$v->costprice.'">';
							$data	.=	'<input class="product_price" type="hidden" value="'.$v->price.'">';
							$data	.=	'<input class="product_quantity" type="hidden" value="'.$v->quantity.'">';
							$data	.=	'<p class="product_name">'.$v->name.'<input type="hidden" value="'.$v->name.'"></p></a>';
							//$data[$v->id][] 		= $v->name;
						}
						//echo json_encode($data);
						echo $data;
					}else{
						echo '<p><i>Không tìm thấy kết quả phù hợp</i></p>';
					}
					
				}
				else{
					$rs = $this->qlk->getWarehouse_name($key);
					if(is_array($rs)&&count($rs)>0){
						$data = '';
						foreach($rs as $k=>$v){
							$data 	.= 	'<a href="#">';
							$data	.=	'<p>SP'.$v->product_id.'<input type="hidden" value="'.$v->product_id.'"></p>';
							$data	.=	'<input class="product_id" type="hidden" value="'.$v->product_id.'">';
							$data	.=	'<input class="product_costprice" type="hidden" value="'.$v->costprice.'">';
							$data	.=	'<input class="product_price" type="hidden" value="'.$v->price.'">';
							$data	.=	'<input class="product_quantity" type="hidden" value="'.$v->quantity.'">';
							$data	.=	'<p class="product_name">'.$v->name.'<input type="hidden" value="'.$v->name.'"></p></a>';
							//$data[$v->id][] 		= $v->name;
						}
						//echo json_encode($data);
						echo $data;
					}
					else{
						echo '<p><i>Không tìm thấy kết quả phù hợp</i></p>';
					}
				}		
echo '<script type="text/javascript">
  $(document).ready(function(){
    $(".resultsearch a").click(function(){
      product_id = $(this).children(".product_id").val();
      product_name = $(this).children(".product_name").text();
      product_costprice = $(this).children(".product_costprice").val();
      product_price = $(this).children(".product_price").val();
      product_quantity = $(this).children(".product_quantity").val();
      $(".sale .product_name").val(product_name);
      $(".sale .product_id").val(product_id);
      $(".sale .product_costprice").val(product_costprice);
      $(".sale .sale_price").val(product_price);
      $(".sale .product_quantity").val(product_quantity);
    })
})
</script>';
			}
		}
	}
	function test(){
		$rs = $this->qlk->getWarehouse_id(2);
		print_r($rs);
	}
	function loadjs(){
		echo "<script type='text/javascript'>
			$(document).ready(function(){
				$('.numberformat').number(true);
			    //xóa 1 sản phẩm
			    $('.entrywarehouse .product .action').click(function(){
			        url = '".base_url()."nhapkho/remove_product';
			        product_id = $(this).parent().parent('.product').find('.idsp').text();
			        $(this).parent('.last').parent('.product').remove();
			      	//Cập nhật giá tiền hàng ở form thanh toán
			      	updateprices();
			      	//cập nhật tiền còn nợ
			     	update_owe();
			     	update_stt();
			        $.ajax({
			          method  : 'post',
			          url     : url,
			          data    : {id:product_id}, 
			        });
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
			        update_owe();
			      });
			      //Thay đổi tiền đã thành toán ở form thanh toán
			      $('.thanhtoan .paid').keyup(function(){
			          // Cập nhật tiền còn nợ
			          update_owe();
			        });
			  })
		</script>";
	}
	function insert_product(){
		if($this->input->post('id')){
			$check = 0;
			if($this->session->userdata('pd_id')){
				foreach($this->session->userdata('pd_id') as $k=>$v){
						$pd_id[] = $v;
						if($v==$this->input->post('id')){
							$check = 1;
						}
				}
			}
			if($check==0){
				$pd_id[] 	= $this->input->post('id');
				$data	= 	'<tr class="even pointer product">';
                $data 	.=  '<td class="stt"></td>';
                $data 	.=  '<td class="idsp">'.$this->input->post('id').'<input type="hidden" name="idsp[]" value="'.$this->input->post('id').'"></td>';
                $data 	.=  '<td class=" ">'.$this->input->post('name').'</td>';
                $data 	.=  '<td class=""><input type="text" name="quantity[]" class="form-control numberformat quantity change" value="1" min="1"></td>
                  <td class=""><input type="text" name="costprice[]" class="form-control numberformat costprice change" min="0"></td>
                  <td ><input class="form-control sum numberformat" readonly=""></td>
                  <td class="price"><input type="text" name="price[]" class="form-control numberformat"  min="0"></td>
                  <td class="last"><a class="action" href="#"><i class="fa fa-times"></i></a>
                  </td>
                </tr>'; 
                echo $data;
			}
			if($this->session->userdata('pd_name')){
				foreach($this->session->userdata('pd_name') as $k=>$v){
					foreach($v as $id=>$name){
						$pd_name[][$id] = $name;
					}
				}
			}
			if($check==0){
				$pd_name[][$this->input->post('id')] 	= $this->input->post('name');
			}
			$this->session->set_userdata('pd_id',$pd_id);
			$this->session->set_userdata('pd_name',$pd_name);
		}
		else{
			//$this->session->sess_destroy();
			//$this->session->unset_userdata('pd_name');
			//$pd_id[] = $this->session->userdata('pd_id');
			//$pd_id[] = 8;
			//$this->session->set_userdata('pd_id',$pd_id);
			
			//print_r($this->session->userdata('pd_id'));
			//echo '<br>';
			//echo '<pre>';
			//print_r($this->session->userdata('pd_name'));
			//echo '</pre>';
		}
	}
	function show_product(){
		$data = '';
		$stt  = 1;
		foreach($this->session->userdata('pd_name') as $k=>$v){
			foreach($v as $id=>$name){
				$data	.= 	'<tr class="even pointer product">';
                $data 	.=  '<td class="stt">'.$stt++.'</td>';
                $data 	.=  '<td class="idsp">'.$id.'<input type="hidden" name="idsp[]" value="'.$id.'"></td>';
                $data 	.=  '<td class=" ">'.$name.'</td>';
                $data 	.=  '<td class=""><input type="text" name="quantity[]" class="form-control numberformat quantity change" value="1" min="1"></td>
                  <td class=""><input type="text" name="costprice[]" class="form-control numberformat costprice change" min="0"></td>
                  <td ><input class="form-control sum numberformat" readonly=""></td>
                  <td class="price"><input type="text" name="price[]" class="form-control numberformat"  min="0"></td>
                  <td class="last"><a class="action" href="#"><i class="fa fa-times"></i></a>
                  </td>
                </tr>';
			}
		}
		echo $data;
	}
	function remove_product(){
		if($this->input->post('id')){
			if($this->session->userdata('pd_id')){
				foreach($this->session->userdata('pd_id') as $k=>$v){
					if($v==$this->input->post('id')){
						unset($pd_id[$k]);
					}else{
						$pd_id[] = $v;
					}
				}
				$this->session->set_userdata('pd_id',$pd_id);
			}
			if($this->session->userdata('pd_name')){
				foreach($this->session->userdata('pd_name') as $k=>$v){
					foreach($v as $id=>$name){
						if($id==$this->input->post('id')){
							unset($pd_name[$k][$v]);
						}
						else{
							$pd_name[][$id] = $name;
						}
					}
				}
				$this->session->set_userdata('pd_name',$pd_name);
			}
		}
	}
	function remove_all(){
		$this->session->unset_userdata('pd_id');
		$this->session->unset_userdata('pd_name');
	}
	function insert_pd(){
		if($this->input->post('idsp')){
			//print_r($_POST);
			$this->form_validation->set_rules('idsp[]', 'Mã sản phẩm', 'trim|required|xss_clean');
			$this->form_validation->set_rules('quantity[]', 'Số lượng', 'trim|required|xss_clean');
			$this->form_validation->set_rules('costprice[]', 'Số lượng', 'trim|xss_clean');
			$this->form_validation->set_rules('price[]', 'Giá bán', 'trim|xss_clean');
			$this->form_validation->set_rules('supplier', 'Nhà cung cấp', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('total_money', 'Tiền hàng', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('paid', 'Còn nợ', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('hinhthuc', 'Hình thức thanh toán', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('user', 'Người tạo', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('status', 'Tình trạng', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == TRUE) {
				# code...
				$dataInsert = array(
					'total_money' 	=> $this->input->post('total_money'),
					'paid' 			=> $this->input->post('paid'),
					'hinhthuc' 		=> $this->input->post('hinhthuc'),
					'entry_at'		=> now(),
					'note' 			=> $this->input->post('note'),
					'status'		=> $this->input->post('status'),
					'supplier'		=> $this->input->post('supplier'),
					'user'			=> $this->input->post('user')
				);
				if($this->db->insert('warehouse_enter',$dataInsert)){
					$insert_id = $this->db->insert_id();
					$idsp = $this->input->post('idsp');
					$quantity = $this->input->post('quantity');
					$costprice = $this->input->post('costprice');
					$price = $this->input->post('price');
					$partern = '/sp(.*)/i';
					for($i=0;$i<count($idsp);$i++){
						preg_match($partern, $idsp[$i],$m); 
						$dataInsert = array(
						'insert_id' 	=> 	$insert_id,
						'product_id'	=>	$m[1],
						'quantity'		=>	$quantity[$i],
						'costprice'		=>	$costprice[$i],
						'price'			=>	$price[$i],
						);
						$this->db->insert('warehouse_detail',$dataInsert);
						if($this->input->post('status')==1){
							$product = $this->qlk->checkproduct($m[1]);
							if($product!=''){
								$dataUpdate = array(
									'quantity'		=>	$product->quantity+$quantity[$i],
									'costprice'		=>	$costprice[$i],
									'price'			=>	$price[$i],
								);
								$this->db->update('warehouse',$dataUpdate,array('id'=>$product->id));
							}
							else{
								$dataInsert = array(
								'product_id'	=>	$m[1],
								'quantity'		=>	$quantity[$i],
								'costprice'		=>	$costprice[$i],
								'price'			=>	$price[$i],
								);
								$this->db->insert('warehouse',$dataInsert);
							}
						}
					}
					$this->remove_all();
				}
				else{
					$thongbao = 'Đã xảy ra lỗi, thêm không thành công';
					echo $thongbao;
				}
			}
		}
	}
	function ajaxpndetail(){
		if($this->input->post('id')){
			$rs = $this->qlk->getwarehousedetail($this->input->post('id'));
			if(count($rs)>0){
				$data = '';
				$stt= 1;
				foreach($rs as $r){
					$data .= '<tr class="even pointer">';
		            $data .= '<td class="">'.$stt++.'</td>';
		            $data .= '<td class="">SP'.$r->product_id.'</td>';
		            $data .= '<td class="">'.$this->qlk->getproductname_id($r->product_id).'</td>';
		            $data .= '<td class="">'.$r->quantity.'</td>';
		            $data .= '<td class="">'.number_format($r->costprice).'</td>';
		            $data .= '<td class="">'.number_format($r->price).'</td></tr>';
				}
				echo $data;
			}
		}
	}
	function ajaxbtndetail(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$status = $this->qlk->checkstatus($id);
			if($status == 0){
				echo '<button class="btn btn-warning huy"><i class="fa fa-times" aria-hidden="true"></i>Hủy</button><button class="btn btn-info goupdate"><i class="fa fa-share" aria-hidden="true"></i>Mở phiếu</button>';
				echo "<script> 
						$('.pndetail .goupdate').click(function(){
					      window.location.href = urlck+'nhapkho/update/$id';
					    });
					    $('.pndetail .huy').click(function(){
					      window.location.href = urlck+'nhapkho/cancel/$id';
					    });
				    </script>";
			}
		}
	}
	function insert_supplier(){
		if($this->input->post('name')){
			//print_r($_POST);
			$this->form_validation->set_rules('name', 'Tên nhà cung cấp', 'trim|required|xss_clean|html_escape');
			$this->form_validation->set_rules('phone', 'Điện thoại', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('tax_code', 'Mã số thuế', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('company', 'Mã số thuế', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == TRUE) {
				# code...
				$dataInsert = array(
					'name' => $this->input->post('name'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
					'tax_code' => $this->input->post('tax_code'),
					'company' => $this->input->post('company'),
					'address' => $this->input->post('address'),
					'note' => $this->input->post('note'),
				);
				$this->db->insert('supplier',$dataInsert);
			}
		}
	}
	function getsuppliername(){
		if($this->input->post('key')){
			$this->form_validation->set_rules('key', 'key', 'trim|required|xss_clean|html_escape');
			if ($this->form_validation->run() == TRUE) {
				# code...
				$rs = $this->qlk->getsuppliername($this->input->post('key'));
				$data = '';
				if(is_array($rs)&&count($rs)>0){
					foreach($rs as $r){
						$data .= '<a href="#"><input type="hidden" value="'.$r->id.'"><p>'.$r->name.'</p></a>';
					}
				}
				else{
					$data .= '<p><i>Không tìm thấy kết quả phù hợp</i></p>';
				}
				echo $data;
				echo "<script>$('.supplier .supplier_result a').click(function(){
							name = $(this).find('p').text();
							id 	= $(this).find('input').val();
							$('.supplier_name_checked').show();
						    $('.supplier_name_checked div:last-child p').text(name);
						    $('.supplier .supplier_input .supplier_id').val(id);
						  });</script>";
			} 
		}
	}

	function ajax_update(){
		$id = $this->uri->segment(3,0);
		if(0==$this->qlk->checkstatus($id)){
			if($this->input->post('idsp')){
				//print_r($_POST);
				$this->form_validation->set_rules('idsp[]', 'Mã sản phẩm', 'trim|required|xss_clean');
				$this->form_validation->set_rules('quantity[]', 'Số lượng', 'trim|required|xss_clean');
				$this->form_validation->set_rules('costprice[]', 'Số lượng', 'trim|xss_clean');
				$this->form_validation->set_rules('price[]', 'Giá bán', 'trim|xss_clean');
				$this->form_validation->set_rules('supplier', 'Nhà cung cấp', 'trim|xss_clean|html_escape');
				$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
				$this->form_validation->set_rules('total_money', 'Tiền hàng', 'trim|xss_clean|html_escape');
				$this->form_validation->set_rules('paid', 'Còn nợ', 'trim|xss_clean|html_escape');
				$this->form_validation->set_rules('hinhthuc', 'Hình thức thanh toán', 'trim|xss_clean|html_escape');
				$this->form_validation->set_rules('status', 'Tình trạng', 'trim|xss_clean|html_escape');
				if ($this->form_validation->run() == TRUE) {
					# code...
					$dataUpdate = array(
						'total_money' 	=> $this->input->post('total_money'),
						'paid' 			=> $this->input->post('paid'),
						'hinhthuc' 		=> $this->input->post('hinhthuc'),
						'entry_at'		=> now(),
						'note' 			=> $this->input->post('note'),
						'status'		=> $this->input->post('status'),
						'supplier'		=> $this->input->post('supplier')
					);
					if($this->db->update('warehouse_enter',$dataUpdate,array('id'=>$id))){
						$this->db->delete('warehouse_detail',array('insert_id'=>$id));
						$idsp = $this->input->post('idsp');
						$quantity = $this->input->post('quantity');
						$costprice = $this->input->post('costprice');
						$price = $this->input->post('price');
						$partern = '/sp(.*)/i';
						for($i=0;$i<count($idsp);$i++){
							preg_match($partern, $idsp[$i],$m); 
							$dataInsert = array(
							'insert_id' 	=> 	$id,
							'product_id'	=>	$m[1],
							'quantity'		=>	$quantity[$i],
							'costprice'		=>	$costprice[$i],
							'price'			=>	$price[$i],
							);
							$this->db->insert('warehouse_detail',$dataInsert);
							if($this->input->post('status')==1){
								$product = $this->qlk->checkproduct($m[1]);
								if($product!=''){
									$dataUpdate = array(
										'quantity'		=>	$product->quantity+$quantity[$i],
										'costprice'		=>	$costprice[$i],
										'price'			=>	$price[$i],
									);
									$this->db->update('warehouse',$dataUpdate,array('id'=>$product->id));
								}
								else{
									$dataInsert = array(
									'product_id'	=>	$m[1],
									'quantity'		=>	$quantity[$i],
									'costprice'		=>	$costprice[$i],
									'price'			=>	$price[$i],
									);
									$this->db->insert('warehouse',$dataInsert);
								}
							}
						}
						$this->remove_all();
					}
					else{
						$thongbao = 'Đã xảy ra lỗi, thêm không thành công';
						echo $thongbao;
					}
				}
			}
		}
	}
	function cancel(){
		$id = $this->uri->segment(3,0);
		$this->db->update('warehouse_enter',array('status'=>2),array('id'=>$id));
		redirect('nhapkho');
	}
	function printpdf(){
		$this->load->helper('pdf_helper');
		$id 	= $this->uri->segment(3,0);
		$row 	= $this->qlk->getwarehouse_enter($id);
		$entry 	= date('d/m/Y H:i:s',$row->entry_at);
		$own	= $row->total_money-$row->paid;
		$total_money 	= number_format($row->total_money);
		$paid 			= number_format($row->paid);
		$data['id'] 	= $id;
		$data['entry'] 	= $entry;
		$data['own'] 	= number_format($own);
		$data['total_money'] = $total_money;
		$data['paid'] 	= $paid;
		$data['row'] 	= $row;
		$data['user']	=	$this->qlk->getuser($row->user);
		$data['supplier']	= $this->qlk->getsupplier($row->supplier);
		$detail 		=	$this->qlk->getwarehousedetail($id);
		$tb = '';
		$stt = 1;
		$total_quantity = 0;
		foreach($detail as $r){
			//$tb .= '<tr><td>'.$stt++.'</td>';
			$tb .= '<tr><td>SP'.$r->product_id.'</td>';
			$tb .= '<td>'.$this->qlk->getproductname_id($r->product_id).'</td>';
			$tb .= '<td>'.$r->quantity.'</td>';
			$tb .= '<td>'.number_format($r->costprice).'</td>';
			$tb .= '<td>'.number_format($r->price).'</td></tr>';
			$data['total_quantity'] +=$r->quantity;
		}
		$data['tb'] = $tb;
		//$my_html="";
	    $this->load->view('pdfreport',$data);
	}
	function nonhacungcap(){
		$rs 			=	$this->db->where('total_money != paid')->get('warehouse_enter');
		$currentPage 	= 	$this->uri->segment(3,1);
		$config 		=	paginationConfig();
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'nhapkho/nonhacungcap/';
		$config['total_rows'] = $rs->num_rows();
		$this->pagination->initialize($config);
		$rs = $this->db->select('id,total_money,paid,entry_at,status,supplier,note,user')
						->order_by('id','desc')->where('total_money != paid')->get_where('warehouse_enter',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
		if($rs->num_rows()>0){
			foreach($rs->result() as $v){
				$data['row'][] =	$v;
			}
		}
		$data['status'] =array(0=>'Lưu tạm',1=>'Đã nhập hàng',2=>'Đã hủy');
		$data['stt']	= 1;
		$data['view'] = 'modules/nhapkho/index';
		$this->load->view('layout/home',$data);
	}
	function dathanhtoan(){
		$rs 			=	$this->db->where('total_money = paid')->get('warehouse_enter');
		$currentPage 	= 	$this->uri->segment(3,1);
		$config 		=	paginationConfig();
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'nhapkho/dathanhtoan/';
		$config['total_rows'] = $rs->num_rows();
		$this->pagination->initialize($config);
		$rs = $this->db->select('id,total_money,paid,entry_at,status,supplier,note,user')
						->order_by('id','desc')->where('total_money = paid')->get_where('warehouse_enter',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
		if($rs->num_rows()>0){
			foreach($rs->result() as $v){
				$data['row'][] =	$v;
			}
		}
		$data['status'] =array(0=>'Lưu tạm',1=>'Đã nhập hàng',2=>'Đã hủy');
		$data['stt']	= 1;
		$data['view'] = 'modules/nhapkho/index';
		$this->load->view('layout/home',$data);
	}
}
