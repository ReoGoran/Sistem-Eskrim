<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('Blog_model'); }
    public function index(){ $data['posts']=$this->Blog_model->list(10,0); $this->load->view('partials/header',$data); $this->load->view('blog/index',$data); $this->load->view('partials/footer'); }
    public function detail($slug){ $post=$this->Blog_model->get_by_slug($slug); if(!$post) show_404(); $data['post']=$post; $this->load->view('partials/header',$data); $this->load->view('blog/detail',$data); $this->load->view('partials/footer'); }
}
