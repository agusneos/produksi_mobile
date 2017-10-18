<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_teacher extends CI_Model
{    
    static $table1 = 'm_teacher';
     
    function __construct() {
        parent::__construct();
        $this->load->helper('security');
      //  $this->load->helper('database'); // Digunakan untuk memunculkan data Enum
    }

    function index(){
        $this->db->select('m_teacher_id, m_teacher_name, m_teacher_username');
        $query  = $this->db->get(self::$table1);
                   
        $data = array();
        foreach ( $query->result() as $row ) {
            array_push($data, $row); 
        }
 
        $result = array();
	$result['rows'] = $data;
        
        return json_encode($result);          
    }   
        
    function create($m_teacher_name, $m_teacher_username, $m_teacher_password){
        $query = $this->db->insert(self::$table1,array(
            'm_teacher_name'        => $m_teacher_name,
            'm_teacher_username'    => $m_teacher_username,
            'm_teacher_password'    => do_hash($m_teacher_password,'md5')
        ));
        if($query){
            return json_encode(array('success'=>true));
        }
        else{
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }        
    }
    
    function update($m_teacher_id, $m_teacher_name, $m_teacher_username, $m_teacher_password){
        if($m_teacher_password==''){
            $this->db->where('m_teacher_id', $m_teacher_id);
            $query = $this->db->update(self::$table1,array(
                'm_teacher_name'        => $m_teacher_name,
                'm_teacher_username'    => $m_teacher_username
            ));
        }
        else{
            $this->db->where('m_teacher_id', $m_teacher_id);
            $query = $this->db->update(self::$table1,array(
                'm_teacher_name'        => $m_teacher_name,
                'm_teacher_username'    => $m_teacher_username,
                'm_teacher_password'    => do_hash($m_teacher_password,'md5')
            ));
        }
        if($query){
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
    
    function delete($m_teacher_id) {
        $query = $this->db->delete(self::$table1, array('m_teacher_id' => $m_teacher_id));
        if($query) {
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }   
}

/* End of file m_teacher.php */
/* Location: ./application/models/master/m_teacher.php */