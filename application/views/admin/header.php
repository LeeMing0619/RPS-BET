<!DOCTYPE html>

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
        <script src="<?php echo base_url() ?>asset/lib/js/jquery-latest.min.js"></script>
        <!--<script src="<?php echo base_url() ?>asset/lib/js/countdown.js"></script>-->
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
        <style>
        .drop { background-color: #fff; }
        
        .drop:after { border: dashed 0.3rem rgba(0, 0, 0, 0.0875); }
        
        .drop .drop-label { color: rgba(0, 0, 0, 0.0875); }
        
        .drop:hover:after { border-color: rgba(0, 0, 0, 0.125); }
        
        .drop:hover .drop-label { color: rgba(0, 0, 0, 0.125); }
        
        #image-preview, .image-preview { background-color: #000; }
        
        .drop {
          max-width: 150px;
          min-height: 100px;
          position: relative;
          overflow: hidden;
          cursor: pointer;
          margin-top: 30px;
          margin-bottom: 30px;
        }
        
        .drop:after {
          content: "";
          position: absolute;
          top: 0;
          right: 0;
          left: 0;
          bottom: 0;
        }
        
        .drop.file-focus { border: 0; }
        
        .drop:hover { cursor: pointer; }
        
        .drop .drop-label {
          font-size: 1.8rem;
          font-weight: 200;
          line-height: 2rem;
          width: 200px;
          text-align: center;
          position: absolute;
          top: 50%;
          margin-top: -1.5rem;
        }
        
        .drop input[type=file] {
          line-height: 100px;
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          height: 100px;
          width: 200px;
          opacity: 0;
          z-index: 10;
          cursor: pointer;
        }
        
        #image-preview, .image-preview {
          width: 200px;
          display: block;
          position: relative;
          z-index: 1;
        }
        
        #image-preview:empty, .image-preview:empty { display: none; }
        
        #image-preview img, .image-preview img {
          display: block;
          margin: 0 auto;
          width: 200px;
        }
        
        #image-preview:after, .image-preview:after {
          content: "";
          position: absolute;
          top: 0;
          bottom: 0;
          right: 0;
          left: 0;
          border: solid 0.1rem rgba(0, 0, 0, 0.08);  
        }
    </style>
    </head>
    
    <?php 
        if (!isset($this->session->userdata['user_name'])) {
            echo '<script>window.location.href = window.location.protocol + "//" + window.location.host + "/auth";</script>';
        }
    ?>
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
                            <li><a href="<?php echo base_url()?>topList/"><strong>LEADERBOARD (TOP 10)</strong></a></li>
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
                        <li class="active"><a data-toggle='modal' data-target='#helpModal' href="" style="font-size: 18.5px;">How To Play</a></li>
                        <!-- <li><a href="#"><?php echo $this->uri->segment(1)?></a></li> -->
                        <li class="pull-right">
                            <a class="btn btn-sm btn-info" data-toggle='modal' data-target='#editModal' href="" style="width: 60px;height: 60px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;">
                                <?php 
                                    $photo = $this->session->userdata['user_photo'];
                                    if ($photo != '') {
                                        echo '<img src="'.base_url().'/uploads/photo/'.$photo.'" style="display: inline;   margin: 0 auto;    margin-left: -25%; height: 100%;width: auto;"  id="user_avatar"/>';
                                    } else {
                                        echo '<img src="'.base_url().'/asset/images/account.png" class="user_icon" id="user_avatar"/>';
                                    }
                                ?>
                            </a>
                        </li>
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
                <h4 class="text-center">BETA Trial <i>3</i> (ENDED 07.06.19)</h4>
                <p><i><b>What's New (26.05.19): </b></i><br>Brain Game!<br>Set your score, then wait for players to try beat it. Be wary of brainy players, END the game before they take the PR!!<br><br><i><b>TRIAL 4 (Begins soon!):</b></i><br class=""/>Trial 3 has finally ended after a week of Ups &#38; Downs!<br>Check the <a style="color: #000; text-decoration: underline;" href="https://www.rpsbet.com/topList/">Leaderboards</a> to see where you came.<br>To see the Winners of all RPS Bet's testing trials so far and to see news on Trial 4, check out our <a style="color: #000; text-decoration: underline;" href="https://www.facebook.com/rpsbet/">Facebook Page</a>.<br><br><span style="text-align: center;"><i>Please note all bets now will not count towards anything until further news on Trial 4 has been announced in which case balances will reset.</i></span></p><hr>
                <table id="account-modal" style="width:100%">
                  <tr>
                    <td><label>Balance:</label></td>
                    <td>&#163;<label class="class_balance"><?php echo $this->session->userdata['balance'] == '' ? 0 : $this->session->userdata['balance'];?></label></td>
                  </tr>
                  <tr>
                    <td><label>Email:</label></td>
                    <td class="eemail"><?php echo $this->session->userdata['user_email'];?></td>
                  </tr>
                  <tr>
                      <td colspan="2"><hr></td>
                  </tr>
                  <tr>
                    <td><label>Withdraw Methods:</label></td>
                    <td style="display: none;"><!--
                    Bank&nbsp;<input type="radio" name="bank" id="bank" value="0" onchange="javascript:changeShow(0)" checked />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                    PayPal&nbsp;<input type="radio" name="bank" id="bank" checked value="1" onchange="javascript:changeShow(1)"/>
                    </td>
                    <td>Currently we are only able<br>to send out Payments via PayPal.</td>
                  </tr>
                  <tr class="accountnumber" style="display:none">
                    <td><div >
                        <label>Sort code + Account number:</label>
                    </div></td>
                    <td><input type="text" name="accountnumber" id="accountnumber"/></td>
                </tr>
                <tr class="paypal">
                    <td>
                    <div>
                        <label>PayPal Email Address: </label>
                    </div>
                    </td>
                    <td><input type="email" class="bet-amount" name="paypal" id="paypal"/></td>
                </tr>
                <tr><td>
                    <div class="">
                        <label>Amount to Withdraw: (Minimum £100.00)</label>
                    </div>
                    </td>
                    <td>
                        <input type="number" class="bet-amount" name="withdraw" id="withdraw" min="100"/><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><p>Remember! There are <u>NO</u> Withdrawal Fees,<br>the amount you withdraw is the amount you will receive!</p></td>
                </tr>
                <tr>
                  <td><label>Working Hours: </label></td>
                  <td><ul><li><b>Mon-Sat:</b> 8AM - 8PM</li><li><b>Sun:</b> 8AM - 4PM</li></ul></td>
                </tr>
            </table>
              </div>
              <div class="modal-footer">
                <button type="button" data-toggle='modal' data-target='#changeProfile' class="btn btn-primary" id="changeprofile">CHANGE PROFILE</button>
                <button type="button" data-toggle='modal' data-target='#changePwd' class="btn btn-primary" id="changepwd">CHANGE PASSWORD</button>
                <button type="button" data-toggle='modal' data-target='#changeEmail' class="btn btn-primary" id="changemail">CHANGE EMAIL ADDRESS</button>
                <button type="submit" class="btn btn-primary" id="submitWithdraw">WITHDRAW</button>
                
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
                <h3 class="modal-title" id="myModalLabel">Change your Password</h3>
                
              </div>
              <form  id="frm_pwd" role="form" action="<?php echo base_url() ?>changePwd" method="POST">
              <div class="modal-body">
                    <div class="row clear_fix">
                        <div class="col-md-4 col-md-offset-4" style="position: relative">
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
        
        <div class="modal fade" id="changeProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Change your Profile</h3>
                
              </div>
              <form  id="frm_profile" role="form" action="<?php echo base_url() ?>changeProfile" method="POST"  enctype='multipart/form-data'>
              <div class="modal-body">
                    <div class="row clear_fix">
                        <div class="col-md-4 col-md-offset-4" style="position: relative">
                            <p class="alert alert-danger text-center  login-form" id="response"><b>Change password error.</b></p>
                        </div>
                        <style>
                            #response{display: none}
                        </style>
                    </div>
                    <div class="drop">
                        <div class="uploader">
                          <label class="drop-label">Drag and drop images here</label>
                          <input type="file" class="image-upload" id="photo" name="photo" accept="image/*">
                        </div>
                        <div id="image-preview"></div>
                    </div>
                    <br>
                    <label for="">Your Biography (less than 200 characters)</label>
                    <br>
                    <textarea class="form-control" rows="3" name="bio" id="bio" maxlength="200"></textarea>
                
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="changepwd">CHANGE PROFILE</button>
                
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
                <h3 class="modal-title" id="myModalLabel">Change your Email</h3>
                
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
                    <p class="myemail">Current Email Address  :  <?php echo $this->session->userdata['user_email'];?></p>
                    <br>
                    New Email Address :
                    <br>
                    <input type="email" name="newmail" value="" id="newmail" onchange="javascript:onchangeEmail()"/>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">CHANGE EMAIL ADDRESS</button>
                
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
                <h4><b><span>Brain Game</span> Game Mode</b></h4>
                    <h5>START NEW BET</h5>
                    <ol>
                        <li>Click START to answer as many questions as you can in a minute.</li><br>
                        <li>Go to <a href="<?php echo base_url() ?>showLog" style="color: #B5862D;"><b>MY BETS</b></a> and <b>END</b> your game as the PR increases.</li>
                    </ol>
                    <h5>JOIN GAME</h5>
                    <ol>
                        <li>Try beat the Host's score before they end their game, all losses will be added to the PR.</li>
                    </ol>
                <h4><b><span><i>SPLEESH!</i></span> Game Mode</b></h4>
                    <h5>START NEW BET</h5>
                    <ol>
                        <li>Pick Your Number (1-10) for people to guess.</li><br>
                        <li>Wait for players to guess. <i>All guesses will be added to the PR.</i></li><br>
                        <li>Go to <a href="<?php echo base_url() ?>showLog" style="color: #B5862D;"><b>MY BETS</b></a> when the PR exceeds your initial Bet Amount (Your Number) and <b>END</b> your game before anyone guesses your number!</li>
                    </ol>
                    <h5>JOIN GAME</h5>
                    <ol>
                        <li>Guess the Host's Number correctly to Win the PR.</li>
                    </ol>
                    <h4><b><span>Classic RPS</span> Game Mode</b></h4>
                    <p>Rock BEATS Scissors, Paper BEATS Rock, Scissors BEATS Paper - it's as simple as that.</p>
                    <hr>
                    <table>
                      <tr>
                        <th>Game Modes</th>
                        <th>Bet Amount Fees</th>
                        <th>Winnings Fees</th>
                      </tr>
                      <tr>
                        <td class="gamemode">Brain Game</td>
                        <td rowspan="3"><ul>
                          <li>No fees if user's balance is used for payment.</li>
                          <li>PayPal Fees are 5% + 0.05p</li>
                        </ul>
                        </td>
                        <td rowspan="2">
                          8&#37; is only Deducted from Winnings over &pound;5.
                        </td>
                      </tr>
                      <tr>
                        <td class="gamemode"><i>Spleesh!</i></td>
                      </tr>
                      <tr>
                        <td class="gamemode">RPS</td>
                        <td>1.8&#37; is Deducted from RPS Winnings.</td>
                      </tr>
                    </table>
                    <p class="scroll-txt">Scroll &#8680;</p>
                    <hr>
                    <p>Check your <a data-toggle='modal' data-dismiss="modal" data-target='#editModal' href="" style="color: #B5862D;"><b>Balance</b></a> at the end of each game.</p>
                    <hr />
                    <h5>For All Enquiries</h5>
                    <p>For any technical/general problems, please contact <u style="color: #f5b22d;
    font-weight: 600;">online@rpsbet.com</u>.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitEditModal"><a style="color: #fff; text-decoration: none; font-weight: 800 !important;" href="<?php echo base_url() ?>register">PLACE A NEW BET</a></button>
              </div>
            </div>
          </div>
        </div>
        <script src="<?php echo base_url() ?>asset/lib/js/jquery.imagereader-1.1.0.js"></script> 
