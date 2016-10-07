<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('string');
		$this->load->model('qlk');
		$this->load->helper('date');
		$this->load->helper('paginationconfig');
		$this->load->helper('mystring_helper');
		if(!$this->session->warehouse_id || $this->session->warehouse_level != 0){
			redirect('taikhoan/login');
		}
	}
	function index()
	{
		$rs 			=	$this->db->get_where('warehouse_user',array('level !='=>0));
		$currentPage 	= 	$this->uri->segment(3,1);
		$config 		=	paginationConfig();
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'user/index/';
		$config['total_rows'] = $rs->num_rows();
		$this->pagination->initialize($config);
		$rs = $this->db->order_by('level')->get_where('warehouse_user',array('level !='=>0),$config['per_page'],($currentPage-1)*$config['per_page']);
		if($rs->num_rows()>0){
			foreach($rs->result() as $v){
				$data['row'][] =	$v;
			}
		}
		$data['level'] = array('1'=> 'Nhân viên kho','2'=>'Nhân viên bán hàng');
		$data['stt']	= 1;
		$data['view'] = 'modules/user/index';
		$this->load->view('layout/home',$data);
	}
	function insert(){
		if($this->input->post('name')){
			//print_r($_POST);
			$config = array(
				        array(
				                'field' => 'name',
				                'label' => 'Họ tên',
				                'rules' => 'trim|required|xss_clean|html_escape',
				        ),
				        array(
				                'field' => 'username',
				                'label' => 'Tên đăng nhập',
				                'rules' => 'trim|required|is_unique[warehouse_user.username]|xss_clean|html_escape',
				        ),
				        array(
				                'field' => 'password',
				                'label' => 'Password',
				                'rules' => 'trim|required|xss_clean|html_escape|sha1',
				        ),
				        array(
				                'field' => 'repass',
				                'label' => 'Nhập lại mật khẩu',
				                'rules' => 'trim|required|xss_clean|html_escape|callback_repass_check',

				        ),
				        array(
				                'field' => 'level',
				                'label' => 'Phân quyền',
				                'rules' => 'trim|xss_clean|html_escape|is_numeric',
				        ),
				        array(
				                'field' => 'email',
				                'label' => 'Email',
				                'rules' => 'trim|xss_clean|html_escape|valid_email',
				        ),
				        array(
				                'field' => 'phone',
				                'label' => 'Điện thoại',
				                'rules' => 'trim|xss_clean|html_escape',
				        ),
				        array(
				                'field' => 'address',
				                'label' => 'Địa chỉ',
				                'rules' => 'trim|xss_clean|html_escape',
				        ),
				    );
			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', 'Bạn phải nhập {field}');
			$this->form_validation->set_message('is_unique', '{field} đã tồn tại');
			$this->form_validation->set_message('valid_email', 'Email không hợp lệ');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
				# code...
				$dataInsert = array(
								'name' 		=> set_value('name'),
								'username'	=> set_value('username'),
								'password'	=>	set_value('password'),
								'phone'		=>	set_value('phone'),
								'address'	=>	set_value('address'),
								'level'		=>	set_value('level'),
								'email'		=> set_value('email')
							);
				if(!$this->db->insert('warehouse_user',$dataInsert)){
					$data['thongbao'] = 'Đã xảy ra lỗi, thêm không thành công';
				}
				else{
					redirect('user');
				}
			}
		}
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view'] = 'modules/user/insert';
		$this->load->view('layout/home',$data);
	}
	function update(){
		$id = $this->uri->segment(3,0);
		$data['r'] = $this->qlk->getuserid($id);
		if($this->input->post('name')){
			//print_r($_POST);
			$config = array(
				        array(
				                'field' => 'name',
				                'label' => 'Họ tên',
				                'rules' => 'trim|required|xss_clean|html_escape',
				        ),
				        array(
				                'field' => 'username',
				                'label' => 'Tên đăng nhập',
				                'rules' => 'trim|required|xss_clean|html_escape',
				        ),
				        array(
				                'field' => 'password',
				                'label' => 'Mật khẩu',
				                'rules' => 'trim|xss_clean|html_escape|sha1',
				        ),
				        array(
				                'field' => 'passnew',
				                'label' => 'Mật khẩu mới',
				                'rules' => 'trim|xss_clean|html_escape|sha1',

				        ),
				        array(
				                'field' => 'repass',
				                'label' => 'Nhập lại mật khẩu',
				                'rules' => 'trim|xss_clean|html_escape|sha1',

				        ),
				        array(
				                'field' => 'level',
				                'label' => 'Phân quyền',
				                'rules' => 'trim|xss_clean|html_escape|is_numeric',
				        ),
				        array(
				                'field' => 'email',
				                'label' => 'Email',
				                'rules' => 'trim|xss_clean|html_escape|valid_email',
				        ),
				        array(
				                'field' => 'phone',
				                'label' => 'Điện thoại',
				                'rules' => 'trim|xss_clean|html_escape',
				        ),
				        array(
				                'field' => 'address',
				                'label' => 'Địa chỉ',
				                'rules' => 'trim|xss_clean|html_escape',
				        ),
				    );
			$this->form_validation->set_rules($config);
			$this->form_validation->set_message('required', 'Bạn phải nhập {field}');
			$this->form_validation->set_message('is_unique', '{field} đã tồn tại');
			$this->form_validation->set_message('valid_email', 'Email không hợp lệ');
			if ($this->form_validation->run() == FALSE) {
				# code...
				$data['thongbao'] = validation_errors();
			} else {
				# code...
				$upload = 1;
				$checkusername = $this->qlk->checkusername($this->input->post('username'),$id);
				if($checkusername!=false){
					$data['thongbao'] = 'Tên đăng nhặp đã tồn tại';
					$upload = 0;
				}
				else{
					if($this->input->post('password')){
						if(set_value('password')!=$data['r']->password){
							$data['thongbao'] = 'Mật khẩu không đúng';
							$upload = 0;
						}
						else{
							if($this->input->post('passnew')){
								if($this->input->post('passnew')!=$this->input->post('repass')){
									$data['thongbao'] = 'Mật khẩu nhập lại không trùng khớp';
									$upload = 0;
								}
								else{
									$dataUpdate = array(
										'name' 		=> 	set_value('name'),
										'username'	=> 	set_value('username'),
										'password'	=>	set_value('passnew'),
										'phone'		=>	set_value('phone'),
										'address'	=>	set_value('address'),
										'level'		=>	set_value('level'),
										'email'		=> 	set_value('email')
									);
								}
							}
							else{
								$dataUpdate = array(
									'name' 		=> 	set_value('name'),
									'username'	=> 	set_value('username'),
									'phone'		=>	set_value('phone'),
									'address'	=>	set_value('address'),
									'level'		=>	set_value('level'),
									'email'		=> 	set_value('email')
								);
							}
						}
					}
					else{
						$dataUpdate = array(
									'name' 		=> 	set_value('name'),
									'username'	=> 	set_value('username'),
									'phone'		=>	set_value('phone'),
									'address'	=>	set_value('address'),
									'level'		=>	set_value('level'),
									'email'		=> 	set_value('email')
								);
					}
					if($upload == 1){
						if(!$this->db->update('warehouse_user',$dataUpdate,array('id'=>$id))){
							$data['thongbao'] = 'Đã xảy ra lỗi, cập nhật không thành công';
						}
						else{
							redirect('user');
						}
					}
				}
			}
		}
		$csrf = array(
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
		);
		$data['csrf'] 	= $csrf;
		$data['view'] = 'modules/user/update';
		$this->load->view('layout/home',$data);
	}
	function delete(){
		$id = $this->uri->segment(3,0);
		$this->db->delete('warehouse_user',array('id'=>$id));
		redirect('user');
	}
	function repass_check($str){
		if ($str != $this->input->post('password'))
        {
                $this->form_validation->set_message('repass_check', 'Mật khẩu nhập lại không đúng');
                return FALSE;
        }
       	return TRUE;
	}
}
