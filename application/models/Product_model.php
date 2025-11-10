<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    private $table = 'products';

    public function list($limit=12,$offset=0,$filters=[]){
        if(isset($filters['category_id'])) $this->db->where('category_id',$filters['category_id']);
        if(!empty($filters['flavor_slug'])){
            $this->db->join('product_flavors pf','pf.product_id=products.id','inner');
            $this->db->join('flavors f','f.id=pf.flavor_id','inner');
            $this->db->where('f.slug',$filters['flavor_slug']);
        }
        if(isset($filters['discount'])) $this->db->where('is_discount',1);
        if(isset($filters['popular'])) $this->db->where('is_popular',1);
        if(isset($filters['search'])){
            $this->db->group_start();
            $this->db->like('name',$filters['search']);
            $this->db->or_like('description',$filters['search']);
            $this->db->group_end();
        }
        // Make ORDER BY explicit to avoid ambiguous column when joins are present
        if(isset($filters['sort'])){
            if($filters['sort']=='price_asc') $this->db->order_by('products.price','asc');
            elseif($filters['sort']=='price_desc') $this->db->order_by('products.price','desc');
            else $this->db->order_by('products.id','desc');
        } else {
            $this->db->order_by('products.id','desc');
        }
        return $this->db->get($this->table,$limit,$offset)->result();
    }
    public function count_all($filters=[]){
        if(isset($filters['category_id'])) $this->db->where('category_id',$filters['category_id']);
        if(!empty($filters['flavor_slug'])){
            $this->db->join('product_flavors pf','pf.product_id=products.id','inner');
            $this->db->join('flavors f','f.id=pf.flavor_id','inner');
            $this->db->where('f.slug',$filters['flavor_slug']);
        }
        if(isset($filters['discount'])) $this->db->where('is_discount',1);
        if(isset($filters['popular'])) $this->db->where('is_popular',1);
        if(isset($filters['search'])){
            $this->db->group_start();
            $this->db->like('name',$filters['search']);
            $this->db->or_like('description',$filters['search']);
            $this->db->group_end();
        }
        return $this->db->count_all_results($this->table);
    }
    public function get($id){
        return $this->db->get_where($this->table,['id'=>$id])->row();
    }
    public function create($data){
        $data['created_at']=date('Y-m-d H:i:s');
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    public function update_product($id,$data){
        $data['updated_at']=date('Y-m-d H:i:s');
        return $this->db->update($this->table,$data,['id'=>$id]);
    }
    public function delete($id){
        return $this->db->delete($this->table,['id'=>$id]);
    }
}
