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

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->Model('Auth_model');
        
        $this->load->library('paypal_lib');
        //$this->load->library('stripegateway');
    }

    public function index() {
        $this->load->view('admin/home');
        $this->Auth_model->isLoggedIn();
    }

    public function checkout() {
        $this->load->view('admin/checkout');
        $this->Auth_model->isLoggedIn();
    }

    public function memberIndex() {
        $this->load->view('admin/create_member');
    }

    public function memberCreate() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        
        //general information
        $paymentMethod = $this->input->post('withbalance');
        
        $family['betamount'] = $this->input->post('betamount');
        $family['privated'] = $this->input->post('privated');
        $family['card'] = $this->input->post('card');
        $family['note'] = $this->input->post('note');
        $family['password'] = $this->input->post('password');
        $family['paymentmethod'] = 1;
        $family['gamemode'] = $this->input->post('gamemode');
        $family['spleeshamount'] = $this->input->post('spleeshamount');
        $family['potential'] = str_replace("£",'',$this->input->post('potential'));
        
        //for brain game variable.
        $family['potential_braingame'] = str_replace("£",'',$this->input->post('potential_braingame'));
        $family['brain_amount'] = $this->input->post('betamount_braingame');
        $family['brain_game_type'] = $this->input->post('gametype');
        if ($family['brain_game_type'] == 1)
            $family['brain_game_diff'] = 1;
        else 
            $family['brain_game_diff'] = $this->input->post('gamediff');
        
        // Mystery
        $family['mystery_amount'] = str_replace("£",'',$this->input->post('game_cost_mystery'));
        $family['box_prize'] = str_replace("£",'',$this->input->post('game_price_mystery'));
        $family['mystery_potential'] = str_replace("£",'',$this->input->post('potential_mystery'));
        $family['collect_number'] = substr($this->input->post('collect_number'), 0, -1);
        
        if ($family['betamount'] == '' && $family['gamemode'] == 0) 
        {
            $data["msg"] = "Please enter a Bet Amount.";
            $this->load->view('admin/create_member', $data);
        } else if ($family['brain_amount'] == '' && $family['gamemode'] == 2) {
            $data["msg"] = "Please enter a Bet Amount.";
            $this->load->view('admin/create_member', $data);
        } else {
            if ($paymentMethod == 0) { //by with balance
                $res = $this->Admin_model->memberCreateWithBalance($family);
               
                if ($res == 'fail') {
                    echo '<script>alert("Please choose another payment method. Insufficient balance.");
                            document.location="https://www.rpsbet.com/memberList";</script>';
                    
                } else if ($family['gamemode'] != 2) {
                    echo '<script>document.location="https://www.rpsbet.com/memberList";</script>';
                } else {
                    $this->show_question($family['brain_game_diff']);
                }
                
                
            } else { //by paypal
                // put in the session
                $this->session->set_userdata('family', $family);
                $user = $this->session->userdata['user_name'];
                
                if ($family['gamemode'] == 1) {
                    $betamount = $family['spleeshamount'];
                    $betamount = $betamount;
                    
                    $returnURL = 'https://www.rpsbet.com/payment';
                    $cancelURL = 'https://www.rpsbet.com/paycancel';
                    $notifyURL = 'https://www.rpsbet.com/notify';
                    
                    // Add fields to paypal form
                    $this->paypal_lib->add_field('return', $returnURL);
                    $this->paypal_lib->add_field('cancel_return', $cancelURL);
                    $this->paypal_lib->add_field('notify_url', $notifyURL);
                    $this->paypal_lib->add_field('item_name', "RPS");
                    $this->paypal_lib->add_field('custom', $user);
                    $this->paypal_lib->add_field('amount',  $betamount);
                    
                    // Render paypal form
                    $this->paypal_lib->paypal_auto_form();
                } else if($family['gamemode'] == 0) {
                    $betamount = $family['betamount'];
                
                    $returnURL = 'https://www.rpsbet.com/payment';
                    $cancelURL = 'https://www.rpsbet.com/paycancel';
                    $notifyURL = 'https://www.rpsbet.com/notify';
                    
                    // Add fields to paypal form
                    $this->paypal_lib->add_field('return', $returnURL);
                    $this->paypal_lib->add_field('cancel_return', $cancelURL);
                    $this->paypal_lib->add_field('notify_url', $notifyURL);
                    $this->paypal_lib->add_field('item_name', "RPS");
                    $this->paypal_lib->add_field('custom', $user);
                    $this->paypal_lib->add_field('amount',  $betamount);
                    
                    // Render paypal form
                    $this->paypal_lib->paypal_auto_form();    
                } else {
                    $betamount = $family['brain_amount'];
                
                    $returnURL = 'https://www.rpsbet.com/payment';
                    $cancelURL = 'https://www.rpsbet.com/paycancel';
                    $notifyURL = 'https://www.rpsbet.com/notify';
                    
                    // Add fields to paypal form
                    $this->paypal_lib->add_field('return', $returnURL);
                    $this->paypal_lib->add_field('cancel_return', $cancelURL);
                    $this->paypal_lib->add_field('notify_url', $notifyURL);
                    $this->paypal_lib->add_field('item_name', "RPS");
                    $this->paypal_lib->add_field('custom', $user);
                    $this->paypal_lib->add_field('amount',  $betamount);
                    
                    // Render paypal form
                    $this->paypal_lib->paypal_auto_form(); 
                }
            }
        }
        
    }

    // For payment by lee
    public function payment() {
        $paypalInfo = $this->input->get();

        $data['item_name']      = $paypalInfo['item_name'];
        $data['txn_id']         = $paypalInfo["tx"];
        $data['payment_amt']    = $paypalInfo["amt"];
        $data['currency_code']  = $paypalInfo["cc"];
        $data['status']         = $paypalInfo["st"];
        
        $family = $this->session->userdata['family'];
        
        $this->Admin_model->memberCreate($family);
        
        if ($family['gamemode'] != 2)
            echo '<script>document.location="https://www.rpsbet.com/memberList";</script>';
        else {
            $this->show_question($family['brain_game_diff']);
        }
    }
    
    // For cancel pay.
    public function paycancel() {
        //var_dump($this->input->get());
        echo '<script>document.location="https://www.rpsbet.com/memberList";</script>';
    }
    // for notify pay 
    public function notify() {
        $family = $this->session->userdata['family'];
        
        $this->Admin_model->memberCreate($family);
        
        if ($family['gamemode'] != 2)
            echo '<script>document.location="https://www.rpsbet.com/memberList";</script>';
        else {
            $this->show_question($family['brain_game_diff']);
        }
    }
    
    public function show_question($diff) {
        if ($diff == 0) {
            $res = $this->Admin_model->getQuestions();
        
            $data['q_id'] = $res['id'];
            $data['questions'] = $res['question'];
            
            $res_answer_id = $this->Admin_model->getAnswerIDForEasy($res['answer_id']);
            $data['answers'] = $res_answer_id;
            
            $this->load->view('admin/select_question', $data);  
        } else {
            $res = $this->Admin_model->getQuestions();
        
            $data['q_id'] = $res['id'];
            $data['questions'] = $res['question'];
            
            $res_answer_id = $this->Admin_model->getAnswerID($res['answer_id'], $res['answer_id2'], $res['answer_id3'], $res['answer_id4']);
            $data['answers'] = $res_answer_id;
            
            $this->load->view('admin/select_question', $data);    
        }
        
    }
    
    // create brain game and select answer
    public function getResultAndNew() {
        $q_id = $this->input->post('q_id');
        $a_id = $this->input->post('an_id');
        
        $room = $this->session->userdata['room_no'];
        $result = $this->Admin_model->isCorrect($room, $q_id, $a_id);
        
        
        $res = $this->Admin_model->getQuestions();
        
        $data['correct'] = $result;
        $data['q_id'] = $res['id'];
        $data['questions'] = $res['question'];
        
        $res_answer_id = $this->Admin_model->getAnswerID($res['answer_id']);
        $data['answers'] = $res_answer_id;
        
        echo json_encode($data);
    }
    
    public function show_question_join() {
        
        $res = $this->Admin_model->getQuestions();
        
        $data['q_id'] = $res['id'];
        $data['questions'] = $res['question'];
        
        $res_answer_id = $this->Admin_model->getAnswerID($res['answer_id'], $res['answer_id2'], $res['answer_id3'], $res['answer_id4']);
        $data['answers'] = $res_answer_id;
        
        $this->load->view('admin/select_question_join', $data);
    }
    
    // create brain game and select answer
    public function getJoinBrainGame() {
        $q_id = $this->input->post('q_id');
        $a_id = $this->input->post('an_id');
       
        $room = $this->session->userdata['room_id'];
        $result = $this->Admin_model->isCorrect_join($room, $q_id, $a_id);
        
        $res = $this->Admin_model->getQuestions();
        
        $data['correct'] = $result;
        $data['q_id'] = $res['id'];
        $data['questions'] = $res['question'];
        
        $res_answer_id = $this->Admin_model->getAnswerID($res['answer_id'], $res['answer_id2'], $res['answer_id3'], $res['answer_id4']);
        $data['answers'] = $res_answer_id;
        
        echo json_encode($data);
    }
    
    /**/
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
        $this->Auth_model->isLoggedIn();
        $this->load->view('admin/default_list');
    }

    public function topList() {
        $this->Auth_model->isLoggedIn();
        
        
        $this->load->view('admin/top_list');
    }
    
    public function showLogList() {
        $this->load->view('admin/show_log');    
    }
    
    public function showOpenRooms() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        
        $email = $this->session->userdata['user_email'];
        $query = $this->Admin_model->getOpenRoomsHistory($email);
        
        foreach ($query->result() as $val){
            $RoomID = '';
            $pr = '';
            
            if ($val->game_kind == 0) 
                $RoomID = 'RPS-'.$val->id;
            else if ($val->game_kind == 1) 
                $RoomID = 'Spleesh-'.$val->id;
            else 
                $RoomID = 'Brain-'.$val->id;
            
            $bet_amount = '';
            if ($val->game_kind == 1)
                $bet_amount = $val->bet_amount;
            else 
                $bet_amount = $val->bet_amount;
            if($val->game_kind == 1) {
                $pr .= $bet_amount.'/&pound;'.$val->potential_return * 0.92;
            } else if($val->game_kind == 2) {
                $pr .= $bet_amount.'/&pound;'.$val->potential_return;
            } else {
                $pr .= $bet_amount.'/&pound;'.$val->potential_return;
            } 
            
            $status = $val->status == 1 ? 'Private' : 'Public';
            echo '<tr class="'.$val->id.'"><td>'.$RoomID.'</td><td>&pound;'.$pr.'</td><td>'.$status.'</td><td class="'.$val->bet_amount.'"><button type="button" onclick="javascript:cross_win($(this) , '.$val->game_kind.');">END</button></td></tr>';
        }
        exit;    
    }
    
    public function showWinsHistory() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        $email = $this->session->userdata['user_email'];
        $query = $this->Admin_model->getWinsHistory($email);
        
        foreach ($query->result() as $val){
            $RoomID = '';
            
            if ($val->game_kind == 0) 
                $RoomID = 'RPS-'.$val->id;
            else if ($val->game_kind == 1) 
                $RoomID = 'Spleesh-'.$val->id;
            else 
                $RoomID = 'Brain-'.$val->id;
             
            $bet_amount = '';
            if ($val->game_kind == 1)
                $bet_amount = $val->bet_amount / 10;
            else 
                $bet_amount = $val->bet_amount;
                
            echo '<tr class="'.$val->id.'"><td>'.$RoomID.'</td><td>'.$val->fname.'</td><td>'.$val->uname.'</td><td>&pound;'.$bet_amount.'</td><td>'.$val->note.'</td><td>'.$val->end_date.'</td></tr>';
        }
        exit;    
    }
    
    public function showLooseHistory() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        $email = $this->session->userdata['user_email'];
        $query = $this->Admin_model->getLooseHistory($email);
        
        foreach ($query->result() as $val){
            $RoomID = '';
            
            if ($val->game_kind == 0) 
                $RoomID = 'RPS-'.$val->id;
            else if ($val->game_kind == 1) 
                $RoomID = 'Spleesh-'.$val->id;
            else 
                $RoomID = 'Brain-'.$val->id;
            
            $bet_amount = '';
            if ($val->game_kind == 1)
                $bet_amount = $val->bet_amount / 10;
            else 
                $bet_amount = $val->bet_amount;
                
            echo '<tr class="'.$val->id.'"><td>'.$RoomID.'</td><td>'.$val->fname.'</td><td>'.$val->uname.'</td><td>&pound;'.$bet_amount.'</td><td>'.$val->note.'</td><td>'.$val->end_date.'</td></tr>';
        }
        exit;    
    }
    
    public function deleteWinHistory() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        
        $roomID = $this->input->get('id');
        $amount = $this->input->get('amount');
        $kind = $this->input->get('kind');
        
        $email = $this->session->userdata['user_email'];
        
        if ($kind == 1) {
            $paymethod = $this->Admin_model->getPaymentMethodByRoom($roomID);
            $pr = $this->Admin_model->getPotentialByRoom($roomID);
            $return = $this->Admin_model->resetYourBalanceWithSpleesh($email, $amount, $pr, $paymethod);   
            
            $query = $this->Admin_model->deleteHistory($roomID);
            if ($query == 0)
                echo $return;
            else 
                echo "";
            
        } else if($kind == 0) {
            $paymethod = $this->Admin_model->getPaymentMethodByRoom($roomID);
            $query = $this->Admin_model->deleteHistory($roomID);
            
            if ($query == 0) {
                $returnVal = $this->Admin_model->resetYourBalance($email, $amount, $paymethod);
                
                $this->session->set_userdata('balance', $returnVal);
                echo $returnVal;
            } else {
                echo "";
            }    
        } else {
            $is_connecting = $this->Admin_model->isConnectingAnother($roomID);
            if($is_connecting > 0) {
                echo '<script>alert("Lobby has now closed, we have refunded your bet into your account balance.");
                    document.location="https://www.rpsbet.com/memberList";</script>';
            }
            
            $paymethod = $this->Admin_model->getPaymentMethodByRoom($roomID);
            $pr = $this->Admin_model->getPotentialByRoom($roomID);
            $query = $this->Admin_model->deleteHistory($roomID);
            
            if ($query == 0) {
                $returnVal = $this->Admin_model->resetYourBalanceWithBrain($email, $amount,$pr, $paymethod);
                
                $this->session->set_userdata('balance', $returnVal);
                echo $returnVal;
            } else {
                echo "";
            }    
        }
    }
    
    public function showDrawsHistory() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        $email = $this->session->userdata['user_email'];
        $query = $this->Admin_model->getDrawsHistory($email);
        
        foreach ($query->result() as $val){
            $RoomID = $val->game_kind == 1 ? 'Spleesh-'.$val->id : 'RPS-'.$val->id;
            echo '<tr class="'.$val->id.'"><td>'.$RoomID.'</td><td>'.$val->fname.'</td><td>'.$val->uname.'</td><td>&pound;'.$val->bet_amount.'</td><td>'.$val->note.'</td><td>'.$val->end_date.'</td></tr>';
        }
        exit;    
    }
    
    public function memberListLoad() {
        $sql = "select m.id,CONCAT('Rock', m.id)as member_id, m.fname, m.user1,  m.status, m.bet_amount, m.note ,m.password, m.game_kind, m.potential_return , a.photo, a.bio
                from member m join auth a where a.email=m.user1 and m.win='' order by m.id desc";
        
        $result =  $this->db->query($sql);
            $family = array();
            foreach ($result->result() as $row){
                $family[] = $row;
            }
            
        echo json_encode($family);
    }
    
    public function recentListLoad() {
        $user = $this->session->userdata['user_email'];
        $sql = "select m.id, m.fname, m.user1, a.uname as user1_name, a.photo as photo1, a.bio as bio1, m.user2, b.uname as user2_name,b.photo as photo2, b.bio as bio2, m.status, m.bet_amount, m.note ,m.password, m.game_kind, m.win, m.end_date
                from member m join auth a join auth b 
				where a.email=m.user1 and b.email=m.user2 and m.win !='' and m.win!='draw' and m.end_date!='' and (m.user1='$user' || m.user2='$user') order by m.end_date desc limit 10";
        
        $result =  $this->db->query($sql);
            $family = array();
            foreach ($result->result() as $row){
                $family[] = $row;
            }
            
        echo json_encode($family);
    }
    
    public function top_list_load() {
        $sql = "select * from auth order by balance desc LIMIT 10";
        
        $result =  $this->db->query($sql);
            $family = array();
            foreach ($result->result() as $row){
                $family[] = $row;
            }
            
        echo json_encode($family);
    }
    
    public function procRPS($method) {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        $card_value = $this->session->userdata['card_value'];

        $room_no = $this->session->userdata['room_id'];

        $old_value = $this->Admin_model->getCardNumByRoom($room_no);

        $user2 = $this->Admin_model->getEmailNumByRoom($room_no);
        $payment_old = $this->Admin_model->getPaymentMethodByRoom($room_no);
        $balance = $this->Admin_model->getBalenceByRoom($room_no);

        $user1 = $this->session->userdata['user_email'];

        $payment_method = 0;
        if ($payment_old == 0 && $method == 1)
            $payment_method = 1;
        else if ($payment_old == 1 && $method == 0)
            $payment_method = 2;
        else if ($payment_old == 1 && $method == 1)
            $payment_method = 3;
        $res = '';
       
        switch ($card_value) {
            case 0: //rock
                # code...
                if ($old_value == 0) {
                    $this->Admin_model->releaseBet($room_no, $user1, $card_value);
                    $this->Admin_model->setWithdraw($balance, $user1, $user2, $payment_method, $room_no);
                    $res = "Draw, No Winner!";
                }
                elseif ($old_value == 2) { //scissors
                    $this->Admin_model->confirmWin($room_no, $user1, 'win', $card_value);
                    $this->Admin_model->setBalance($balance, $user1, $balance, $user2, $payment_method);
                    
                    $res = 'NICE, You Won!';
                }else {
                    $this->Admin_model->confirmWin($room_no, $user1, 'lose', $card_value);
                    $this->Admin_model->setBalance($balance, $user2, $balance, $user1, $payment_method);
                    $res = 'Oops, You Lost!';
                }
                break;
            case 1: // paper
                if ($old_value == 2){
                    $this->Admin_model->confirmWin($room_no, $user1, 'lose', $card_value);
                    $this->Admin_model->setBalance($balance, $user2, $balance, $user1, $payment_method);
                    $res = 'Oops, You Lost!';
                }elseif ($old_value == 1){
                    $this->Admin_model->releaseBet($room_no, $user1, $card_value);
                    $this->Admin_model->setWithdraw($balance, $user1, $user2, $payment_method, $room_no);
                    $res = 'Draw, No Winner!';
                }
                else{
                    $this->Admin_model->confirmWin($room_no, $user1, 'win', $card_value);
                    $this->Admin_model->setBalance($balance, $user1, $balance, $user2, $payment_method);
                    $res = 'NICE, You Won!';
                }
                break;
            case 2: // scissors
                if ($old_value == 1) { // paper
                    $this->Admin_model->confirmWin($room_no, $user1, 'win', $card_value);
                    $this->Admin_model->setBalance($balance, $user1, $balance, $user2, $payment_method);
                    $res = "NICE, You Won!";
                }
                elseif ($old_value == 0) { // rock
                    $this->Admin_model->confirmWin($room_no, $user1, 'lose', $card_value);
                    $this->Admin_model->setBalance($balance, $user2, $balance, $user1, $payment_method);
                    $res = 'Oops, You Lost!';
                }
                else{
                    $this->Admin_model->releaseBet($room_no, $user1, $card_value);
                    $this->Admin_model->setWithdraw($balance, $user1, $user2, $payment_method, $room_no);
                    $res = 'Draw, No Winner!';
                }
                break;
            default:
                # code...
                break;
        }
        
        $balance = $this->Auth_model->getUserBalance($this->session->userdata['user_email']);
        
        $this->session->set_userdata('balance', $balance);
        
        echo '<script>alert("'.$res.'"); window.location.href = "https://www.rpsbet.com/memberList";</script>';
    }
    
    public function selectScissor(){   
        $this->procRPS(1);
    }
    
    public function confirmWin() {
        $id_value = $this->input->post('idval');
        
        $isEnd = $this->Admin_model->isEndLobby($id_value);
        
        if ($isEnd == 0) {
            echo '<script>alert("This Lobby closed already."); window.location.href = "https://rpsbet.com/memberList";</script>';
        } else {
            $gameKind['kind'] = $this->input->post('gamekind');
            
            //Get Previous Guess
            $gameKind['guess'] = $this->Admin_model->getPreviousGuess($id_value);
            
            $gameKind['betAmount'] = $this->Admin_model->getAmountById($id_value);
            $gameKind['score'] =  $this->Admin_model->getScoreByID($id_value);
            $gameKind['prize'] = $this->Admin_model->getPrizes($id_value);
            $gameKind['box_price'] = $this->Admin_model->getBoxPrice($id_value);
            $gameKind['prize_log'] = $this->Admin_model->getPrizesLog($id_value);
            
            $this->session->set_userdata('room_id', $id_value);
                
            $this->load->view('admin/selectrock', $gameKind);
        }
    }
  
    public function joinGame() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        
        $paymentMethod = $this->input->post('withbalance');
        
        $id_value = $this->session->userdata['room_id'];
    
        $betamount = $this->Admin_model->getAmountById($id_value);
        
        $card_value = $this->input->post('card');
        $this->session->set_userdata('card_value', $card_value);
        
        if ($paymentMethod == 0) {
            $res = $this->Admin_model->joinGameWithBalance($betamount, 0);
           
            if ($res == 'fail') {
                echo '<script>alert("Your balance is less than the Bet Amount. Try using PayPal."); window.location.href = "https://rpsbet.com/memberList";</script>';
            }
            else {
                $this->procRPS($paymentMethod);
            }
        } else if ($paymentMethod == 2) {
            $cardnumber = $this->input->post('cardnumber');
            $expmonth = $this->input->post('expiremonth');
            $expyear = $this->input->post('expireyear');
            
            if ($cardnumber == '' || $expmonth == '' || $expyear == '') {
                $data["msg"] = "please enter fill for stripe payment.";
                $this->load->view('admin/selectrock', $data);
            } else {
                $betamount = $betamount * 100;
                
                $data = array(
                    'number' =>$cardnumber, 
                    'exp_month'=>$expmonth,
                    'exp_year'=>$expyear,
                    'amount'=>$betamount); 
                
                $res = $this->stripegateway->checkout($data);
                
                if($res == 'succeeded') 
                    $this->procRPS($paymentMethod);
                else
                    echo '<script>document.location="https://www.rpsbet.com/memberList";</script>';
            }
        }else {
            $user = $this->session->userdata['user_name'];
            
            $returnURL = 'https://www.rpsbet.com/scissors';
            $cancelURL = 'https://www.rpsbet.com/paycancel';
            $notifyURL = 'https://www.rpsbet.com/scissors';
            
            // Add fields to paypal form
            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', "RPS");
            $this->paypal_lib->add_field('custom', $user);
            $this->paypal_lib->add_field('amount',  $betamount);
            
            // Render paypal form
            $this->paypal_lib->paypal_auto_form();
        }
    }

    public function joinspleeshgame() {
       if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        
        $paymentMethod = $this->input->post('withbalance');
        $guessNumber = $this->input->post('spleeshamount');
        
        $id_value = $this->session->userdata['room_id'];
        $betamount = $this->Admin_model->getAmountById($id_value);
    
        $this->session->set_userdata('card_value', $guessNumber);
    
        if ($paymentMethod == 0) {
            $res = $this->Admin_model->joinGameWithBalance($guessNumber, 1);
           
            if ($res != 'fail')
                $this->procSpleesh($paymentMethod);
            else {
                echo '<script>alert("Your balance is less than the Bet Amount. Try using PayPal."); window.location.href = "https://rpsbet.com/memberList";</script>';
            }
        } else {
            $user = $this->session->userdata['user_name'];
            $amount = $guessNumber;
            
            $returnURL = 'https://www.rpsbet.com/spleesh';
            $cancelURL = 'https://www.rpsbet.com/paycancel';
            $notifyURL = 'https://www.rpsbet.com/spleesh';
            
            // Add fields to paypal form
            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', "RPS");
            $this->paypal_lib->add_field('custom', $user);
            $this->paypal_lib->add_field('amount',  $amount);
            
            // Render paypal form
            $this->paypal_lib->paypal_auto_form();
        }
    }
    
    public function joinBrainGame() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        $id_value = $this->session->userdata['room_id'];
        
        $is_connecting = $this->Admin_model->isConnectingAnother($id_value);
        if($is_connecting > 0) {
            echo '<script>alert("Lobby has now closed, we have refunded your bet into your account balance.");
                document.location="https://www.rpsbet.com/memberList";</script>';
        } else {
            $paymentMethod = $this->input->post('withbalance');
            
            $betamount = $this->Admin_model->getAmountById($id_value);
            
            if ($paymentMethod == 0) {
                $res = $this->Admin_model->joinGameWithBalance($betamount, 0);
               
                if ($res == 'fail') {
                    echo '<script>alert("Your balance is less than the Bet Amount. Try using PayPal."); window.location.href = "https://rpsbet.com/memberList";</script>';
                }
                else {
                    $this->session->set_userdata('payment', 0);
                    $this->show_question_join();
                }
            } else {
                $user = $this->session->userdata['user_name'];
                
                $returnURL = 'https://www.rpsbet.com/braingame';
                $cancelURL = 'https://www.rpsbet.com/paycancel';
                $notifyURL = 'https://www.rpsbet.com/braingame';
                
                // Add fields to paypal form
                $this->paypal_lib->add_field('return', $returnURL);
                $this->paypal_lib->add_field('cancel_return', $cancelURL);
                $this->paypal_lib->add_field('notify_url', $notifyURL);
                $this->paypal_lib->add_field('item_name', "RPS");
                $this->paypal_lib->add_field('custom', $user);
                $this->paypal_lib->add_field('amount',  $betamount);
                
                // Render paypal form
                $this->paypal_lib->paypal_auto_form();
            }
        }
    }
    
    public function braingame() {
        $this->session->set_userdata('payment', 1);
        $this->show_question_join();
    }
    
    public function isWinBrain() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        
        $room_no = $this->session->userdata['room_id'];
        $payment_old = $this->Admin_model->getPaymentMethodByRoom($room_no);
        $amount = $this->Admin_model->getBalenceByRoom($room_no);
        $payment = $this->session->userdata['payment'];
        
        $user2 = $this->Admin_model->getEmailNumByRoom($room_no);
        
        $payment_method = 0;
        if ($payment_old == 0 && $payment == 1)
            $payment_method = 1;
        else if ($payment_old == 1 && $payment == 0)
            $payment_method = 2;
        else if ($payment_old == 1 && $payment == 1)
            $payment_method = 3;
            
        $res = $this->Admin_model->isWinBrain($room_no, $payment_method, $amount,$user2);    
        echo $res;
    }
    
    public function spleesh() {
        $this->procSpleesh(1);
    }
    
    public function procSpleesh($method) {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        
        $room_no = $this->session->userdata['room_id']; //room number

        //created user's Value
        $old_value = $this->Admin_model->getCardNumByRoom($room_no);
        $new_value = $this->session->userdata['card_value'];
        
        //created User's email
        $user2 = $this->Admin_model->getEmailNumByRoom($room_no);
        $payment_old = $this->Admin_model->getPaymentMethodByRoom($room_no);
        
        // bet Amount
        $balance = $this->Admin_model->getBalenceByRoom($room_no);

        $user1 = $this->session->userdata['user_email'];

        $payment_method = 0;
        if ($payment_old == 0 && $method == 1)
            $payment_method = 1;
        else if ($payment_old == 1 && $method == 0)
            $payment_method = 2;
        else if ($payment_old == 1 && $method == 1)
            $payment_method = 2;
            
        $res = '';
       
        if ($old_value == $new_value) {
            $this->Admin_model->confirmWin($room_no, $user1, 'win', $new_value);
            $this->Admin_model->setBalanceForSpleesh($user1, $balance, $payment_method,$room_no);
            
            $res = 'You guessed correctly - you win!';
        } else {
            $this->Admin_model->incorrectGuess($room_no, $user1, $new_value,$method);
            
            $res = 'Incorrect guess - sorry!';
        }
        
        $balance = $this->Auth_model->getUserBalance($this->session->userdata['user_email']);
        
        $this->session->set_userdata('balance', $balance);
        
        echo '<script>alert("'.$res.'"); window.location.href = "https://www.rpsbet.com/memberList";</script>';    
    }
    
    public function backup() {
        $this->load->dbutil();
        $backup =& $this->dbutil->backup(); 
        $this->load->helper('download');
        force_download('mybackup.zip', $backup);
        
        echo '<script>document.location="https://www.rpsbet.com/memberList";</script>';
    }
    
    public function joinMysteryGame() {
        if (!isset($this->session->userdata['user_email'])) {
            echo '<script>document.location="https://www.rpsbet.com/auth";</script>';
            exit;
        }
        $id_value = $this->session->userdata['room_id'];
        
        $is_connecting = $this->Admin_model->isConnectingAnother($id_value);
        if($is_connecting > 0) {
            echo '<script>alert("Lobby has now closed, we have refunded your bet into your account balance.");
                document.location="https://www.rpsbet.com/memberList";</script>';
        } else {
            $paymentMethod = $this->input->post('withbalance');
            
            $betamount = $this->Admin_model->getAmountById($id_value);
            
            if ($paymentMethod == 0) {
                $res = $this->Admin_model->joinGameWithBalance($betamount, 3);
               
                if ($res == 'fail') {
                    echo '<script>alert("Your balance is less than the Bet Amount. Try using PayPal."); window.location.href = "https://rpsbet.com/memberList";</script>';
                }
                else {
                    $this->session->set_userdata('payment', 0);
                    $this->show_mystery_box($id_value);
                }
            } else {
                $user = $this->session->userdata['user_name'];
                
                $returnURL = 'https://www.rpsbet.com/mysterygame';
                $cancelURL = 'https://www.rpsbet.com/paycancel';
                $notifyURL = 'https://www.rpsbet.com/mysterygame';
                
                // Add fields to paypal form
                $this->paypal_lib->add_field('return', $returnURL);
                $this->paypal_lib->add_field('cancel_return', $cancelURL);
                $this->paypal_lib->add_field('notify_url', $notifyURL);
                $this->paypal_lib->add_field('item_name', "RPS");
                $this->paypal_lib->add_field('custom', $user);
                $this->paypal_lib->add_field('amount',  $betamount);
                
                // Render paypal form
                $this->paypal_lib->paypal_auto_form();
            }
        }
    }
    
    public function mysterygame() {
        $this->session->set_userdata('payment', 1);
        $id_value = $this->session->userdata['room_id'];
        
        $this->show_mystery_box($id_value);
    }
    
    public function show_mystery_box($room_id) {
        $res = $this->Admin_model->show_mystery_box($room_id);
        
        $user = $this->session->userdata['user_email'];
        $this->Admin_model->addBalanceWithMystery($user, $res);
        
        $data['amount'] = $res;
        $data['prize'] = $this->Admin_model->getPrizes($room_id);
        $data['prize_log'] = $this->Admin_model->getPrizesLog($room_id);
        
        $this->load->view('admin/selected_mystery_box', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/admin.php */