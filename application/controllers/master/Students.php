<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('master/m_students','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        if (isset($_GET['grid'])){
            echo $this->record->index();      
        }
        else {
            $this->load->view('master/v_students'); 
        }
    } 
    
    function create() {
        if(!isset($_POST))	
            show_404();

        $m_students_name    = addslashes($_POST['m_students_name']);
        $m_students_parents = addslashes($_POST['m_students_parents']);
        
        echo $this->record->create($m_students_name, $m_students_parents);
    }     
    
    function update($m_students_id=null) {
        if(!isset($_POST))	
            show_404();
        
        $m_students_name    = addslashes($_POST['m_students_name']);
        $m_students_parents = addslashes($_POST['m_students_parents']);
        
        echo $this->record->update($m_students_id, $m_students_name, $m_students_parents);
    }
        
    function delete(){
        if(!isset($_POST))	
            show_404();

        $m_students_id = addslashes($_POST['m_students_id']);
        
        echo $this->record->delete($m_students_id);
    }
    
    function getParents(){
        
        echo $this->record->getParents();
    }
                
}

/* End of file students.php */
/* Location: ./application/controllers/master/students.php */