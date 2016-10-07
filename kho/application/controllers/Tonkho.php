<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tonkho extends CI_Controller {
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
	function index()
	{
		$rsall 			=	$this->db->get('warehouse');
		$currentPage 	= 	$this->uri->segment(3,1);
		$config 		=	paginationConfig();
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'tonkho/index/';
		$config['total_rows'] = $rsall->num_rows();
		$this->pagination->initialize($config);
		$rs = $this->db->order_by('quantity','desc')->get_where('warehouse',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
		if($rs->num_rows()>0){
			foreach($rs->result() as $v){
				$data['row'][] =	$v;
			}
		}
		$data['totalProducts'] = $rsall->num_rows();
		$data['totalQuantity'] = 0;
		if($rsall->num_rows()>0){
			foreach($rsall->result() as $v){
				$data['totalQuantity'] +=	$v->quantity;
			}
		}
		$data['stt']	= 1;
		$data['view'] = 'modules/tonkho/index';
		$this->load->view('layout/home',$data);
	}
	function ajaxwarehousedetail(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$rs = $this->qlk->getwarehousedetail_pdid($id);
			if(is_array($rs)&&count($rs)>0){
				$data 	= '';
				$stt 	= 1;
				foreach($rs as $r){
					$data .= '<tr><td>'.$stt++.'</td>';
					$data .= '<td>PN'.$r->insert_id.'</td>';
					$data .= '<td>'.date('d/m/Y H:i:s' ,$this->qlk->gettime($r->insert_id)).'</td>';
					$data .= '<td>'.$r->costprice.'</td>';
					$data .= '<td>'.$r->price.'</td>';
					$data .= '<td>'.$r->quantity.'</td></tr>';
				}
				echo $data;
			}
		}
	}
	function ajaxsearch(){
		if($this->input->post('key')){
			$this->form_validation->set_rules('key', 'key', 'trim|required|xss_clean|html_escape');
			if ($this->form_validation->run() == TRUE) {
				# code...
				$key	=	$this->input->post('key');
				$partern = '/sp(.*)/i';
				preg_match($partern, $key,$m); 
				if(count($m)>0){
					$rs = $this->qlk->getproductid_warehouse($m[1]);
					if(is_array($rs)&&count($rs)>0){
						$data = '';
						foreach($rs as $k=>$v){
							
							$data 	.= 	'<a href="#">';
							$data	.=	'<p class="product_id">SP'.$v->id.'<input type="hidden" value="'.$v->id.'"></p>';
							$data	.=	'<p class="product_name">'.$v->name.'<input type="hidden" value="'.$v->name.'"></p></a>';
						}
						echo $data;
					}else{
						echo '<p><i>Không tìm thấy kết quả phù hợp</i></p>';
					}
					
				}
				else{
					$rs = $this->qlk->getproductname_warehouse($key);
					if(is_array($rs)&&count($rs)>0){
						$data = '';
						foreach($rs as $k=>$v){
							$data 	.= 	'<a href="#">';
							$data	.=	'<p class="product_id">SP'.$v->id.'<input type="hidden" value="'.$v->id.'"></p>';
							$data	.=	'<p class="product_name">'.$v->name.'<input type="hidden" value="'.$v->name.'"></p></a>';
						}
						echo $data;
					}
					else{
						echo '<p><i>Không tìm thấy kết quả phù hợp</i></p>';
					}
				}	
				echo "<script>$('.warehouse_search .resultsearch a').click(function(){
					      url = urlck+'tonkho/ajaxwarehouse';
					      id  = $(this).find('.product_id input').val();
					      $.ajax({
					      	method : 'post',
					      	url : url,
					      	data : {id:id},
					      	success: function(d){
					      		$('.warehouse .tonkho tbody').html(d);
					      		loadjswarehouse();
					      	}
					      })
					    })</script>";
			} 
		}
	}
	function ajaxwarehouse(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$rs =	$this->db->get_where('warehouse',array('product_id'=>$id));
			if($rs->num_rows()>0){
				$data = '';
				foreach($rs->result() as $r){
					$data .= '<tr class="even pointer"><td class="">1</td>';
					$data .= '<td class="product_id">SP'.$r->product_id.'<input type="hidden" value="'.$r->product_id.'"></td>';
		            $data .= '<td class="product_name">'.$this->qlk->getproductname_id($r->product_id).'</td>';    
		            $data .= '<td class="">'.number_format($r->costprice).'</td>';
		            $data .= '<td class="">'.number_format($r->price).'</td>';
		            $data .= '<td class=" last">'.$r->quantity.'</td></tr>';
				}
				echo $data;
			}
		}
	}
	function delete(){
		$id = $this->uri->segment(3,0);
		$this->db->delete('warehouse',array('product_id'=>$id));
		redirect('tonkho');
	}
}

