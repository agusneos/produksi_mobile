<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_scan extends CI_Model
{   
    static $table1  = 'view_t_proc'; //t_process
    static $table2  = 't_prod';
    static $table3  = 't_po_detail';
    static $table4  = 'm_process';
    static $table5  = 'm_machine';
    static $table6  = 'm_process_cat';
    static $table7  = '';
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

    function create($id, $procid, $procName, $proc_tbl, $nik, $mcid){        
        $this->db->select('t_prod_qty, m_process_seq, t_prod_qty');
        $this->db->join(self::$table3, 't_prod_lot = t_po_detail_lot_no', 'left')
                 ->join(self::$table4, 't_po_detail_item = m_process_id', 'left');
        $this->db->where('t_prod_id', $id)
                 ->where('m_process_proc_cat_id', $procid);
        $query_1    = $this->db->get(self::$table2);
        $row_1      = $query_1->row();
        if($row_1){     // Memeriksa apakah item tsb mempunyai proses yang akan diinput + sequence
            $this->db->select('t_proc_id, t_proc_cat, t_proc_cat_table, t_po_detail_item, t_proc_qty_in, t_proc_kbm');
            $this->db->join(self::$table2, 't_proc_prod_id = t_prod_id', 'left')
                     ->join(self::$table3, 't_prod_lot = t_po_detail_lot_no', 'left');
            $this->db->where('t_proc_prod_id', $id);
            $this->db->order_by('t_proc_id', 'desc');
            $this->db->limit(1);
            $query_3    = $this->db->get(self::$table1);
            $row_3      = $query_3->row();
            if($row_3){      // memeriksa apakah sudah pernah masuk card tsb di tabel proses                  
                $this->db->select('m_process_seq, m_process_weight');
                $this->db->where('m_process_id', $row_3->t_po_detail_item)
                         ->where('m_process_proc_cat_id', $row_3->t_proc_cat);
                $query_4    = $this->db->get(self::$table4);
                $row_4      = $query_4->row();
                $lastProcess = floor($row_4->m_process_seq)+1;
                $nextProcess = floor($row_1->m_process_seq);
                if($lastProcess == $nextProcess){   // Memeriksa apakah urutan prosesnya benar ?
                    if($row_3->t_proc_kbm==0){ // memeriksa apakah dalam proses KBM
                        $stdQty     = $row_1->t_prod_qty;
                        $lastQty    = $row_3->t_proc_qty_in;
                        if($stdQty <> $lastQty){    // memeriksa apakah qty proses terakhir masih std per kartu?
                            $berat      = $this->round_up(($row_4->m_process_weight*$lastQty)/1000,2);
                            $warning    = TRUE;
                            $info       = 'Standard Qty sudah berubah dari proses sebelumnya. Harap sesuaikan beratnya menjadi '.$berat.' Kg';
                        }
                        else{
                            $warning    = FALSE;
                            $info       = '';
                        }
                        $query = $this->db->insert($proc_tbl,array(
                            't_proc_seq'             => $nextProcess,
                            't_proc_cat'             => $procid,
                            't_proc_prod_id'         => $id,
                            't_proc_qty_in'          => $lastQty,
                            't_proc_qty_out'         => $lastQty,
                            't_proc_opr_nik'         => $nik,
                            't_proc_machine'         => $mcid
                        ));
                        if($query){
                            $this->db->where('t_proc_id', $row_3->t_proc_id);
                            $query2 = $this->db->update($row_3->t_proc_cat_table,array(
                                't_proc_done'            => 1
                            ));
                            if($query2){
                                return json_encode(array('success'=>true,'warning'=>$warning,'info'=>$info));
                            }
                            else{
                                return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                            }
                        }
                        else{
                            return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                        }
                        
                    }
                    else{
                        return json_encode(array('success'=>false,'error'=>'Kartu Ini Dalam Proses KBM'));
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
                    $query = $this->db->insert($proc_tbl,array(
                        't_proc_seq'             => 1,
                        't_proc_cat'             => $procid,
                        't_proc_prod_id'         => $id,
                        't_proc_qty_in'          => $row_1->t_prod_qty,
                        't_proc_qty_out'         => $row_1->t_prod_qty,
                        't_proc_opr_nik'         => $nik,
                        't_proc_machine'         => $mcid
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
    
    function create_BAK($id, $procid, $procName, $nik, $mcid){        
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
        $this->db->select('t_proc_id, t_proc_qty_out, t_proc_cat, t_proc_kbm, t_po_detail_item');
        $this->db->join(self::$table2, 't_proc_prod_id=t_prod_id', 'left')
                 ->join(self::$table3, 't_prod_lot=t_po_detail_lot_no', 'left');
        $this->db->where('t_proc_cat', $procid)
                 ->where('t_proc_prod_id', $scId);
        $query_1    = $this->db->get(self::$table1);
        $row_1      = $query_1->row();
        if($row_1){ 
            if($row_1->t_proc_kbm==0){ // memeriksa apakah dalam proses kbm
                $this->db->select('m_process_weight');
                $this->db->where('m_process_id', $row_1->t_po_detail_item)
                         ->where('m_process_proc_cat_id', $row_1->t_proc_cat);
                $query_2    = $this->db->get(self::$table4);
                $row_2      = $query_2->row();
                if($row_2){
                    $berat  = $this->round_up(($row_2->m_process_weight*$row_1->t_proc_qty_out)/1000,2);
                    return json_encode(array('success'=>true,'prosid'=>$row_1->t_proc_id,'current'=>$berat, 'grpcs'=>$row_2->m_process_weight));
                }
                else{
                    return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                }
            }
            else {
                return json_encode(array('success'=>false,'error'=>'Kartu dalam proses KBM'));
            }
        }
        else{
            return json_encode(array('success'=>false,'error'=>'Data Tidak Ditemukan'));
        }
    }

    function update($scId, $afterKg, $grPcs, $proc_tbl){
      /*  $this->db->select('t_proc_id');
        $this->db->where('t_proc_id', $scId)
                 ->where('t_proc_kbm', 0);
        $query_1    = $this->db->get($proc_tbl);
        $row_1      = $query_1->row();
        if($row_1){ /// memeriksa apakah dalam proses kbm */
            $afterPcs = ($afterKg/$grPcs)*1000;
            $this->db->where('t_proc_id', $scId);
            $query = $this->db->update($proc_tbl,array(
                't_proc_qty_in'        => $afterPcs,
                't_proc_qty_out'       => $afterPcs
            ));
            if($query){
                return json_encode(array('success'=>true));
            }
            else{
                return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
            }
    /*    }
        else{
            return json_encode(array('success'=>false,'error'=>'Kartu dalam proses KBM'));
        } */
    }
    
    function kbm($procid, $kbmScanId, $proc_tbl){
        $this->db->select('t_proc_id, t_proc_kbm');
        $this->db->where('t_proc_cat', $procid)
                 ->where('t_proc_prod_id', $kbmScanId);
        $query_1    = $this->db->get(self::$table1);
        $row_1      = $query_1->row();
        if($row_1){ 
            if($row_1->t_proc_kbm==0){ // memeriksa apakah dalam proses kbm
                $this->db->where('t_proc_id', $row_1->t_proc_id);
                $query_2 = $this->db->update($proc_tbl,array(
                    't_proc_kbm'        => '1'
                ));
                if($query_2){
                    return json_encode(array('success'=>true));
                }
                else{
                    return json_encode(array('success'=>false,'error'=>$this->db->_error_message()));
                }
            }
            else {
                return json_encode(array('success'=>false,'error'=>'Kartu sudah dalam proses KBM'));
            }
        }
        else{
            return json_encode(array('success'=>false,'error'=>'Data Tidak Ditemukan'));
        }
    }
}

/* End of file m_check_all.php */
/* Location: ./application/models/master/m_check_all.php */