<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_scan','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        $this->load->view('v_scan'); 
    }
    
    function create() {        
        if(!isset($_POST))	
            show_404();
        
        $id         = addslashes($_POST['scid']);
        $mcid       = addslashes($_POST['mcid']);
        $procid     = $this->session->userdata('procid');
        $proc       = $this->session->userdata('proc');
        $proc_tbl   = $this->session->userdata('proc_tbl');
        $nik        = $this->session->userdata('nik');
                           
        //echo $this->record->create($id, $procid, $proc, $nik, $shid, $mcid);
        echo $this->record->create($id, $procid, $proc, $proc_tbl, $nik, $mcid);
        
    }
    
    function machCheck() {        
        if(!isset($_POST))	
            show_404();
        
        $liid   = addslashes($_POST['liid']);
        $mcid   = addslashes($_POST['mcid']);
        $procid = $this->session->userdata('procid');
                           
        echo $this->record->machCheck($procid, $liid, $mcid);
        
    }
    
    function cardCheck() {
        if(!isset($_POST))	
            show_404();
        
        $scId   = addslashes($_POST['upScanId']);
        $procid = $this->session->userdata('procid');
                           
        echo $this->record->cardCheck($procid, $scId);
    }
    
    function update() {       
        if(!isset($_POST))	
            show_404();

        $scId       = addslashes($_POST['idPros']);
        $afterKg    = addslashes($_POST['afterKg']);
        $grPcs      = addslashes($_POST['grPcs']);
        $proc_tbl   = $this->session->userdata('proc_tbl');
        
        echo $this->record->update($scId, $afterKg, $grPcs, $proc_tbl);
    }
    
    function kbm() {       
        if(!isset($_POST))	
            show_404();
        
        $kbmScanId  = addslashes($_POST['kbmScanId']);
        $procid     = $this->session->userdata('procid');
        $proc_tbl   = $this->session->userdata('proc_tbl');
                           
        echo $this->record->kbm($procid, $kbmScanId, $proc_tbl);
    }
}

/* End of file check.php */
/* Location: ./application/controllers/check.php */