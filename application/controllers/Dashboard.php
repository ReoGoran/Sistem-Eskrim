<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(['Banner_model','Product_model','Event_model']);
    }
    public function index(){
        $data['banners']=$this->Banner_model->active();
        $data['popular']=$this->Product_model->list(8,0,['popular'=>1]);
        $data['discount']=$this->Product_model->list(8,0,['discount'=>1]);
        $data['flavors']=$this->db->query("SELECT DISTINCT flavor FROM products WHERE flavor IS NOT NULL")->result();
        $data['events']=$this->Event_model->active();
        $this->load->view('partials/header',$data);
        $this->load->view('dashboard/index',$data);
        $this->load->view('partials/footer');
    }
}
