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
        $this->load->view('partials/header',$data);
        $this->load->view('products/index',$data);
        $this->load->view('partials/footer');
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
