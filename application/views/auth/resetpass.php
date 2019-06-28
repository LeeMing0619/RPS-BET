<?php $this->load->view('header') ?>
<div class="container" style="margin-top: 10%">
    <div class="row clear_fix">
        <div class="col-md-6 col-md-offset-3"  style="position: relative">
            <p class="alert alert-danger  login-form text-center" id="response"><b>Your new password has been set.</b></p>
        </div>
    </div>
            <div class="row clear_fix">
                <div class="col-md-6 col-md-offset-3 login-form"  style="position: relative">
                    <style>
                        #response{display: none}
                    </style>
                    
                    <form id="frm_reset" role="form" action="<?php echo base_url() ?>auth/resetProcess" method="POST">
                        <div class="form-group">
                          <label for="">Please enter your Email Address:</label>
                          <label class="text-success"><b><?php echo $email?></b></label>
                          <hr/>
                          <label>Email ID</label>
                          <input type="email" id="email" class="form-control" name="email"  placeholder="Email Address">
                        </div>
                        <button class="btn btn-info btn-block">reset password</button>
                      </form>
                    <a href="<?php echo base_url()?>auth" style="background-color: #c83228 !important; color: #fff !important;" class="btn btn-block">login</a>                    
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function (){
            $("#frm_reset").submit(function (e){
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var data = $(this).serialize();
                
                $.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                    if(data=='okay') {
                        location.href = "<?php echo base_url() ?>auth";
                    } else {
                        $("#response").text(data);
                        $("#response").slideDown('fast');
                        $('#frm_reset')[0].reset();
                        setTimeout(function (){
                            $("#response").slideUp('fast');
                        },3000);
                    }
                    });
                     
                });
            });
        
        </script>

<?php $this->load->view('footer');
