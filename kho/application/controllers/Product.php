<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('string');
		$this->load->model('qlk');
		$this->load->helper('date');
		$this->load->helper('paginationconfig');
		$this->load->helper('mystring_helper');
		if(!$this->session->warehouse_id){
			redirect('taikhoan/login');
		}
	}
	function index()
	{
		$rs 			=	$this->db->get('products');
		$currentPage 	= 	$this->uri->segment(3,1);
		$config 		=	paginationConfig();
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'product/index/';
		$config['total_rows'] = count($rs);
		$this->pagination->initialize($config);
		$rs = $this->db->select('id,image,name,note')->order_by('id','desc')->get_where('products',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
		if($rs->num_rows()>0){
			foreach($rs->result() as $v){
				$data['row'][] =	$v;
			}
		}
		$data['stt']	= 1;
		$data['view'] = 'modules/product/index';
		$this->load->view('layout/home',$data);
	}
	function insert(){
		if($this->input->post('name')){
			//print_r($_POST);
			$this->form_validation->set_rules(
				'name',
				'Tên sản phẩm', 
				'trim|required|xss_clean|html_escape|is_unique[products.name]',
				array(
					'required' 	=> 'Không được để trống %s.',
					'is_unique'	=>	'Tên sản phẩm đã tồn tại'
				)
			);
			//$this->form_validation->set_rules('cate', 'Danh mục', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('avatar', 'Ảnh đại diện', 'trim|xss_clean');
			$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
				# code...
				$dataInsert = array(
					'name' 			=> $this->input->post('name'),
					//'category_id' 	=> $this->input->post('cate'),
					'image'			=> $this->input->post('avatar'),
					'note'			=> $this->input->post('note')
				);
				if(!$this->db->insert('products',$dataInsert)){
					$data['thongbao'] = 'Đã xảy ra lỗi, thêm không thành công';
				}
				else{
					redirect('product');
				}
			}
		}
		//$data['category'] = $this->qlk->getallcategory_name();
		//$datacate = $this->qlk->danhmucall(); 
		//$data['row'] = $this->qlk->danhmuc3(0,$datacate,'');
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view']	= 	'modules/product/insert';
		$this->load->view('layout/home',$data);
	}
	function update(){
		$id = $this->uri->segment(3,0);
		if($this->input->post('name')){
			//print_r($_POST);
			$this->form_validation->set_rules(
				'name',
				'Tên sản phẩm', 
				'trim|required|xss_clean|html_escape',
				array(
					'required' 	=> 'Không được để trống %s.',
				)		
			);
			//$this->form_validation->set_rules('cate', 'Danh mục', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('avatar', 'Ảnh đại diện', 'trim|xss_clean');
			$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
				# code...
				if($this->qlk->checkproductname($id,$this->input->post('name'))==true){
					$data['thongbao'] = 'Tên sản phẩm đã tồn tại';
				}
				else{
					$dataUpdate = array(
					'name' 			=> $this->input->post('name'),
					//'category_id' 	=> $this->input->post('cate'),
					'image'			=> $this->input->post('avatar'),
					'note'			=> $this->input->post('note')
					);
					if(!$this->db->update('products',$dataUpdate,array('id'=>$id))){
						$data['thongbao'] = 'Đã xảy ra lỗi, cập nhật không thành công';
					}
					else{
						redirect('product');
					}
				}
			}
		}
		$data['r']		= $this->qlk->getproduct_id($id);
		//$data['category'] = $this->qlk->getallcategory_name();
		//$datacate = $this->qlk->danhmucall(); 
		//$data['row'] = $this->qlk->danhmuc3(0,$datacate,'');
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view']	= 	'modules/product/update';
		$this->load->view('layout/home',$data);
	}
	function delete(){
		$id = $this->uri->segment(3,0);
		if(!$this->db->delete('products',array('id'=>$id))){
			echo 'Đã xảy ra lỗi xóa không thành công';
			die();
		}
		else{
			redirect('product');
		}
	}
}
