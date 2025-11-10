<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model(['Product_model','Category_model','Review_model']); }
    public function index(){
        $page=max(1,(int)$this->input->get('page')); $limit=12; $offset=($page-1)*$limit;
        $filters=[
            'category_id'=>$this->input->get('category_id')?:null,
            'flavor_slug'=>$this->input->get('flavor')?:null,
            'discount'=>$this->input->get('discount')?:null,
            'popular'=>$this->input->get('popular')?:null,
            'search'=>$this->input->get('q')?:null,
            'sort'=>$this->input->get('sort')?:null
        ];
        $data['categories']=$this->Category_model->all();
        $data['products']=$this->Product_model->list($limit,$offset,array_filter($filters,function($v){return $v!==null && $v!=='';}));
        $data['total']=$this->Product_model->count_all($filters);
        $data['limit']=$limit; $data['page']=$page;
        // load flavors via model and pass to view instead of loading model inside view
        $this->load->model('Flavor_model');
        $data['flavors_bar'] = $this->Flavor_model->all();
        $data['currentFlavor'] = $this->input->get('flavor')?:null;
        $this->load->view('partials/header',$data);
        $this->load->view('products/index',$data);
        $this->load->view('partials/footer');
    }

    /**
     * AJAX endpoint: returns product cards HTML for given filters
     */
    public function ajax_list(){
        $limit = 12;
        $page = max(1,(int)$this->input->get('page'));
        $offset = ($page-1)*$limit;
        $filters = [
            'flavor_slug' => $this->input->get('flavor')?:null,
            'discount' => $this->input->get('discount')?:null,
            'popular' => $this->input->get('popular')?:null,
            'search' => $this->input->get('q')?:null,
            'sort' => $this->input->get('sort')?:null
        ];
        $products = $this->Product_model->list($limit,$offset,array_filter($filters,function($v){return $v!==null && $v!=='';}));
        $total = $this->Product_model->count_all($filters);
        $data = ['products'=>$products,'limit'=>$limit,'page'=>$page,'total'=>$total];
        // render partial cards
        echo $this->load->view('products/_cards',$data,TRUE);
        // also render pagination fragment
        // simple pagination HTML
        $pages = ceil($total/$limit);
        if($pages>1){
            echo '<nav><ul class="pagination">';
            for($i=1;$i<=$pages;$i++){
                $active = $i==$page? ' active' : '';
                echo '<li class="page-item'.$active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
            }
            echo '</ul></nav>';
        }
    }
    public function detail($id){
        $p=$this->Product_model->get($id); if(!$p) show_404();
        $data['product']=$p;
        $data['reviews']=$this->Review_model->for_product($id);
        $this->load->view('partials/header',$data);
        $this->load->view('products/detail',$data);
        $this->load->view('partials/footer');
    }
}
