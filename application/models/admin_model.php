<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function memberCreate($param) {
        $member = array('fname' => $this->session->userdata['user_name'],
            'bet_amount' => $param['betamount'],
            'status' => $param['privated'],
            'user1' => $this->session->userdata['user_email'],
            'card1' => $param['card'],
            'win' => '',
            'note' => $param['note'],
            'password' => $param['password']);
        $this->db->insert('member', $member);
        
        exit;
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
    
    public function getAmountByEmail($id) {
        $this->db->where('email', $id);
        $res = $this->db->get('member');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->bet_amount;
        }

        return $balance;
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
    
    public function confirmWin($room, $user, $val) {
        $data1 = array('user2' => $user, 'card2'=>$val, 'win'=>$val);

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
    
    public function getWinsHistory($email) {
        $sql = "select m.id,CONCAT('Rock', m.id)as member_id, m.fname, m.user1,  m.status, m.bet_amount, m.note ,m.password from member m where (m.user2='$email' and m.win='win') or (m.user1='$email' and m.win='lose') order by m.id desc";
        $query = $this->db->query($sql);
        
        return $query;    
    }
    
    public function getLooseHistory($email) {
        $sql = "select m.id,CONCAT('Rock', m.id)as member_id, m.fname, m.user1,  m.status, m.bet_amount, m.note ,m.password from member m where (m.user2='$email' and m.win='lose') or (m.user1='$email' and m.win='win') order by m.id desc";
        $query = $this->db->query($sql);
        
        return $query;    
    }
    
    public function getDrawsHistory($email) {
        $sql = "select m.id,CONCAT('Rock', m.id)as member_id, m.fname, m.user1,  m.status, m.bet_amount, m.note ,m.password from member m where (m.user2='$email' and m.win='') or (m.user1='$email' and m.win='') order by m.id desc";
        $query = $this->db->query($sql);
        
        return $query;    
    }
    
    public function setBalance($val, $id, $val1, $id2) {
        $this->db->where('email', $id);
        $res = $this->db->get('auth');
        $res = $res->result();

        $balance = '';
        foreach ($res as $row) {
            # code...
            $balance = $row->balance;
        }

        $real = $balance + $val;

        $data = array('balance' => $real);

        $this->db->where('email', $id);
        $res = $this->db->update('auth', $data);
        ////////////////////////////////////////////
        $this->db->where('email', $id2);
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
        $res = $this->db->update('auth', $data1);
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

    public function releaseBet($room_no, $balance) {
        $upBalance = $balance * 2;
        $data = array('bet_amount' => $upBalance);

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

    public function deleteUser($param) {
        $id = $param;
        $this->db->delete('auth', array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            echo'<p class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Congrats ! </strong>One record has been deleted successfully.</p>';
        } else {
            echo'<p class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sorry! </strong>Internal Error.</p>';
        }
        exit;
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
}
