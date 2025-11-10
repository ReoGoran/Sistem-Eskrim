<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Flavors extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); $this->load->model('Flavor_model'); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){ $data['flavors']=$this->Flavor_model->all(); $this->load->view('admin/partials/header'); $this->load->view('admin/flavors/index',$data); $this->load->view('admin/partials/footer'); }
    public function create(){
        $data=[];
        if($this->input->method()==='post'){
            $this->form_validation->set_rules('name','Name','required|min_length[2]');
            if($this->form_validation->run()){
                $image=NULL;
                if(!empty($_FILES['image']['name'])){
                    $config=['upload_path'=>UPLOAD_PATH_PRODUCTS,'allowed_types'=>ALLOWED_IMAGE_TYPES,'max_size'=>2048,'max_width'=>2000,'max_height'=>2000];
                    $this->load->library('upload',$config);
                    if($this->upload->do_upload('image')){
                        $image='/public/assets/img/uploads/'.$this->upload->data('file_name');
                    } else { $data['upload_error']=$this->upload->display_errors(); }
                }
                $slug=url_title($this->input->post('name'),'dash',TRUE);
                $this->Flavor_model->create(['name'=>$this->input->post('name',TRUE),'slug'=>$slug,'image'=>$image]);
                return redirect('admin/flavors');
            }
        }
        $this->load->view('admin/partials/header'); $this->load->view('admin/flavors/create',$data); $this->load->view('admin/partials/footer');
    }
    public function edit($id){ $f=$this->Flavor_model->get($id); if(!$f) show_404();
        $data=['flavor'=>$f];
        if($this->input->method()==='post'){
            $upd=['name'=>$this->input->post('name',TRUE)];
            $upd['slug']=url_title($upd['name'],'dash',TRUE);
            if(!empty($_FILES['image']['name'])){
                $config=['upload_path'=>UPLOAD_PATH_PRODUCTS,'allowed_types'=>ALLOWED_IMAGE_TYPES,'max_size'=>2048,'max_width'=>2000,'max_height'=>2000];
                $this->load->library('upload',$config);
                if($this->upload->do_upload('image')){ $upd['image']='/public/assets/img/uploads/'.$this->upload->data('file_name'); }
                else { $data['upload_error']=$this->upload->display_errors(); }
            }
            $this->Flavor_model->update($id,$upd); return redirect('admin/flavors');
        }
        $this->load->view('admin/partials/header'); $this->load->view('admin/flavors/edit',$data); $this->load->view('admin/partials/footer');
    }
    public function delete($id){ $this->Flavor_model->delete($id); redirect('admin/flavors'); }
}
