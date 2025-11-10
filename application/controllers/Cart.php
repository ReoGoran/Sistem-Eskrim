<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model(['Cart_model','Product_model']); }
    private function require_login(){ if(!$this->session->userdata('user_id')) redirect('login'); }
    public function index(){ $this->require_login(); $data['items']=$this->Cart_model->items($this->session->userdata('user_id')); $data['totals']=$this->Cart_model->totals($this->session->userdata('user_id')); $this->load->view('partials/header',$data); $this->load->view('cart/index',$data); $this->load->view('partials/footer'); }
    public function add($id){ $this->require_login(); $p=$this->Product_model->get($id); if(!$p) show_404(); $this->Cart_model->add_item($this->session->userdata('user_id'),$p); if($this->input->is_ajax_request()) return $this->output->set_content_type('application/json')->set_output(json_encode(['success'=>true])); redirect('cart'); }
}
