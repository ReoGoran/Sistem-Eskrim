<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); $this->load->model('Product_model'); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){ $data['products']=$this->Product_model->list(100,0,[]); $this->load->view('admin/partials/header'); $this->load->view('admin/products/index',$data); $this->load->view('admin/partials/footer'); }
    public function create(){
        $data = [];
    $this->load->model('Flavor_model');
    $data['flavors'] = $this->Flavor_model->all();
        if($this->input->method()==='post'){
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
            $this->form_validation->set_rules('name','Name','required|min_length[3]');
            $this->form_validation->set_rules('price','Price','required|integer');
            $this->form_validation->set_rules('stock','Stock','required|integer');
            // weight removed from form, no validation needed
            if($this->form_validation->run()){
                $image=NULL;
                if(!empty($_FILES['image']['name'])){
                    $config=[
                        'upload_path'=>UPLOAD_PATH_PRODUCTS,
                        'allowed_types'=>ALLOWED_IMAGE_TYPES,
                        'max_size'=>2048, // KB
                        'max_width'=>2000,
                        'max_height'=>2000
                    ];
                    $this->load->library('upload',$config);
                    if($this->upload->do_upload('image')){
                        $upload_data = $this->upload->data();
                        // Resize to max 800x800 maintain ratio
                        $this->load->library('image_lib');
                        $resize_cfg = [
                            'image_library' => 'gd2',
                            'source_image'  => $upload_data['full_path'],
                            'maintain_ratio'=> TRUE,
                            'quality'       => '85%',
                            'width'         => 800,
                            'height'        => 800
                        ];
                        $this->image_lib->initialize($resize_cfg);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        $image='/public/assets/img/uploads/'.$upload_data['file_name'];
                    } else {
                        $data['upload_error'] = $this->upload->display_errors();
                        // fall through to re-render form with error
                        $this->load->view('admin/partials/header');
                        $this->load->view('admin/products/create',$data);
                        $this->load->view('admin/partials/footer');
                        return;
                    }
                }
                // Determine is_popular: if admin explicitly set the checkbox use its value,
                // otherwise default to 1 so newly created products appear on the site immediately.
                $post_popular = $this->input->post('is_popular');
                if ($post_popular === null) {
                    $is_popular = 1; // default: new products are popular
                } else {
                    $is_popular = $post_popular ? 1 : 0;
                }

                $product_id = $this->Product_model->create([
                    'name'=>$this->input->post('name',TRUE),
                    'slug'=>url_title($this->input->post('name'),'dash',TRUE),
                    'description'=>$this->input->post('description',TRUE),
                    'price'=>$this->input->post('price'),
                    'stock'=>$this->input->post('stock'),
                    'weight_kg'=>DEFAULT_PRODUCT_WEIGHT,
                    'image'=>$image,
                    // legacy single flavor kept for compatibility but optional
                    'flavor'=>$this->input->post('flavor',TRUE),
                    'is_discount'=>$this->input->post('is_discount')?1:0,
                    'is_popular'=>$is_popular,
                ]);
                // assign multiple flavors if provided
                $selected = $this->input->post('flavor_ids') ?: [];
                if(!empty($selected)){
                    $this->Flavor_model->assign_to_product($product_id, $selected);
                }
                return redirect('admin/products');
            }
        }
        $this->load->view('admin/partials/header'); $this->load->view('admin/products/create',$data); $this->load->view('admin/partials/footer');
    }
    public function edit($id){
    $p=$this->Product_model->get($id); if(!$p) show_404();
        $this->load->model('Flavor_model');
    $data['flavors_all']=$this->Flavor_model->all();
    $current=$this->Flavor_model->flavors_for_product($id);
    $data['flavor_ids']=array_map(function($r){return $r->id;}, $current);
        if($this->input->method()==='post'){
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
            $is_popular = $this->input->post('is_popular')?1:0;

            $data=[
                'name'=>$this->input->post('name',TRUE),
                'description'=>$this->input->post('description',TRUE),
                'price'=>$this->input->post('price'),
                'stock'=>$this->input->post('stock'),
                // keep existing weight, ignore posted removal
                'weight_kg'=>$p->weight_kg,
                'flavor'=>$this->input->post('flavor',TRUE),
                'is_discount'=>$this->input->post('is_discount')?1:0,
                'is_popular'=>$is_popular,
            ];
            if(!empty($_FILES['image']['name'])){
                $config=[
                    'upload_path'=>UPLOAD_PATH_PRODUCTS,
                    'allowed_types'=>ALLOWED_IMAGE_TYPES,
                    'max_size'=>2048,
                    'max_width'=>2000,
                    'max_height'=>2000
                ];
                $this->load->library('upload',$config);
                if($this->upload->do_upload('image')){
                    $upload_data = $this->upload->data();
                    // Resize
                    $this->load->library('image_lib');
                    $resize_cfg = [
                        'image_library' => 'gd2',
                        'source_image'  => $upload_data['full_path'],
                        'maintain_ratio'=> TRUE,
                        'quality'       => '85%',
                        'width'         => 800,
                        'height'        => 800
                    ];
                    $this->image_lib->initialize($resize_cfg);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    $data['image']='/public/assets/img/uploads/'.$upload_data['file_name'];
                } else {
                    $viewData['upload_error'] = $this->upload->display_errors();
                    $viewData['product'] = (object) array_merge((array)$p, $data);
                    $this->load->view('admin/partials/header');
                    $this->load->view('admin/products/edit',$viewData);
                    $this->load->view('admin/partials/footer');
                    return;
                }
            }
            $this->Product_model->update_product($id,$data);
            $selected = $this->input->post('flavor_ids') ?: [];
            $this->Flavor_model->assign_to_product($id, $selected);
            return redirect('admin/products');
        }
        $data['product']=$p; $this->load->view('admin/partials/header'); $this->load->view('admin/products/edit',$data); $this->load->view('admin/partials/footer');
    }
    public function delete($id){ $this->Product_model->delete($id); redirect('admin/products'); }
}
