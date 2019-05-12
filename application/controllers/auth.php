<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Auth extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->Model('Auth_model');
        }

        public function index()
    	{
    	    $session_setvalue = $this->session->all_userdata();
    	    
            //check for remember data
            if (isset($session_setvalue['remember_me']) && $session_setvalue['remember_me'] == "1") {
                redirect('/memberList');
            }else {
                $this->load->view('auth/login');
            }
    	}
        
        public function signUp()
    	{ 
                
                if ($this->input->is_ajax_request()) {
                    
                    $email = $this->input->get_post('email');
                    $username = $this->input->get_post('username');
                    $password = $this->input->get_post('password');

                 if($this->Auth_model->sendSignUp($username, $email, $password)){
                     echo'true';
                 }else{
                     echo'false';
                 }
                exit;
                }
                $this->load->view('auth/signup');
                
    	}
        
        public function resetPassword(){
            $data['email'] = $this->uri->segment(2);
            $this->load->view('auth/resetpass', $data);
        }
        
        public function resetProcess() {
                $email = $this->input->get_post('email');
                
                if($this->Auth_model->isEmailExists($email)) {
                    $realpassword = uniqid();
                    //send email with #realpass as a link
                    $config = Array(
                        'smtp_crypto' => 'tls',
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.live.com',
                        'smtp_port' => 587,
                        'smtp_user' => 'leeming0619@hotmail.com',
                        'smtp_pass' => 'panda0619',
                        'mailtype' => 'html', 
                        'charset' => 'iso-8859-1'
                        );


                    $this->load->library('email', $config);
                    
                    $this->email->set_newline("\r\n");
                    
                    $this->email->from('leeming0619@hotmail.com', "leeming");
                    $this->email->to($email);
                    $this->email->subject("Reset your Password");
        
                    $message = "<p>This is reset password, please use it:</p>";
                    $message .= $realpassword;
                    $this->email->message($message);
                    
                    if($this->email->send()){
                        if($this->Auth_model->resetPassword($email, $realpassword)) {
                            echo 'okay';
                        } else {
                            echo 'error processing.';    
                        }
                    }
                    else{
                        //show_error($this->email->print_debugger());
                        echo "email was not sent, please contact your administrator";
                    }
                } else {
                    echo 'None registered this email.';
                }
                exit;
        }
        
        public function sendMailToUser($email, $amount) {
            $config = Array(
                'smtp_crypto' => 'tls',
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.live.com',
                'smtp_port' => 587,
                'smtp_user' => 'leeming0619@hotmail.com',
                'smtp_pass' => 'panda0619',
                'mailtype' => 'html', 
                'charset' => 'iso-8859-1'
                );


            $this->load->library('email', $config);
            
            $this->email->set_newline("\r\n");
            
            $this->email->from('leeming0619@hotmail.com', "leeming");
            $this->email->to($email);
            $this->email->subject("Rock-Paper-Scissors");

            $message = "<p>You have requested to withdraw ";
            $message .= $amount;
            $message .= ". Please wait up to 2-3 working days for your earnings to process.</p>";
            
            $this->email->message($message);
            
            if($this->email->send()){
                echo 'okay';
            }
            else{
                // show_error($this->email->print_debugger());
                echo "email was not sent, please contact your administrator";
            }
        }
        
        public function sendMailToManager($useremail, $account, $amount) {
            $config = Array(
                'smtp_crypto' => 'tls',
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.live.com',
                'smtp_port' => 587,
                'smtp_user' => 'leeming0619@hotmail.com',
                'smtp_pass' => 'panda0619',
                'mailtype' => 'html', 
                'charset' => 'iso-8859-1'
                );


            $this->load->library('email', $config);
            
            $this->email->set_newline("\r\n");
            
            $this->email->from('leeming0619@hotmail.com', "leeming");
            $this->email->to('online@rpsbet.com');
            $this->email->subject("Rock-Paper-Scissors");

            //User's email
            $message = "<p>User Email:</p>";
            $message .= $useremail;
            
            //User's bank
            $message = "<p>User’s sort code/account number OR paypal address:</p>";
            $message .= $account;
            
            //
            $message = "<p>Amount withdraw:</p>";
            $message .= $amount;
            
            $this->email->message($message);
            
            if($this->email->send()){
                echo 'okay';
            }
            else{
                echo "email was not sent, please contact your administrator";
            }
        }
        
        public function withdrawproc() {
            $useremail = $this->session->userdata['user_email'];
            $bankmethod = $this->input->post('bank');
            $accountnumber = '';
            $paypal = "";
            $amount_withdraw = $this->input->post('withdraw');
            
            if($bankmethod == 0) {
                $accountnumber = $this->input->post('accountnumber');
                
                $this->sendMailToManager($useremail, $accountnumber, $amount_withdraw);
                
            } else {
                $paypal = $this->input->post('paypal');
                
                $this->sendMailToManager($useremail, $paypal, $amount_withdraw);
            }
            
            $this->sendMailToUser($useremail, $amount_withdraw);
        }
        
        public function changePwd() {
            $newpwd = $this->input->post('newpwd');
            $useremail = $this->session->userdata['user_email'];
            
            if ($this->Auth_model->resetPassword($useremail, $newpwd))
            {
                echo TRUE;
            } else {
                echo FALSE;
            }
        }
        
        public function changeEmail() {
            $newemail = $this->input->post('newmail');
            $useremail = $this->session->userdata['user_email'];
            
            if ($this->Auth_model->updateEmail($useremail, $newemail))
            {
                $this->session->set_userdata('user_email', $newemail);
                echo TRUE;
            } else {
                echo FALSE;
            }
        }
        public function logout(){
            $this->session->sess_destroy();
            header("cache-Control: no-store, no-cache, must-revalidate");
            header("cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
            redirect('auth/' ,'refresh');
            exit;
        }
        
        public function login(){
            
            $session_setvalue = $this->session->all_userdata();
            
            /*//check for remember data
            if (isset($session_setvalue['remember_me']) && $session_setvalue['remember_me'] == "1") {
                $this->load->view('admin/default_list');
                exit;
            } else {*/
                if ($this->input->is_ajax_request()) {
                    $username =  $this->input->post('username');
                    $password =  $this->input->post('password');
                    $remember = $this->input->post('keep');
                    
                    if ($remember) {
                        $this->session->set_userdata('remember_me', TRUE);
                    }
                    //call the model for auth
                    if($this->Auth_model->login($username, $password)){
                        $useremail = $this->Auth_model->getEmailByUserName($username);
                        
                        $this->session->set_userdata('user_email', $useremail);
                        
                        $this->session->set_userdata('user_name', $username);
        
                        $balance = $this->Auth_model->getUserBalance($useremail);
                        $this->session->set_userdata('balance', $balance);
        
                        //
                        echo 'true';
                    }else{
                        echo 'false';
                    }
                    exit;
                }    
            //}
            
            redirect(base_url().'auth');
        }
}