<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class support extends CI_Controller {

public function __construct()
	{
	
			parent::__construct();
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('form_validation', 'session');
	
	}
	public function index()
	{
		$myuser_id = $this->session->userdata('client_id');
		if($myuser_id!="") {		
			$client_id = $myuser_id;
			$this->load->view('support');
		}
		else {
			redirect('login');
		}
	}
	
}
