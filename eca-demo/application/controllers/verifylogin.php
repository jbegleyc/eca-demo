<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user','',TRUE);
  }

  function index()
  {
  	$username = $this->input->post('username');
  	$password = $this->input->post('password');
  	
  	//query the database
    $result = $this->user->login($username, $password);
    
    if($result) {
      $sess_array = array();
      foreach($result as $row) {
        $sess_array = array(
          'id' => $row->id,
          'username' => $row->user
        );
        $this->session->set_userdata('logged_in', $sess_array);
      }
    }
    
    redirect('home', 'refresh');
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    
    //query the database
    $result = $this->user->login($username, $password);
    
    if($result)
    {
      $sess_array = array();
      foreach($result as $row)
      {
        $sess_array = array(
          'id' => $row->id,
          'username' => $row->user
        );
        $this->session->set_userdata('logged_in', $sess_array);
      }
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'Invalid username or password');
      return false;
    }
  }
}
?>