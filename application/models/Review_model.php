<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends CI_Model {
    public function for_product($product_id){
        return $this->db->order_by('created_at','desc')->get_where('reviews',['product_id'=>$product_id,'is_approved'=>1])->result();
    }
    public function create($data){
        $this->db->insert('reviews',$data);
        return $this->db->insert_id();
    }
    public function delete($id){ return $this->db->delete('reviews',['id'=>$id]); }
}
