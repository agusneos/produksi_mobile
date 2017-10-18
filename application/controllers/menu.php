<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_menu','record');
    }
    
    function index(){       
        $auth       = new Auth();
        $auth->restrict();
        
        $id = $this->session->userdata('level');
        echo $this->record->ambil_menu($id);               
    }
    
    function reset(){
        if(!isset($_POST))	
            show_404();
        $id             = $this->session->userdata('id');
        $table          = $this->session->userdata('table');
        $user_password  = addslashes($_POST['user_password']);
        
        echo $this->record->reset($table, $id, $user_password);
    }
}


/* End of file menu.php */
/* Location: ./application/controllers/menu.php */