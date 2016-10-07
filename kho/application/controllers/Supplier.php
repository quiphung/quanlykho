<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
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
		$rs 			=	$this->db->get('supplier');
		$currentPage 	= 	$this->uri->segment(3,1);
		$config 		=	paginationConfig();
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'tonkho/index/';
		$config['total_rows'] = $rs->num_rows();
		$this->pagination->initialize($config);
		$rs = $this->db->order_by('name')->get_where('supplier',array(),$config['per_page'],($currentPage-1)*$config['per_page']);
		if($rs->num_rows()>0){
			foreach($rs->result() as $v){
				$data['row'][] =	$v;
			}
		}
		$data['stt']	= 1;
		$data['view'] = 'modules/supplier/index';
		$this->load->view('layout/home',$data);
	}
	function update(){
		$id = $this->uri->segment(3,0);
		if($this->input->post('name')){
			//print_r($_POST);
			$this->form_validation->set_rules(
				'name',
				'Tên công ty', 
				'trim|required|xss_clean|html_escape',
				array(
					'required' => 'Không được để trống %s.'
				)
			);
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|html_escape',array('valid_email'=> 'Email không hợp lệ'));
			$this->form_validation->set_rules('tax_code', 'Mã số thuế', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('company', 'Công ty', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
				# code...
				$dataUpdate = array(
					'name' => $this->input->post('name'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
					'tax_code' => $this->input->post('tax_code'),
					'company' => $this->input->post('company'),
					'address' => $this->input->post('address'),
					'note' => $this->input->post('note'),
				);
				if(!$this->db->update('supplier',$dataUpdate,array('id'=>$id))){
					$data['thongbao'] = 'Đã xảy ra lỗi, cập nhật không thành công';
				}
				else{
					redirect('supplier');
				}
			}
		}
		$data['row']	=	$this->qlk->getsupplierall($id);
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view']	= 	'modules/supplier/update';
		$this->load->view('layout/home',$data);
	}
	function delete(){
		$id = $this->uri->segment(3,0);
		if(!$this->db->delete('supplier',array('id'=>$id))){
			echo 'Đã xảy ra lỗi xóa không thành công';
			die();
		}
		else{
			redirect('supplier');
		}
	}
	function insert(){
		if($this->input->post('name')){
			//print_r($_POST);
			$this->form_validation->set_rules(
				'name',
				'Tên công ty', 
				'trim|required|xss_clean|html_escape',
				array(
					'required' => 'Không được để trống %s.'
				)
			);
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean|html_escape',array('valid_email'=> 'Email không hợp lệ'));
			$this->form_validation->set_rules('tax_code', 'Mã số thuế', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('company', 'Công ty', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'trim|xss_clean|html_escape');
			$this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean|html_escape');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
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
				if(!$this->db->insert('supplier',$dataInsert)){
					$data['thongbao'] = 'Đã xảy ra lỗi, thêm không thành công';
				}
				else{
					redirect('supplier');
				}
			}
		}
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view']	= 	'modules/supplier/insert';
		$this->load->view('layout/home',$data);
	}
}
