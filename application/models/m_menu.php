<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_menu extends CI_Model
{
    static $table1  = 'm_menu';
    
    function __construct() {
        parent::__construct();
        $this->load->helper('security');
    }
    
    function ambil_menu($id){
        $this->db->where('m_menu_id', $id);        
        $rs = $this->db->get(self::$table1);
        $result  = array();
        foreach ( $rs->result() as $row ){
            $node = array();
            $node['id']         = $row->m_menu_id;
            $node['text']       = $row->m_menu_name;
            $node['uri']        = $this->link_menu($row->m_menu_uri);
            array_push($result, $node);
        }
        return json_encode($result);
    }
    
    function link_menu($link){
        if ($link != ''){
            return site_url($link);
        } 
        else{
            return 'empty';
        }
    }
    
    function reset($table, $id, $user_password){
        if($table=='m_security'){
            $this->db->where('m_security_id', $id);
            $query = $this->db->update('m_security',array(
                'm_security_password'   => do_hash($user_password,'md5')
            ));
        }elseif ($table=='m_parents') {
            $this->db->where('m_parents_id', $id);
            $query = $this->db->update('m_parents',array(
                'm_parents_password'   => do_hash($user_password,'md5')
            ));
        }else {
            $this->db->where('m_teacher_id', $id);
            $query = $this->db->update('m_teacher',array(
                'm_teacher_password'   => do_hash($user_password,'md5')
            ));
        }
        
        if($query){
            return json_encode(array('success'=>true));
        }
        else {
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
}

/* End of file m_menu.php */
/* Location: ./application/models/m_menu.php */