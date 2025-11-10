<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('Chat_model'); }
    private function require_login(){ if(!$this->session->userdata('user_id')) redirect('login'); }
    public function index(){
        $this->require_login();
        if($this->input->method()==='post'){
            $msg=trim($this->input->post('message',TRUE)); if($msg!=='') $this->Chat_model->add_message($this->session->userdata('user_id'),$msg,'user',$this->input->post('order_id'));
            redirect('chat');
        }
        $data['messages']=$this->Chat_model->list_for_user($this->session->userdata('user_id'));
        $this->load->view('partials/header',$data); $this->load->view('chat/index',$data); $this->load->view('partials/footer');
    }
}
