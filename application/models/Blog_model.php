<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {
    public function list($limit=10,$offset=0){
        $this->db->where('is_published',1)->order_by('created_at','desc');
        return $this->db->get('blog_posts',$limit,$offset)->result();
    }
    public function get_by_slug($slug){
        return $this->db->get_where('blog_posts',['slug'=>$slug,'is_published'=>1])->row();
    }
    public function create($data){ $this->db->insert('blog_posts',$data); return $this->db->insert_id(); }
}
