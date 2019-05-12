<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-2">
 <?php $this->load->view('admin/sidebar'); ?>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <h1 class="text-center text-uppercase">Welcome to rock-paper-scissors.</h1>
                    <div class="text-center" >
                    <img src="<?php echo base_url() ?>asset/images/gym.png" alt=""/>
                    </div>
                </div>
    
            </div>
        </div>
<script>
    console.log(window.login);
</script>

<?php $this->load->view('admin/footer'); 
