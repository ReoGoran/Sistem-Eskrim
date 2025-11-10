<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    private $table = 'users';

    public function get_by_email($email){
        return $this->db->get_where($this->table,['email'=>$email])->row();
    }
    public function create($data){
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    public function get($id){
        return $this->db->get_where($this->table,['id'=>$id])->row();
    }
    public function update_user($id,$data){
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table,$data,['id'=>$id]);
    }
}
