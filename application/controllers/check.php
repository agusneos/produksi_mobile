<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_check_all','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        if (isset($_GET['grid'])){
            $parents_id = $this->session->userdata('id');
            echo $this->record->check($parents_id);      
        }
        else {
            $this->load->view('v_check'); 
        }
    } 
}

/* End of file check.php */
/* Location: ./application/controllers/check.php */