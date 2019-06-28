<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 1px solid #D14B54; background: #f5f5f5f5; height: 100vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h1 class="text-center text-uppercase">All My Bets</h1>
            <hr/>
            <div class="row">
                <div class="col-xs-3"> <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
                        <li class="active od"><a href="#OD" data-toggle="tab">Open Rooms</a></li>
                        <li class="ed"><a href="#ED" data-toggle="tab">Wins History</a></li>
                        <li class="em"><a href="#EM" data-toggle="tab">Losses History</a></li>
                        <li class="di"><a href="#DI" data-toggle="tab">Draws History</a></li>
                    </ul>
                </div>
                <div class="col-xs-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="OD">
                            
                            <table class="table table-hover">
                                <thead><tr><th>Room ID</th><th>Bet / PR</th><th>Status</th><th>Action</th></tr></thead>
                                <tbody id="open_room"></tbody>
                                <tfoot></tfoot>
                            </table>
                            
                            <br><br>
                            <p class="text-center">
                                Keep a close eye on your open <i>Spleesh</i> games!
                            </p>
                            <p class="text-center">
                                <b>END anytime once your PR exceeds your<br>Bet Amount to make Profit.</b>
                            </p>
                            <p class="text-center">
                                Otherwise you'll make a loss<br>unless noone has bet yet in which case<br>your Bet Amount will be returned to your balance. Just like when you end an RPS game.*
                            </p>
                            <p class="text-center">
                                *Fees Apply where PayPal has been used.
                            </p>
                        </div>
                        <div class="tab-pane" id="ED">
                            
                            <table class="table table-hover">
                                <thead><tr><th>Room ID</th><th>Host</th><th>Opponent</th><th>Bet Amount</th><th>Note</th><th>Date Ended</th></tr></thead>
                                <tbody id="exp_res"></tbody>
                                <tfoot></tfoot>
                            </table>
                            
                        </div>
                        <div class="tab-pane" id="EM">
                            <table class="table table-hover">
                                <thead><tr><th>Room ID</th><th>Host</th><th>Opponent</th><th>Bet Amount</th><th>Note</th><th>Date Ended</th></tr></thead>
                                <tbody id="ins_res"></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                        
                        <div class="tab-pane" id="DI">
                            <table class="table table-hover">
                                <thead><tr><th>Room ID</th><th>Host</th><th>Opponent</th><th>Bet Amount</th><th>Note</th><th>Date Ended</th></tr></thead>
                                <tbody id="memexp_res"></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    var OD = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showOpenRooms'
        }).done(function (data){
            $("#open_room").html(data);
        });
    };
    //wins history
    var ED = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showWinsHistory'
        }).done(function (data){
            $("#exp_res").html(data);
        });
    };
    
    //loose history
    var EM = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showLooseHistory'
        }).done(function (data){
            $("#ins_res").html(data);
        });
    };
    
    //draws history
    var DI = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showDrawsHistory'
        }).done(function (data){
            $("#memexp_res").html(data);
        });
    };
    
    //cross wins
    function cross_win(obj, kind) {
        parentObj = obj.parent().parent();
        var amount = $(obj).parent().attr("class");
        var roomID = $(parentObj).attr("class");
        
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/deleteWinHistory?id='+roomID + '&amount=' + amount + '&kind=' + kind
        }).done(function (data){
            if(data !='') {
                $(".class_balance").html(data);
                $(parentObj).remove();
            } else 
                alert(/*'This room has already closed.'*/data);
                $(parentObj).remove();
        });    
    }
    
    /*//cross loose
    function cross_loose(obj) {
        parentObj = obj.parent().parent();
        var amount = $(obj).parent().attr("class");
        var roomID = $(parentObj).attr("class");
        
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/deleteWinHistory?id='+roomID + '&amount=' + amount
        }).done(function (data){
            if(data=='success')
                $(parentObj).remove();
            else 
                alert('Fatal Error.');
        });    
    }
    
    //cross draws
    function cross_draws(obj) {
        parentObj = obj.parent().parent();
        var amount = $(obj).parent().attr("class");
        var roomID = $(parentObj).attr("class");
        
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/deleteWinHistory?id='+roomID + '&amount=' + amount
        }).done(function (data){
            if(data=='success')
                $(parentObj).remove();
            else 
                alert('Fatal Error.');
        });    
    }*/
    
    $(document).ready(function (){
        OD();
        
        $(".od").on('click', function (){
           OD();
        });

        $(".ed").on('click', function (){
           ED();
        });
        
        $(".di").on('click', function (){
           DI();
        });
        
        $(".em").on('click', function (){
           EM();
        });
    });
</script>
<?php
$this->load->view('admin/footer');
