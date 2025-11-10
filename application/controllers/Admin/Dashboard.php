<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); $this->load->model('Finance_model'); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){
        $today=date('Y-m-d'); $week=date('Y-m-d',strtotime('-7 days')); $month=date('Y-m-d',strtotime('-30 days'));
        $data['sum_today']=$this->Finance_model->summary_range($today,$today);
        $data['sum_week']=$this->Finance_model->summary_range($week,$today);
        $data['sum_month']=$this->Finance_model->summary_range($month,$today);
        $data['trend']=$this->Finance_model->daily_trend(14);
        $this->load->view('admin/partials/header');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/partials/footer');
    }
}
