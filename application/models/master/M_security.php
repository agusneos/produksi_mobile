<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_security extends CI_Model
{    
    static $table1 = 'm_security';
     
    function __construct() {
        parent::__construct();
        $this->load->helper('security');
    }

    function index(){
        $this->db->select('m_security_id, m_security_name, m_security_username');
        $query  = $this->db->get(self::$table1);
                   
        $data = array();
        foreach ( $query->result() as $row ) {
            array_push($data, $row); 
        }
 
        $result = array();
	$result['rows'] = $data;
        
        return json_encode($result);          
    }   
        
    function create($m_security_name, $m_security_username, $m_security_password){
        $query = $this->db->insert(self::$table1,array(
            'm_security_name'        => $m_security_name,
            'm_security_username'    => $m_security_username,
            'm_security_password'    => do_hash($m_security_password,'md5')
        ));
        if($query){
            return json_encode(array('success'=>true));
        }
        else{
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }        
    }
    
    function update($m_security_id, $m_security_name, $m_security_username, $m_security_password){
        if($m_security_password==''){
            $this->db->where('m_security_id', $m_security_id);
            $query = $this->db->update(self::$table1,array(
                'm_security_name'        => $m_security_name,
                'm_security_username'    => $m_security_username
            ));
        }
        else{
            $this->db->where('m_security_id', $m_security_id);
            $query = $this->db->update(self::$table1,array(
                'm_security_name'        => $m_security_name,
                'm_security_username'    => $m_security_username,
                'm_security_password'    => do_hash($m_security_password,'md5')
            ));
        }
        if($query){
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
    
    function delete($m_security_id) {
        $query = $this->db->delete(self::$table1, array('m_security_id' => $m_security_id));
        if($query) {
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }      
}

/* End of file m_security.php */
/* Location: ./application/models/master/m_security.php */