<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reviews extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); $this->load->model('Review_model'); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){ $this->db->order_by('created_at','desc'); $data['reviews']=$this->db->get('reviews')->result(); $this->load->view('admin/partials/header'); $this->load->view('admin/reviews/index',$data); $this->load->view('admin/partials/footer'); }
    public function approve($id){ $this->db->update('reviews',['is_approved'=>1],['id'=>$id]); redirect('admin/reviews'); }
    public function hide($id){ $this->db->update('reviews',['is_approved'=>0],['id'=>$id]); redirect('admin/reviews'); }
    public function delete($id){ $this->Review_model->delete($id); redirect('admin/reviews'); }
}
