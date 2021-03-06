<?php
class Login extends CI_Controller
{
    function index(){

        $this->form_validation->set_rules('login', 'Username or Email Address', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
           $this->form_validation->set_error_delimiters('<div class="error" style="color:red">', '</div>');
            $this->load->view('login');
        }
        $login = $_POST['login'];
        $password = $_POST['password'];

        $result = $this->Login_model->checkuser($login,$password);
        $u_id = '';
        foreach ($result as $row){
            $u_id = $row->u_id;
            $fname = $row->fname;
            $lname = $row->lname;
            $username = $row->username;
            $email = $row->email;
            $status = $row->status;
        }

        if($u_id == ''){
            $data['login_error'] = 'Invalid Username or Password';
            $this->load->view('login',$data);
        }
        else{

            $sess_data =array(
                'u_id' => $u_id,
                'dis_name' => $fname ." ". $lname,
                'username' => $username,
                'email' => $email,
                'status' => $status
            );

            $this->session->set_userdata($sess_data);
            redirect('Welcome');
        }
    }

    function logout(){
        $array_items = array('username', 'email','u_id','dis_name');
        $this->session->unset_userdata($array_items);
        session_destroy();
        redirect('Welcome');
    }
}