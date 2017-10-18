<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parents extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('master/m_parents','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        if (isset($_GET['grid'])){
            echo $this->record->index();      
        }
        else {
            $this->load->view('master/v_parents'); 
        }
    } 
    
    function create() {
        if(!isset($_POST))	
            show_404();

        $m_parents_name     = addslashes($_POST['m_parents_name']);
        $m_parents_username = addslashes($_POST['m_parents_username']);
        $m_parents_password = addslashes($_POST['m_parents_password']);
        
        echo $this->record->create($m_parents_name, $m_parents_username, $m_parents_password);
    }     
    
    function update($m_parents_id=null) {
        if(!isset($_POST))	
            show_404();
        
        $m_parents_name     = addslashes($_POST['m_parents_name']);
        $m_parents_username = addslashes($_POST['m_parents_username']);
        $m_parents_password = addslashes($_POST['m_parents_password']);
        
        echo $this->record->update($m_parents_id, $m_parents_name, $m_parents_username, $m_parents_password);
    }
        
    function delete(){
        if(!isset($_POST))	
            show_404();

        $m_parents_id = addslashes($_POST['m_parents_id']);
        
        echo $this->record->delete($m_parents_id);
    }
}

/* End of file parents.php */
/* Location: ./application/controllers/master/parents.php */