<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); $this->load->model('Chat_model'); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){
        $user_id=$this->input->get('user_id');
        if($this->input->method()==='post'){
            $this->Chat_model->add_message($this->input->post('user_id'),$this->input->post('message',TRUE),'admin',NULL,$this->session->userdata('user_id'));
            redirect('admin/chat?user_id='.$this->input->post('user_id'));
        }
        $data['selected_user']=$user_id;
        $data['messages']=$user_id? $this->Chat_model->list_for_user($user_id):[];
        $data['users']=$this->db->select('id,name')->where('role','user')->order_by('name','asc')->get('users')->result();
        $this->load->view('admin/partials/header');
        $this->load->view('admin/chat/index',$data);
        $this->load->view('admin/partials/footer');
    }
}
