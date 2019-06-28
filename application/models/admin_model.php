<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function memberCreate($param) {
        if ($param['gamemode'] == 1) {
            $member = array('fname' => $this->session->userdata['user_name'],
                'bet_amount' => $param['spleeshamount'],
                'status' => $param['privated'],
                'user1' => $this->session->userdata['user_email'],
                'card1' => $param['spleeshamount'],
                'win' => '',
                'note' => $param['note'],
                'paymentmethod' => $param['paymentmethod'],
                'password' => $param['password'],
                'game_kind' => $param['gamemode'],
                'potential_return' => 0);
                
             $this->db->insert('member', $member);
        } else if ($param['gamemode'] == 0) {
            $betAmount = $param['betamount'];
            $potentialValue = $betAmount - ($betAmount*0.05 + 0.05);
            
            $member = array('fname' => $this->session->userdata['user_name'],
            'bet_amount' => $param['betamount'],
            'status' => $param['privated'],
            'user1' => $this->session->userdata['user_email'],
            'card1' => $param['card'],
            'win' => '',
            'note' => $param['note'],
            'paymentmethod' => $param['paymentmethod'],
            'password' => $param['password'],
            'game_kind' => 0,
            'potential_return' => $potentialValue);
            
            
            $this->db->insert('member', $member);    
        } else if ($param['gamemode'] == 2) {
            $betAmount = $param['brain_amount'];
            $potentialValue = $betAmount;
            
            $member = array('fname' => $this->session->userdata['user_name'],
            'bet_amount' => $param['brain_amount'],
            'status' => $param['privated'],
            'user1' => $this->session->userdata['user_email'],
            'card1' => 0,
            'card2' => 0,
            'win' => '',
            'note' => $param['note'],
            'paymentmethod' => $param['paymentmethod'],
            'password' => $param['password'],
            'game_kind' => 2,
            'brain_game_type' => $param['brain_game_type'],
            'brain_game_diff' => $param['brain_game_diff'],
            'potential_return' => $param['potential_braingame']);
            
            
            $return_val = $this->db->insert('member', $member);
            $insert_id = $this->db->insert_id();
            $this->session->set_userdata('room_no', $insert_id);
        } else {
            $betAmount = $param['mystery_amount'];
            $potentialValue = $betAmount;
            
            $member = array('fname' => $this->session->userdata['user_name'],
            'bet_amount' => $param['mystery_amount'],
            'status' => $param['privated'],
            'user1' => $this->session->userdata['user_email'],
            'card1' => 0,
            'card2' => 0,
            'win' => '',
            'note' => $param['note'],
            'paymentmethod' => $param['paymentmethod'],
            'password' => $param['password'],
            'game_kind' => 3,
            'box_prize' => $param['box_prize'],
            'mystery_prizes' => $param['collect_number'],
            'potential_return' => $param['mystery_potential']);
            
            $return_val = $this->db->insert('member', $member);
            $insert_id = $this->db->insert_id();
            $this->session->set_userdata('room_no', $insert_id);
        }
        
    }
    
    public function memberCreateWithBalance($param) {
        $useremail = $this->session->userdata['user_email'];
        
        $this->db->where('email', $useremail);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }
        
        $betAmount = $param['betamount'];
        $guessAmount = $param['spleeshamount'];
        $brainAmount = $param['brain_amount'];
        $mysteryAmount = $param['mystery_amount'];
        
        if ($param['gamemode'] == 0 && $balance < $betAmount) {
            return 'fail';
        } else if ($param['gamemode'] == 1 && $balance < ($guessAmount/10)) {
            exit();return 'fail';
        } else if ($param['gamemode'] == 2 && $balance < $brainAmount) {
            return 'fail';
        } else if ($param['gamemode'] == 3 && $balance < $mysteryAmount) {
            return 'fail';
        } else {
            if ($param['gamemode'] == 1) {  //spleesh game mode
                $balance -= $guessAmount;
                $data = array('balance' => $balance);
    
                $this->db->where('email', $useremail);
                $res = $this->db->update('auth', $data);
               
                $this->session->set_userdata('balance', $balance);
                $member = array('fname' => $this->session->userdata['user_name'],
                    'bet_amount' => $param['spleeshamount'],
                    'status' => $param['privated'],
                    'user1' => $this->session->userdata['user_email'],
                    'card1' => $param['spleeshamount'],
                    'win' => '',
                    'note' => $param['note'],
                    'password' => $param['password'],
                    'game_kind' => $param['gamemode'],
                    'paymentmethod' => 0,
                    'potential_return' => 0);
                    
                 $this->db->insert('member', $member);
            } else if ($param['gamemode'] == 0) { //RPS Game game mode
                $balance -= $betAmount;
                $data = array('balance' => $balance);
    
                $this->db->where('email', $useremail);
                $res = $this->db->update('auth', $data);
               
                $this->session->set_userdata('balance', $balance);
                ////////////////////////////////////////////////////////////
                $member = array('fname' => $this->session->userdata['user_name'],
                    'bet_amount' => $param['betamount'],
                    'status' => $param['privated'],
                    'user1' => $this->session->userdata['user_email'],
                    'card1' => $param['card'],
                    'win' => '',
                    'note' => $param['note'],
                    'password' => $param['password'],
                    'paymentmethod' => 0,
                    'game_kind' => 0,
                    'potential_return' => $param['potential']);
                    
                $this->db->insert('member', $member);    
            } else if($param['gamemode'] == 2) {  //Brain Game game mode
                $balance -= $brainAmount;
                $data = array('balance' => $balance);
    
                $this->db->where('email', $useremail);
                $res = $this->db->update('auth', $data);
               
                $this->session->set_userdata('balance', $balance);
                ////////////////////////////////////////////////////////////
                $member = array('fname' => $this->session->userdata['user_name'],
                    'bet_amount' => $param['brain_amount'],
                    'status' => $param['privated'],
                    'user1' => $this->session->userdata['user_email'],
                    'card1' => 0,
                    'card2' => 0,
                    'win' => '',
                    'note' => $param['note'],
                    'password' => $param['password'],
                    'paymentmethod' => 0,
                    'game_kind' => 2,
                    'brain_game_type' => $param['brain_game_type'],
                    'brain_game_diff' => $param['brain_game_diff'],
                    'potential_return' => $param['potential_braingame']);
                    
                $return_val = $this->db->insert('member', $member);
                $insert_id = $this->db->insert_id();
                $this->session->set_userdata('room_no', $insert_id);
            } else {
                $balance -= $mysteryAmount;
                $data = array('balance' => $balance);
    
                $this->db->where('email', $useremail);
                $res = $this->db->update('auth', $data);
               
                $this->session->set_userdata('balance', $balance);
                ////////////////////////////////////////////////////////////
                $member = array('fname' => $this->session->userdata['user_name'],
                    'bet_amount' => $param['mystery_amount'],
                    'status' => $param['privated'],
                    'user1' => $this->session->userdata['user_email'],
                    'card1' => 0,
                    'card2' => 0,
                    'win' => '',
                    'note' => $param['note'],
                    'password' => $param['password'],
                    'paymentmethod' => 0,
                    'game_kind' => 3,
                    'box_prize' => $param['box_prize'],
                    'mystery_prizes' => $param['collect_number'],
                    'potential_return' => $param['mystery_potential']);
                    
                $return_val = $this->db->insert('member', $member);
                $insert_id = $this->db->insert_id();
                $this->session->set_userdata('room_no', $insert_id);
            }
            
            return 'success';
        }
        
        
    }
    
    public function isEndLobby($room) {
        $sql = "select * from member where id='$room' and win= ''";
        
        $query = $this->db->query($sql);
        
        return $query->num_rows();
    }
    
    public function getPaymentMethodByRoom($room) {
        $this->db->where('id', $room);
        $res = $this->db->get('member');
        $res = $res->result();

        $payment = '';
        foreach ($res as $row) {
            # code...
            $payment = $row->paymentmethod;
        }

        return $payment;    
    }
    
    public function getPotentialByRoom($room_id) {
        $this->db->where('id', $room_id);
        $res = $this->db->get('member');
        $res = $res->result();

        $pr = '';
        foreach ($res as $row) {
            # code...
            $pr = $row->potential_return;
        }

        return $pr;      
    }
    
    public function getPreviousGuess($room_id) {
        $this->db->where('id', $room_id);
        $res = $this->db->get('member');
        $res = $res->result();

        $guess = '';
        foreach ($res as $row) {
            # code...
            $guess = $row->guess_log;
        }

        return $guess; 
    }
    
    public function joinGameWithBalance($param, $kind) {
        $useremail = $this->session->userdata['user_email'];
        
        $this->db->where('email', $useremail);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }
        
        $betAmount = '';
        if ($kind == 1)
            $betAmount = $param;
        else
            $betAmount = $param;
            
        if ($balance < $betAmount) {
            return 'fail';
        } else {
            $balance -= $betAmount;
            $data = array('balance' => $balance);

            $this->db->where('email', $useremail);
            $res = $this->db->update('auth', $data);
           
            $this->session->set_userdata('balance', $balance);
            ///////////////////////////////////////////////////
            
            return 'success';
        }
    }
    
    public function getAmountById($id) {
        $this->db->where('id', $id);
        $res = $this->db->get('member');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->bet_amount;
        }

        return $balance;
    }
    
    public function getScoreByID($id) {
        $this->db->where('id', $id);
        $res = $this->db->get('member');
        $res = $res->result();

        $score = '';
        foreach ($res as $row) {
            # code...
            $score = $row->card1;
        }

        return $score;
    }
    
    public function getEmailNumByRoom($roomNo) {
        $this->db->where('id', $roomNo);
        $res = $this->db->get('member');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->user1;
        }

        return $balance;
    }
    
    public function confirmWin($room, $user, $val, $result) {
        $time = date("Y-m-d H:i:s");
        $data1 = array('user2' => $user, 'card2'=>$result, 'win'=>$val,'end_date'=>$time);

        $this->db->where('id', $room);
        $res = $this->db->update('member', $data1);
    }
    
    public function getBalenceByRoom($id) {
        $this->db->where('id', $id);
        $res = $this->db->get('member');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->bet_amount;
        }

        return $balance;
    }
    
    public function getOpenRoomsHistory($email) {
        $sql = "select m.id,CONCAT('Rock', m.id)as member_id, m.fname, m.user1,  m.status, m.bet_amount, m.note ,m.password, m.game_kind, m.potential_return from member m where m.user1='$email' and m.win='' order by m.id desc";
        $query = $this->db->query($sql);
        
        return $query;    
    }
    
    public function getWinsHistory($email) {
        $sql = "select t1.id, t1.fname, t1.opponents,  t1.status, t1.bet_amount,     t1.note ,t1.password, t1.game_kind, t1.end_date, t2.uname from
                (select m1.id, m1.fname, m1.user1 opponents,  m1.status, m1.bet_amount, m1.note ,m1.password, m1.game_kind,m1.end_date  
                    from member m1 where m1.user2='$email' and m1.win='win' 
                UNION ALL
                    select m2.id, m2.fname, m2.user2 opponents,  m2.status, m2.bet_amount, m2.note ,m2.password, m2.game_kind,m2.end_date  
                from member m2 where m2.user1='$email' and m2.win='lose') t1 LEFT JOIN auth t2 On t1.opponents=t2.email order by t1.id desc";
        $query = $this->db->query($sql);
        
        return $query;    
    }
    
    public function getLooseHistory($email) {
        $sql = "select t1.id, t1.fname, t1.opponents,  t1.status, t1.bet_amount,     t1.note ,t1.password, t1.game_kind, t1.end_date, t2.uname from
                (select m1.id, m1.fname, m1.user1 opponents,  m1.status, m1.bet_amount, m1.note ,m1.password, m1.game_kind, m1.end_date
                
                 from member m1 where m1.user2='$email' and m1.win='lose' 
                UNION ALL
                select m2.id, m2.fname, m2.user2 opponents,  m2.status, m2.bet_amount, m2.note ,m2.password, m2.game_kind,m2.end_date 
                 from member m2 where m2.user1='$email' and m2.win='win') t1 LEFT JOIN auth t2 On t1.opponents=t2.email order by t1.id desc";
        $query = $this->db->query($sql);
        
        return $query;    
    }
    
    public function getDrawsHistory($email) {
        $sql = "select t1.id, t1.fname, t1.opponents,  t1.status, t1.bet_amount,     t1.note ,t1.password, t1.game_kind, t1.end_date, t2.uname from
                (select m1.id, m1.fname, m1.user1 opponents,  m1.status, m1.bet_amount, m1.note ,m1.password, m1.game_kind,m1.end_date 
                
                 from member m1 where m1.user2='$email' and m1.win='draw'
                UNION
                select m2.id, m2.fname, m2.user2 opponents,  m2.status, m2.bet_amount, m2.note ,m2.password, m2.game_kind, m2.end_date
                
                 from member m2 where m2.user1='$email' and m2.win='draw') t1 LEFT JOIN auth t2 On t1.opponents=t2.email order by t1.id desc";
        $query = $this->db->query($sql);
        
        return $query;    
    }
    
    public function setWithdraw($val, $user1, $user, $payment_method, $room) {
        if ($payment_method != 0) {
            $this->db->where('email', $user1);
            $res = $this->db->get('auth');
            $res = $res->result();
    
            $balance = '';
            foreach ($res as $row) {
                # code...
                $balance = $row->balance;
            }
            
            $fee = $val - ($val * 0.05 + 0.05);
            $value = '';
            //if($payment_method == 1)
            //{
            //    $value = ($val + $fee) - (($val + $fee) * 0.018);
            //    $value = round($value * 1000000)/1000000;
                
            //}
            $real = $balance + $fee;
    
            $data = array('balance' => $real);
    
            $this->db->where('email', $user1);
            $res = $this->db->update('auth', $data);
        } else {
            $this->db->where('email', $user1);
            $res = $this->db->get('auth');
            $res = $res->result();
    
            $balance = '';
            foreach ($res as $row) {
                # code...
                $balance = $row->balance;
            }
            
           
            $value = $val+$balance;
                
            $data = array('balance' => $value);
    
            $this->db->where('email', $user1);
            $res = $this->db->update('auth', $data);
            
            ///////////////////////////////////
            $this->db->where('email', $user);
            $res = $this->db->get('auth');
            $res = $res->result();
    
            $balance = '';
            foreach ($res as $row) {
                # code...
                $balance = $row->balance;
            }
            
           
            $value = $balance + $val;
                
            $data = array('balance' => $value);
    
            $this->db->where('email', $user);
            $res = $this->db->update('auth', $data);
        }
    }
    
    public function setBalance($val, $id, $val1, $id2, $payment_method) {
        $this->db->where('email', $id);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }
        
        //proc
        $fee = $val - ($val * 0.05 + 0.05);
        $value = '';
        
        if($payment_method == 1)
        {
            if ($val > 5)
                $value = ($val + $fee) - (($val + $fee) * 0.08);
            else 
                $value = ($val + $fee) - (($val + $fee) * 0.018);
                
            $value = round($value * 1000000)/1000000;
            
        } else if ($payment_method == 0) {
            if ($val > 5) 
                $value = 2*$val*0.95;
            else 
                $value = 2*$val*0.95;
        } else if ($payment_method == 2) {
            if ($val > 5)
                $value = ($val + $fee) - (($val + $fee) * 0.08);
            else 
                $value = ($val + $fee) - (($val + $fee) * 0.018);
                
            $value = round($value * 1000000)/1000000;
        } else if ($payment_method == 3) {
            if ($val > 5)
                $value = ($fee + $fee) - (($fee + $fee) * 0.08);
            else 
                $value = ($fee + $fee) - (($fee + $fee) * 0.018);
                
            $value = round($value * 1000000)/1000000;
        }
        
        $real = $balance + $value;

        $data = array('balance' => $real);

        $this->db->where('email', $id);
        $res = $this->db->update('auth', $data);
        
        ////////////////////////////////////////////
        /*$this->db->where('email', $id2);
        $res2 = $this->db->get('auth');
        $result = $res2->result();

        $balance1 = '';
        foreach ($result as $row) {
            # code...
            $balance1 = $row->balance;
        }

        $real1 = $balance1 - $val1;

        $data1 = array('balance' => $real1);

        $this->db->where('email', $id2);
        $res = $this->db->update('auth', $data1);*/
    }
    
    public function setBalanceForSpleesh($winner, $amount, $paymentMethod, $room) {
        $amount = $amount;
        //get Balance
        $this->db->where('email', $winner);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }
        
        // get PR
        $this->db->where('id', $room);
        $res1 = $this->db->get('member');
        $res1 = $res1->result();

        $pr = '';
        foreach ($res1 as $row) {
            # code...
            $pr = $row->potential_return;
        }
        
        //proc
        $fee = $amount - ($amount * 0.05 + 0.05);
        $value = '';
        
        if($paymentMethod == 1)
        {
            $value = $fee * 2 + $pr;
            $value = round($value * 1000000)/1000000;
            
        } else if ($paymentMethod == 0) {
            $value = 2 * $amount + $pr;
        } else if ($paymentMethod == 2) {
            $value = $fee * 2 + $pr;
            $value = round($value * 1000000)/1000000;
        }
        
        if ($value > 0.5) 
            $value = $value - $value * 0.08;
            
        $real = $balance + $value;
        
        $data = array('balance' => $real);

        $this->db->where('email', $winner);
        $res = $this->db->update('auth', $data);
    }
    
    //When user incorrect Guess on the Spleesh Game
    public function incorrectGuess($roomID, $user, $guess, $payment) {
        $guess = $guess;  // changed user bet 1, it's cost 0.1
        $this->db->where('id', $roomID);
        $res = $this->db->get('member');
        $res = $res->result();

        $balance = '';
        $guessLog = '';
        $pr = '';
        
        foreach ($res as $row) {
            # code...
            $balance = $row->bet_amount;
            $guessLog = $row->guess_log;
            $pr = $row->potential_return;
        }
        
        if ($guessLog == '')
            $guessLog = $guess;
        else 
            $guessLog = $guessLog.",".$guess;
        
        if ($payment == 1)
            $pr = $pr + ($guess - ($guess*0.05 + 0.05));
        else
            $pr = $pr + $guess;
            
        $real = $guess + $balance;
     
        $time = date("Y-m-d H:i:s");
        $data = array('guess_log'=>$guessLog, 'potential_return'=>$pr,'end_date'=>$time);

        $this->db->where('id', $roomID);
        $res = $this->db->update('member', $data);
    }
    
    public function resetYourBalance($email, $amount, $roomPay) {
        
        // get method form room id
        if ($roomPay == 1) {
            $this->db->where('email', $email);
            $res = $this->db->get('auth');
            $res = $res->result();
    
            $balance = '';
            foreach ($res as $row) {
                # code...
                $balance = $row->balance;
            }
            
            $amount = $amount - ($amount*0.05 + 0.05);
            $real = $balance + $amount;
    
            $data = array('balance' => $real);
    
            $this->db->where('email', $email);
            $this->db->update('auth', $data);  
            
            return $real;
        } else {
            $this->db->where('email', $email);
            $res = $this->db->get('auth');
            $res = $res->result();
    
            $balance = '';
            foreach ($res as $row) {
                # code...
                $balance = $row->balance;
            }
    
            $real = $balance + $amount;
    
            $data = array('balance' => $real);
    
            $this->db->where('email', $email);
            $res = $this->db->update('auth', $data);  
            
            return $real;
        }
        
    }
    
    public function resetYourBalanceWithSpleesh($email, $amount, $pr, $paymethod) {
        $betAmount = $amount;
        $amount = $amount;
        $this->db->where('email', $email);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }
        
        if ($paymethod == 0) { //without paypal
            if ($pr > 0 && $pr > $amount) {
                $condition = $pr + $amount;
                if ($condition > 0.5)
                    $amount = $balance + $condition*0.92;
                else
                    $amount = $balance + $amount + $pr;
            } else if ($pr > 0) {
                if ($pr > 0.5)
                    $amount = $balance + $pr * 0.92;
                else 
                    $amount = $balance + $pr;
            } else {
                if ($amount > 0.5)
                    $amount = $balance + $amount * 0.92;
                else
                    $amount = $balance + $amount;
            }
        } else { //with paypal
            if ($pr > 0 && $pr > $amount) {
                $cond = ($amount-($amount*0.05 + 0.05)) + $pr;
                
                if ($cond > 0.5)
                    $amount = $balance + $cond * 0.92;
                else
                    $amount = $balance + $cond;
            } else if ($pr > 0) {
                if ($pr > 0.5)
                    $amount = $balance + $pr * 0.92;
                else 
                    $amount = $balance + $pr;
            } else {
                $cond1 = $amount-($amount*0.05 + 0.05);
                if ($cond1 > 0.5)
                    $amount = $balance + $cond1*0.92;
                else
                    $amount = $balance + $cond1;
            }
        }
        
        $data = array('balance' => $amount);

        $this->db->where('email', $email);
        $this->db->update('auth', $data);  
        
        return $amount;
    }
    
    public function resetYourBalanceWithBrain($email, $amount, $pr, $paymethod) {
        $this->db->where('email', $email);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }
        
        $amount = $balance + $pr;
        
        $data = array('balance' => $amount);

        $this->db->where('email', $email);
        $this->db->update('auth', $data);  
        
        return $amount;
    }
    
    public function getCardNumByRoom($roomNo) {
        $this->db->where('id', $roomNo);
        $res = $this->db->get('member');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->card1;
        }

        return $balance;
    }

    public function releaseBet($room_no, $user, $card) {
        $time = date("Y-m-d H:i:s");
        $data = array('user2' => $user,'card2'=> $card, 'win'=>'draw','end_date'=>$time);

        $this->db->where('id', $room_no);
        $res = $this->db->update('member', $data);   
    }
    
    public function userList() {
        $result = $this->db->get('auth');
        return $result;
    }

    public function editUser($param) {
        $id = $param;
        $query = $this->db->get_where('auth', array('id' => $id));
        return $query;
    }
    
    public function userUpdate($param) {
        $password= $param['password'];
        $data = array('uname' => $param['name'], 'email' => $param['email'], 'password'=> $password, 'role'=>$param['role'], 'status'=>$param['status']);
        $this->db->where('id', $param['id']);
        $this->db->update('auth', $data);
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>User updated successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Nothing to update.</p>';
        }
        exit;
    }

    public function deleteHistory($param) {
        $this->db->delete('member', array('id' => $param));
        
        if ($this->db->affected_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public function loadnotes($param) {
        $id = $param;
        $this->db->where('id', $id);
        return $this->db->get('teriff');
    }
    
    public function memberDelete($param) {
        $id = $param;
        $this->db->where('id', $id);
        $this->db->delete('member');
        
        $this->db->where('member_id', $id);
        $this->db->delete('member_plan');
        
        if($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
        
    }
    
    public function getGameTypeOfBrain($roomID) {
        $this->db->where('id', $roomID);
        $res = $this->db->get('member');
        $res = $res->result();

        $gameType = '';
        foreach ($res as $row) {
            # code...
            $gameType = $row->brain_game_type;
        }

        return $gameType; 
    }
    
    public function getGameDiffOfBrain($roomID) {
        $this->db->where('id', $roomID);
        $res = $this->db->get('member');
        $res = $res->result();

        $gameDiff = '';
        foreach ($res as $row) {
            # code...
            $gameDiff = $row->brain_game_diff;
        }

        return $gameDiff; 
    }
    
    //get questions
    public function getQuestions() {
        $roomNo = $this->session->userdata['room_no'];
        
        $gameType = $this->getGameTypeOfBrain($roomNo);
        $gameDiff = $this->getGameDiffOfBrain($roomNo);
        
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(1);
        $this->db->where('gametype', $gameType);
        $this->db->where('gamediff', $gameDiff);
        
        $res = $this->db->get('tbl_question');
        $res = $res->result();

        $guess = '';
        foreach ($res as $row) {
            # code...
            $guess['id'] = $row->id;
            $guess['question'] = $row->question;
            $guess['answer_id'] = $row->answer;
            $guess['answer_id2'] = $row->answer;
            $guess['answer_id3'] = $row->answer;
            $guess['answer_id4'] = $row->answer;
        }

        return $guess; 
    }
    
    public function getAnswerID($id, $id2, $id3, $id4) {
        $sql = "SELECT * FROM tbl_answer as t1 where t1.id=$id
                Union all SELECT * FROM tbl_answer2 as t2 where t2.id=$id2
                Union all SELECT * FROM tbl_answer3 as t2 where t2.id=$id3
                Union all SELECT * FROM tbl_answer4 as t2 where t2.id=$id4";
        
        $result =  $this->db->query($sql);
    
        $res_array = array();
        foreach ($result->result() as $row){
            $res_array[] = $row;
        }

        return $res_array;
    }
    
    public function getAnswerIDForEasy($id) {
        $sql = "(SELECT * FROM tbl_answer as t1 where t1.id=$id)
                Union all (SELECT * FROM tbl_answer2 as t2 ORDER BY RAND() LIMIT 1)
                Union all (SELECT * FROM tbl_answer3 as t2 ORDER BY RAND() LIMIT 1)
                Union all (SELECT * FROM tbl_answer4 as t2 ORDER BY RAND() LIMIT 1)";
        
        $result =  $this->db->query($sql);
    
        $res_array = array();
        foreach ($result->result() as $row){
            $res_array[] = $row;
        }

        return $res_array;
    }
    
    public function isCorrect($room_no, $q_id, $a_id) {
        $sql = "SELECT * FROM tbl_question where id=$q_id and answer=$a_id";
        
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $query = "update member set card1=(card1 + 1) where id=$room_no";
            $res = $this->db->query($query);
            return $room_no;
        } else {
            $query = "update member set card1=(card1 - 1) where id=$room_no";
            $res = $this->db->query($query);
            return 0;
        }
        
    }
    
    public function isCorrect_join($room_no, $q_id, $a_id) {
        $time = date("Y-m-d H:i:s");
        
        $user = $this->session->userdata['user_email'];
        $sql = "SELECT * FROM tbl_question where id=$q_id and answer=$a_id";
        
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $query = "update member set user2='$user', card2=(card2 + 1), end_date='$time' where id=$room_no";
            $res = $this->db->query($query);
            return $room_no;
        } else {
            $query = "update member set user2='$user', card2=(card2 - 1), end_date='$time' where id=$room_no";
            $res = $this->db->query($query);
            return 0;
        }
        
    }
    
    public function isConnectingAnother($room) {
       $sql = "SELECT * FROM member where id=$room and user2!=''";
        
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        } 
    }
    
    public function isWinBrain($room, $payment_method, $val, $user1) {
        $user = $this->session->userdata['user_email'];
        
        #####################potential value ###########################
        $this->db->where('id', $room);
        $res = $this->db->get('member');
        $res = $res->result();

        $pr = '';
        
        foreach ($res as $row) {
            # code...
            $pr = $row->potential_return;
        }
        ################################################################
                
        $this->db->where('id', $room);
        $res = $this->db->get('member');
        $res = $res->result();

        $created_men_value = '';
        $me_value = '';
        foreach ($res as $row) {
            # code...
            $created_men_value = $row->card1;
            $me_value = $row->card2;
        }

        ####################################################
        if ($me_value > $created_men_value) {
            $query = "update member set win='win' where id=$room";
            $res = $this->db->query($query);
        
            #################################################        
            $this->db->where('email', $user);
            $res = $this->db->get('auth');
            $res = $res->result();
    
            $balance = '';
            foreach ($res as $row) {
                # code...
                $balance = $row->balance;
            }
            
            //proc
            $val = $val + $pr;
            $fee = $val - ($val * 0.05 + 0.05);
            
            $real = $balance + $fee;
    
            $data = array('balance' => $real);
    
            $this->db->where('email', $user);
            $res = $this->db->update('auth', $data);
            
            /// delete
            $this->db->where('id', $room);
            $this->db->delete('member');
            
            return 1;
        } else if ($me_value == $created_men_value) {
            if ($payment_method != 0) {
                $this->db->where('email', $user);
                $res = $this->db->get('auth');
                $res = $res->result();
        
                $balance = '';
                foreach ($res as $row) {
                    # code...
                    $balance = $row->balance;
                }
                
                $val = ($val + $pr) / 2;
                $fee = $val - ($val * 0.05 + 0.05);
               
                $real = $balance + $fee;
        
                $data = array('balance' => $real);
        
                $this->db->where('email', $user);
                $res = $this->db->update('auth', $data);
            } else {
                $this->db->where('email', $user);
                $res = $this->db->get('auth');
                $res = $res->result();
        
                $balance = '';
                foreach ($res as $row) {
                    # code...
                    $balance = $row->balance;
                }
                
                $val = ($val + $pr)/2;
                $value = $val + $balance;
                    
                $data = array('balance' => $value);
        
                $this->db->where('email', $user);
                $res = $this->db->update('auth', $data);
                
                ///////////////////////////////////
                $this->db->where('email', $user1);
                $res = $this->db->get('auth');
                $res = $res->result();
        
                $balance = '';
                foreach ($res as $row) {
                    # code...
                    $balance = $row->balance;
                }
                
               
                $value = $balance + $val;
                    
                $data = array('balance' => $value);
        
                $this->db->where('email', $user1);
                $res = $this->db->update('auth', $data);
            }
            
            $this->db->where('id', $room);
            $this->db->delete('member');
            
            return 0;
        } else {
            $pr = $pr + $val;
            
            $time = date("Y-m-d H:i:s");
            $data = array('user2'=>'', card2=>'0', 'potential_return'=>$pr,'end_date'=>$time);
    
            $this->db->where('id', $room);
            $res = $this->db->update('member', $data);
            
            return -1;
        }
        
    }
    
    public function getPrizes($roomID) {
        $this->db->where('id', $roomID);
        $res = $this->db->get('member');
        $res = $res->result();

        $guess = '';
        foreach ($res as $row) {
            # code...
            $guess = $row->mystery_prizes;
        }

        return $guess; 
    }
    
    public function getPrizesLog($roomID) {
        $this->db->where('id', $roomID);
        $res = $this->db->get('member');
        $res = $res->result();

        $guess = '';
        foreach ($res as $row) {
            # code...
            $guess = $row->guess_log;
        }

        return $guess; 
    }
    
    public function getBoxPrice($roomID) {
        $this->db->where('id', $roomID);
        $res = $this->db->get('member');
        $res = $res->result();

        $price = '';
        foreach ($res as $row) {
            # code...
            $price = $row->box_prize;
        }

        return $price; 
    }
    
    public function show_mystery_box($roomID) {
        $this->db->where('id', $roomID);
        $res = $this->db->get('member');
        $res = $res->result();

        $price = '';
        foreach ($res as $row) {
            # code...
            $price = $row->mystery_prizes;
        }
        
        $prizes = explode(",", $price);
        ////////////////////////////////////////
        $guess = $this->getPrizesLog($roomID);
        
        $guess_diff = explode(",", $guess);
        if(count($guess_diff) > 0) {
            foreach($guess_diff as $val) {
                $idx = 0;
                foreach($prizes as $g_val) {
                    if ($val == $g_val ){
                        unset($prizes[$idx]);
                        sort($prizes);
                       
                        break;
                    }
                    $idx++;
                }
            }
        }
        
        if (count($prizes) == count($guess)) {
            $user = $this->session->userdata['user_email'];
            $time = date("Y-m-d H:i:s");
            $data = array('user2' => $user, 'win' => 'win', 'end_date'=>$time);

            $this->db->where('id', $roomID);
            $res = $this->db->update('member', $data);    
        }
        
        $rand = $prizes[array_rand($prizes, 1)];
        $guess = $rand.','.$guess;
        
        $data = array('guess_log' => $guess);

        $this->db->where('id', $roomID);
        $res = $this->db->update('member', $data);
        
        return $rand;
    }
    
    public function addBalanceWithMystery($user, $amount) {
        $this->db->where('email', $user);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }
        
        //proc
        $balance = $balance + $amount;

        $data = array('balance' => $balance);

        $this->db->where('email', $user);
        $res = $this->db->update('auth', $data);
    }
}
