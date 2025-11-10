<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
    public function create_from_cart($user_id,$address_id){
        $this->load->model('Cart_model');
        $totals=$this->Cart_model->totals($user_id);
        $weight=ceil($totals['weight']);
        $shipping=$weight*SHIPPING_RATE_PER_KG;
        $order_code=strtoupper(substr(md5(uniqid(mt_rand(),true)),0,10));
        $order=[ 'order_code'=>$order_code,'user_id'=>$user_id,'address_id'=>$address_id,'subtotal'=>$totals['subtotal'],'shipping_cost'=>$shipping,'total'=>$totals['subtotal']+$shipping,'status'=>'Placed','created_at'=>date('Y-m-d H:i:s') ];
        $this->db->insert('orders',$order);
        $order_id=$this->db->insert_id();
        $items=$this->Cart_model->items($user_id);
        foreach($items as $i){
            $p=$this->db->get_where('products',['id'=>$i->product_id])->row();
            $this->db->insert('order_items',[ 'order_id'=>$order_id,'product_id'=>$i->product_id,'name'=>$p?$p->name:'Unknown','price'=>$i->price,'qty'=>$i->qty,'weight_kg'=>$i->weight_kg ]);
        }
        $this->db->insert('order_status_history',['order_id'=>$order_id,'status'=>'Placed']);
        $this->Cart_model->clear($user_id);
        return $order_code;
    }
    public function get_by_code($code){
        return $this->db->get_where('orders',['order_code'=>$code])->row();
    }
    public function items($order_id){
        return $this->db->get_where('order_items',['order_id'=>$order_id])->result();
    }
    public function history($order_id){
        return $this->db->order_by('id','asc')->get_where('order_status_history',['order_id'=>$order_id])->result();
    }
    public function update_status($order_id,$status){
        $this->db->update('orders',['status'=>$status,'updated_at'=>date('Y-m-d H:i:s')],['id'=>$order_id]);
        $this->db->insert('order_status_history',['order_id'=>$order_id,'status'=>$status]);
        $order=$this->db->get_where('orders',['id'=>$order_id])->row();
        if($order){
            $this->db->insert('notifications',[ 'user_id'=>$order->user_id,'title'=>'Order Update','message'=>'Status updated to '.$status ]);
            if($status=='Delivered'){
                // finance record revenue
                $this->db->insert('finance_transactions',[ 'type'=>'revenue','order_id'=>$order_id,'label'=>'Order revenue','amount'=>$order->total,'occurred_on'=>date('Y-m-d') ]);
            }
        }
    }
}
