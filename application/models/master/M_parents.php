<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_parents extends CI_Model
{    
    static $table1 = 'm_parents';
     
    function __construct() {
        parent::__construct();
        $this->load->helper('security');
      //  $this->load->helper('database'); // Digunakan untuk memunculkan data Enum
    }

    function index(){
        $this->db->select('m_parents_id, m_parents_name, m_parents_username');
        $query  = $this->db->get(self::$table1);
                   
        $data = array();
        foreach ( $query->result() as $row ) {
            array_push($data, $row); 
        }
 
        $result = array();
	$result['rows'] = $data;
        
        return json_encode($result);          
    }   
        
    function create($m_parents_name, $m_parents_username, $m_parents_password){
        $query = $this->db->insert(self::$table1,array(
            'm_parents_name'        => $m_parents_name,
            'm_parents_username'    => $m_parents_username,
            'm_parents_password'    => do_hash($m_parents_password,'md5')
        ));
        if($query){
            return json_encode(array('success'=>true));
        }
        else{
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }        
    }
    
    function update($m_parents_id, $m_parents_name, $m_parents_username, $m_parents_password){
        if($m_parents_password==''){
            $this->db->where('m_parents_id', $m_parents_id);
            $query = $this->db->update(self::$table1,array(
                'm_parents_name'        => $m_parents_name,
                'm_parents_username'    => $m_parents_username
            ));
        }
        else{
            $this->db->where('m_parents_id', $m_parents_id);
            $query = $this->db->update(self::$table1,array(
                'm_parents_name'        => $m_parents_name,
                'm_parents_username'    => $m_parents_username,
                'm_parents_password'    => do_hash($m_parents_password,'md5')
            ));
        }
        if($query){
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
    
    function delete($m_parents_id) {
        $query = $this->db->delete(self::$table1, array('m_parents_id' => $m_parents_id));
        if($query) {
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
}

/* End of file m_parents.php */
/* Location: ./application/models/master/m_parents.php */