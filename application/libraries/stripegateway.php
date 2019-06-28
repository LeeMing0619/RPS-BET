<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

include("./vendor/autoload.php");

class stripegateway {
    public function __construct() {
        $stripe = array(
                "secret_key" => "sk_test_quuG28pUbi8bGmLyVgMmmiNh00Kz66h3OD",
                "public_key" => "pk_test_KhGeJsQcYtgOy9xjQ4ErR43x00jEXDuQdq"
        );
        
        \Stripe\Stripe::setApiKey($stripe["secret_key"]);
    }
    
    public function checkout($data) {
        $message = "";
        try{
            $mycard = array('number' => $data['number'], 'exp_month' =>$data['exp_month'], 'exp_year' =>$data['exp_year']);
        
            $token = \Stripe\Token::create([
              'card' => [
                'number' => $data['number'],
                'exp_month' => $data['exp_month'],
                'exp_year' => $data['exp_year'],
                'cvc' => 213
              ]
            ]);
            
            $charge = \Stripe\Charge::create([
                'amount'=>$data['amount'], 
                'currency'=>'gbp',
                'source'=>$token]);
            
            $message = $charge->status;    
        } catch (Exception $e) {
            $message = $e->getMessage();
            
        }
        
        return $message;
    }
}