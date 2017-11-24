<?php
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');
   session_start();
class Administrator extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $admin_id=$this->session->userdata('admin_id');
        if($admin_id != NULL){
            redirect('super_admin','refresh');
        }
    }
    //put your code here
    public function index(){
        $this->load->view('admin/admin_login');
    }
    public function admin_login_check(){
        $data=array();
        $data['admin_email_address']=$this->input->post('admin_email_address',true);
        $data['admin_password']=$this->input->post('admin_password',true);
        $result=$this->administrator_model->admin_login_check_info($data);
        $sdata=array();
        if($result){
            $sdata['admin_id']=$result->admin_id;
            $sdata['admin_name']=$result->admin_name;
            $this->session->set_userdata($sdata);
           redirect('super_admin'); 
        }
        else{
            $sdata['exception']='your user/email address invalid!';
            $this->session->set_userdata($sdata);
            redirect('administrator');
        }
    }
}

?>
