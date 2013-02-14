<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HistoryResults extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('history','',TRUE);
  }

  function index() {
  	$tmpl = array (
                    'table_open'          => '<table class="flex">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th width="100">',
                    'heading_cell_end'    => '</th>',
                    'table_close'         => '</table>'
              );
  	
  	
  	$acctnum = $this->input->post('acctnum');
  	$query = $this->history->get_history($acctnum);
  	$this->load->library('table');
  	$this->table->set_template($tmpl);
  	$data['table_results'] = $this->table->generate($query);
  	$data['address'] = $this->history->get_address($acctnum);
	
	// get chart data and format it for google charts
	$chartdata = $this->history->get_chart_data($acctnum);
	$chartrows = array();
	foreach ($chartdata as $row) {
		$newrow = array($row['EndDate'], (int)$row['Consumption']);
		$chartrows[] = $newrow; 
	}
	
	$data['chartrecs'] = json_encode(array_reverse($chartrows));
  	
  	$this->load->view('templates/header');
  	$this->load->view('view_history', $data);
  	$this->load->view('templates/footer');
  }
}