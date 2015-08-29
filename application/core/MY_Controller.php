<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	protected $validate;
	protected $model;
	
	public function __construct(){
        parent::__construct();
    }
	
	/*
	 'data'				=> (*)insert data 
	 'validate'			=> validation array
	 'template'			=> view template file
	 'view_data'		=> array(array('var_name'=>1,'value'=>2))
	 * */
	protected function _create($args){        
        if($this->input->post('submit')){
        	
            //validation values
			if( isset($args['validate']) ){
				$validate = $args['validate'];
			}else{
				$validate = $this->{$this->model}->validate;
			}
			
            if($this->{$this->model}->validate($validate) == TRUE){
                $rid = $this->{$this->model}->create($args['data']);
                if($rid){
                    logdb($rid);    
                    $this->session->set_flashdata('messages', array('type'=>'success','title'=>'Insert Successful...!','message'=>''));
                    redirect(current_url());
                }
            }
        }
		
        $data = array(
            'title'         => $this->router->fetch_class(),
            'sub_title'     => $this->router->fetch_method().'.',
            'messages'      => $this->session->flashdata('messages'),
            'validation'    => array('message'=>validation_errors('<li>', '</li>')),
            );
			
		//view data
		if( isset($args['view_data']) ){
			foreach ($args['view_data'] as $key => $value) {
				$data[$value['var_name']] = $value['value'];
			}
		}
		
		//view template file
		if( isset($args['template']) ){
			$template = $args['template'];
		}else{
			$template = 'create';
		}
		
        $this->load->view($template, $data);
    }
	
	/*
	 'default_sort_by'	=> if not set: set default search to id to desc
	 'fields'			=> (*)table columns 
	 'template'			=> view template file
	 'view_data'		=> array(array('var_name'=>1,'value'=>2))
	 * */
	protected function _read($args){
		if( ! isset($args['default_sort_by']) ){
			$default_sort_by = $this->{$this->model}->primary_key;
		}else{
			$default_sort_by = $args['default_sort_by'];
		}
		
        $this->session->set_userdata('current_url', current_url());        
        if($this->session->userdata('sort') == NULL){
			$this->session->set_userdata('sort', array('by'=>$default_sort_by,'sort_value'=>'desc'));
		}		
        if($this->input->post('search_value')){
            $this->session->set_userdata('search', $this->input->post());
        }		
        if($this->input->post('sort_value')){
            $this->session->set_userdata('sort', $this->input->post());
        }
        if($this->input->post('reset')){
            $this->session->unset_userdata('search');
            $this->session->unset_userdata('sort');
            redirect(current_url());
        }
		
		$pagi_conf = $this->config->item('pagi_conf');		         
       	$pagi_conf['base_url'] = current_url();
		$pagi_conf['per_page'] = 16;		
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
        $pagi_conf['total_rows'] = $this->{$this->model}->record_count($this->session->userdata('search'));		
       	$this->pagination->initialize($pagi_conf);
		
        $data = array(
            'title'         => $this->router->fetch_class(),
            'sub_title'     => $this->router->fetch_method().'.',
            'result'       	=> $this->{$this->model}->read($args['fields'],$pagi_conf['per_page'], $page,$this->session->userdata('search'),$this->session->userdata('sort')),
            'search_data'   => $this->session->userdata('search'),
            'sort_data'     => $this->session->userdata('sort'),
            
            'links'         => $this->pagination->create_links(),
            'messages'      => $this->session->flashdata('messages'),
            );
			
		//view data
		if( isset($args['view_data']) ){
			foreach ($args['view_data'] as $key => $value) {
				$data[$value['var_name']] = $value['value'];
			}
		}
		
		//view template file
		if( isset($args['template']) ){
			$template = $args['template'];
		}else{
			$template = 'read';
		}
		
        $this->load->view($template, $data);
    }

	/*
	 'refer_by'	=> table refer by column name
	 'refer'	=> (*)refer value
	 'data'		=> (*)
	 'validate'	=> validation array
	 'template'	=> view template file
	 'view_data'=> array(array('var_name'=>1,'value'=>2))  
	 * */
	public function _update($args){
        if($this->input->post('submit')){
        	
        	//validation values
			if( isset($args['validate']) ){
				$validate = $args['validate'];
			}else{
				$validate = $this->{$this->model}->validate;
			}
			
            if($this->{$this->model}->validate($validate) == TRUE){
				//if not set reffer by
				if( !isset($args['refer_by']) ){
					$refer_by = $this->{$this->model}->primary_key;
				}else{
					$refer_by = $args['refer_by'];
				}
				
                if($this->{$this->model}->update($refer_by,$args['refer'],$args['data'])){
                    logdb($args['refer']);
                    $this->session->set_flashdata('messages', array('type'=>'success','title'=>'Update Successful...!','message'=>''));
                    redirect($this->session->userdata('current_url'));
                }
            }
        }
		
        $data = array(
            'title'         => $this->router->fetch_class(),
            'sub_title'     => $this->router->fetch_method().'.',
            'messages'      => $this->session->flashdata('messages'),
            'validation'    => array('message'=>validation_errors('<li>', '</li>')),
            );
		
		//view data
		if( isset($args['view_data']) ){
			foreach ($args['view_data'] as $key => $value) {
				$data[$value['var_name']] = $value['value'];
			}
		}
		
		//view template file
		if( isset($args['template']) ){
			$template = $args['template'];
		}else{
			$template = 'create';
		}
				
        $this->load->view($template, $data);
    }


	/*
	 'refer_by'	=> table refer by column name
	 'refer'	=> (*)refer value
	 'data'		=> (*)
	 * */
	public function _update_status($args){
        if( ! isset($args['refer_by']) ){
			$refer_by = $this->{$this->model}->primary_key;
		}else{
			$refer_by = $args['refer_by'];
		}
		
        if($this->{$this->model}->update($refer_by,$args['refer'],$args['data'])){
            logdb($args['refer']);
            $this->session->set_flashdata('messages', array('type'=>'success','title'=>'Update Successful...!','message'=>''));
            redirect($this->session->userdata('current_url'));
        }
    }

	public function _delete($id){
        $this->{$this->model}->delete($id);
		logdb($id);
        $this->session->set_flashdata('messages', array('type'=>'danger','title'=>'Delete Successful...!','message'=>''));
        redirect($this->session->userdata('current_url'));
    }
}