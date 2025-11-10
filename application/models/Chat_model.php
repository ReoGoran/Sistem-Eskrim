<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {
    public function list_for_user($user_id,$order_id=null){
        if($order_id) $this->db->where('order_id',$order_id);
        return $this->db->order_by('created_at','asc')->get_where('chat_messages',['user_id'=>$user_id])->result();
    }
    public function add_message($user_id,$message,$sent_by='user',$order_id=null,$admin_id=null){
        $this->db->insert('chat_messages',[ 'user_id'=>$user_id,'admin_id'=>$admin_id,'order_id'=>$order_id,'message'=>$message,'sent_by'=>$sent_by ]);
    }
}
