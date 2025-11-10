<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }
    private function throttle_check($email){
        $window=LOGIN_ATTEMPT_WINDOW_MIN; $limit=MAX_LOGIN_ATTEMPTS;
        $sql="SELECT COUNT(*) c FROM auth_attempts WHERE email=? AND attempted_at>=DATE_SUB(NOW(),INTERVAL ? MINUTE) AND success=0";
        $row=$this->db->query($sql,[$email,$window])->row();
        return ($row && $row->c>=$limit);
    }
    public function login(){
        $debug_mode = (ENVIRONMENT === 'development' && $this->input->get('debug'));
        $view_data = [];
        if($this->input->method()=='post'){
            $email=trim($this->input->post('email',TRUE));
            $pass=$this->input->post('password');
            $throttled = $this->throttle_check($email);
            if($throttled && !$debug_mode){
                $this->session->set_flashdata('error','Terlalu banyak percobaan. Coba lagi nanti.');
                return redirect('login');
            }
            $user=$this->User_model->get_by_email($email);
            $ok = $user && password_verify($pass,$user->password_hash);
            $this->db->insert('auth_attempts',[ 'email'=>$email,'ip'=>$this->input->ip_address(),'success'=>$ok?1:0 ]);
            if($ok){
                $this->session->set_userdata(['user_id'=>$user->id,'role'=>$user->role,'name'=>$user->name]);
                if($user->role==='admin') return redirect('admin');
                return redirect('/');
            }
            if($debug_mode){
                $attempts_row = $this->db->query("SELECT COUNT(*) c FROM auth_attempts WHERE email=? AND attempted_at>=DATE_SUB(NOW(),INTERVAL ? MINUTE)",[$email,LOGIN_ATTEMPT_WINDOW_MIN])->row();
                $view_data['debug'] = [
                    'email_input' => $email,
                    'user_exists' => (bool)$user,
                    'hash_prefix' => $user?substr($user->password_hash,0,20):null,
                    'password_len' => strlen($pass),
                    'verify_result' => $user?password_verify($pass,$user->password_hash):false,
                    'throttled' => $throttled,
                    'attempts_in_window' => $attempts_row?$attempts_row->c:0
                ];
            } else {
                $this->session->set_flashdata('error','Email atau password salah.');
                return redirect('login');
            }
        }
        $this->load->view('partials/header');
        $this->load->view('auth/login',$view_data);
        $this->load->view('partials/footer');
    }
    public function register(){
        if($this->input->method()=='post'){
            $this->form_validation->set_rules('name','Nama','required|min_length[3]');
            $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('whatsapp','WhatsApp','required|min_length[8]');
            $this->form_validation->set_rules('password','Password','required|min_length[6]');
            $this->form_validation->set_rules('password_confirm','Konfirmasi Password','required|matches[password]');
            if($this->form_validation->run()){
                // Buat akun baru (role default 'user') lalu arahkan kembali ke halaman login.
                $this->User_model->create([
                    'name'=>$this->input->post('name',TRUE),
                    'email'=>$this->input->post('email',TRUE),
                    'whatsapp'=>$this->input->post('whatsapp',TRUE),
                    'password_hash'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                ]);
                // Tidak auto-login: pakai flash message agar user tahu pendaftaran berhasil.
                $this->session->set_flashdata('success','Pendaftaran berhasil. Silakan login.');
                return redirect('login');
            }
        }
        $this->load->view('partials/header');
        $this->load->view('auth/register');
        $this->load->view('partials/footer');
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }

    // Development helper: reset admin password to 'admin' locally
    public function reset_admin(){
        if(ENVIRONMENT === 'production') show_404();
        $email = 'admin@icescoop.local';
        $hash = password_hash('admin', PASSWORD_DEFAULT);
        $this->db->update('users',[ 'password_hash'=>$hash, 'role'=>'admin' ],['email'=>$email]);
        // clear throttling attempts for this email in dev
        $this->db->delete('auth_attempts',['email'=>$email]);
        // Immediately output hash prefix for verification in dev
        $row = $this->db->get_where('users',['email'=>$email])->row();
        echo 'Admin password reset to "admin" for '.$email.' Hash prefix: '.substr($row->password_hash,0,20);
    }

    // Ensure admin user exists or create it with password 'admin'
    public function ensure_admin(){
        if(ENVIRONMENT === 'production') show_404();
        $email = 'admin@icescoop.local';
        $user = $this->User_model->get_by_email($email);
        $hash = password_hash('admin', PASSWORD_DEFAULT);
        if($user){
            $this->db->update('users',[ 'password_hash'=>$hash, 'role'=>'admin', 'name'=>'Admin' ],['id'=>$user->id]);
            // clear throttling attempts for this email in dev
            $this->db->delete('auth_attempts',['email'=>$email]);
            echo 'Admin updated. ID='.$user->id.' New hash prefix='.substr($hash,0,20);
        } else {
            $this->db->insert('users',[ 'name'=>'Admin','email'=>$email,'whatsapp'=>'000','password_hash'=>$hash,'role'=>'admin','created_at'=>date('Y-m-d H:i:s') ]);
            $id=$this->db->insert_id();
            // clear throttling attempts for this email in dev
            $this->db->delete('auth_attempts',['email'=>$email]);
            echo 'Admin inserted. ID='.$id.' Hash prefix='.substr($hash,0,20);
        }
        echo "\nUse email: $email password: admin";
    }

    // Development helper: clear throttling attempts for an email
    public function clear_attempts(){
        if(ENVIRONMENT === 'production') show_404();
        $email = trim($this->input->get('email')) ?: 'admin@icescoop.local';
        $this->db->delete('auth_attempts',['email'=>$email]);
        echo 'Cleared auth attempts for '.$email;
    }
}
