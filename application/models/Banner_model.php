<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model {
    public function active(){ return $this->db->order_by('sort_order','asc')->get_where('banners',['is_active'=>1])->result(); }
}
