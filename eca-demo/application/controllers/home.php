<?php

/*
 * Created on Feb 9, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

if (!defined('BASEPATH'))
	exit ('No direct script access allowed');
	
session_start();

class Home extends CI_Controller {
	
	function __construct() {
    	parent::__construct();
  	}

	/**
	 * Index Page for this controller.
	 * 
	 */
	public function index() {
		$this->load->helper(array('form'));
		$this->load->view('templates/header');
		
		if($this->session->userdata('logged_in')) {
      		$session_data = $this->session->userdata('logged_in');
      		$data['username'] = $session_data['username'];
      		$this->load->view('history_request', $data);
    	} else {
      		//If no session, show login
      		$this->load->view('login');
		}

		$this->load->view('templates/footer');
	}
}

?>