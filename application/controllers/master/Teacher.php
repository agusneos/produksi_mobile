<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('master/m_teacher','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        if (isset($_GET['grid'])){
            echo $this->record->index();      
        }
        else {
            $this->load->view('master/v_teacher'); 
        }
    } 
    
    function create() {
        if(!isset($_POST))	
            show_404();

        $m_teacher_name     = addslashes($_POST['m_teacher_name']);
        $m_teacher_username = addslashes($_POST['m_teacher_username']);
        $m_teacher_password = addslashes($_POST['m_teacher_password']);
        
        echo $this->record->create($m_teacher_name, $m_teacher_username, $m_teacher_password);
    }     
    
    function update($m_teacher_id=null) {
        if(!isset($_POST))	
            show_404();
        
        $m_teacher_name     = addslashes($_POST['m_teacher_name']);
        $m_teacher_username = addslashes($_POST['m_teacher_username']);
        $m_teacher_password = addslashes($_POST['m_teacher_password']);
        
        echo $this->record->update($m_teacher_id, $m_teacher_name, $m_teacher_username, $m_teacher_password);
    }
        
    function delete(){
        if(!isset($_POST))	
            show_404();

        $m_teacher_id = addslashes($_POST['m_teacher_id']);
        
        echo $this->record->delete($m_teacher_id);
    }          
}

/* End of file teacher.php */
/* Location: ./application/controllers/master/teacher.php */