<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(['Banner_model','Product_model','Event_model']);
    }
    public function index(){
        $data['banners']=$this->Banner_model->active();
        // fetch popular products but exclude items that are marked as discount
        $popular_raw = $this->Product_model->list(8,0,['popular'=>1]);
        $popular_filtered = array_values(array_filter($popular_raw, function($p){
            return empty($p->is_discount) || $p->is_discount==0;
        }));
        $data['popular'] = $popular_filtered;
    $data['discount']=$this->Product_model->list(8,0,['discount'=>1]);
        // Kategori / fallback: simply show latest products for the category section
        $data['icecreams'] = $this->Product_model->list(8,0,[]);
    // load flavors from flavors table so admin-managed flavors are shown
    $this->load->model('Flavor_model');
    $data['flavors']=$this->Flavor_model->all();
        $data['events']=$this->Event_model->active();
        $this->load->view('partials/header',$data);
        $this->load->view('dashboard/index',$data);
        $this->load->view('partials/footer');
    }
}
