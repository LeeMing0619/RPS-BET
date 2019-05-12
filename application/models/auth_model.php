<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('Mailer');

        $this->table = 'auth';
    }

    public function login($name, $password) {
        $this->db->where('uname', $name);
        $this->db->where('password', md5($password));
        $this->db->where('status', 1);
        $query = $this->db->get('auth');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $data = array(
                    'username' => $row->email,
                    'logged_in' => TRUE,
                    'role'=>$row->role
                );
            }
            $this->session->set_userdata($data);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getUserBalance($param) {
        $this->db->where('email', $param);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }

        return $balance;
    }

    public function setUserBalance($param, $param1) {
        $balance = array('balance' => $param);
        $this->db->where('email', $param1);
        $this->db->update('auth', $balance);
    }


    /*
        param 1 : user name
        param 2 : email
        param 3 : password
    */
    public function sendSignUp($param1, $param2, $param3) {
        $username = $param1;
        $email = $param2;
        $password = md5($param3);

        $this->db->where('email', $email);
        $query = $this->db->get('auth');

        if ($query->num_rows() > 0) {
            return false;
        } else {
            $res = $this->db->insert("auth", array('uname'=>$username, 'email'=>$email, 'password'=>$password, 'status'=>1));      

            if ($res == 1) return true; 
            else return false;
        }
    }
    
    public function isEmailExists($email) {
        $query = $this->db->query("SELECT email, password FROM auth WHERE email='$email'");    
        if($row = $query->row()){
            return TRUE;
        }else{
            return FALSE;
        }    
    }
    
    public function resetPassword($param, $pass) {
        $password = md5($pass);
        $sql = "Update auth SET password='$password' WHERE email ='$param'";
        $this->db->query($sql);
        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    public function updateEmail($param, $pass) {
        $sql = "Update auth SET email='$pass' WHERE email ='$param'";
        $this->db->query($sql);
        if($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }

    public function getUserNameByEmail($email) {
        $this->db->where('email', $email);
        $res = $this->db->get('auth');
        $res = $res->result();

        $username = '';
        foreach ($res as $row) {
            # code...
            $username = $row->uname;
        }

        return $username;
    }
    
    public function getEmailByUserName($name) {
        $this->db->where('uname', $name);
        $res = $this->db->get('auth');
        $res = $res->result();

        $username = '';
        foreach ($res as $row) {
            # code...
            $username = $row->email;
        }

        return $username;
    }
    
    public function isLoggedIn() {
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        $is_logged_in = $this->session->userdata('logged_in');

        if (!isset($is_logged_in) || $is_logged_in !== TRUE) {
            redirect('/auth');
            exit;
        }
    }

//    public function sendMail() {
//        $mail = new PHPMailer();
//        $body = '<div style="width: 400px; border: 2px solid #ddd; padding: 10px;">
//                <a href="http://webrocom.net/" style="text-align: center; display: block; text-transform: uppercase; font-size: 25px; background: #33ccff; color: #fff">webrocom</a>
//                <p style="background: #efe9e9; font-size: 15px; padding: 4px;">Your Name:<span style="font-size: 15px; padding: 4px; font-weight: bold"></span></p>
//                <p style="background: #efe9e9; font-size: 15px; padding: 4px;">Your Email:<span style="font-size: 15px; padding: 4px; font-weight: bold"></span></p>
//                <p style="background: #efe9e9; font-size: 15px; padding: 4px;">Your Message:<span style="font-size: 15px; padding: 4px; font-weight: bold"></span></p>
//            </div>';
//        $mail->IsSMTP(); // we are going to use SMTP
//        $mail->SMTPAuth = true; // enabled SMTP authentication
//        $mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
//        $mail->Host = "smtp.gmail.com";      // setting GMail as our SMTP server
//        $mail->Port = 587;                   // SMTP port to connect to GMail
//        $mail->Username = "erentservices";  // user email address
//        $mail->Password = "erentservices";            // password in GMail
//        $mail->SetFrom('webrocom@gmail.com', 'Vikram Parihar');  //Who is sending the email
//        $mail->AddReplyTo("pariharvikram1989@gmail.com", "Vikram Parihar");  //email address that receives the response
//        $mail->Subject = "PHPMailer Test by Gmail tuts on webrocom";
//        $mail->msgHTML($body);
//        $mail->AltBody = "Plain text message";
//        $mailto = "vikram.parihar@mediatech.co.in";
//        $mail->AddAddress($mailto, "John Doe");
//        if (!$mail->Send()) {
//            echo $mail->ErrorInfo;
//            return FALSE;
//        } else {
//            return true;
//        }
//    }

}
