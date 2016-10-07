<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('qlk');
		$this->load->helper('date');
	}
	public function index()
	{
		$today 		= date('Y/m/d',now());
		$tomorrow 	= date('Y/m/d',strtotime($today)+24*3600);
		$data['today'] = $this->qlk->getSaleDate($today);
		$data['tomorrow'] = $this->qlk->getSaleDate($tomorrow);
		$data['dateToday'] = date('Y-m-d',strtotime($today));
		$data['dateTomorrow'] = date('Y-m-d',strtotime($tomorrow));
		$data['view'] = 'modules/welcome/index';
		$this->load->view('layout/home',$data);
	}
}
