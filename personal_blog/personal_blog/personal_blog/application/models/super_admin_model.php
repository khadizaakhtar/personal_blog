<?php

class Super_Admin_Model extends CI_Model {
    //put your code here
    public function save_category_info($data){
        $data=array();
        $data['category_name']=$this->input->post('category_name',true);
        $data['publication_status']=$this->input->post('publication_status',true);
        $this->db->insert('tbl_category',$data);
        
    }
    public function select_all_category(){
        $this->db->select('*');
        $this->db->from('tbl_category');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }
    public function unpublished_category_by_category_id($category_id){
        $this->db->set('publication_status',0);
        $this->db->where('category_id',$category_id);
        $this->db->update('tbl_category');
    }
    public function published_category_by_category_id($category_id){
      $this->db->set('publication_status',1); 
      $this->db->where('category_id',$category_id);
      $this->db->update('tbl_category');
    }
    public function delete_category_by_category_id($category_id){
       $this->db->where('category_id',$category_id);
       $this->db->delete('tbl_category');
    }
    public function select_category_by_category_id($category_id){
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_id',$category_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
    public function update_category_info(){
        $data=array();
        $data['category_name']=$this->input->post('category_name',true);
        $data['publication_status']=$this->input->post('publication_status',true);
        $category_id=$this->input->post('category_id',true);
        $this->db->where('category_id',$category_id); 
        $this->db->update('tbl_category',$data);
    }
    public function save_post_info($data){
        $this->db->insert('tbl_post',$data);
    }
    public function select_all_post(){
        //$this->db->select('*');
        //$this->db->from('tbl_post');
        //$query_result=$this->db->get();
        $sql="SELECT a.post_id,a.post_title,a.post_summary,a.post_description,a.post_image,a.publication_status,b.category_name FROM tbl_post as a,tbl_category as b WHERE a.category_id=b.category_id";
        $query_result=$this->db->query($sql);
        $result=$query_result->result();
        return $result;
    }
    public function unpublished_post_by_post_id($post_id){
        $this->db->set('publication_status',0);
        $this->db->where('post_id',$post_id);
        $this->db->update('tbl_post');
    
    }
    public function published_post_by_post_id($post_id){
        $this->db->set('publication_status',1);
        $this->db->where('post_id',$post_id);
        $this->db->update('tbl_post');
    }
    public function delete_post_by_post_id($post_id){
        $this->db->where('post_id',$post_id);
        $this->db->delete('tbl_post');
    }
    public function select_post_by_post_id($post_id){
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('post_id',$post_id);
        $query_result=$this->db->get();
        $result=$query_result->row();
        return $result;
    }
    public function update_post_info(){
      $data['post_title']=$this->input->post('post_title',true);
      $data['category_id']=$this->input->post('category_id',true);
      $data['post_summary']=$this->input->post('post_summary',true);
      $data['post_description']=$this->input->post('post_description',true);
      $data['publication_status']=$this->input->post('publication_status',true);
      $post_id=$this->input->post('post_id',true);
      $this->db->where('post_id',$post_id); 
      $this->db->update('tbl_post',$data);  
    }
   }

?>
