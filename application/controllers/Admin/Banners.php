<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banners extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->auth_admin(); }
    private function auth_admin(){ if($this->session->userdata('role')!=='admin') redirect('login'); }
    public function index(){ $this->db->order_by('sort_order','asc'); $data['banners']=$this->db->get('banners')->result(); $this->load->view('admin/partials/header'); $this->load->view('admin/banners/index',$data); $this->load->view('admin/partials/footer'); }
    public function create()
    {
        if($this->input->method()==='post'){
            $title = $this->input->post('title', TRUE);
            $description = $this->input->post('description', TRUE);
            $image = NULL;
            if(!empty($_FILES['image']['name'])){
                $config = ['upload_path'=>UPLOAD_PATH_PRODUCTS,'allowed_types'=>ALLOWED_IMAGE_TYPES,'max_size'=>2048];
                $this->load->library('upload',$config);
                if($this->upload->do_upload('image')){
                    $file_name = $this->upload->data('file_name');
                    $full_path = $this->upload->data('full_path');
                    // resize uploaded image to banner size (width x height)
                    $target_w = 1200; $target_h = 700; // adjust if needed
                    $this->resize_image($full_path, $target_w, $target_h);
                    $image = '/public/assets/img/uploads/'.$file_name;
                }
            }
            $this->db->insert('banners',[
                'title'=>$title,
                'description'=>$description,
                'image'=>$image,
                'link'=>$this->input->post('link',TRUE),
                'is_active'=>$this->input->post('is_active')?1:0,
                'sort_order'=>$this->input->post('sort_order')?:0
            ]);
            return redirect('admin/banners');
        }

        $this->load->view('admin/partials/header');
        $this->load->view('admin/banners/create');
        $this->load->view('admin/partials/footer');
    }

    public function edit($id)
    {
        $b = $this->db->get_where('banners',['id'=>$id])->row();
        if(!$b) show_404();

        if($this->input->method()==='post'){
            $data = [
                'title'=>$this->input->post('title',TRUE),
                'description'=>$this->input->post('description',TRUE),
                'link'=>$this->input->post('link',TRUE),
                'is_active'=>$this->input->post('is_active')?1:0,
                'sort_order'=>$this->input->post('sort_order')?:0
            ];

            // handle image upload and remove old file if replaced
            if(!empty($_FILES['image']['name'])){
                $config = ['upload_path'=>UPLOAD_PATH_PRODUCTS,'allowed_types'=>ALLOWED_IMAGE_TYPES,'max_size'=>2048];
                $this->load->library('upload',$config);
                if($this->upload->do_upload('image')){
                    $file_name = $this->upload->data('file_name');
                    $full_path = $this->upload->data('full_path');
                    $target_w = 1200; $target_h = 700;
                    $this->resize_image($full_path, $target_w, $target_h);
                    $newImage = '/public/assets/img/uploads/'.$file_name;
                    $data['image'] = $newImage;
                    // remove old image file if exists
                    if(!empty($b->image)){
                        $oldPath = FCPATH . ltrim($b->image, '/');
                        if(file_exists($oldPath) && is_writable($oldPath)) @unlink($oldPath);
                    }
                }
            }

            $this->db->update('banners',$data,['id'=>$id]);
            return redirect('admin/banners');
        }

        $data['banner'] = $b;
        $this->load->view('admin/partials/header');
        $this->load->view('admin/banners/edit',$data);
        $this->load->view('admin/partials/footer');
    }

    public function delete($id = null)
    {
        // Prefer POST deletion with CSRF token. Accept id from POST or URL for compatibility.
        $targetId = $this->input->post('id') ?: $id;
        if(!$targetId) return redirect('admin/banners');

        $b = $this->db->get_where('banners',['id'=>$targetId])->row();
        if($b){
            // remove image file if exists
            if(!empty($b->image)){
                $path = FCPATH . ltrim($b->image, '/');
                if(file_exists($path) && is_writable($path)) @unlink($path);
            }
            $this->db->delete('banners',['id'=>$targetId]);
        }
        redirect('admin/banners');
    }

    /**
     * Resize an image to target dimensions (overwrite original file).
     * Uses GD functions and preserves JPEG/PNG/WebP based on original.
     */
    private function resize_image($filePath, $targetW, $targetH)
    {
        if(!file_exists($filePath)) return false;
        list($origW, $origH, $type) = getimagesize($filePath);
        if(!$origW || !$origH) return false;

        $src = null; $ext = '';
        switch($type){
            case IMAGETYPE_JPEG: $src = imagecreatefromjpeg($filePath); $ext='jpg'; break;
            case IMAGETYPE_PNG: $src = imagecreatefrompng($filePath); $ext='png'; break;
            case IMAGETYPE_WEBP: $src = imagecreatefromwebp($filePath); $ext='webp'; break;
            default: return false; // unsupported type
        }

        // Calculate aspect-fit cropping to fill target (cover behavior)
        $srcRatio = $origW / $origH;
        $targetRatio = $targetW / $targetH;
        if($srcRatio > $targetRatio){
            // source is wider: crop left/right
            $newHeight = $origH;
            $newWidth = intval($origH * $targetRatio);
            $srcX = intval(($origW - $newWidth) / 2);
            $srcY = 0;
        }else{
            // source is taller: crop top/bottom
            $newWidth = $origW;
            $newHeight = intval($origW / $targetRatio);
            $srcX = 0;
            $srcY = intval(($origH - $newHeight) / 2);
        }

        $dst = imagecreatetruecolor($targetW, $targetH);
        // preserve PNG transparency
        if($type == IMAGETYPE_PNG){ imagealphablending($dst, false); imagesavealpha($dst, true); }

        imagecopyresampled($dst, $src, 0,0, $srcX,$srcY, $targetW,$targetH, $newWidth,$newHeight);

        // overwrite original file
        switch($type){
            case IMAGETYPE_JPEG: imagejpeg($dst, $filePath, 86); break;
            case IMAGETYPE_PNG: imagepng($dst, $filePath); break;
            case IMAGETYPE_WEBP: imagewebp($dst, $filePath, 84); break;
        }

        imagedestroy($src);
        imagedestroy($dst);
        return true;
    }

    }
