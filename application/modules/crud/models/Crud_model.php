<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends MY_Model {
   		
    protected $table 		= 'crud';
	public    $validate 	= array(array('field' => 'email', 		'label' => 'Email',			'rules' => 'required|xss_clean'),
							    	array('field' => 'pass', 		'label' => 'Password',		'rules' => 'required|xss_clean'));
	
}