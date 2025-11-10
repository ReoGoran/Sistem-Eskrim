<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){ $this->db->order_by('created_at','desc'); $data['events']=$this->db->get('events')->result(); $this->load->view('admin/partials/header'); $this->load->view('admin/events/index',$data); $this->load->view('admin/partials/footer'); }
    public function create(){ if($this->input->method()==='post'){ $this->db->insert('events',[ 'title'=>$this->input->post('title',TRUE),'content'=>$this->input->post('content'),'target_amount'=>$this->input->post('target_amount'),'is_active'=>$this->input->post('is_active')?1:0 ]); return redirect('admin/events'); } $this->load->view('admin/partials/header'); $this->load->view('admin/events/create'); $this->load->view('admin/partials/footer'); }
    public function edit($id){ $e=$this->db->get_where('events',['id'=>$id])->row(); if(!$e) show_404(); if($this->input->method()==='post'){ $data=[ 'title'=>$this->input->post('title',TRUE),'content'=>$this->input->post('content'),'target_amount'=>$this->input->post('target_amount'),'is_active'=>$this->input->post('is_active')?1:0 ]; $this->db->update('events',$data,['id'=>$id]); return redirect('admin/events'); } $data['event']=$e; $this->load->view('admin/partials/header'); $this->load->view('admin/events/edit',$data); $this->load->view('admin/partials/footer'); }
    public function delete($id){ $this->db->delete('events',['id'=>$id]); redirect('admin/events'); }
}
