<?php 
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
            $data=array();
            $data['all_published_category']=$this->welcome_model->select_all_published_category();
            $data['all_published_post']=$this->welcome_model->select_all_published_post();
            $data['published_post_for_home_content']=$this->welcome_model->select_published_post_for_home_content();
            $data['published_comments']=$this->welcome_model->select_published_comments();
            $data['title']='home';
	    $data['maincontent']=$this->load->view('home_content',$data,true);
            $this->load->view('home',$data);
	}
        public function post_category($category_id){
            $data=array();
            $data['all_published_category']=$this->welcome_model->select_all_published_category();
            $data['all_published_post']=$this->welcome_model->select_all_published_post();
            $data['all_post_info']=$this->welcome_model->select_post_by_category($category_id);
            $data['published_comments']=$this->welcome_model->select_published_comments();
            $data['maincontent']=$this->load->view('view_post',$data,true);
            $data['title']='view post';
            $this->load->view('home',$data);
        }
        public function post_details($category_id){
            $data=array();
            $data['all_published_category']=$this->welcome_model->select_all_published_category();
            $data['all_published_post']=$this->welcome_model->select_all_published_post();
            $data['all_post_info']=$this->welcome_model->select_post_by_category($category_id);
            $data['published_comments']=$this->welcome_model->select_published_comments();
            $data['maincontent']=$this->load->view('post_details',$data,true);
            $data['title']='Post Details';
            $this->load->view('home',$data);  
        }
        public function details_for_post($post_id){
         $data=array();
         $data['all_published_category']=$this->welcome_model->select_all_published_category();
         $data['all_published_post']=$this->welcome_model->select_all_published_post();
         $data['all_post']=$this->welcome_model->select_post_info_by_post_id($post_id);
         $data['comments_info']=$this->welcome_model->select_comments_by_post_id($post_id);
         $data['published_comments']=$this->welcome_model->select_published_comments();
         $data['maincontent']=$this->load->view('details_for_post',$data,true);
         $data['title']='Details for post';
         $this->load->view('home',$data);  
        }

        public function recent_post($post_id){
          $data=array();  
          $data['all_published_category']=$this->welcome_model->select_all_published_category();
          $data['all_published_post']=$this->welcome_model->select_all_published_post();
          $data['all_post']=$this->welcome_model->select_post_info_by_post_id($post_id);
          $data['comments_info']=$this->welcome_model->select_comments_by_post_id($post_id);
          $data['published_comments']=$this->welcome_model->select_published_comments();
          $data['maincontent']=$this->load->view('recent_post_info',$data,true);
          $data['title']='Recent Post Info';
          $this->load->view('home',$data);  
        }
        public function save_comments(){
            $post_id=$this->input->post('post_id',true);
            $this->welcome_model->save_comments_info();
            redirect('welcome/recent_post/'.$post_id);
        }
         public function save_comments_for_details(){
            $post_id=$this->input->post('post_id',true);
            $this->welcome_model->save_comments_info();
            redirect('welcome/details_for_post/'.$post_id);
        }

        public function sign_up()
	{
            $data=array();
            $data['title']='sign up';
            $data['all_published_category']=$this->welcome_model->select_all_published_category();
            $data['all_published_post']=$this->welcome_model->select_all_published_post();
            $data['published_comments']=$this->welcome_model->select_published_comments();
	    $data['maincontent']=$this->load->view('sign_up','',true);
            $this->load->view('home',$data);
	}
        public function save_register(){
            $data=array();
            $this->welcome_model->save_register_info($data);
            redirect('welcome/sign_up');
        }

        public function log_in()
	{
            $data=array();
            $data['all_published_category']=$this->welcome_model->select_all_published_category();
            $data['all_published_post']=$this->welcome_model->select_all_published_post();
            $data['published_comments']=$this->welcome_model->select_published_comments();
            $data['title']='log in';
	    $data['maincontent']=$this->load->view('log_in','',true);
            $this->load->view('home',$data);
	}
        public function save_login(){
         $data=array();
         $data['user_email_address']=$this->input->post('user_email_address');
         $data['user_password']=$this->input->post('user_password');
         $result=$this->welcome_model->save_login_info($data);
         $sdata=array();
         $sdata['user_id']=$result->user_id;
         $this->session->set_userdata($sdata);
         if($result){
             redirect('welcome');
         }
         else{
             $sdata['exception']='your user id/password is wrong!';
             $this->session->set_userdata($sdata);
             redirect('welcome/log_in');
         }
        }

        public function contact()
	{
            $data=array();
            $data['all_published_category']=$this->welcome_model->select_all_published_category();
            $data['all_published_post']=$this->welcome_model->select_all_published_post();
            $data['published_comments']=$this->welcome_model->select_published_comments();
            $data['title']='contact';
	    $data['maincontent']=$this->load->view('contact','',true);
            $this->load->view('home',$data);
	}
        public function check_ajax_email($email_address){
         $result=$this->welcome_model->check_ajax_email_info($email_address);
         if($result){
             echo 'Already Exists !';  
         }
         else{
             echo 'Avaiable !';
         }
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */