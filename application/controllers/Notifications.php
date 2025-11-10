<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notifications extends CI_Controller {
    public function __construct(){ parent::__construct(); $this->load->model('Notification_model'); }
    public function pull(){
        $uid=$this->session->userdata('user_id');
        $count=$uid?$this->Notification_model->unread_count($uid):0;
        return $this->output->set_content_type('application/json')->set_output(json_encode(['count'=>$count]));
    }
}
