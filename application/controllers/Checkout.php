<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkout extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model(['Cart_model','Order_model']); }
    private function require_login(){ if(!$this->session->userdata('user_id')) redirect('login'); }
    public function index(){
        $this->require_login();
        if($this->input->method()==='post'){
            $this->form_validation->set_rules('full_name','Nama','required');
            $this->form_validation->set_rules('phone','Telepon','required');
            $this->form_validation->set_rules('address_line','Alamat','required');
            if($this->form_validation->run()){
                $addr=[
                    'user_id'=>$this->session->userdata('user_id'),
                    'label'=>$this->input->post('label')==='Work'?'Work':'Home',
                    'full_name'=>$this->input->post('full_name',TRUE),
                    'phone'=>$this->input->post('phone',TRUE),
                    'address_line'=>$this->input->post('address_line',TRUE),
                    'detail'=>$this->input->post('detail',TRUE),
                    'lat'=>$this->input->post('lat'),
                    'lng'=>$this->input->post('lng')
                ];
                $this->db->insert('addresses',$addr); $address_id=$this->db->insert_id();
                $code=$this->Order_model->create_from_cart($this->session->userdata('user_id'),$address_id);
                redirect('orders/track/'.$code);
            }
        }
        $data['totals']=$this->Cart_model->totals($this->session->userdata('user_id'));
        $this->load->view('partials/header',$data);
        $this->load->view('checkout/index',$data);
        $this->load->view('partials/footer');
    }
}
