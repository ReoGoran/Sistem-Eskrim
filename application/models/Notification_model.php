<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {
    public function unread_count($user_id){
        return $this->db->where(['user_id'=>$user_id,'is_read'=>0])->count_all_results('notifications');
    }
    public function mark_all_read($user_id){
        $this->db->update('notifications',['is_read'=>1],['user_id'=>$user_id]);
    }
}
