<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55; height: 100vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <?php 
        if(isset($kind) && $kind == 1) {
            ?>
            <div class="col-md-10 col-sm-10">
                <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
                <div class="row" style="padding: 0px 5px;">
                    <div class="col-md-12">
                        <h3 class="red-title">Guess The Host's Number: </h3>
                        <div id="ajaxresponse"><font color="red"><?php echo isset($msg) ? $msg:'';?></font></div>
                        <br>
                        <form id="frm_spleesh" name="frm_spleesh" class="form" action="<?php echo base_url() ?>joinSpleeshGame" method="POST">

                            <div class="row clearfix">
                                <br>
                                <div class="selectRockDiv col-xs-6 col-md-6">
                                <label>Previous Guesses</label><br>
                                    <p class="prevguess"><?php echo $guess; ?></p>
                                </div><br>
                                <div class="selectRockDiv col-xs-6 col-md-6">
                                <label class="required">Your Guess</label>
                                <?php
                                    if($betAmount < 1) {
                                        ?>
                                        <div class="col-xs-6 col-md-6 spleeshNumber1">
                                            <label class="radio-inline checked">
                                                <input type="radio" checked name="spleeshamount" value="0.1" id="spleeshamount1" /><i>£0.10</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="0.2" id="spleeshamount2" /><i>£0.20</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="0.3" id="spleeshamount3" /><i>£0.30</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="0.4" id="spleeshamount4"/><i>£0.40</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="0.5" id="spleeshamount5" /><i>£0.50</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="0.6" id="spleeshamount6" /><i>£0.60</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="0.7" id="spleeshamount7" /><i>£0.70</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="0.8" id="spleeshamount8" /><i>£0.80</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="0.9" id="spleeshamount9" /><i>£0.90</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="1" id="spleeshamount10" /><i>£1.0</i>
                                            </label>
                                    </div>
                                        <?php
                                    } else if ($betAmount < 10) {
                                        ?>
                                        <div class="col-xs-6 col-md-6 spleeshNumber2">
                                            <label class="radio-inline checked">
                                                <input type="radio" checked name="spleeshamount" value="1" id="spleeshamount11" /><i>£1.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="2" id="spleeshamount12" /><i>£2.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="3" id="spleeshamount13" /><i>£3.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="4" id="spleeshamount14" /><i>£4.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="5" id="spleeshamount15"  /><i>£5.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="6" id="spleeshamount16" /><i>£6.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="7" id="spleeshamount17"/><i>£7.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="8" id="spleeshamount18"/><i>£8.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="9" id="spleeshamount19"/><i>£9.0</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="10" id="spleeshamount20"/><i>£10.0</i>
                                            </label>
                                    </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="col-xs-6 col-md-6 spleeshNumber3">
                                            <label class="radio-inline checked">
                                                <input type="radio" checked name="spleeshamount" value="10" id="spleeshamount21"/><i>£10</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="20" id="spleeshamount22" /><i>£20</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="30" id="spleeshamount23" /><i>£30</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="40" id="spleeshamount24" /><i>£40</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="50" id="spleeshamount25" /><i>£50</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="60" id="spleeshamount26" /><i>£60</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="70" id="spleeshamount27"/><i>£70</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="80" id="spleeshamount28" /><i>£80</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="90" id="spleeshamount29" /><i>£90</i>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="spleeshamount" value="100" id="spleeshamount30" /><i>£100</i>
                                            </label>
                                    </div>
                                        <?php
                                    }
                                ?>
                                </div>
                            <br>
                            <div class="selectRockDiv col-xs-6 col-md-6">
                            <label>Payment Method</label>
                            
                            <label class="radio-inline">
                                <input type="radio" checked name="withbalance" value="0" id="withbalance"  onchange="javascript:changePaymentMethod(0)"/>
                                Pay with Balance
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="withbalance" value="1" id="withpaypal" onchange="javascript:changePaymentMethod(1)" />
                                PayPal
                            </label>
                        </div>
                        <br>
                        <input type="button" class="btn btn-success btn-block" value="Submit"  onclick="javascript:send();"/><br>
                    </form>
                </div>
            </div>
            <script>
                function send() {
                    /*if (spleeshamount.value == '') {
                        alert("please enter guess number....");
                        return false;
                    }*/
                    var money = parseInt($("input[name='spleeshamount']:checked"). val());
                    var balance = <?php echo $this->session->userdata['balance']=='' ? 0 :$this->session->userdata['balance'];?>;
                    
                    var radios = document.getElementsByName('withbalance');
                    
                    
                    for (var i = 0, length = radios.length; i < length; i++) {
                        if (radios[i].checked) {
                            if (radios[i].value == 0) {
                                if(money/10 > balance) {
                                    alert("Unable to Place Bet, your balance is not enough.\n\nTry selecting PayPal.");
                                    return false
                                } else {
                                    frm_spleesh.submit();   
                                }
                            } else {
                                frm_spleesh.submit();
                            }
                            break;
                        }
                    }
                }
                
                /*spleeshamount.oninput =function() {
                    var betAmount = parseInt(spleeshamount.value);
                    var prevGuess = $(".prevguess").html();
                    
                    if (prevGuess.includes(betAmount)) {
                        alert("Please enter a number that has not been Previously Guessed.");
                        spleeshamount.value = "";
                        return false;
                    }
                    
                    if(betAmount ==0) {
                        alert('Please enter a number greater than 0.');
                        spleeshamount.value = "";
                        return false;
                    }
                    
                    if (betAmount > 9) {
                        alert('Please enter a number that is 9 or less.');
                        spleeshamount.value = "";
                        return false;
                    }
                }  */ 
            
            </script>
        </div>
        <?php
    } else if (isset($kind) && $kind == 0) {
        ?>
        <div class="col-md-10 col-sm-10">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-12">
                    <h3 class="red-title">Choose: Rock - Paper - Scissors</h3>
                    <div id="ajaxresponse"><font color="red"><?php echo isset($msg) ? $msg:'';?></font></div>
                    <br>
                    <form id="frm_admin_create" class="form" action="<?php echo base_url() ?>admin/joinGame" method="POST">

                        <div class="row clearfix">
                            <br>
                            <label>Payment Method</label><br>
                            <label class="radio-inline">
                                <input type="radio" checked name="withbalance" value="0" id="withbalance"  onchange="javascript:changePaymentMethod(0)"/>
                                Pay with Balance
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="withbalance" value="1" id="withpaypal" onchange="javascript:changePaymentMethod(1)" />
                                PayPal
                            </label>
                            <!--<label class="radio-inline">
                                <input type="radio" name="withbalance" value="2" id="withbalance" onchange="javascript:changePaymentMethod(2)" />
                                Stripe(Credite Card)
                            </label>
                            <br>
                            <div class="col-xs-12 col-md-12" id="stripe" style="display:none">
                                <br>
                                <div class="form-group" style="margin-bottom:0px">
                                    <label class="radio-inline">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Card-Number: 
                                    <input type="number" name="cardnumber" value="" id="cardnumber"  placeholder="enter your card number." />
                                    </label>
                                </div>
                                <div class="form-group" style="margin-bottom:0px">
                                    <label class="radio-inline">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Expiration : 
                                    <input type="number" name="expiremonth" value="" id="expiremonth" size="2" placeholder="MM" /> / 
                                    <input type="number" name="expireyear" value="" id="expireyear" size="4" placeholder="YYYY" />
                                    </label>
                                </div>
                                
                            </div>-->
                            <br>
                            <div class="cc-selector">                           <input id="rock" type="radio" checked="true"  name="card" value="0" />
                                <label class="drinkcard-cc rock" for="rock"></label>
                                <input id="paper" type="radio" name="card" value="1" />
                                <label class="drinkcard-cc paper"for="paper"></label>
                                <input id="scissors" type="radio" name="card" value="2" />
                                <label class="drinkcard-cc scissors"for="scissors"></label>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success btn-block" value="Submit"/><br>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } else if(isset($kind) && $kind == 2) {
        ?>
        <div class="col-md-10 col-sm-10">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-12">
                    <h3 class="red-title">Click START to begin BRAIN GAME: 60 secs</h3>
                    <div id="ajaxresponse"><font color="red"><?php echo isset($msg) ? $msg:'';?></font></div>
                    <br>
                    <form id="frm_admin_create" class="form" action="<?php echo base_url() ?>admin/joinBrainGame" method="POST">

                        <div class="row clearfix" style="margin: 0 20px;">
                            <div class="col-md-10 col-sm-10 joinBrainGame">
                            <br>
                            BET AMOUNT: <label style="font-size: 26px;margin-left:1em;">&nbsp;&pound;<?php echo $betAmount;?></label><br>
                            <br>
                            SCORE TO BEAT: <label style="color: #c73128cc;font-size: 26px; margin-left:1em;"><?php echo $score;?></label><br>
                            <br>
                            </div>
                            <div class="payment col-md-10 col-sm-10">
                            <label>Payment Method</label><br>
                            <label class="radio-inline">
                                <input type="radio" checked name="withbalance" value="0" id="withbalance"  onchange="javascript:changePaymentMethod(0)"/>
                                Pay with Balance
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="withbalance" value="1" id="withpaypal" onchange="javascript:changePaymentMethod(1)" />
                                PayPal
                            </label>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success btn-block" value="START"/><br>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } else {
    ?>
        <div class="col-md-10 col-sm-10">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-12">
                    <h3 class="red-title">Buy a Mystery Box?</h3>
                    <div id="ajaxresponse"><font color="red"><?php echo isset($msg) ? $msg:'';?></font></div>
                    <br>
                    <form id="frm_admin_create" name="frm_admin_create" class="form" action="<?php echo base_url() ?>admin/joinMysteryGame" method="POST">

                        <div class="row clearfix" style="margin: 0 20px;">
                            <div class="col-md-offset-1 col-md-10 col-sm-10">
                                <br>
                                <label style="font-size: 26px;margin-left:1em;">Prizes:</label><br>
                                
                                <table id="mysteryTable" style="overflow-x: scroll; width: 100%;">
                                    <tr>
                                        <?php
                                            $close_image_url = site_url("asset/images/cross-24-512.png");
                                            $prizes = explode(",", $prize);
                                            $array_prize_log = explode("," , $prize_log);
                                            $len = count($array_prize_log) - 1;
                                            asort($prizes);
                                            
                                            foreach($prizes as $val) {
                                                $img = "";
                                                $idx = 0;
                                                foreach($array_prize_log as $guess) {
                                                    if ($val == $guess ){
                                                        $img = "<img src='" . $close_image_url . "' style='width:25px; height: 25px; position: absolute;left: 50%; margin-left: -12px; top:50%; margin-top:-12px;'/>";
                                                        unset($array_prize_log[$idx]);
                                                        sort($array_prize_log);
                                                       
                                                        break;
                                                    }
                                                    $idx++;
                                                }
                                                
                                                echo '<td style="font-weight: 800; position:relative;">&pound;'.$val. $img . '</td>';
                                            }
                                        ?>
                                    </tr>
                                </table>
                                
                                <br>
                                <label style="font-size: 26px; margin-left:1em;">Select a Box</label><br>
                                <div class="col-md-12 col-sm-12">
                                    <?php
                                        $prizes = explode(",", $prize);
                                        $array_prize_log = explode("," , $prize_log);
                                        $len = count($array_prize_log) - 1;
                                        asort($prizes);
                                        $show_grey = 0;
                                        
                                        foreach($prizes as $val) {
                                            $img = "";
                                            $idx = 0;
                                            foreach($array_prize_log as $guess) {
                                                if ($val == $guess ){
                                                    $img = "<img src='" . $close_image_url . "' style='width:25px; height: 25px; position: absolute;left: 50%; margin-left: -12px; top:50%; margin-top:-12px;'/>";
                                                    unset($array_prize_log[$idx]);
                                                    sort($array_prize_log);
                                                    $show_grey = 1;
                                                    break;
                                                }
                                                $idx++;
                                            }
                                            
                                            if ($show_grey == 1) {
                                                echo '<div class="col-xs-2" style="text-align:center; padding-left: 10px;margin-bottom: 3px;">
                                                  <div class="price_div" style="border:thin dashed #ebddca">
                                                      <img src="/asset/images/boxgrey.png" style="width: 100%;">
                                                      <span class="add-betamount-box" style="position: absolute; z-index: 1; width: 212px; top: 58.5px; left: -13px; font-weight: bold; font-size: 16px; text-align: center;"></span>
                                                      <font color="green" size="1em">&pound;'.round($box_price,2).'</font></div></div>';
                                                $show_grey = 0;
                                            } else 
                                                 echo '<div class="col-xs-2" style="text-align:center; padding-left: 10px;margin-bottom: 3px;">
                                                  <div class="price_div" style="border:thin dashed #ebddca" onclick="javascript:selectID(this)">
                                                      <img src="/asset/images/box1@2x.png" style="width: 100%;">
                                                      <span class="add-betamount-box" style="position: absolute; z-index: 1; width: 212px; top: 58.5px; left: -13px; font-weight: bold; font-size: 16px; text-align: center;"></span>
                                                      <font color="green" size="1em">&pound;'.round($box_price,2).'</font></div></div>';
                                        }
                                    ?>
                                </div>
                                <br>
                                
                                <div class="payment col-md-12 col-sm-12"><br>
                                    <label style="font-size: 26px; margin-left:1em;">Payment Method</label><br>
                                    <label class="radio-inline">
                                        <input type="radio" checked name="withbalance" value="0" id="withbalance"  onchange="javascript:changePaymentMethod(0)"/>
                                        Pay with Balance
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="withbalance" value="1" id="withpaypal" onchange="javascript:changePaymentMethod(1)" />
                                        PayPal
                                    </label>
                                </div>
                                
                                <input type="button" class="btn btn-success btn-block" value="START" onclick="javascript:submitFrm();"/><br>
                            </div>
                            
                            
                            <script>
                                var clicked = 0;
                                function selectID(element) {
                                    $('div .price_div').each(function( index, element ) {
                                       element.style.border = "thin dashed #ebddca";
                                    });
                                    clicked = 1;
                                    element.style.border = "thin dashed red";
                                }
                                
                                function submitFrm() {
                                    if (clicked == 0) {
                                        alert('please select any box.');
                                        return false;
                                    }
                                    frm_admin_create.submit();
                                }
                            </script>
                        </div>
                        <br>
                        
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
    ?>


</div>


<style>

.genderblock span {
    display: inline-block;
    height: 30px;
    line-height: 30px;
    width: 100px;
}
.genderblock input {
    display: inline;
    margin: 0;
    width: 30px;
}
.genderblock span lable {
    position: absolute;
}
</style>
<script>

    $('input#withbalance').click(function() {
        $(this).closest('label').addClass('checked');
        $('input#withpaypal').closest('label').removeClass('checked');
    });

    $('input#withpaypal').click(function() {
        $(this).closest('label').addClass('checked');
        $('input#withbalance').closest('label').removeClass('checked');
    });

    $('input[name="withbalance"]:checked').closest('label').addClass("checked");
    $('input[name="spleeshamount"]:checked').closest('label').addClass("checked");
    
    $('input[name="spleeshamount"]').click(function() {
        $('input[name="spleeshamount"]').each(function() {
            $('input[name="spleeshamount"]').closest('label').removeClass('checked');
        });
        
        $(this).closest('label').addClass('checked');
    });
    
    function changePaymentMethod(val) {
        if (val ==2) {
            $("#stripe").show();
        } else {
            $("#stripe").hide();
        }
    }
        /*$(document).ready(function () {
            $('#frm_admin_create').submit(function (e) {
                e.preventDefault(); 

                var data =  $(this).serialize();               
                $.ajax({
                  url: '<?php echo base_url() ?>admin/joinGame',
                  type: 'post',
                  data: data
                }).done(function (html) {                  
                  alert(html);
                  window.location.href = "<?php echo base_url() ?>memberList";
                });
            });
        });*/
    </script>


    <?php
    $this->load->view('admin/footer');
    