<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testtopdf extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('string');
		$this->load->model('qlk');
		$this->load->helper('date');
		$this->load->helper('paginationconfig');
		$this->load->helper('phpToPDF');
	}
	function index()
	{
		$my_html="<HTML><h2>PDF from HTML using phpToPDF</h2></HTML>";
		/*
	    //Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
	    $pdf_options = array(
	      "source_type" => 'html',
	      "source" => $my_html,
	      "action" => 'save',
	      "save_directory" => 'pdf',
	      "file_name" => 'my_filename.pdf');
	    */
	      $url = base_url().'Testtopdf/data';
	      $pdf_options = array(
	      "source_type" => 'url',
          "source" => $url,
          "action" => 'save',
          "save_directory" => 'pdf',
	      "file_name" => 'my_filename2.pdf');
	    //Code to generate PDF file from options above
	    phptopdf($pdf_options);
	}
	function data(){
		$this->load->view('layout/data');
	}
	function createpdf(){
		$this->load->helper('pdf_helper');
		$this->load->view('pdfreport');
	}
}
