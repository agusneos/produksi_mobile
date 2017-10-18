<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('master/m_security','record');
        $this->auth->restrict();
    }
    
    function index(){
        if (isset($_GET['grid'])){
            echo $this->record->index();      
        }
        else {
            $this->load->view('master/v_security'); 
        }
    } 
    
    function create() {
        if(!isset($_POST))	
            show_404();

        $m_security_name     = addslashes($_POST['m_security_name']);
        $m_security_username = addslashes($_POST['m_security_username']);
        $m_security_password = addslashes($_POST['m_security_password']);
        
        echo $this->record->create($m_security_name, $m_security_username, $m_security_password);
    }     
    
    function update($m_security_id=null) {
        if(!isset($_POST))	
            show_404();
        
        $m_security_name     = addslashes($_POST['m_security_name']);
        $m_security_username = addslashes($_POST['m_security_username']);
        $m_security_password = addslashes($_POST['m_security_password']);
        
        echo $this->record->update($m_security_id, $m_security_name, $m_security_username, $m_security_password);
    }
        
    function delete(){
        if(!isset($_POST))	
            show_404();

        $m_security_id = addslashes($_POST['m_security_id']);
        
        echo $this->record->delete($m_security_id);
    }     
}

/* End of file security.php */
/* Location: ./application/controllers/master/security.php */