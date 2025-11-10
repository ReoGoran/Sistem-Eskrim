<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); $this->load->model('Order_model'); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){
        $this->db->order_by('id','desc');
        $data['orders']=$this->db->get('orders',50,0)->result();
        $this->load->view('admin/partials/header');
        $this->load->view('admin/orders/index',$data);
        $this->load->view('admin/partials/footer');
    }
    public function view($id){
        $o=$this->db->get_where('orders',['id'=>$id])->row(); if(!$o) show_404();
        $data['order']=$o; $data['items']=$this->Order_model->items($o->id); $data['history']=$this->Order_model->history($o->id);
        $this->load->view('admin/partials/header');
        $this->load->view('admin/orders/view',$data);
        $this->load->view('admin/partials/footer');
    }
    public function status($id){
        if($this->input->method()==='post'){
            $status=$this->input->post('status');
            $allowed=['Placed','Processed','Shipped','Out for delivery','Delivered','Cancelled'];
            if(in_array($status,$allowed)){ $this->Order_model->update_status($id,$status); }
        }
        redirect('admin/orders/view/'.$id);
    }
}
