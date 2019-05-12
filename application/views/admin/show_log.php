<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 1px solid #D14B54; background: #f5f5f5f5">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h1 class="text-center text-uppercase">Bet Log history</h1>
            <hr/>
            <div class="row">
                <div class="col-xs-3"> <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
                        <li class="active ed"><a href="#ED" data-toggle="tab">Wins History</a></li>
                        <li class="di"><a href="#DI" data-toggle="tab">Loose History</a></li>
                        <li class="em"><a href="#EM" data-toggle="tab">Draws History</a></li>
                    </ul>
                </div>
                <div class="col-xs-9">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="ED">
                            
                            <table class="table table-hover">
                                <thead><tr><th>Room ID</th><th>Bet Amount</th><th>Status</th></tr></thead>
                                <tbody id="exp_res"></tbody>
                                <tfoot></tfoot>
                            </table>
                            
                        </div>
                        <div class="tab-pane" id="DI">
                            <table class="table table-hover">
                                <thead><tr><th>Room ID</th><th>Bet Amount</th><th>Status</th></tr></thead>
                                <tbody id="ins_res"></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                        
                        <div class="tab-pane" id="EM">
                            <table class="table table-hover">
                                <thead><tr><th>Room ID</th><th>Bet Amount</th><th>Status</th></tr></thead>
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
    //wins history
    var ED = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showWinsHistory'
        }).done(function (data){
            $("#exp_res").html(data);
        });
    };
    
    var EM = function (){
    
    $.ajax({
        type:'GET',
        url:'<?php echo base_url()?>admin/showLooseHistory'
    }).done(function (data){
        $("#memexp_res").html(data);
    });
        
    };
    
    var DI = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showDrawsHistory'
        }).done(function (data){
            $("#ins_res").html(data);
        });
    };
    
    
    
    $(document).ready(function (){
        ED();
        
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
