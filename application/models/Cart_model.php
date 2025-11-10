<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {
    public function get_cart_id($user_id){
        $row=$this->db->get_where('carts',['user_id'=>$user_id])->row();
        if($row) return $row->id;
        $this->db->insert('carts',['user_id'=>$user_id]);
        return $this->db->insert_id();
    }
    public function add_item($user_id,$product){
        $cart_id=$this->get_cart_id($user_id);
        $existing=$this->db->get_where('cart_items',['cart_id'=>$cart_id,'product_id'=>$product->id])->row();
        if($existing){
            $this->db->set('qty','qty+1',FALSE)->where('id',$existing->id)->update('cart_items');
        } else {
            $this->db->insert('cart_items',[ 'cart_id'=>$cart_id,'product_id'=>$product->id,'qty'=>1,'price'=>$product->price,'weight_kg'=>$product->weight_kg ]);
        }
    }
    public function items($user_id){
        $cart_id=$this->get_cart_id($user_id);
        return $this->db->get_where('cart_items',['cart_id'=>$cart_id])->result();
    }
    public function totals($user_id){
        $items=$this->items($user_id); $subtotal=0; $weight=0; foreach($items as $i){$subtotal+=$i->price*$i->qty; $weight+=$i->weight_kg*$i->qty;} return ['subtotal'=>$subtotal,'weight'=>$weight];
    }
    public function clear($user_id){
        $cart_id=$this->get_cart_id($user_id); $this->db->delete('cart_items',['cart_id'=>$cart_id]);
    }
}
