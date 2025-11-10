<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reviews extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('Review_model'); }
    private function require_login(){ if(!$this->session->userdata('user_id')) redirect('login'); }
    public function store(){
        $this->require_login();
        $this->form_validation->set_rules('product_id','Product','required|integer');
        $this->form_validation->set_rules('rating','Rating','required|integer|greater_than_equal_to[1]|less_than_equal_to[5]');
        if($this->form_validation->run()){
            $this->Review_model->create([
                'product_id'=>$this->input->post('product_id'),
                'user_id'=>$this->session->userdata('user_id'),
                'rating'=>$this->input->post('rating'),
                'comment'=>$this->input->post('comment',TRUE),
                'is_approved'=>1
            ]);
        }
        redirect('products/detail/'.$this->input->post('product_id'));
    }
}
