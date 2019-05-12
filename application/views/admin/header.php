<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RPS Bet - Home</title>
        <link href="<?php echo base_url() ?>asset/lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/select2/select2.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/select2/select2-bootstrap.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/alertify/alertify.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/alertify/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/jquery_ui/jquery-ui.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url() ?>asset/lib/jquery_ui/jquery-ui.theme.min.css"/>
        <link href="<?php echo base_url() ?>asset/lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="<?php echo base_url() ?>asset/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
        <script>
        /*window.addEventListener("load", function(){
        window.cookieconsent.initialise({
          "palette": {
            "popup": {
              "background": "#33271f"
            },
            "button": {
              "background": "#f5b22d"
            }
          },
          "theme": "edgeless",
          "content": {
            "href": "https://rpsbet.com/privacy-policy/"
          }
        })});*/
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-55401494-4"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-55401494-4');
        </script>
        <script src="<?php echo base_url() ?>asset/lib/js/jquery-latest.min.js"></script>
        <script src="<?php echo base_url() ?>asset/lib/jquery_ui/jquery-ui.min.js"></script>
    </head>
    <body>
        <div id="loaderkender" style=""><div><button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i>&nbsp;&nbsp;Loading...</button></div></div>

        <div class="toprow"></div>
        <div style="background: #33271f;" class="fullheader">
            <div class="container">
                <div class="row">
                    <a href="<?php echo base_url()?>memberList" class="navbar-brand pull-left">
                        <img class="logo" src="<?php echo base_url() ?>asset/images/logo.png" alt="RPS Bet Logo" style="height: 50px; width: auto;"/>
                    </a>
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="glyphicon glyphicon-align-justify"></span>
                    </button>
                    <nav class="navbar-collapse navbar-collapse-cus navbar-inverse  collapse" role="navigation">
                        <ul class="navbar-nav nav">
                            <li><a href="#"><strong>ROCK-PAPER-SCISSORS</strong></a></li>
                        </ul>
                        <ul class="navbar-nav nav pull-right">
                            <li><a href="<?php echo base_url()?>auth/logout">&nbsp;LOGOUT&nbsp;&nbsp;<i class="glyphicon glyphicon-off"></i> <b></b></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container-fluid scrollheader" style="background: #000;">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center"> </p>
                </div>
            </div>
        </div>

        <div class="container" id="lower-header" style="background: #ffffff99; height: 40px;">
            <div row>
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active"><a data-toggle='modal' data-target='#helpModal' href="">How To Play</a></li>
                        <!-- <li><a href="#"><?php echo $this->uri->segment(1)?></a></li> -->
                        <li class="pull-right"><a class="btn btn-sm btn-info" data-toggle='modal' data-target='#editModal' href=""><img src="<?php base_url()?>/asset/images/account.png" class="user_icon"/></a></li>
                    </ol>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"><?php echo $this->session->userdata['user_name'];?></h3>
                
              </div>
              <form  id="frm_withdraw" role="form" action="<?php echo base_url() ?>withdrawproc" method="POST">
              <div class="modal-body">
                    Balance  :  <?php echo $this->session->userdata['balance'] == '' ? 0 : $this->session->userdata['balance'];?>
                    <br>
                    Email    :  <?php echo $this->session->userdata['user_email'];?>
                    <br>
                    Widthraw Methods :
                    <br>
                    Bank - <input type="radio" name="bank" value="0" onchange="javascript:changeShow(0)" checked />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Paypal - <input type="radio" name="bank" value="1" onchange="javascript:changeShow(1)"/>
                    <br>
                    <div class="accountnumber">
                        <label>enter sort code + account number: </label>
                        <input type="text" name="accountnumber" id="accountnumber"/>
                    </div>
                    <div class="paypal" style="display:none">
                        <label>Paypal email address: </label>
                        <input type="email" name="paypal" id="paypal"/>
                    </div>
                    <br>
                    <div class="">
                        <label>Amount to Withdraw: </label>
                        <input type="number" name="withdraw" id="withdraw"/>
                    </div>
                    * Minimum Withrawal Threshold is £5.00
              </div>
              <div class="modal-footer">
                <button type="button" data-toggle='modal' data-target='#changePwd' class="btn btn-primary" id="changepwd">CHANGE PASSWORD</button>
                <button type="button" data-toggle='modal' data-target='#changeEmail' class="btn btn-primary" id="changemail">CHANGE EMAIL ADDRESS</button>
                <button type="submit" class="btn btn-primary" id="submitEditModal">WITHDRAW</button>
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="changePwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Change your password</h3>
                
              </div>
              <form  id="frm_pwd" role="form" action="<?php echo base_url() ?>changePwd" method="POST">
              <div class="modal-body">
                    <div class="row clear_fix">
                        <div class="col-md-4 col-md-offset-4"style="position: relative">
                            <p class="alert alert-danger text-center  login-form" id="response"><b>Change password error.</b></p>
                        </div>
                        <style>
                            #response{display: none}
                        </style>
                    </div>
                    
                    New Password :
                    <br>
                    <input type="password" name="newpwd" id="newpwd" value=""/>
                    <br>
                    Confirm Password:
                    <br>
                    <input type="password" name="confirmpwd" id="confirmpwd" value="" onchange="javascript:passwordchange()"/>
                
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="changepwd">CHANGE PASSWORD</button>
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="changeEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"><?php echo $this->session->userdata['user_name'];?></h3>
                
              </div>
              <div class="modal-body">
                  <div class="row clear_fix">
                        <div class="col-md-4 col-md-offset-4"style="position: relative">
                            <p class="alert alert-danger text-center  login-form" id="response"><b>Change Email error.</b></p>
                        </div>
                        <style>
                            #response{display: none}
                        </style>
                    </div>
                  <form  id="frm_email" role="form" action="<?php echo base_url() ?>changeEmail" method="POST">
                    Current Email Address  :  <?php echo $this->session->userdata['user_email'];?>
                    <br>
                    New Email Address :
                    <br>
                    <input type="email" name="newmail" value="" id="newmail" onchange="javascript:onchangeEmail()"/>
              </div>
              <div class="modal-footer">
                <button type="sumbit" class="btn btn-primary">CHANGE EMAIL ADDRESS</button>
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content" style="background-color: #333;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel" style="color: #fff;">How To Play <span style="color: #c33626;">RPS</span> <span style="color: #ebddca;">Bet</span></h3>
                
              </div>
              <div class="modal-body">
                    <h4>START NEW BET</h4><br>
                    <ol>
                        <li>Click 'START NEW BET'.</li><br>
                        <li>Enter 'Bet Amount'.</li><br>
                        <li>Choose 'Rock', 'Paper' or 'Scissors'.</li><br>
                        <li>Wait for a <i>contender.</i></li>
                    </ol>
                    <hr />
                    <h4>JOIN GAME</h4><br>
                    <ol>
                        <li>Click 'JOIN GAME'.</li><br>
                        <li>Choose 'Rock', 'Paper' or 'Scissors'.</li><br>
                        <li>Check your <a data-toggle='modal' data-dismiss="modal" data-target='#editModal' href="" style="color: #B5862D;">Balance!</a></li>
                    </ol>
                    <hr />
                    <h4>For All Enquiries</h4>
                    <p>For any technical/general problems, please contact <u style="color: #f5b22d;
    font-weight: 600;">online@rpsbet.com</u>.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitEditModal">PLACE A NEW BET</button>
              </div>
            </div>
          </div>
        </div>
        
        <script>
        
            function changeShow(val) {
                if (val == 0) {
                    $(".paypal").hide();
                    $(".accountnumber").show();
                } else {
                    $(".paypal").show();
                    $(".accountnumber").hide();
                }
            }
            
            //Check password
            function passwordchange() {
                var confirm = confirmpwd.value;
                var password = newpwd.value;
                
                if (password == '') {
                    alert("please enter new password.");
                    return false;
                }
                
                if (confirm != password)
                {
                    alert('please enter again.');
                    confirmpwd.value = '';
                    password.value = '';
                    return false;
                }
            }
            
            //submit form for change password
            $(document).ready(function (){
                
                $("#frm_pwd").submit(function (e){
                    e.preventDefault();
                    var url = $(this).attr('action');
                    var method = $(this).attr('method');
                    var data = $(this).serialize();
                    
                    $newpwd = $("#newpwd").val();
                    if($newpwd == '') {
                        alert("please enter new password.");
                        return false;
                    }
                    $.ajax({
                       url:url,
                       type:method,
                       data:data
                    }).done(function(data){
                       if(data =='false')
                        {
                            $("#newpwd").focus();
                            $("#response").slideDown('fast');
                            $('#frm_pwd')[0].reset();
                            setTimeout(function (){
                                $("#response").slideUp('fast');
                            },3000);
                        }
                        else if(data =='1')
                        {
                            $("#changePwd").modal('hide');
                            $("#newpwd").val('');
                            $("#confirmpwd").val('');
                        } 
                    });
                });
            });
            
            //Check email
            function onchangeEmail() {
                var email = newmail.value;
                
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var res = re.test(String(email).toLowerCase());
                if(res == 'false') {
                    alert('Invalid Email, please enter again.');
                    return false;
                }
            }
            
            $(document).ready(function (){
                
                $("#frm_email").submit(function (e){
                    e.preventDefault();
                    var url = $(this).attr('action');
                    var method = $(this).attr('method');
                    var data = $(this).serialize();
                    
                    $newpwd = $("#newmail").val();
                    if($newpwd == '') {
                        alert("please enter your email address.");
                        return false;
                    }
                    $.ajax({
                       url:url,
                       type:method,
                       data:data
                    }).done(function(data){
                       if(data =='false')
                        {
                            $("#newmail").focus();
                            $("#response").slideDown('fast');
                            $('#frm_email')[0].reset();
                            setTimeout(function (){
                                $("#response").slideUp('fast');
                            },3000);
                        }
                        else if(data =='1')
                        {
                            $("#changeEmail").modal('hide');
                            $("#newmail").val('');
                        } 
                    });
                });
            });
            
            withdraw.oninput = function(){
                var money = withdraw.value;
                if(isNaN(money))
                {
                    alert('Enter only Number, please.');
                    withdraw.value = '';
                    return false;
                }
            }
            
            $(document).ready(function (){
                
                $("#frm_withdraw").submit(function (e){
                    e.preventDefault();
                    var url = $(this).attr('action');
                    var method = $(this).attr('method');
                    var data = $(this).serialize();
                    
                    var withdraw = $("#withdraw").val();
                    if(withdraw == '') {
                        alert("please enter new password.");
                        return false;
                    }
                    
                    $.ajax({
                       url:url,
                       type:method,
                       data:data
                    }).done(function(data){
                        if(data =='okayokay')
                        {
                            $("#editModal").modal('hide');
                            $("#withdraw").val('');
                            $("#paypal").val('');
                            $("#accountnumber").val('');
                        } else {
                            $("#withdraw").focus();
                            $("#response").slideDown('fast');
                            $('#frm_withdraw')[0].reset();
                            setTimeout(function (){
                                $("#response").slideUp('fast');
                            },3000);
                        }
                    });
                });
            });
        </script>
        












