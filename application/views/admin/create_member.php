<?php $this->load->view('admin/header'); ?>
<!--<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
-->
<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55; height: 100vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-10">
                    <div class="thumbnail  familycol">
                        <form id="paymentFrm" action="<?php echo base_url()?>admin/memberCreate" method="post" class="form" enctype="multipart/form-data">   <legend>Create a New Game</legend>
                            <font color="red"><?php echo isset($msg) ? $msg:'';?></font>
                            
                            <label>Game Mode:</label>
                            <label class="radio-inline">
                                <input type="radio" checked name="gamemode" value="0" id="gamemode" onchange="javascript:changeGameMode(0)" />
                                Classic RPS
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gamemode" value="1" id="gamemode2" onchange="javascript:changeGameMode(1)" /><i>Spleesh!</i>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gamemode" value="2" id="gamemode3" onchange="javascript:changeGameMode(2)" />Brain Game
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gamemode" value="3" id="gamemode4" onchange="javascript:changeGameMode(3)" />Mystery Box
                            </label>
                            <hr>
                            <div class="row rpsbetamount">
                                <div class="col-xs-6 col-md-6">
                                    <label class="required">Bet Amount</label>
                                    <input type="text" name="betamount" id="betamount" value="" class="form-control input-sm bet-amount" placeholder="Bet Amount"  />
                                </div>
                            </div>
                            <div class="row spleeshbetamount" style="display:none">
                                <div class="col-xs-6 col-md-6">
                                    <label>Game Type:</label>
                                    <label class="radio-inline">
                                        <input type="radio" checked name="spleeshtype" value="0" id="spleeshtype1" onchange="javascript:changeSpleeshGameType(0)" /><i>£0.10 - £1</i>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="spleeshtype" value="1" id="spleeshtype2" onchange="javascript:changeSpleeshGameType(1)" /><i>£1 - £10</i>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="spleeshtype" value="2" id="spleeshtype3" onchange="javascript:changeSpleeshGameType(2)" /><i>£10 - £100</i>
                                    </label>
                                    <br>
                                    <hr>
                                </div>
                                <div class="col-xs-6 col-md-6">
                                    <label class="required">Your Number</label>
                                    <!--<input type="number" min="0" max="100" name="spleeshamount" id="spleeshamount" value="" class="form-control input-sm bet-amount"/>-->
                                    <div class="col-xs-6 col-md-6 spleeshNumber1">
                                        <label class="radio-inline">
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
                                    <div class="col-xs-6 col-md-6 spleeshNumber2" style="display:none;">
                                        <label class="radio-inline">
                                            <input type="radio" name="spleeshamount" value="1" id="spleeshamount11" /><i>£1.0</i>
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
                                    <div class="col-xs-6 col-md-6 spleeshNumber3" style="display:none;">
                                        <label class="radio-inline">
                                            <input type="radio" name="spleeshamount" value="10" id="spleeshamount21"/><i>£10</i>
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
                                </div>
                                <br>
                                <input type="hidden" readonly="true" name="spleeshpotential" id="spleeshpotential" value="&pound;0" class="form-control input-sm" placeholder=""  />
                            </div>
                            
                            <div class="row braingame" style="display:none">
                                <div class="col-xs-6 col-md-6">
                                    <label>Game Type:</label>
                                    <label class="radio-inline">
                                        <input type="radio" checked name="gametype" value="0" id="gametype1" onchange="javascript:changeGameType(0)" /><i>Maths</i>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gametype" value="1" id="gametype2" onchange="javascript:changeGameType(1)" /><i> Toki </i>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gametype" value="2" id="gametype3" onchange="javascript:changeGameType(2)" /><i>General Knowledge</i>
                                    </label>
                                    <br>
                                    This game mode tests your everyday knowledge.
                                    <hr>
                                </div>
                                <div class="col-xs-6 col-md-6 game_diff">
                                    <label>Difficulty(New!):</label>
                                    <label class="radio-inline">
                                        <input type="radio" checked name="gamediff" value="0" id="gamediff1" /><i>EASY</i>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gamediff" value="1" id="gamediff2" /><i>MEDIUM</i>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gamediff" value="2" id="gamediff3" /><i>HARD</i>
                                    </label>
                                    <hr>
                                </div>
                                <div class="col-xs-6 col-md-6">
                                    <label class="required">Bet Amount</label>
                                    <input type="text" name="betamount_braingame" id="betamount_braingame" value="" class="form-control input-sm bet-amount" placeholder="Bet Amount"  />
                                </div>
                                
                                <input type="hidden" readonly="true" name="potential_braingame" id="potential_braingame" value="" class="form-control input-sm" placeholder=""  />
                            </div>
                            
                            <div class="row mystery" style="display:none">
                                <div class="col-xs-9" style="border-right: solid 3px #ccc;">
                                    <div class="row" id="add_box_row">
                                    </div>
                                </div>
                                <div class="col-xs-3 empty_all_box">
                                    <div id="empty_all_box" title="Empty All Of the Box?" 
                                        style="width: 20px; height: 20px; cursor: pointer; background: #3ea0e5; float: left; margin-right: 5px;">
                                    </div>
                                    <span><b> EMPTY</b></span>
                                </div>

                                <div class="col-xs-6 col-md-6">
                                    <label class="required">Create a Box</label>
                                    <input type="text" name="addbox_amount" class="add_betamount" id="addbox_amount" value="0" placeholder="0"  />
                                    <button class="" style="border-radius: 0px;" type="button" onclick="javascript:addtobox();">
                                    ADD BOX</button>
                                    <input type="hidden" name="collect_number" id="collect_number" value="" />
                                    <label style="margin-left: 5px;">* Use 0 to add EMPTY boxes; EMPTY boxes increase profits but create lower ODDS when user buy boxes.</label>
                                    <br><hr>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <label class="">Game Cost(Total Bet Amount)</label>
                                    <input type="text" readonly="true" name="game_cost_mystery" id="game_cost_mystery" value="£0" class="form-control input-sm" placeholder=""  />
                                    The Amount you will pay to Start the Game.(Game Cost = Sum of all Mystery Boxes)
                                    <br><hr>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <label class="">Box Price</label>
                                    <input type="text" readonly="true" name="game_price_mystery" id="game_price_mystery" value="£0" class="form-control input-sm" placeholder=""  />
                                    This will be the fixed cost players will be changed to open one of your boxes.(Box Price = Average of boxes > &pound;0)
                                    <br>
                                </div>
                                <input type="hidden" readonly="true" name="potential_mystery" id="potential_mystery" value="£0" class="form-control input-sm" placeholder=""  />
                            </div>
                            
                            <hr>
                            <label>Payment Method:</label>
                            <label class="radio-inline">
                                <input type="radio" checked name="withbalance" value="0" id="withbalance" onchange="javascript:changePaymentMethod(0)" />
                                Pay using Balance
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="withbalance" value="1" id="withpaypal" onchange="javascript:changePaymentMethod(1)" />
                                PayPal
                            </label>
                            
                            <div class="pr-rpg">
                                <hr>
                                <label class="">Potential Return</label>
                                <input type="text" readonly="true" name="potential" id="potential" value="" class="form-control input-sm" placeholder=""  />
                                Your potential earnings are calculated by deducting fees from your Winnings total.
                            </div>
                                
                            <div class="pr" style="display:none;">
                                <hr>
                                <label class="">Your Potential Return</label>
                                <input type="text" readonly="true" name="your_potential" id="your_potential" value="" class="form-control input-sm" placeholder=""  />
                                Your potential earnings are calculated by deducting fees from your Winnings total.
                                
                                <hr>
                                <label class="">Public Potential Return</label>
                                <input type="text" readonly="true" name="public_potential" id="public_potential" value="" class="form-control input-sm" placeholder=""  />
                                Your potential earnings are calculated by deducting fees from your Winnings total.
                            </div>
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
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Expiration: 
                                    <input type="number" name="expiremonth" value="" id="expiremonth" size="2" placeholder="MM" /> / 
                                    <input type="number" name="expireyear" value="" id="expireyear" size="4" placeholder="YYYY" />
                                    </label>
                                </div>
                                
                            </div>-->
                            
                            <hr>
                            <label>Status:</label>
                            <label class="radio-inline">
                                <input type="radio" checked name="privated" value="0" id="public" onchange="javascript:changeShowPrivated(0)" />                        
                                Public
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="privated" value="1" id="private" onchange="javascript:changeShowPrivated(1)" />                        
                                Private
                            </label>
                            <label class="radio-inline password" style="display:none;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password: 
                                <input type="password" name="password" value="" id="password"  placeholder="enter password" />
                            </label>
                            <br>
                            By selecting 'Private', users will be required to enter a password to join your game.
                            <hr>
                            <div class="cc-selector rpsselector">
                                <label class="text-center">Select: Rock - Paper - Scissors!</label><br>                          
                                <input id="rock" type="radio" checked="true"  name="card" value="0" />
                                <label class="drinkcard-cc rock" for="rock"></label>
                                <input id="paper" type="radio" name="card" value="1" />
                                <label class="drinkcard-cc paper" for="paper"></label>
                                <input id="scissors" type="radio" name="card" value="2" />
                                <label class="drinkcard-cc scissors" for="scissors"></label>
                                <hr style="width: 100% !important;">
                            </div>
                            <div>
                            <div class="comment">
                                <label>Add Comment</label>
                                <textarea class="form-control input-sm" name="note" maxlength="40" rows="3" placeholder="Comment"></textarea> 
                                <button class="btn btn-lg btn-primary btn-block signup-btn" type="button" onclick="javascript:send();">
                                    Submit</button>
                            </div>
                            <div class="start_braingame" style="display:none">
                                <label>You will have 60 seconds to answer as many questions as correctly. You will only have 1 attempt.</label>
                                <button class="btn btn-lg btn-primary btn-block signup-btn" type="button" onclick="javascript:send();">
                                    Start</button>
                            </div>
                         </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

    var total_cost = 0;
    var real_box = 0;
    var pr_box = 0;
    var spleeshtype = 0
    
    $(document).ready(function (){
        $(".empty_all_box").on("click", function(){
            $("#add_box_row").html("");
            
            total_cost = 0;
            real_box = 0;
            pr_box = 0;
            $("#game_cost_mystery").val("£0");
            $("#game_price_mystery").val("£0");
            $("#potential_mystery").val("£0");
            $("#collect_number").val("");
        });
    });

    function addtobox(){
        var pound_sign = "£";
        var bet_amount = $(".add_betamount").val();

        var orange_box_url = "/asset/images/box1@2x.png";
        var blue_box_url = "/asset/images/box3@2x.png";
        var close_url = "/asset/images/close.png";

        var img_url = blue_box_url;
        if (bet_amount == "" || bet_amount == 0) {
            img_url = blue_box_url;
            bet_amount = 0;
        } else {
            img_url = orange_box_url;
            real_box++;
            if (pr_box < bet_amount)
                pr_box = bet_amount;
        }
        
        var num_txt = $("#collect_number").val();
        num_txt = num_txt + bet_amount + ",";
        $("#collect_number").val(num_txt);
        
        var add_box_row = $("#add_box_row");
        var col_div = $("<div>").addClass("col-xs-2")
                            .appendTo(add_box_row );
        var img = $("<img>").attr("src", img_url )
                            .css("width", "100%")
                            .appendTo(col_div );

        $(img).one("load", function() {
            var img_width = $(img).width();
            var img_height = $(img).height();

            var span = $("<span>")
                                .attr("class", "add-betamount-box")
                                .css("position", "absolute")
                                .css("z-index", 1)
                                .css("width", img_width + "px")
                                .css("top", img_height / 2 - 15 + "px")
                                .css("left", "10px")
                                .css("font-weight", "bold")
                                .css("font-size", "16px")
                                .css("text-align", "center")
                                .text(bet_amount == 0 ? "" : pound_sign + bet_amount )
                                .appendTo(col_div );
            var close_img = $("<img>").attr("src", close_url )
                                .css("position", "absolute")
                                .attr("title", "Delete Box?")
                                .attr("class", bet_amount)
                                .css("z-index", 1)
                                .css("right", "25px")
                                .css("top", "15px")
                                .css("width", "15px")
                                .css("height", "15px")
                                .css("cursor", "pointer")
                                .on("click", function(){
                                    $(this).parent().remove();
                                    var val = parseFloat($(this).attr("class"));
                                    if (val > 0) {
                                        total_cost = total_cost - val;
                                        real_box = real_box - 1;
                                        
                                        if (real_box == 0)
                                            box_price = 0;
                                        else
                                            box_price = total_cost/real_box;
                                            
                                        if (pr_box == val) {
                                            pr_box = 0;
                                            $("div>img").each(function( index, element ) {
                                               var value = parseFloat($(this).attr("class"));
                                               if (pr_box < value)
                                                pr_box = value;
                                            });
                                        }
                                        $("#game_cost_mystery").val("£"+total_cost);
                                        $("#game_price_mystery").val("£"+box_price);
                                        $("#potential_mystery").val("£"+pr_box);
                                    }
                                    
                                    $("#collect_number").val('');
                                    $("div>img").each(function( index, element ) {
                                        var value = parseFloat($(this).attr("class"));
                                        if (value == "" || !isNaN(value)) {
                                            var txt = $("#collect_number").val();
                                            txt = txt + value + ",";
                                            $("#collect_number").val(txt);
                                        }
                                    });
                                    
                                })
                                .appendTo(col_div );
                               
            $(".add_betamount").val("");
            total_cost = total_cost + parseFloat(bet_amount);
            box_price = 0;
            if (real_box == 0)
                box_price = 0;
            else
                box_price = total_cost/real_box;
            
            $("#game_cost_mystery").val("£"+total_cost);
            $("#game_price_mystery").val("£"+box_price);
            $("#potential_mystery").val("£"+pr_box);
        });
    }

    $('input#public').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#private').closest('label').removeClass('checked');
    });

    $('input#private').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#public').closest('label').removeClass('checked');
    });

    $('input[name="privated"]:checked').closest('label').addClass("checked");

    // RPS Game
    $('input#gamemode').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gamemode2').closest('label').removeClass('checked');
            $('input#gamemode3').closest('label').removeClass('checked');
            $('input#gamemode4').closest('label').removeClass('checked');
    });

    // Spleesh Game
    $('input#gamemode2').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gamemode').closest('label').removeClass('checked');
            $('input#gamemode3').closest('label').removeClass('checked');
            $('input#gamemode4').closest('label').removeClass('checked');
    });
    
    // Brain Game
    $('input#gamemode3').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gamemode').closest('label').removeClass('checked');
            $('input#gamemode2').closest('label').removeClass('checked');
            $('input#gamemode4').closest('label').removeClass('checked');
    });

    // Mystery Game
    $('input#gamemode4').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gamemode').closest('label').removeClass('checked');
            $('input#gamemode2').closest('label').removeClass('checked');
            $('input#gamemode3').closest('label').removeClass('checked');
    });
    
    //GameType in Brain Game
    $('input#gametype1').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gametype2').closest('label').removeClass('checked');
            $('input#gametype3').closest('label').removeClass('checked');
    });
    $('input#gametype2').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gametype1').closest('label').removeClass('checked');
            $('input#gametype3').closest('label').removeClass('checked');
    });
    $('input#gametype3').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gametype2').closest('label').removeClass('checked');
            $('input#gametype1').closest('label').removeClass('checked');
    });
    
    // Game Diff in Brain Game
    $('input#gamediff1').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gamediff2').closest('label').removeClass('checked');
            $('input#gamediff3').closest('label').removeClass('checked');
    });
    $('input#gamediff2').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gamediff1').closest('label').removeClass('checked');
            $('input#gamediff3').closest('label').removeClass('checked');
    });
    $('input#gamediff3').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#gamediff2').closest('label').removeClass('checked');
            $('input#gamediff1').closest('label').removeClass('checked');
    });
    
    // Game Type in Spleesh Game
    $('input#spleeshtype1').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#spleeshtype2').closest('label').removeClass('checked');
            $('input#spleeshtype3').closest('label').removeClass('checked');
    });
    $('input#spleeshtype2').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#spleeshtype1').closest('label').removeClass('checked');
            $('input#spleeshtype3').closest('label').removeClass('checked');
    });
    $('input#spleeshtype3').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#spleeshtype2').closest('label').removeClass('checked');
            $('input#spleeshtype1').closest('label').removeClass('checked');
    });
    
    $('input[name="spleeshamount"]').click(function() {
        $('input[name="spleeshamount"]').each(function() {
            $('input[name="spleeshamount"]').closest('label').removeClass('checked');
        });
        
        var payment = $('input[name="withbalance"]:checked').val();
        var money = $(this).val();
        
        $("#your_potential").val(getYourPr(1, money,payment));
        $("#public_potential").val(getPublicPr(1, money,payment));
        
        $(this).closest('label').addClass('checked');
    });
   
    $('input[name="gamemode"]:checked').closest('label').addClass("checked");
    $('input[name="gametype"]:checked').closest('label').addClass("checked");
    $('input[name="gamediff"]:checked').closest('label').addClass("checked");
    $('input[name="spleeshtype"]:checked').closest('label').addClass("checked");
    $('input[name="spleeshamount"]:checked').closest('label').addClass("checked");
    
    function changeSpleeshGameType(val) {
          if(val == 0) {
              $("#spleeshTable1").show();
              $("#spleeshTable2").hide();
              $("#spleeshTable3").hide();
             
              $(".spleeshNumber1").show();
              $(".spleeshNumber2").hide();
              $(".spleeshNumber3").hide();
              
              $('input[name="spleeshamount"]').each(function() {
                $('input[name="spleeshamount"]').closest('label').removeClass('checked');
              });
              
              $('#spleeshamount1').closest('label').addClass('checked');
              $('#spleeshamount1').prop('checked', true);
              spleeshtype = 0;
              
              var payment = $('input[name="withbalance"]:checked').val();
              var money = $('input[name="spleeshamount"]:checked').val();
            
              $("#your_potential").val(getYourPr(1, money,payment));
              $("#public_potential").val(getPublicPr(1, money,payment));
          } else if (val == 1) {
              $("#spleeshTable2").show();
              $("#spleeshTable1").hide();
              $("#spleeshTable3").hide();
              
              $(".spleeshNumber2").show();
              $(".spleeshNumber1").hide();
              $(".spleeshNumber3").hide();
              
              $('input[name="spleeshamount"]').each(function() {
                $('input[name="spleeshamount"]').closest('label').removeClass('checked');
              });
              
              $('#spleeshamount11').closest('label').addClass('checked');
              $('#spleeshamount11').prop('checked', true);
              spleeshtype = 1;
              
              var payment = $('input[name="withbalance"]:checked').val();
              var money = $('input[name="spleeshamount"]:checked').val();
            
              $("#your_potential").val(getYourPr(1, money,payment));
              $("#public_potential").val(getPublicPr(1, money,payment));
          } else {
              $("#spleeshTable3").show();
              $("#spleeshTable2").hide();
              $("#spleeshTable1").hide();
              
              $(".spleeshNumber3").show();
              $(".spleeshNumber2").hide();
              $(".spleeshNumber1").hide();
              
              $('input[name="spleeshamount"]').each(function() {
                $('input[name="spleeshamount"]').closest('label').removeClass('checked');
              });
              
              $('#spleeshamount21').closest('label').addClass('checked');
              $('#spleeshamount21').prop('checked', true);
              spleeshtype = 2;
              
              var payment = $('input[name="withbalance"]:checked').val();
              var money = $('input[name="spleeshamount"]:checked').val();
            
              $("#your_potential").val(getYourPr(1, money,payment));
              $("#public_potential").val(getPublicPr(1, money,payment));
          }
    }
    
    //select game mode 0: RPS 1:Spleesh 2: Brain game
    function changeGameMode(val) {
        if (val == 0) {
            $(".rpsbetamount").show();
            $(".pr-rpg").show();
            $(".pr").hide();
            $(".spleeshbetamount").hide();
            $(".start_braingame").hide();
            $(".braingame").hide();
            $(".rpsselector").show();
            $(".comment").show();
            $(".mystery").hide();
            
            $("#your_potential").val("");
            $("#public_potential").val("");
        } else if (val == 1) {
            $(".spleeshbetamount").show();
            $(".pr").show();
            $(".pr-rpg").hide();
            $(".start_braingame").hide();
            $(".rpsbetamount").hide();
            $(".rpsselector").hide();
            $(".braingame").hide();
            $(".comment").show();
            $(".mystery").hide();
            
            var money = $('input[name="spleeshamount"]:checked').val();
            var pay = $('input[name="withbalance"]:checked').val();
                        
            $("#your_potential").val(getYourPr(1, money,pay));
            $("#public_potential").val(getPublicPr(1, money,pay));
        } else if (val == 2) {
            $(".braingame").show();
            $(".pr").show();
            $(".pr-rpg").hide();
            $(".spleeshbetamount").hide();
            $(".rpsbetamount").hide();
            $(".rpsselector").hide();
            $(".start_braingame").show();
            $(".comment").hide();
            $(".mystery").hide();
            
            var pay = $('input[name="withbalance"]:checked').val();
            var money = $('#betamount_braingame').val();
            if (money == ''){
                $("#your_potential").val('');
                $("#public_potential").val('');
            } else {
                $("#your_potential").val(getYourPr(2, money,pay));
                $("#public_potential").val(getPublicPr(2, money,pay));   
            }
        } else {
            $(".mystery").show();
            $(".pr").hide();
            $(".pr-rpg").hide();
            $(".braingame").hide();
            $(".spleeshbetamount").hide();
            $(".rpsbetamount").hide();
            $(".rpsselector").hide();
            $(".start_braingame").hide();
            $(".comment").show();
            
            $("#your_potential").val("");
            $("#public_potential").val("");
        }
    }
    
    function changeShowPrivated(val) {
        if (val == 0) 
            $(".password").hide();
        else
            $(".password").show();
    }
    
    $('input#withbalance').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#withpaypal').closest('label').removeClass('checked');
    });

    $('input#withpaypal').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#withbalance').closest('label').removeClass('checked');
    });
    
    $('input[name="withbalance"]:checked').closest('label').addClass("checked");
    
    function send() {
        var money = parseFloat(betamount.value);
        var balance = <?php echo $this->session->userdata['balance']=='' ? 0 :$this->session->userdata['balance'];?>;
        
        var radios = document.getElementsByName('withbalance');
        
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                if (radios[i].value == 0) {
                    if(money > balance) {
                        alert("Unable to Place Bet, your balance is not enough.\n\nTry selecting PayPal.");
                        return false;
                    } else {
                        paymentFrm.submit();   
                    }
                } else {
                    paymentFrm.submit();
                }
                break;
            }
        }
    }

    function changePaymentMethod(val) {
        var radios = document.getElementsByName('gamemode');
        
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) { //RPS
                if (radios[i].value == 0) {
                    if (val ==2) {
                        var money = parseFloat(betamount.value);
                        fee = 2 * (money-(money*0.014 + 0.2));
                        result = fee - fee * 0.04;
                        
                        potential.value = "£" + Math.round(result*100)/100;
                        $("#stripe").show();
                    } else if (val == 1){
                        var money = parseFloat(betamount.value);
                        fee = (money - (money*0.05 + 0.05));
                    
                        ppPotential  = 2 * fee * 0.95;
                        result = (money + (money-(money*0.05+0.05))) * 0.95;
                        
                        potential.value = "£" + ppPotential + " ~ £" + result;
                        $("#stripe").hide();
                    } else {
                        var money = parseFloat(betamount.value);
                        result_low = (money + (money-(money*0.05+0.05))) * 0.95;
                        result_high = money* 2 * 0.95;
                        potential.value = "£" + result_low + " ~ £" + result_high;
                        $("#stripe").hide();
                    }
                } else if (radios[i].value==1) {  //SPLEESH
                    if (val ==2) {
                        var money = $('input[name="spleeshamount"]:checked').val();
                        fee = 2 * (money-(money*0.014 + 0.2));
                        result = fee - fee * 0.04;
                        
                        spleeshpotential.value = "£0";// + Math.round(result*100)/100;
                        $("#stripe").show();
                    } else if (val == 1){
                        var money = $('input[name="spleeshamount"]:checked').val();
                       
                        $("#your_potential").val(getYourPr(1, money,1));
                        $("#public_potential").val(getPublicPr(1, money,1));
                        
                        spleeshpotential.value = "£0";// + Math.round(result1*1000000)/1000000 + " - " + "£" + Math.round(result*1000000)/1000000;
                        $("#stripe").hide();
                    } else {
                        var money = $('input[name="spleeshamount"]:checked').val();
                        
                        $("#your_potential").val(getYourPr(1, money,0));
                        $("#public_potential").val(getPublicPr(1, money,0));
                        
                        spleeshpotential.value = "£0";// + result;
                        $("#stripe").hide();
                    }
                } else { // Brain Game
                    var money = parseInt(betamount_braingame.value);
                    result = money;
                    potential_braingame.value = "£" + result;
                    alert(money);
                    if (val == 0) {
                        $("#your_potential").val(getYourPr(2, money,0));
                        $("#public_potential").val(getPublicPr(2, money,0));
                    } else {
                        $("#your_potential").val(getYourPr(2, money,1));
                        $("#public_potential").val(getPublicPr(2, money,1));
                    }
                    
                    $("#stripe").hide();
                }
                break;
            }
        }
        
        
        
    }
    
    function changeGameType(val) {
        if(val == 1) 
            $('.game_diff').hide();
        else
            $('.game_diff').show();
    }

    betamount.oninput = function () {
        var money = parseFloat(betamount.value);
        var radios = document.getElementsByName('withbalance');
        
        if(money ==0) {
            alert('Please enter a number greater than 0.');
            betamount.value = "";
            return false;
        }
        // if money isn't number.
        if(isNaN(money))
        {
            alert('Please enter a numeric Bet Amount.');
            betamount.value = '';
            return false;
        }
        
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                if (radios[i].value == 0) {
                    result_low = (money + (money-(money*0.05+0.05))) * 0.95;
                    result_high = money* 2 * 0.95;
                    potential.value = "£" + result_low + " ~ £" + result_high;
                    $("#stripe").hide();
                } else if (radios[i].value==1) {
                    fee = (money - (money*0.05 + 0.05));
                    
                    ppPotential  = 2 * fee * 0.95;
                    result = (money + (money-(money*0.05+0.05))) * 0.95;
                    
                    potential.value = "£" + ppPotential + " ~ £" + result;
                    $("#stripe").hide();
                } else {
                    fee = 2*(money-(money*0.014 + 0.2));
                    result = fee - fee * 0.04;
                    potential.value = "£" + Math.round(result*100)/100;
                    $("#stripe").show();
                }
                break;
            }
        }
        
    }
    
    /* spleeshamount.oninput =function() {
        spleeshamount.value = spleeshamount.value.replace(/[^0-9]/g,'');
        var betAmount = parseInt(spleeshamount.value);
        var radios = document.getElementsByName('withbalance');
        
        if(betAmount ==0) {
            alert('Please enter a number greater than 0.');
            spleeshamount.value = "";
            return false;
        }
        
        if (spleeshtype == 0) {
            if (betAmount > 0.9) {
                alert('Please enter a number that is 0.9 or less.');
                spleeshamount.value = "";
                return false;
            }    
        }
        
        
        
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                if (radios[i].value == 0) {
                    result = betAmount * 2;
                    spleeshpotential.value = "£0";// + result;
                    $("#stripe").hide();
                } else if (radios[i].value==1) {
                    fee = (betAmount - (betAmount*0.034 + 0.2));
                    
                    ppPotential  = 2 * fee;
                    result = (betAmount + fee) - ((betAmount + fee) * 0.018);
                    result1 = ppPotential * 0.982;
                    spleeshpotential.value = "£0";// + Math.round(result1*1000000)/1000000 + " - " + "£" + Math.round(result*1000000)/1000000;
                    $("#stripe").hide();
                } else {
                    fee = 2*(betAmount-(betAmount*0.014 + 0.2));
                    result = fee - fee * 0.04;
                    spleeshpotential.value = "£0";// + Math.round(result*100)/100;
                    $("#stripe").show();
                }
                break;
            }
        }
    }*/
    
    betamount_braingame.oninput = function() {
        var money = parseFloat(betamount_braingame.value);
        var radios = document.getElementsByName('withbalance');
        
        if(money ==0) {
            alert('Please enter a number greater than 0.');
            betamount_braingame.value = "";
            return false;
        }
        // if money isn't number.
        if(isNaN(money))
        {
            alert('Please enter a numeric Bet Amount.');
            betamount_braingame.value = '';
            return false;
        }
        
        result = money;
        potential_braingame.value = "£" + result;
        
        var pay = $('input[name="withbalance"]:checked').val();
                    
        $("#your_potential").val(getYourPr(2, money,pay));
        $("#public_potential").val(getPublicPr(2, money,pay));
        
        $("#stripe").hide();
        /*for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                if (radios[i].value == 0) {
                    result = money * 2;
                    potential_braingame.value = "£" + result;
                    $("#stripe").hide();
                } else if (radios[i].value==1) {
                    fee = (money - (money*0.034 + 0.2));
                    
                    ppPotential  = 2 * fee;
                    result = (money + fee) - ((money + fee) * 0.018);
                    result1 = ppPotential * 0.982;
                    potential_braingame.value = "£" + Math.round(result1*1000000)/1000000 + " - " + "£" + Math.round(result*1000000)/1000000;
                    $("#stripe").hide();
                } else {
                    fee = 2*(money-(money*0.014 + 0.2));
                    result = fee - fee * 0.04;
                    potential_braingame.value = "£" + Math.round(result*100)/100;
                    $("#stripe").show();
                }
                break;
            }
        }*/
    }
    
    addbox_amount.oninput = function() {
        var val = addbox_amount.value;
        if (val < 0) {
            alert("please enter a number greater than 0.");
            addbox_amount.value = '';
            return false;
        } else if (isNaN(val)) {
            alert("please enter a number.");
            addbox_amount.value = '';
            return false;
        }
    }
    
    function getYourPr(mode, amount, payment) {
        var lowNum = 0;
        var higherNum = 0;
        amount = parseFloat(amount);
        
        if(mode==1) {
            if (payment == 0) {
                if(amount <= 1)
                {
                    for(i=0.1; i<=1; i+=0.1) 
                    {
                        higherNum = higherNum + i;
                        
                        if (i == amount)
                            continue;
                        else {
                           lowNum = lowNum + (i - (i*0.05 + 0.05));
                        }
                    }
                }
                else if (amount >1 && amount <=10) 
                {
                    for(i=1; i<=10; i++) 
                    {
                        higherNum = higherNum + i;
                        
                        if (i == amount)
                            continue;
                        else{
                           lowNum = lowNum + (i - (i*0.05 + 0.05));
                        }
                    }
                } else {
                    for(i=10; i<=100; i+=10) 
                    {
                        higherNum = higherNum + i;
                        
                        if (i == amount)
                            continue;
                        else{
                           lowNum = lowNum + (i - (i*0.05 + 0.05));
                        }
                    }
                }
                lowNum = (amount + lowNum* 0.92);
                higherNum = higherNum * 0.92;
                return "£"+lowNum+" ~ £" + higherNum;
            } else {
                if(amount <= 1)
                {
                    for(i=0.1; i<=1; i+=0.1) 
                    {
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                        if (i == amount)
                            continue;
                        else 
                            higherNum = higherNum + i;
                    }
                }
                else if (amount >1 && amount <=10) 
                {
                    for(i=1; i<=10; i++) 
                    {
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                        if (i == amount)
                            continue;
                        else 
                            higherNum = higherNum + i;
                    }
                } else {
                    for(i=10; i<=100; i+=10) 
                    {
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                        if (i == amount)
                            continue;
                        else 
                            higherNum = higherNum + i;
                    }
                }
                lowNum = lowNum * 0.92;
                higherNum = (amount-(amount*0.05 +0.05)+higherNum)*0.92;
                return "£"+lowNum+" ~ £" + higherNum;
            }
        } else if (mode==2) {
            return "∞";
        } else if (mode == 3) {
            
        }
    }
    
    function getPublicPr(mode, amount, payment) {
        var lowNum = 0;
        var higherNum = 0;
        amount = parseFloat(amount);
        if(mode==1) {
            if (payment == 0) {
                if(amount <= 1)
                {
                    for(i=0.1; i<=1; i+=0.1) 
                    {
                        higherNum = higherNum + i;
                        
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                    }
                }
                else if (amount >1 && amount <=10) 
                {
                    for(i=1; i<=10; i++) 
                    {
                        higherNum = higherNum + i;
                        
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                    }
                } else {
                    for(i=10; i<=100; i+=10) 
                    {
                        higherNum = higherNum + i;
                        
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                    }
                }
                lowNum = (amount + lowNum) * 0.92;
                higherNum = (amount+higherNum) * 0.92;
                return "£"+lowNum+" ~ £" + higherNum;
            } else {
                if(amount <= 1)
                {
                    for(i=0.1; i<=1; i+=0.1) 
                    {
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                        
                        higherNum = higherNum + i;
                    }
                }
                else if (amount >1 && amount <=10) 
                {
                    for(i=1; i<=10; i++) 
                    {
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                        higherNum = higherNum + i;
                    }
                } else {
                    for(i=10; i<=100; i+=10) 
                    {
                        lowNum = lowNum + (i - (i*0.05 + 0.05));
                        higherNum = higherNum + i;
                    }
                }
                lowNum = ((amount-(amount*0.05+0.05)) + lowNum) * 0.92;
                higherNum = ((amount-(amount*0.05+0.05)) +higherNum) * 0.92;
                return "£"+lowNum+" ~ £" + higherNum;
            }
        } else if (mode==2) {
            if (payment == 0) {
                lowNum = (amount+(amount-(amount*0.05+0.05)))*0.92;
                higherNum = amount*2*0.92;
            } else {
                lowNum = (amount-(amount*0.05+0.05)) * 2 * 0.92;
                higherNum = (amount+(amount-(amount*0.05+0.05)))*0.92;
            }
            return "£"+lowNum+" ~ £" + higherNum;
        } else if (mode == 3) {
            
        }
    }
</script>
<?php
$this->load->view('admin/footer');
