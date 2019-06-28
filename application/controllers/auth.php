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
        
        public function privacy_policy() {
            $this->load->view('admin/privacy_policy');    
        }
        
        public function terms_conditions() {
            $this->load->view('admin/terms_conditions');    
        }
        
        public function signUp()
    	{
            if ($this->input->is_ajax_request()) {
                
                $email = $this->input->get_post('useremail');
                $username = $this->input->get_post('username');
                $password = $this->input->get_post('password');
                $bio = $this->input->get_post('bio');
                
                {       
                        $filename= $_FILES["photo"]["name"];
                        $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
                        
                        $config['upload_path']       = './uploads/photo';
                        $config['allowed_types']     = 'gif|jpg|jpeg|png';
                        $new_name = time().$username.".".$file_ext;
                        $config['file_name'] = $new_name;
                        
                        $this->load->library('upload',$config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload("photo"))
                        {
                            $data['upload_data'] = $this->upload->data('file_name');
                            $image_name = $data['upload_data'];
                        }
                        else
                        {
                            $image_name = '';
                            show_error($this->upload->do_upload('photo'));
                            exit;
                            
                        }
                    }
                

                if ($this->Auth_model->isExistsEmailAndName($email, $username)) {
                    echo '<b>This Email Address has already registered.</b>';
                    exit;
                }
                
                if($this->Auth_model->sendSignUp($username, $email, $password, $new_name, $bio)){
                    echo'true';
                }else{
                    echo'false';
                }
                exit;
            }
            $this->load->view('auth/signup');
                
    	}
        
        public function changeProfile() {
            if (!isset($this->session->userdata['user_email'])) {
                echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
                exit;
            }
            
            $useremail = $this->session->userdata['user_email'];
        
            $bio = $this->input->get_post('bio');
            $filename= $_FILES["photo"]["name"];
            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            
            $config['upload_path']       = './uploads/photo';
            $config['allowed_types']     = 'gif|jpg|jpeg|png';
            $new_name = time().".".$file_ext;
            $config['file_name'] = $new_name;
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload("photo"))
            {
                $data['upload_data'] = $this->upload->data('file_name');
                $image_name = $data['upload_data'];
            }
            else
            {
                echo FALSE;
                exit;
                
            }
            
            if($this->Auth_model->changeProfile($useremail, $new_name, $bio)){
                $this->session->set_userdata('user_bio', $bio);
                $this->session->set_userdata('user_photo', $new_name);
                echo $new_name;
            }else{
                echo FALSE;
            }
        }
        
        public function resetPassword(){
            $data['email'] = $this->uri->segment(2);
            $this->load->view('auth/resetpass', $data);
        }
        
        public function resetProcess() {
            $email = $this->input->get_post('email');
            $username = $this->Auth_model->getUserNameByEmail($email);
            
            if($this->Auth_model->isEmailExists($email)) {
                $realpassword = uniqid();
                //send email with #realpass as a link
                $config = Array(
                    //'smtp_crypto' => 'tls',
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com', //'smtp.live.com',
                    'smtp_port' => 465, //587
                    'smtp_user' => 'rps.outgoings@gmail.com
    ',//'rps_outgoings@hotmail.com',
                    'smtp_pass' => 'Sylvia2019$',
                    'mailtype' => 'html', 
                    'charset' => 'iso-8859-1'
                    );


                $this->load->library('email', $config);
                
                $this->email->set_newline("\r\n");
                
                $this->email->from('rps.outgoings@gmail.com', "RPS Bet - New Password - No Reply");
                $this->email->to($email);
                $this->email->subject("New Password");
                
                $message = "Hi, ".$username."!<br>";
                $message .= "<p>It seems like you've forgotten your password. Don't worry, we've generated a new one for you:</p>";
                $message .= "<b>".$realpassword."</b>";
                $message .= "<p>For any other concerns you may have, you can contact our supportive team - <u>online@rpsbet.com</u>.<br><br>Kind Regards.<br>RPS Bet Team</p>";
                $this->email->message($message);
                
                if($this->email->send()){
                    if($this->Auth_model->resetPassword($email, $realpassword)) {
                        echo 'okay';
                    } else {
                        echo 'error processing.';    
                    }
                }else{
                    show_error($this->email->print_debugger());
                    //echo "email was not sent, please contact your administrator";
                }
            } else {
                echo 'Email Not Registered';
            }
            exit;
        }
        
        public function sendMailToUser($email, $amount) {
            $config = Array(
                //'smtp_crypto' => 'tls',
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com', //'smtp.live.com',
                'smtp_port' => 465, //587
                'smtp_user' => 'rps.outgoings@gmail.com
',//'rps_outgoings@hotmail.com',
                'smtp_pass' => 'Sylvia2019$',
                'mailtype' => 'html', 
                'charset' => 'iso-8859-1'
                );

            $username = $this->Auth_model->getUserNameByEmail($email);
            
            $this->load->library('email', $config);
            
            $this->email->set_newline("\r\n");
            
            $this->email->from('rps.outgoings@gmail.com', "RPS Bet - Withdraw - No Reply");
            $this->email->to($email);
            $this->email->subject("Withdrawal Requested - Your Receipt");

            $message = "Hi, ".$username."!<br><p>You have requested to withdraw ";
            $message .= "&pound;".$amount;
            $message .= ". Please wait up to 4-6 working hours for your earnings to process.<hr>";
            $message .= "<h4>Working Hours (GMT)</h4><ul><li><b>Mon-Sat:</b> 8AM - 8PM</li><li><b>Sun:</b> 8AM - 4PM</li></ul><hr>";
            $message .= "Thanks for betting with RPS Bet. We appreciate your patience to receive your Winnings.<br>If there any problems with your payments or for any concerns in general, please contact: <u>online@rpsbet.com</u>.<br><br>Kind Regards.<br>RPS Bet Team</p>";
            
            $this->email->message($message);
            
            if(!$this->email->send()){
                // show_error($this->email->print_debugger());
                echo "Email was not sent, please contact online@rpsbet.com.";
            }
        }
        
        public function sendMailToManager($useremail, $account, $amount) {
            $config = Array(
                //'smtp_crypto' => 'tls',
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',//'smtp.live.com',
                'smtp_port' => 465, //587
                'smtp_user' => 'rps.outgoings@gmail.com
',//'rps_outgoings@hotmail.com',
                'smtp_pass' => 'Sylvia2019$',
                'mailtype' => 'html', 
                'charset' => 'iso-8859-1'
                );

            $username = $this->Auth_model->getUserNameByEmail($useremail);
            
            $this->load->library('email', $config);
            
            $this->email->set_newline("\r\n");
            
            $this->email->from('rps.outgoings@gmail.com', "RPS Withdrawal Request");
            $this->email->to('online@rpsbet.com');
            $this->email->subject("Withdrawal");

            //User's email
            $message = "Hi, ".$username."<br><p>User's Email Address:</p>";
            $message .= $useremail;
            
            //User's bank
            $message .= "<p>User&#39;s sort code/account number OR paypal address:</p>";
            $message .= $account;
            
            //Amount
            $message .= "<p>Amount to Send:</p>";
            $message .= $amount;
            
            $this->email->message($message);
            
            if(!$this->email->send()){
                echo "Email was not sent, please contact online@rpsbet.com.";
            }
        }
        
        public function withdrawproc() {
            if (!isset($this->session->userdata['user_email'])) {
                echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
                exit;
            }
            
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
            $resultBalance = $this->Auth_model->resetBalance($useremail, $amount_withdraw);
            echo $resultBalance;
        }
        
        public function changePwd() {
            if (!isset($this->session->userdata['user_email'])) {
                echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
                exit;
            }
            
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
            if (!isset($this->session->userdata['user_email'])) {
                echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
                exit;
            }
            
            $newemail = $this->input->post('newmail');
            $useremail = $this->session->userdata['user_email'];
            
            $returnVal = $this->Auth_model->updateEmail($useremail, $newemail);
            if ($returnVal != 'fail')
            {
                $res = $this->session->set_userdata('user_email', $newemail);
                echo $returnVal;
            } else {
                echo 'fail';
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
                    $userBio = $this->Auth_model->getBioByEmail($useremail);
                    $userPhoto = $this->Auth_model->getPhotoByEmail($useremail);
                    
                    $this->session->set_userdata('user_email', $useremail);
                    $this->session->set_userdata('user_name', $username);
                    $this->session->set_userdata('user_bio', $userBio);
                    $this->session->set_userdata('user_photo', $userPhoto);
                    
                    $balance = $this->Auth_model->getUserBalance($useremail);
                    $this->session->set_userdata('balance', $balance);
    
                    echo 'true';exit();
                }else{
                    echo 'false';exit();
                }
                exit;
            }    
            redirect(base_url().'auth');
        }
}