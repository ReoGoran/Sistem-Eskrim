<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Finance extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); $this->load->model('Finance_model'); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){
        if($this->input->method()==='post'){
            $this->form_validation->set_rules('label','Label','required');
            $this->form_validation->set_rules('amount','Amount','required|integer');
            if($this->form_validation->run()){
                $this->db->insert('finance_transactions',[ 'type'=>'expense','order_id'=>NULL,'label'=>$this->input->post('label',TRUE),'amount'=>$this->input->post('amount'),'occurred_on'=>$this->input->post('occurred_on')?:date('Y-m-d') ]);
            }
        }
        $today=date('Y-m-d'); $week=date('Y-m-d',strtotime('-7 days'));
        $data['sum']=$this->Finance_model->summary_range($week,$today);
        $this->db->order_by('occurred_on','desc');
        $data['tx']=$this->db->get('finance_transactions',50,0)->result();
        $this->load->view('admin/partials/header');
        $this->load->view('admin/finance/index',$data);
        $this->load->view('admin/partials/footer');
    }
}
