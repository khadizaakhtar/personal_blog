<?php
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');
session_start();
class Super_Admin  extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
   $admin_id=$this->session->userdata('admin_id');
        if($admin_id == NULL){
            redirect('administrator','refresh');
        }
    }
    public function index(){
        $data=array();
        $data['admin_maincontent']=$this->load->view('admin/dashboard','',true);
        $data['title']='dashboard';
        $this->load->view('admin/admin_home',$data);
    }
    public function logout(){
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('admin_id');
        $sdata['message']='your successfully logout! ';
        $this->session->set_userdata($sdata);
        redirect('administrator');
    }
    public function add_category(){
        $data=array();
        $data['admin_maincontent']=$this->load->view('admin/add_category','',true);
        $data['title']='Add Category';
        $this->load->view('admin/admin_home',$data);
        
    }
    public function save_category(){
        $data=array();
        $this->super_admin_model->save_category_info($data);
        $sdata['message']='you are successfully saved';
        $this->session->set_userdata($sdata);
        redirect('super_admin/add_category');
    }
    public function manage_category(){
        $data=array();
        $data['all_category']=$this->super_admin_model->select_all_category();
        $data['admin_maincontent']=$this->load->view('admin/manage_category',$data,true);
        $data['title']='Manage Category';
        $this->load->view('admin/admin_home',$data);    
    }
    public function unpublished_category($category_id){
       $this->super_admin_model->unpublished_category_by_category_id($category_id);
       redirect('super_admin/manage_category');
    }
    public function published_category($category_id){
      $this->super_admin_model->published_category_by_category_id($category_id); 
      redirect('super_admin/manage_category');
    }
    public function delete_category($category_id){
      $this->super_admin_model->delete_category_by_category_id($category_id);
      redirect('super_admin/manage_category');
    }
    public function edit_category($category_id){
        $data=array();
        $data['category_info']=$this->super_admin_model->select_category_by_category_id($category_id);
        $data['admin_maincontent']=$this->load->view('admin/edit_category',$data,true);
        $data['title']='edit category';
        $this->load->view('admin/admin_home',$data);
    }
    public function update_category(){
        $this->super_admin_model->update_category_info();
        redirect('super_admin/manage_category');
    }

    public function add_post(){
        $data=array();
        $data['all_published_category']=$this->welcome_model->select_all_published_category();
        $data['admin_maincontent']=$this->load->view('admin/add_post',$data,true);
        $data['title']='Add Post'; 
        $this->load->view('admin/admin_home',$data);
        
    }
  public function save_post(){
     $data=array();
     $data['post_title']=$this->input->post('post_title',true);
     $data['category_id']=$this->input->post('category_id',true);
     $data['post_summary']=$this->input->post('post_summary',true);
     $data['post_description']=$this->input->post('post_description',true);
     $data['publication_status']=$this->input->post('publication_status',true);
     $data['author_name']=$this->session->userdata('admin_name');
     /*
         *start news_image upload 
         */
       /* echo '<pre>';
        print_r($_FILES);
        exit();*/
     $config['upload_path'] = 'images/post_image/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
                $error='';
                $fdata=array();
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('post_image'))
		{
			$error = $this->upload->display_errors();
                        echo $error;
                        exit();               
		}
		else
		{
			$fdata = $this->upload->data();
                        $data['post_image']=$config['upload_path'] .$fdata['file_name'];
		}
        /*
         * end news_image upload
         */
     $this->super_admin_model->save_post_info($data);
     $sdata=array();
     $sdata['message']='your information successfully saved!';
     $this->session->set_userdata($sdata);
     redirect('super_admin/add_post');
   
  }

  public function manage_post(){
        $data=array();
        $data['all_post']=$this->super_admin_model->select_all_post();
        $data['admin_maincontent']=$this->load->view('admin/manage_post',$data,true);
        $data['title']='Manage Post';
        $this->load->view('admin/admin_home',$data);
        
    }
    public function unpublished_post($post_id){
      $this->super_admin_model->unpublished_post_by_post_id($post_id);
      redirect('super_admin/manage_post');
    }
    public function published_post($post_id){
       $this->super_admin_model->published_post_by_post_id($post_id);
      redirect('super_admin/manage_post');  
    }
    public function delete_post($post_id){
        $this->super_admin_model->delete_post_by_post_id($post_id);
        redirect('super_admin/manage_post');
    }
    public function edit_post($post_id){
     $data=array();
     $data['post_info']=$this->super_admin_model->select_post_by_post_id($post_id);
     $data['admin_maincontent']=$this->load->view('admin/edit_post',$data,true);
     $data['title']='edit post';
     $this->load->view('admin/admin_home',$data);
    }
    public function update_post(){
        $this->super_admin_model->update_post_info();
        redirect('super_admin/manage_post');
    }
}

?>
