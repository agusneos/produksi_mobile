<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_scan extends CI_Model
{   
    static $table1  = 't_process';
    static $table2  = 't_prod';
    static $table3  = 't_po_detail';
    static $table4  = 'm_process';
    static $table5  = 'm_machine';
    static $table6  = 't_process_in';
    static $table7  = 't_process_out';
    static $table8  = '';
    static $table9  = '';

    public function __construct() {
        parent::__construct();
        //$this->load->helper('database'); // Digunakan untuk memunculkan data Enum
    }
    
    function round_up ( $value, $precision ) { 
        $pow = pow ( 10, $precision ); 
        return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
    }

    function create_in($id, $procid, $procName, $nik, $mcid){        
        $this->db->select('t_process_in_id');
        $this->db->where('t_process_in_prod_id', $id)
                 ->where('t_process_in_cat', $procid);
        $query_1    = $this->db->get(self::$table6); //t_process_in
        $row_1      = $query_1->row();
        if($row_1){     // memeriksa apakah sudah pernah diinput / duplikat di tabel process in
            return json_encode(array('success'=>false,'error'=>'Proses Sudah pernah diinput'));
        }
        else {
            $this->db->select('t_prod_qty, m_process_seq');
            $this->db->join(self::$table3, 't_prod_lot = t_po_detail_lot_no', 'left') //t_po_detail
                     ->join(self::$table4, 't_po_detail_item = m_process_id', 'left'); //m_process
            $this->db->where('t_prod_id', $id)
                     ->where('m_process_proc_cat_id', $procid);
            $query_2    = $this->db->get(self::$table2); //t_prod
            $row_2      = $query_2->row();
            if($row_2){ // Apakah proses tsb ada di master proses
                if($row_2->m_process_seq==1){ // apakah proses tsb proses 1
                    $query_3 = $this->db->insert(self::$table6,array( // input ke tabel process in
                        't_process_in_proc_seq'        => 1,
                        't_process_in_cat'             => $procid,
                        't_process_in_prod_id'         => $id,
                        't_process_in_qty'             => $row_2->t_prod_qty,
                        't_process_in_operator_nik'    => $nik,
                        't_process_in_shif'            => 0,
                        't_process_in_machine'         => $mcid
                    ));
                    if($query_3){
                        return json_encode(array('success'=>true));
                    }
                    else{
                        return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                    }
                }
                else{
                    $this->db->select('t_process_out_id, t_process_out_proc_seq, t_process_out_qty, t_process_out_done');
                    $this->db->where('t_process_out_prod_id', $id)
                             ->where('t_process_out_done', 0);
                    $query_4    = $this->db->get(self::$table7); //t_process_out
                    $row_4      = $query_4->row();
                    if($row_4){ // menghindari error apabila di proses out belum diinput
                        $lastProcess = $row_4->t_process_out_proc_seq+1;
                    }
                    else{
                        $lastProcess = 0+1;
                    }
                    $nextProcess = $row_2->m_process_seq; //proses dari master proc
                    if($lastProcess == $nextProcess){ //apakah proses selanjutnya cocok
                        $query_5 = $this->db->insert(self::$table6,array( // input ke tabel process in
                            't_process_in_proc_seq'        => $row_2->m_process_seq,
                            't_process_in_cat'             => $procid,
                            't_process_in_prod_id'         => $id,
                            't_process_in_qty'             => $row_4->t_process_out_qty,
                            't_process_in_operator_nik'    => $nik,
                            't_process_in_shif'            => 0,
                            't_process_in_machine'         => $mcid
                        ));
                        
                        $this->db->where('t_process_out_id', $row_4->t_process_out_id); 
                        $query_6 = $this->db->update(self::$table7,array( //update tabel process out sebelumnya
                            't_process_out_done'        => 1
                        ));
                        if($query_5 && $query_6){
                            return json_encode(array('success'=>true));
                        }
                        else {
                            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                        }
                    }
                    else {
                        return json_encode(array('success'=>false,'error'=>'Proses Sebelumnya Terlewati'));
                    }
                }
            }
            else{
                return json_encode(array('success'=>false,'error'=>'Proses '.$procName.' Tidak ada untuk item tersebut'));
            }
        }
    }
    
    function create_out($id, $procid, $procName, $nik, $mcid){        
        $this->db->select('t_process_out_id');
        $this->db->where('t_process_out_prod_id', $id)
                 ->where('t_process_out_cat', $procid);
        $query_1    = $this->db->get(self::$table7); //t_process_out
        $row_1      = $query_1->row();
        if($row_1){     // memeriksa apakah sudah pernah diinput / duplikat di tabel process out
            return json_encode(array('success'=>false,'error'=>'Proses Sudah pernah diinput'));
        }
        else {
            $this->db->select('t_process_in_id, t_process_in_qty, t_process_in_proc_seq');
            $this->db->where('t_process_in_prod_id', $id)
                     ->where('t_process_in_cat', $procid);
            $query_2    = $this->db->get(self::$table6); //t_process_in
            $row_2      = $query_2->row();
            if($row_2){     // memeriksa apakah sudah pernah diinput di tabel process in
                $this->db->select('t_prod_qty, m_process_weight');
                $this->db->where('m_process_proc_cat_id', $procid)
                         ->where('t_prod_id', $id);
                $this->db->join(self::$table3, 't_prod_lot = t_po_detail_lot_no', 'left')
                         ->join(self::$table4, 't_po_detail_item = m_process_id', 'left');
                $query_3    = $this->db->get(self::$table2); //t_prod
                $row_3      = $query_3->row();
                
                $stdQty     = $row_3->t_prod_qty;
                $lastQty    = $row_2->t_process_in_qty;
                if($stdQty <> $lastQty) { // memeriksa apakah qty proses terakhir masih std per kartu?
                    $berat      = $this->round_up(($row_3->m_process_weight*$lastQty)/1000,2);
                    $warning    = TRUE;
                    $info       = 'Standard Qty sudah berubah dari proses sebelumnya. Harap sesuaikan beratnya menjadi '.$berat.' Kg';
                }
                else {
                    $warning    = FALSE;
                    $info       = '';
                }
                $query_4 = $this->db->insert(self::$table7,array(
                    't_process_out_proc_seq'        => $row_2->t_process_in_proc_seq,
                    't_process_out_cat'             => $procid,
                    't_process_out_prod_id'         => $id,
                    't_process_out_qty'             => $lastQty,
                    't_process_out_operator_nik'    => $nik,
                    't_process_out_shif'            => 0,
                    't_process_out_machine'         => $mcid
                ));
                $this->db->where('t_process_in_id', $row_2->t_process_in_id); 
                    $query_5 = $this->db->update(self::$table6,array( //update tabel process in sebelumnya
                        't_process_in_done'        => 1
                ));
                if($query_4 && $query_5){
                    return json_encode(array('success'=>true,'warning'=>$warning,'info'=>$info));
                }
                else{
                    return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                }
                
            }
            else {
                return json_encode(array('success'=>false,'error'=>'Proses IN belum diinput'));
            }
        }
    }
    
    function create($id, $procid, $procName, $nik, $mcid){        
        $this->db->select('t_prod_qty, m_process_seq, t_prod_qty');
        $this->db->join(self::$table3, 't_prod_lot = t_po_detail_lot_no', 'left')
                 ->join(self::$table4, 't_po_detail_item = m_process_id', 'left');
        $this->db->where('t_prod_id', $id)
                 ->where('m_process_proc_cat_id', $procid);
        $query_1    = $this->db->get(self::$table2);
        $row_1      = $query_1->row();
        if($row_1){     // Memeriksa apakah item tsb mempunyai proses yang akan diinput + sequence
            $this->db->select('t_process_cat, t_po_detail_item, t_process_qty');
            $this->db->join(self::$table2, 't_process_prod_id = t_prod_id', 'left')
                     ->join(self::$table3, 't_prod_lot = t_po_detail_lot_no', 'left');
            $this->db->where('t_process_prod_id', $id);
            $this->db->order_by('t_process_id', 'desc');
            $this->db->limit(1);
            $query_3    = $this->db->get(self::$table1);
            $row_3      = $query_3->row();
            if($row_3){      // memeriksa apakah sudah pernah masuk card tsb di tabel proses
                $this->db->select('m_process_seq, m_process_weight');
                $this->db->where('m_process_id', $row_3->t_po_detail_item)
                         ->where('m_process_proc_cat_id', $row_3->t_process_cat);
                $query_4    = $this->db->get(self::$table4);
                $row_4      = $query_4->row();
                $lastProcess = ($row_4->m_process_seq)+1;
                $nextProcess = $row_1->m_process_seq;
                if($lastProcess == $nextProcess){   // Memeriksa apakah urutan prosesnya benar ?
                    $stdQty     = $row_1->t_prod_qty;
                    $lastQty    = $row_3->t_process_qty;
                    if($stdQty <> $lastQty){    // memeriksa apakah qty proses terakhir masih std per kartu?
                        $berat      = $this->round_up(($row_4->m_process_weight*$lastQty)/1000,2);
                        $warning    = TRUE;
                        $info       = 'Standard Qty sudah berubah dari proses sebelumnya. Harap sesuaikan beratnya menjadi '.$berat.' Kg';
                    }
                    else{
                        $warning    = FALSE;
                        $info       = '';
                    }
                    $query = $this->db->insert(self::$table1,array(
                        't_process_proc_seq'        => $nextProcess,
                        't_process_cat'             => $procid,
                        't_process_prod_id'         => $id,
                        't_process_qty'             => $lastQty,
                        't_process_operator_nik'    => $nik,
                        't_process_shif'            => 0,
                        't_process_machine'         => $mcid
                    ));
                    if($query){
                        return json_encode(array('success'=>true,'warning'=>$warning,'info'=>$info));
                    }
                    else{
                        return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                    }
                }
                else if($lastProcess < $nextProcess){
                    return json_encode(array('success'=>false,'error'=>'Proses Sebelumnya Terlewati'));
                }
                else{
                    return json_encode(array('success'=>false,'error'=>'Proses Sudah pernah diinput'));
                }
            }
            else{
                if($row_1->m_process_seq==1){
                    $query = $this->db->insert(self::$table1,array(
                        't_process_proc_seq'        => 1,
                        't_process_cat'             => $procid,
                        't_process_prod_id'         => $id,
                        't_process_qty'             => $row_1->t_prod_qty,
                        't_process_operator_nik'    => $nik,
                        't_process_shif'            => 0,
                        't_process_machine'         => $mcid
                    ));
                    if($query){
                        return json_encode(array('success'=>true));
                    }
                    else{
                        return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                    }
                }
                else{
                    return json_encode(array('success'=>false,'error'=>'Proses Awal Belum Diinput'));
                }
            }
        }
        else{
            return json_encode(array('success'=>false,'error'=>'Proses '.$procName.' Tidak ada untuk item tersebut'));
        }
    }
    
    function create_bak($id, $procid, $procName, $nik, $mcid){        
        $this->db->select('t_prod_qty, m_process_seq, t_prod_qty');
        $this->db->join(self::$table3, 't_prod_lot = t_po_detail_lot_no', 'left')
                 ->join(self::$table4, 't_po_detail_item = m_process_id', 'left');
        $this->db->where('t_prod_id', $id)
                 ->where('m_process_proc_cat_id', $procid);
        $query_1    = $this->db->get(self::$table2);
        $row_1      = $query_1->row();
        if($row_1){     // Memeriksa apakah item tsb mempunyai proses yang akan diinput + sequence
            $this->db->select('t_process_cat, t_po_detail_item, t_process_qty');
            $this->db->join(self::$table2, 't_process_prod_id = t_prod_id', 'left')
                     ->join(self::$table3, 't_prod_lot = t_po_detail_lot_no', 'left');
            $this->db->where('t_process_prod_id', $id);
            $this->db->order_by('t_process_id', 'desc');
            $this->db->limit(1);
            $query_3    = $this->db->get(self::$table1);
            $row_3      = $query_3->row();
            if($row_3){      // memeriksa apakah sudah pernah masuk card tsb di tabel proses
                $this->db->select('m_process_seq, m_process_weight');
                $this->db->where('m_process_id', $row_3->t_po_detail_item)
                         ->where('m_process_proc_cat_id', $row_3->t_process_cat);
                $query_4    = $this->db->get(self::$table4);
                $row_4      = $query_4->row();
                $lastProcess = ($row_4->m_process_seq)+1;
                $nextProcess = $row_1->m_process_seq;
                if($lastProcess == $nextProcess){   // Memeriksa apakah urutan prosesnya benar ?
                    $stdQty     = $row_1->t_prod_qty;
                    $lastQty    = $row_3->t_process_qty;
                    if($stdQty <> $lastQty){    // memeriksa apakah qty proses terakhir masih std per kartu?
                        $berat      = $this->round_up(($row_4->m_process_weight*$lastQty)/1000,2);
                        $warning    = TRUE;
                        $info       = 'Standard Qty sudah berubah dari proses sebelumnya. Harap sesuaikan beratnya menjadi '.$berat.' Kg';
                    }
                    else{
                        $warning    = FALSE;
                        $info       = '';
                    }
                    $query = $this->db->insert(self::$table1,array(
                        't_process_proc_seq'        => $nextProcess,
                        't_process_cat'             => $procid,
                        't_process_prod_id'         => $id,
                        't_process_qty'             => $lastQty,
                        't_process_operator_nik'    => $nik,
                        't_process_shif'            => 0,
                        't_process_machine'         => $mcid
                    ));
                    if($query){
                        return json_encode(array('success'=>true,'warning'=>$warning,'info'=>$info));
                    }
                    else{
                        return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                    }
                }
                else if($lastProcess < $nextProcess){
                    return json_encode(array('success'=>false,'error'=>'Proses Sebelumnya Terlewati'));
                }
                else{
                    return json_encode(array('success'=>false,'error'=>'Proses Sudah pernah diinput'));
                }
            }
            else{
                if($row_1->m_process_seq==1){
                    $query = $this->db->insert(self::$table1,array(
                        't_process_proc_seq'        => 1,
                        't_process_cat'             => $procid,
                        't_process_prod_id'         => $id,
                        't_process_qty'             => $row_1->t_prod_qty,
                        't_process_operator_nik'    => $nik,
                        't_process_shif'            => 0,
                        't_process_machine'         => $mcid
                    ));
                    if($query){
                        return json_encode(array('success'=>true));
                    }
                    else{
                        return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                    }
                }
                else{
                    return json_encode(array('success'=>false,'error'=>'Proses Awal Belum Diinput'));
                }
            }
        }
        else{
            return json_encode(array('success'=>false,'error'=>'Proses '.$procName.' Tidak ada untuk item tersebut'));
        }
    }
    
    function machCheck($procid, $liid, $mcid){
        $this->db->select('m_machine_id');
        $this->db->where('m_machine_lines', $liid)
                 ->where('m_machine_mac', $mcid)
                 ->where('m_machine_proc', $procid);
        $query_1    = $this->db->get(self::$table5);
        $row_1      = $query_1->row();
        if($row_1){
            return json_encode(array('success'=>true,'machineId'=>$row_1->m_machine_id));
        }
        else{
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
    
    function cardCheck($procid, $scId){
        $this->db->select('t_process_id, t_process_qty, t_process_cat, t_po_detail_item');
        $this->db->join(self::$table2, 't_process_prod_id=t_prod_id', 'left')
                 ->join(self::$table3, 't_prod_lot=t_po_detail_lot_no', 'left');
        $this->db->where('t_process_cat', $procid)
                 ->where('t_process_prod_id', $scId);
        $query_1    = $this->db->get(self::$table1);
        $row_1      = $query_1->row();
        if($row_1){
            $this->db->select('m_process_weight');
            $this->db->where('m_process_id', $row_1->t_po_detail_item)
                     ->where('m_process_proc_cat_id', $row_1->t_process_cat);
            $query_2    = $this->db->get(self::$table4);
            $row_2      = $query_2->row();
            if($row_2){
                $berat  = $this->round_up(($row_2->m_process_weight*$row_1->t_process_qty)/1000,2);
                return json_encode(array('success'=>true,'prosid'=>$row_1->t_process_id,'current'=>$berat, 'grpcs'=>$row_2->m_process_weight));
            }
            else{
                return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
            }
        }
        else{
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }

    function update($scId, $afterKg, $grPcs){
        $afterPcs = ($afterKg/$grPcs)*1000;
        $this->db->where('t_process_id', $scId);
        $query = $this->db->update(self::$table1,array(
            't_process_qty'        => $afterPcs
        ));
        if($query){
            return json_encode(array('success'=>true));
        }
        else{
            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
        }
    }
    
}

/* End of file m_check_all.php */
/* Location: ./application/models/master/m_check_all.php */