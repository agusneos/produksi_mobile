<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_students extends CI_Model
{    
    static $table1 = 'm_students';
    static $table2 = 'm_parents';
     
    function __construct() {
        parent::__construct();
    }

    function index(){
        $this->db->select('m_students_id, m_students_name, m_students_parents, m_parents_name');
        $this->db->join(self::$table2, 'm_students_parents=m_parents_id', 'left');
        $query  = $this->db->get(self::$table1);
                   
        $data = array();
        foreach ( $query->result() as $row ) {
            array_push($data, $row); 
        }
 
        $result = array();
	$result['rows'] = $data;
        
        return json_encode($result);          
    }   
        
    function create($m_students_name, $m_students_parents){
        $query = $this->db->insert(self::$table1,array(
            'm_students_name'       => $m_students_name,
            'm_students_parents'    => $m_students_parents
        ));
        if($query){
            return json_encode(array('success'=>true));
        }
        else{
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }        
    }
    
    function update($m_students_id, $m_students_name, $m_students_parents){
        $this->db->where('m_students_id', $m_students_id);
        $query = $this->db->update(self::$table1,array(
            'm_students_name'       => $m_students_name,
            'm_students_parents'    => $m_students_parents
        ));
        if($query){
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
    
    function delete($m_students_id) {
        $query = $this->db->delete(self::$table1, array('m_students_id' => $m_students_id));
        if($query) {
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
    
    function getParents(){
        $this->db->select('m_parents_id, m_parents_name');
        $query  = $this->db->get(self::$table2);
                   
        $data = array();
        foreach ( $query->result() as $row ){
            array_push($data, $row); 
        }       
        return json_encode($data);
    }        
}

/* End of file m_students.php */
/* Location: ./application/models/master/m_students.php */