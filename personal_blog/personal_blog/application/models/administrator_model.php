<?php

class Administrator_Model extends CI_Model{
    //put your code here
    public function admin_login_check_info($data){
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('admin_email_address',$data['admin_email_address']);
        $this->db->where('admin_password',md5($data['admin_password']));
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
}

?>
