<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('Order_model'); }
    public function track($code){
        $o=$this->Order_model->get_by_code($code); if(!$o) show_404();
        $data['order']=$o; $data['items']=$this->Order_model->items($o->id); $data['history']=$this->Order_model->history($o->id);
        $this->load->view('partials/header',$data);
        $this->load->view('orders/track',$data);
        $this->load->view('partials/footer');
    }
}
