<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
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
		/*
		$rs 			=	$this->db->get('categories');
		$currentPage 	= 	$this->uri->segment(3,1);
		$config 		=	paginationConfig();
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'product/index/';
		$config['total_rows'] = $rs->num_rows();
		$this->pagination->initialize($config);
		$rs = $this->db->select('id,category_id,image,name,note')->order_by('id','desc')->get_where('products',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
		if($rs->num_rows()>0){
			foreach($rs->result() as $v){
				$data['row'][] =	$v;
			}
		}*/
		$datacate = $this->qlk->danhmucall(); 
		$data['row'] = $this->qlk->danhmucall2(0,$datacate,'');
		$data['stt']	= 1;
		$data['view'] = 'modules/category/index';
		$this->load->view('layout/home',$data);
	}
	function insert(){
		if($this->input->post('name')){
			//print_r($_POST);
			$this->form_validation->set_rules(
				'name',
				'Tên danh mục', 
				'trim|required|xss_clean|html_escape|is_unique[categories.title]',
				array(
					'required' 	=> 'Không được để trống %s.',
					'is_unique'	=>	'Danh mục đã tồn tại'
				)
			);
			$this->form_validation->set_rules('cate', 'Danh mục cha', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
				# code...
				$dataInsert = array(
					'title' 			=> $this->input->post('name'),
					'parent_id' 	=> $this->input->post('cate'),
				);
				if(!$this->db->insert('categories',$dataInsert)){
					$data['thongbao'] = 'Đã xảy ra lỗi, thêm không thành công';
				}
				else{
					redirect('category');
				}
			}
		}
		//$data['category'] = $this->qlk->getallcategory_name();
		$datacate = $this->qlk->danhmucall(); 
		$data['row'] = $this->qlk->danhmuc3(0,$datacate,'');
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view']	= 	'modules/category/insert';
		$this->load->view('layout/home',$data);
	}
	function update(){
		$id = $this->uri->segment(3,0);
		$data['id'] = $id;
		if($this->input->post('name')){
			//print_r($_POST);
			$this->form_validation->set_rules(
				'name',
				'Tên danh mục', 
				'trim|required|xss_clean|html_escape',
				array(
					'required' 	=> 'Không được để trống %s.',
				)		
			);
			$this->form_validation->set_rules('cate', 'Danh mục', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
				# code...
				if($this->qlk->checkcatename($id,$this->input->post('name'))==true){
					$data['thongbao'] = 'Tên danh mục đã tồn tại';
				}
				else{
					$dataUpdate = array(
					'title' 			=> $this->input->post('name'),
					'parent_id' 	=> $this->input->post('cate'),
					);
					if(!$this->db->update('categories',$dataUpdate,array('id'=>$id))){
						$data['thongbao'] = 'Đã xảy ra lỗi, cập nhật không thành công';
					}
					else{
						redirect('category');
					}
				}
			}
		}
		$data['r']		= $this->qlk->getcategory($id);
		//$data['category'] = $this->qlk->getallcategory_name();
		$datacate = $this->qlk->danhmuc($id); 
		$data['row'] = $this->qlk->danhmuc3(0,$datacate,'');
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view']	= 	'modules/category/update';
		$this->load->view('layout/home',$data);
	}
	function delete(){
		$id = $this->uri->segment(3,0);
		if(!$this->db->delete('categories',array('id'=>$id))){
			echo 'Đã xảy ra lỗi xóa không thành công';
			die();
		}
		else{
			redirect('category');
		}
	}
}
