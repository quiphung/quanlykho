<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nhapkho extends CI_Controller {
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
		$rs 			=	$this->db->get('warehouse_enter');
		$currentPage 	= 	$this->uri->segment(3,1);
		$config 		=	paginationConfig();
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'nhapkho/index/';
		$config['total_rows'] = $rs->num_rows();
		$this->pagination->initialize($config);
		$rs = $this->db->select('id,total_money,paid,entry_at,status,supplier,note,user')
						->order_by('id','desc')->get_where('warehouse_enter',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
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
					$rs = $this->qlk->getproductid($m[1]);
					if(is_array($rs)&&count($rs)>0){
						$data = '';
						foreach($rs as $k=>$v){
							
							$data 	.= 	'<a href="#">';
							$data	.=	'<p class="product_id">SP'.$v->id.'<input type="hidden" value="'.$v->id.'"></p>';
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
					$rs = $this->qlk->getproductname($key);
					if(is_array($rs)&&count($rs)>0){
						$data = '';
						foreach($rs as $k=>$v){
							$data 	.= 	'<a href="#">';
							$data	.=	'<p class="product_id">SP'.$v->id.'<input type="hidden" value="'.$v->id.'"></p>';
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
      product_id = $(this).children(".product_id").text();
      product_name = $(this).children(".product_name").text();
      url = "'.base_url().'nhapkho/insert_product"; 
      $.ajax({
        method:"post",
        url: url,
        data:{id:product_id,name:product_name},
        success:function(d){
        //show_product(); 
        	$(".entrywarehouse .tbproduct tbody").append(d);
        	update_stt();
        	loadjs();
        }
      });
    })
})
</script>';
			}
		}
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
			$this->form_validation->set_rules('idsp[]', 'Mã sản phẩm', 'trim|required|xss_clean');
			$this->form_validation->set_rules('quantity[]', 'Số lượng', 'trim|required|xss_clean');
			$this->form_validation->set_rules('costprice[]', 'Số lượng', 'trim|xss_clean');
			$this->form_validation->set_rules('price[]', 'Giá bán', 'trim|xss_clean');
			$this->form_validation->set_rules('supplier', 'Nhà cung cấp', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('total_money', 'Tiền hàng', 'trim|xss_clean|html_escape');
			//$this->form_validation->set_rules('paid', 'Còn nợ', 'trim|xss_clean|html_escape');
			//$this->form_validation->set_rules('hinhthuc', 'Hình thức thanh toán', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('user', 'Người tạo', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('status', 'Tình trạng', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == TRUE) {
				# code...
				$dataInsert = array(
					'total_money' 	=> $this->input->post('total_money'),
					//'paid' 			=> $this->input->post('paid'),
					//'hinhthuc' 		=> $this->input->post('hinhthuc'),
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
			if(is_array($rs)&&count($rs)>0){
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
	function update(){
		$id = $this->uri->segment(3,0);
		$this->remove_all();
		$data['detail'] = 	$this->qlk->getwarehousedetail($id);
		foreach($data['detail'] as $r){
			$pd_id[] 	= 'SP'.$r->product_id;
		}
		$this->session->set_userdata('pd_id',$pd_id);
		$data['id'] = $id;
		$data['enter'] 	= 	$this->qlk->getwarehouse_enter($id);
		$data['view']	=	'modules/nhapkho/update';
		$this->load->view('layout/home',$data);
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
				//$this->form_validation->set_rules('paid', 'Còn nợ', 'trim|xss_clean|html_escape');
				//$this->form_validation->set_rules('hinhthuc', 'Hình thức thanh toán', 'trim|xss_clean|html_escape');
				$this->form_validation->set_rules('status', 'Tình trạng', 'trim|xss_clean|html_escape');
				if ($this->form_validation->run() == TRUE) {
					# code...
					$dataUpdate = array(
						'total_money' 	=> $this->input->post('total_money'),
						//'paid' 			=> $this->input->post('paid'),
						//'hinhthuc' 		=> $this->input->post('hinhthuc'),
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
	function delete(){
		$id = intval($this->uri->segment(3,0));
		$this->db->delete('warehouse_detail',array('insert_id'=>$id));
		$this->db->delete('warehouse_enter',array('id'=>$id));
		redirect('nhapkho');
	}
}
