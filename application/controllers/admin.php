<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;


require 'vendor/autoload.php';

define('SITE_URL', 'http://localhost/register');

class Admin extends CI_Controller {
    
    public $delete_id = array();

    public $bbb = "sadfafas";

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->Model('Auth_model');
    }

    public function index() {
        $this->load->view('admin/home');
        $this->Auth_model->isLoggedIn();
    }

    public function getPayPal() {
        $paypal = new ApiContext(
            new OAuthTokenCredential(
                //cliend id
                'AcjgffUCQGK6GzhXm3hNvgxO1uSaHv6b_jm_aPQpb94TF9KxumlLLCLmBQRF2IwUJNaBzMe_2tmGjQis', 
                //sec id
                'EC5gGXp777iRcY0-XcnWjnrXHD2UAlHNo1WB8SlU3ctg78vyYao1ngTVptec-bZGtmq2guTrO7Mab4dv'
            )
        );

        $paypal->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true
            )
        );
        return $paypal;
    }

    public function checkout() {
        $this->load->view('admin/checkout');
        $this->Auth_model->isLoggedIn();
    }

    public function memberIndex() {
        $this->load->view('admin/create_member');
    }

    public function memberCreate() {
        
//                        general information
        $family['betamount'] = $this->input->post('betamount');
        $family['potential'] = $this->input->post('potential');
        $family['privated'] = $this->input->post('privated');
        $family['card'] = $this->input->post('card');
        $family['note'] = $this->input->post('note');
        $family['password'] = $this->input->post('password');
        
        $betamount = $family['betamount'];
        $shipping = 0.00;
        $total =  $betamount + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName("RockPaper")
            ->setCurrency('GBP')
            ->setQuantity(1)
            ->setPrice($betamount);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($betamount);
        
        $amount = new Amount();
        $amount->setCurrency('GBP')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('PayForSomething Payment')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('https://rpsbet.com/payment?approved=true')
            ->setCancelUrl('https://rpsbet.com/register?approved=false');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->getPayPal());
        } catch (Exception $e) {
            $data = json_decode($e->getData());
            var_dump($data);
            die($e);
        }

        $approvalUrl = $payment->getApprovalLink();

        header("Location: {$approvalUrl}");
        //echo "<script>window.open('http://localhost/admin/checkout', 'width=710,height=555,left=160,top=170')</script>";
        $this->Admin_model->memberCreate($family);
        //$this->load->view('admin/create_member');
    }

