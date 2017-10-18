<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_all extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_check_all','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        if (isset($_GET['grid'])){
            echo $this->record->check_all();      
        }
        else {
            $this->load->view('v_check_all'); 
        }
    } 
}

/* End of file check_all.php */
/* Location: ./application/controllers/master/check_all.php */