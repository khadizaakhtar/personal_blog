<?php

class welcome_model extends CI_Model {
    //put your code here
    public function select_all_published_category(){
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('publication_status',1);
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    public function select_post_by_category($category_id){
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('publication_status',1);
        $this->db->where('category_id',$category_id);
        $this->db->order_by('category_id','DESC');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    public function select_all_published_post(){
       $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('publication_status',1);
        $this->db->order_by('post_date_time','DESC');
        $this->db->limit('5');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;  
    }
    public function select_published_post_for_home_content(){
       $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('publication_status',1);
        $this->db->order_by('post_date_time','DESC');
        $this->db->limit('1');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;   
    }

    public function select_post_info_by_post_id($post_id){
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('publication_status',1);
        $this->db->where('post_id',$post_id);
        $this->db->order_by('post_id','DESC');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result; 
    }
    public function save_comments_info($data){
        $this->db->insert('tbl_comments',$data);
    }
    public function show_comments_info($post_id){
        $this->db->select('*');
        $this->db->from('tbl_comments');
        $this->db->where('post_id',$post_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
       }

    public function save_register_info($data){
        $sdata=array();
        $data=array();
        $data['user_name']=$this->input->post('user_name',true);
        $data['user_email_address']=$this->input->post('user_email_address',true);
        $data['user_password']=$this->input->post('user_password',true);
        $data['user_phone_number']=$this->input->post('user_phone_number',true);
        $this->db->insert('tbl_user',$data);
        $sdata['message']='your registration successfully saved';
        $this->session->set_userdata($sdata);
    }
    public function save_login_info($data){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('user_email_address',$data['user_email_address']);
        $this->db->where('user_password',$data['user_password']);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
        
    }
}

?>
