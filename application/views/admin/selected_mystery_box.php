<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55; height: 100vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-12">
                    <h3 class="red-title">Prize</h3>
                    <div id="ajaxresponse"><font color="red"><?php echo isset($msg) ? $msg:'';?></font></div>
                    <br>
                    
                    <div class="row clearfix" style="margin: 0 20px;">
                        <div class="col-md-offset-1 col-md-10 col-sm-10">
                            <br>
                           
                            <label style="font-size: 26px; margin-left:1em;">
                                <?php 
                                    if ($amount == 0)
                                        echo 'Sorry!! you’ve opened an empty box :(';
                                    else 
                                        echo 'Nice!! '.$amount.' has been added to your balance.';
                                ?>
                            </label><br>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-xs-4 price_div" style="text-align:center; margin-left: 10px;margin-bottom: 3px;" onclick="javascript:selectID(this)">
                                <img src="/asset/images/empty-open-box.png" style="width: 100%;">
                                <span class="add-betamount-box" style="position: absolute; z-index: 1; width: 212px; top: -25.5px; left: 80px; font-weight: bold; font-size: 16px; text-align: center;">
                                    <font color="green" style="font-size: 96px">&pound;<?php echo $amount?></font>
                                </span>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
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
                    <input type="button" class="btn btn-success btn-block" value="GO BACK TO MAIN GAMES PAGE" onclick="javascript:location.href = 'https://rpsbet.com/memberList'"/><br>
                </div>
            </div>
        </div>
    </div>
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
    