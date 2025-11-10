<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); $this->load->model('Blog_model'); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){ $this->db->order_by('created_at','desc'); $data['posts']=$this->db->get('blog_posts')->result(); $this->load->view('admin/partials/header'); $this->load->view('admin/blog/index',$data); $this->load->view('admin/partials/footer'); }
    public function create(){
        if($this->input->method()==='post'){
            $title=$this->input->post('title',TRUE); $slug=url_title($title,'dash',TRUE);
            $this->db->insert('blog_posts',[ 'title'=>$title,'slug'=>$slug,'content'=>$this->input->post('content'),'author_id'=>$this->session->userdata('user_id'),'is_published'=>$this->input->post('is_published')?1:0 ]);
            return redirect('admin/blog');
        }
        $this->load->view('admin/partials/header'); $this->load->view('admin/blog/create'); $this->load->view('admin/partials/footer');
    }
    public function edit($id){
        $p=$this->db->get_where('blog_posts',['id'=>$id])->row(); if(!$p) show_404();
        if($this->input->method()==='post'){
            $data=[ 'title'=>$this->input->post('title',TRUE), 'content'=>$this->input->post('content'), 'is_published'=>$this->input->post('is_published')?1:0 ];
            $this->db->update('blog_posts',$data,['id'=>$id]);
            return redirect('admin/blog');
        }
        $data['post']=$p; $this->load->view('admin/partials/header'); $this->load->view('admin/blog/edit',$data); $this->load->view('admin/partials/footer');
    }
    public function delete($id){ $this->db->delete('blog_posts',['id'=>$id]); redirect('admin/blog'); }
}
