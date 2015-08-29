<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends MY_Controller {
    
	protected $model = 'crud_model';	
	
    public function __construct(){
        parent::__construct();
        $this->load->model($this->model);
		$this->load->library('phpass'); 
    }
    
    public function create(){
		if($this->input->post('submit')){
			$data = $this->{$this->model}->create_process($this->input->post()); 	
		}
		parent::_create(array('data'=>@$data));
    }

    public function read(){
		$view_data = array(array('var_name'=>'sort_options'		,'value'=>array('id'=> 'Id')),
						   array('var_name'=>'search_options'	,'value'=>array('email'=> 'Email')));
		
		parent::_read(array('fields'=>'id,email,password,status','view_data'=>$view_data));
    }
    
    public function update($id){
        $data = array('email'      => $this->input->post('email'),
	                  'password'   => $this->input->post('pass'));				
		
		//form update data 
		$update_data = $this->{$this->model}->get_by(array('fields'=>'id,email,password,status','refer'=>$id));			  
		$view_data = array(array('var_name'=>'form_data','value'=>$update_data));
		
		parent::_update(array('refer'=>$id,'data'=>$data,'view_data'=>$view_data));
    }
    
    public function delete($id){
    	parent::_delete($id);
    }
    
    public function activate($id){
    	$data = array('status' => 1);
		parent::_update_status(array('refer'=>$id,'data'=>$data));
    }
    
    public function deactivate($id){
    	$data = array('status' => 0);
		parent::_update_status(array('refer'=>$id,'data'=>$data));
    }
}