// For payment by lee
    public function payment() {
        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];

        $payment =Payment::get($paymentId, $this->getPayPal());

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->getPayPal());
        } catch (Exception $e) {
            die($e);
        }

        $this->load->view('admin/default_list');
    }
    
    public function userUpdate() {
        $user['email'] = $this->input->get_post('email');
        $user['id'] = $this->input->get_post('id');
        $user['name'] = $this->input->get_post('name');
        $user['password'] = $this->input->get_post('password');
        $user['role'] = $this->input->get_post('role');
        $user['status'] = $this->input->get_post('status');
        $this->Admin_model->userUpdate($user);
    }
   
    public function deleteUser() {
        $id = $this->input->get_post('id');
        $this->Admin_model->deleteUser($id);
    }

    public function memberList() {
        $this->load->view('admin/default_list');
    }

    public function showLogList() {
        $this->load->view('admin/show_log');    
    }
    
    public function showWinsHistory() {
        $email = $this->session->userdata['user_email'];
        $query = $this->Admin_model->getWinsHistory($email);
        
        foreach ($query->result() as $val){
            echo '<tr class=""><td>'.$val->member_id.'</td><td>'.$val->bet_amount.'</td><td>win</td></tr>';
        }
        exit;    
    }
    
    public function showLooseHistory() {
        $email = $this->session->userdata['user_email'];
        $query = $this->Admin_model->getLooseHistory($email);
        
        foreach ($query->result() as $val){
            echo '<tr class=""><td>'.$val->member_id.'</td><td>'.$val->bet_amount.'</td><td>win</td></tr>';
        }
        exit;    
    }
    
    public function showDrawsHistory() {
        $email = $this->session->userdata['user_email'];
        $query = $this->Admin_model->getDrawsHistory($email);
        
        foreach ($query->result() as $val){
            echo '<tr class=""><td>'.$val->member_id.'</td><td>'.$val->bet_amount.'</td><td>win</td></tr>';
        }
        exit;    
    }
    
    public function memberListLoad() {
        $sql = "select m.id,CONCAT('Rock', m.id)as member_id, m.fname, m.user1,  m.status, m.bet_amount, m.note ,m.password from member m where m.win='' order by m.id desc";
        
        $result =  $this->db->query($sql);
            $family = array();
            foreach ($result->result() as $row){
                $family[] = $row;
            }
                       
       /* 
//        collect expire members
        $param = array();
        foreach ($family as $row){
            $exp_date = $row->expire_date;
            $exp_date_temp =  date_create($exp_date);
            date_add($exp_date_temp, date_interval_create_from_date_string('90 days'));

            $exp_member =  date_format($exp_date_temp, 'Y-m-d');

            $date1=date_create(date('Y-m-d'));
            $date2=date_create($exp_member);
            $diff=date_diff($date1,$date2);
            $days =  $diff->format("%R%a");
            if($days <= 0){
                $param[] = trim($row->member_id,'Rock');
            }
        }
        $this->setExpireMember($param);*/
        
        echo json_encode($family);
//            exit;
    }
    
    public function selectScissor(){   
         $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];

        $payment =Payment::get($paymentId, $this->getPayPal());

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->getPayPal());
        } catch (Exception $e) {
            die($e);
        }
       
        $this->load->view('admin/selectrock');
    }
    
    public function memberUpdate() {
//        var_dump($_POST); exit;    
            $this->form_validation->set_rules('firstname', 'First name ', 'required');
            $this->form_validation->set_rules('middlename', 'Middle name', 'required');
            $this->form_validation->set_rules('lastname', 'Last name', 'required');
            $this->form_validation->set_rules('area', 'Area/Town/City', 'required');
            $this->form_validation->set_rules('telephone', 'Telephone', 'required|min_length[10]|max_length[10]|numeric');

            $this->form_validation->set_rules('plan', 'Package type', 'required');
            $this->form_validation->set_rules('tariff', 'Selected period', 'required');
            $this->form_validation->set_rules('start_date', 'start date', 'required');
            $this->form_validation->set_rules('end_date', 'end date', 'required');
            $this->form_validation->set_rules('paid', 'Amount paid', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                echo'<div class="alert alert-dismissable alert-danger"><small>' . validation_errors() . '</small></div>';
            } else {
//                        general information
                $family['id'] = $this->input->post('id');
                $family['firstname'] = $this->input->post('firstname');
                $family['middlename'] = $this->input->post('middlename');
                $family['lastname'] = $this->input->post('lastname');
                $family['gender'] = $this->input->post('gender');
                $family['address'] = $this->input->post('address');
                $family['area'] = $this->input->post('area');
                $family['telephone'] = $this->input->post('telephone');
                $family['telephone2'] = $this->input->post('telephone2');
                $family['expired'] = $this->input->post('expired');
//                        plan information
                $family['plan'] = $this->input->post('plan');
                $family['tariff'] = $this->input->post('tariff');
                $family['start_date'] = $this->input->post('start_date');
                $family['end_date'] = $this->input->post('end_date');
                $family['paid'] = $this->input->post('paid');
                $family['unpaid'] = $this->input->post('unpaid');
                $family['instalmentdate'] = $this->input->post('instalmentdate');
                $family['desc'] = $this->input->post('desc');
                $this->Admin_model->memberUpdate($family);
            }

            exit;
        
    }
    
    public function joinGame() {
        $id_value = $this->input->post('idval');
        $betamount = $this->Admin_model->getAmountById($id_value);

        $betamount = $betamount;
        $shipping = 0.00;
        $total =  $betamount + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName("RockPaper")
            ->setCurrency('GBP')
            ->setQuantity(1)
            ->setPrice($betamount);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($betamount);
        
        $amount = new Amount();
        $amount->setCurrency('GBP')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('PayForSomething Payment')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('https://rpsbet.com/scissors?approved=true')
            ->setCancelUrl('https://rpsbet.com/memberList?approved=false');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->getPayPal());
        } catch (Exception $e) {
            die($e);
        }

        $this->session->set_userdata('room_id', $id_value);
        $approvalUrl = $payment->getApprovalLink();

        header("Location: {$approvalUrl}");
    }
  
    public function confirmWin() {
        $card_value = $this->input->post('card');

        $room_no = $this->session->userdata['room_id'];

        $old_value = $this->Admin_model->getCardNumByRoom($room_no);

        $user2 = $this->Admin_model->getEmailNumByRoom($room_no); 
        $balance = $this->Admin_model->getBalenceByRoom($room_no);

        $user1 = $this->session->userdata['user_name'];

        $res = '';
        switch ($card_value) {
            case 0:
                # code...
                if ($old_value == 0) {
                    $this->Admin_model->releaseBet($room_no, $old_value);
                    $res = "Draw, No Winner!";
                }
                elseif ($old_value == 1) {
                    $this->Admin_model->confirmWin($room_no, $user1, 'win');
                    $this->Admin_model->setBalance($balance, $user1, $balance, $user2);
                    
                    $res = 'NICE, You Won!';
                }else {
                    $this->Admin_model->confirmWin($room_no, $user1, 'lose');
                    $this->Admin_model->setBalance($balance, $user2, $balance, $user1);
                    $res = 'Oops, You Lost!';
                }
                break;
            case 1:
                if ($old_value == 0){
                    $this->Admin_model->confirmWin($room_no, $user1, 'lose');
                    $this->Admin_model->setBalance($balance, $user2, $balance, $user1);
                    $res = 'Oops, You Lost!';
                }elseif ($old_value == 1){
                    $this->Admin_model->releaseBet($room_no, $old_value);
                    $res = 'Draw, No Winner!';
                }
                else{
                    $this->Admin_model->confirmWin($room_no, $user1, 'win');
                    $this->Admin_model->setBalance($balance, $user1, $balance, $user2);
                    $res = 'NICE, You Won!';
                }
                break;
            case 2:
                if ($old_value == 0) {
                    $this->Admin_model->confirmWin($room_no, $user1, 'win');
                    $this->Admin_model->setBalance($balance, $user1, $balance, $user2);
                    $res = "NICE, You Won!";
                }
                elseif ($old_value == 1) {
                    $this->Admin_model->confirmWin($room_no, $user1, 'lose');
                    $this->Admin_model->setBalance($balance, $user2, $balance, $user1);
                    $res = 'Oops, You Lost!';
                }
                else{
                    $this->Admin_model->releaseBet($room_no, $old_value);
                    $res = 'Draw, No Winner!';
                }
                break;
            default:
                # code...
                break;
        }
        
        $balance = $this->Auth_model->getUserBalance($user1);
        $this->session->set_userdata('balance', $balance);

        echo json_encode($res);

    }

    public function joinPay() {
        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];

        $payment = Payment::get($paymentId, $paypal);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execute, $paypal);
        } catch (Exception $e) {
            $data = json_decode($e->getData());
            var_dump($data);
        }

        $this->load->view('admin/selectrock');
    }

    public function adminCreate() {
        $this->Auth_model->isLoggedIn();
        $this->form_validation->set_rules('name', 'User name', 'required');
        $this->form_validation->set_rules('email', 'Email id', 'required | valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[cpassword]');
        $this->form_validation->set_rules('role', 'Admin role', 'required');
        
            if ($this->form_validation->run() == FALSE) {
                echo'<div class="alert alert-dismissable alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.  validation_errors().'</div>';
            } else {
                $user['name'] = $this->input->post('name');
                $user['email'] = $this->input->post('email');
                $user['password']= $this->input->post('cpassword');
                $user['role']= $this->input->post('role');
                $user['status']= $this->input->post('status');
                $this->Admin_model->adminCreate($user);
            }
    }


    public function userList() {
        $data = $this->Admin_model->userList();
        if ($data->num_rows() > 0) {
            $sr = 0;
            $urldelete = base_url() . 'admin/deleteUser/';
            $urledit = base_url() . 'admin/editUser/';
            foreach ($data->result() as $row) {
                $sr = $sr + 1;
                echo"<tr><td>" . $sr . "</td><td>" . $row->uname . "</td><td>" . $row->email . "</td><td>" . $row->role . "</td><td>" . $row->status . "</td>"
                . "<td><a data-url='$urledit' class='btn btn-sm btn-info btnedit'  data-toggle='modal' data-target='#editModal' data-id='$row->id' title='edit'><i class='glyphicon glyphicon-pencil' title='edit'></i>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a data-url='$urldelete' class='btn btn-sm btn-info btndelete' data-id='$row->id' title='delete'><i class='glyphicon glyphicon-remove'></i>Delete</a></td>"
                . "</tr>";
            }
        } else {
            echo'<tr><td colspan = 4 class="text-info">No Plan added.</td></tr>';
        }
        exit;
    }
    
    public function editUser() {
        $id = $this->input->get_post('id');
        $data['data'] = $this->Admin_model->editUser($id);
        $data['id'] = $id;
        $this->load->view('admin/user_edit', $data);
    }    
    
    public function backup() {
        $this->load->dbutil();
        $backup =& $this->dbutil->backup(); 
        $this->load->helper('download');
        force_download('mybackup.zip', $backup);
        redirect('admin/schema');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/admin.php */