<script>
    checkBalance();
    
    function checkBalance() {
        setTimeout(function () {
          //do something once
          isChangedBalance();
        }, 1000);   
    }
    
    function isChangedBalance() {
        $value = $(".class_balance").html();
        
        $.ajax({
            url:'<?php echo base_url()?>'+'ajax_admin/isChangedBalance',
            type:'GET',
            data:'val='+ $value + '&id=<?php echo $this->session->userdata['user_email']?>'
        }).done(function (html){
            if (html != 'same')
                $(".class_balance").html(html);
            checkBalance();
        });
    }
    
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
            alert("Please enter a new Password.");
            return false;
        }
        
        if (confirm != password)
        {
            alert('Passwords do not match. Try again.');
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
                alert("Please enter a new password.");
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
    
    //Change Profile
    $(document).ready(function (){
        $("#frm_profile").submit(function (e){
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var data = new FormData(this);
            
            var photo = $("#photo").val();
            var bio = $("#bio").val();
            
            if (photo == '') {
                alert("please select your avatar.");
                return false;
            }
            if (bio == '') {
                alert("Please enter your biography.");
                return false;
            }
            
            $.ajax({
               url:url,
               type:method,
               contentType: false,
               processData: false,
               data:data
            }).done(function(data){
               if(data == 0)
                {
                    $("#response").slideDown('fast');
                    setTimeout(function (){
                        $("#response").slideUp('fast');
                    },3000);
                }
                else
                {
                    var url = '<?php  echo base_url() ?>/uploads/photo/'+data;
                    $("#user_avatar").attr('src', url);
                    $("#changeProfile").modal('hide');
                    $("#photo").val('');
                    $("#bio").val('');
                    location.reload(true);
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
                alert("Please enter your Email Address.");
                return false;
            }
            $.ajax({
               url:url,
               type:method,
               data:data
            }).done(function(data){
               if(data =='fail')
                {
                    $("#newmail").focus();
                    $('#frm_email')[0].reset();
                    alert("Email is already assigned to another account. Please use another email.")
                }
                else {alert(data);
                    $(".myemail").html(data);
                    $(".eemail").html(data);
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
            alert('Numeric value required.');
            withdraw.value = '';
            return false;
        }
    }
    
    $(document).ready(function (){
        
        $("#frm_withdraw").submit(function (e){
            e.preventDefault();
            $("#submitWithdraw").prop('disabled', true);
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var data = $(this).serialize();
            
            var withdraw = $("#withdraw").val();
            var account = $("#accountnumber").val();
            var paypal = $("#paypal").val();
            
            var balance = <?php echo $this->session->userdata['balance']== '' ? '0': $this->session->userdata['balance'];?>;
            if(withdraw == '') {
                alert("Please enter the Amount you would like to Withdraw.");
                $("#submitWithdraw").prop('disabled', false);
                return false;
            } else if (account =='' && paypal == '') {
                alert("Please enter your PayPal Email Address so we can send you your payment.");
                $("#submitWithdraw").prop('disabled', false);
                return false;
            } else if (balance < 100) {
                alert("Insufficient Balance. Your Balance must be more than or equal to £100 during testing phases.");
                $("#submitWithdraw").prop('disabled', false);
                return false;
            } else if (withdraw < 100) {
                alert("Minimum Withdraw Threshold is £100. Please enter a value more than or equal to £100.");
                $("#submitWithdraw").prop('disabled', false);
                return false;
            } else if (balance < withdraw) {
                alert("Insufficient balance.");
                $("#submitWithdraw").prop('disabled', false);
                return false;
            } else {
                $("#editModal").modal('hide');
            
                $.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                    $("#withdraw").val('');
                    $("#paypal").val('');
                    $("#accountnumber").val('');
                    $(".class_balance").html(data);
                    
                    alert("Check your email for your Withdrawal receipt.");
                    
                    $("#submitWithdraw").prop('disabled', false);
                });
            }
            
        });
    });
    
    $('#photo').imageReader({
      renderType: 'canvas',
      onload: function(canvas) {
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = "orange";
        ctx.font = "12px Verdana";
        ctx.fillText("Filename : "+ this.name, 10, 20, canvas.width - 10);
        $(canvas).css({
          width: '100%',
          height: '100px'
        });
      }
    });
</script>
        












