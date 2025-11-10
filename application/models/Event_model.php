<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {
    public function active(){ return $this->db->order_by('created_at','desc')->get_where('events',['is_active'=>1])->result(); }
}
