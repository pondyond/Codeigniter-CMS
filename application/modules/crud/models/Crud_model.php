<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends MY_Model {
   		
    protected $table 		= 'crud';
	public    $fields 		= array('id'		=>'id',
									'email'		=>'email',
									'password'	=>'password',
									'status'	=>'status');
	public    $validate 	= array(array('field' => 'email', 		'label' => 'Email',			'rules' => 'required|xss_clean'),
							    	array('field' => 'pass', 		'label' => 'Password',		'rules' => 'required|xss_clean'));
	
	public function __construct(){
        parent::__construct();
		 dump_r($this->db->list_fields('crud'));
    }
	
	public function create_process($post){
		$this->load->library('phpass');
    	$password = 1 ; //$this->phpass->hash($post['pass']);
    	$data = array('email'      => $post['email'],
		           	  'password'   => $password,
		              'status'     => 1);
		return $data;
    }	
}