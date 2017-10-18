<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_check_all extends CI_Model
{    
    static $table1 = 't_leave';
    static $table2 = 'm_students';
     
    function __construct() {
        parent::__construct();
    }

    function check_all(){
        $sql = 'SELECT m_students_id, m_students_name, t_leave_time
                FROM m_students
                LEFT JOIN ( SELECT *
                            FROM t_leave
                            WHERE DATE(t_leave_time)=CURDATE()) AS a
                    ON m_students_id=t_leave_student';
       
        $query  = $this->db->query($sql);
                   
        $data = array();
        foreach ( $query->result() as $row ) {
            array_push($data, $row); 
        }
 
        $result = array();
	$result['rows'] = $data;
        
        return json_encode($result);          
    }
    
    function check($parents_id){
        $sql = 'SELECT m_students_id, m_students_name, t_leave_time
                FROM m_students
                LEFT JOIN ( SELECT *
                            FROM t_leave
                            WHERE DATE(t_leave_time)=CURDATE()) AS a
                    ON m_students_id=t_leave_student
                WHERE m_students_parents='.$parents_id;
       
        $query  = $this->db->query($sql);
                   
        $data = array();
        foreach ( $query->result() as $row ) {
            array_push($data, $row); 
        }
 
        $result = array();
	$result['rows'] = $data;
        
        return json_encode($result);          
    }
}

/* End of file m_check_all.php */
/* Location: ./application/models/master/m_check_all.php */