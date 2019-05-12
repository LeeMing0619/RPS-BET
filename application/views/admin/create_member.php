<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55; padding-bottom: 90px;">
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-10">
                    <div class="thumbnail  familycol">
                        <form action="<?php echo base_url()?>admin/memberCreate" method="post" class="form">   <legend>Create a New Game</legend>
                            <div class="row">
                                <div class="col-xs-6 col-md-6">
                                    <label class="required">Bet Amount</label>
                                    <input type="text" name="betamount" id="betamount" value="" class="form-control input-sm" placeholder="Bet Amount"  />
                                </div>
                                
                                <div class="col-xs-12 col-md-12">
                                    <label class="">Potential Return</label>
                                    <input type="text" readonly="true" name="potential" id="potential" value="" class="form-control input-sm" placeholder=""  />
                                    Your potential earnings are calculated by deducting fees from your Winnings total.
                                </div>
                            </div>
                            <br>
                            <label>Status</label><br>
                            <label class="radio-inline">
                                <input type="radio" checked name="privated" value="0" id="public" onchange="javascript:changeShow(0)" />                        
                                Public
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="privated" value="1" id="private" onchange="javascript:changeShow(1)" />                        
                                Private
                            </label>
                            <label class="radio-inline password" style="display:none;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password: 
                                <input type="password" name="password" value="" id="password"  placeholder="enter password" />
                            </label>
                            <br>
                            By selecting 'Private', users will be required to enter a password to join your game.
                            <br>
                            <br>

                            <div class="cc-selector">                            
                                <input id="rock" type="radio" checked="true"  name="card" value="0" />
                                <label class="drinkcard-cc rock" for="rock"></label>
                                <input id="paper" type="radio" name="card" value="1" />
                                <label class="drinkcard-cc paper" for="paper"></label>
                                <input id="scissors" type="radio" name="card" value="2" />
                                <label class="drinkcard-cc scissors" for="scissors"></label>
                            </div>

                            <label>Add Comment</label>
                            <textarea class="form-control input-sm" name="note" rows="3" placeholder="Comment"></textarea>
                                                    
                            <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit">
                                Submit</button>
                         </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    $('input#public').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#private').closest('label').removeClass('checked');
    });

    $('input#private').click(function() {
            $(this).closest('label').addClass('checked');
            $('input#public').closest('label').removeClass('checked');
    });

    $('input[name="privated"]:checked').closest('label').addClass("checked");

    function changeShow(val) {
        if (val == 0) 
            $(".password").hide();
        else
            $(".password").show();
    }

    $(document).ready(function (){
        
    });

    betamount.oninput = function () {
        var money = betamount.value;
        if(isNaN(money))
        {
            alert('Please enter a numeric bet amount.');
            betamount.value = '';
            return false;
        }
        var result = 0;
        result = (money * 2) - money * 0.05;
        potential.value = "£" + result;
    }
</script>
<?php
$this->load->view('admin/footer');
