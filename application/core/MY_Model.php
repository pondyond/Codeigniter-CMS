<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
        
    protected $table;
	protected $skip_validation;
	public 	  $primary_key 		= 'id';
	protected $status			= 'status';
	
	public function __construct(){
        parent::__construct();		
    }
		    
    public function create($data){
    	
        if($this->db->insert($this->table,$data)){
            return $this->db->insert_id();
        }else{
            return FALSE;
        }
    }
	
	public function record_count($search){
		if(isset($search['search'])){
	        $this->db->like($search['by'],$search['search_value']);
			$this->db->select($this->primary_key);
			$q = $this->db->get($this->table);
			return $q->num_rows();
	    }else{
			return $this->db->count_all($this->table);	
		}
	}
    
    public function read($fields,$limit,$start,$search,$sort){
	    if(isset($search['search'])){
	        $this->db->like($search['by'],$search['search_value']);
	    }                                
      	if(isset($sort['by'])){
            $this->db->order_by($sort['by'],$sort['sort_value']);
        }   
             $this->db->limit($limit, $start);
             $this->db->select($fields);
		$q = $this->db->get($this->table);     
        if($q->num_rows()>0){
            return $q->result_array();    
        }else{
            return FALSE;
        }                      
    } 
	
    public function update($key,$value,$data){        
        if($this->db->where($key, $value)->update($this->table, $data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function delete($id){
        $this->db->delete($this->table, array($this->primary_key => $id)); 
    }
    
	/* $args
		    'fields'	=> (*)table fiels
			'refer_by'	=> table refer by column name
			'refer'		=> (*)refer value
			'where'		=> array(),
			'limit'		=>  
	 */
    public function get_by($args){
		//if no where close
		if( ! isset($args['where']) ){
			if( ! isset($args['refer_by']) ){
				$refer_by = array($this->primary_key => $args['refer']);
			}else{
				$refer_by = array($args['refer_by'] => $args['refer']);
			}	
		}else{
			$refer_by = $args['where'];
		}	
		
		//if limit not set
		if( ! isset($args['limit']) ){
			$limit = 1;
		}else{
			$limit = $args['limit'];
		}
		
		//exicute query	
        $q = $this->db->select($args['fields'])->get_where($this->table, $refer_by, $limit);
		
		//check resut
        if ($q->num_rows() == 1){
           return $q->row_array();
        }
		if ($q->num_rows() > 1){
			return $q->resut_array();
		}
    }
	
	/* $args
		'field1'	=> table field 1
	 	'field2'	=> table field 2
	 	'table'		=> 
	 */
    public function drop_down($args){
    	
		//table
		if( ! isset($args['table']) ){
			$table = $this->table;
		}else{
			$table = $args['table'];
		}
		
		$fields = "{$args['field1']},{$args['field2']}";
    	$q = $this->db->select($fields)->get($table);
		$rows[''] = 'Select';
		foreach ($q->result_array() as $key => $value) {
			$rows[$value[$args['field1']]] = $value[$args['field2']];
		}
		return $rows;
    }
    
	public function validate($validate){
        if($this->skip_validation){
            return TRUE;
        }else{
            $this->form_validation->set_rules($validate);
            if ($this->form_validation->run() === TRUE){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
    }
	
}