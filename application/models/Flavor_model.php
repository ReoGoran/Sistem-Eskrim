<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flavor_model extends CI_Model {
    private $table = 'flavors';

    public function all(){
        return $this->db->order_by('name','asc')->get($this->table)->result();
    }
    public function get($id){
        return $this->db->get_where($this->table,['id'=>$id])->row();
    }
    public function get_by_slug($slug){
        return $this->db->get_where($this->table,['slug'=>$slug])->row();
    }
    public function create($data){
        $data['created_at']=date('Y-m-d H:i:s');
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    public function update($id,$data){
        return $this->db->update($this->table,$data,['id'=>$id]);
    }
    public function delete($id){
        return $this->db->delete($this->table,['id'=>$id]);
    }
    public function assign_to_product($product_id,$flavor_ids){
        // clear existing
        $this->db->delete('product_flavors',[ 'product_id'=>$product_id ]);
        $rows=[];
        foreach($flavor_ids as $fid){
            if(!$fid) continue; $rows[]=['product_id'=>$product_id,'flavor_id'=>$fid];
        }
        if(!empty($rows)) $this->db->insert_batch('product_flavors',$rows);
    }
    public function flavors_for_product($product_id){
        return $this->db->select('f.*')
            ->from('product_flavors pf')
            ->join('flavors f','pf.flavor_id=f.id','inner')
            ->where('pf.product_id',$product_id)
            ->get()->result();
    }
}
