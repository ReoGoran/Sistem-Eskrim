<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    private $table='categories';
    public function all(){ return $this->db->order_by('name','asc')->get($this->table)->result(); }
}
