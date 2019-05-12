<?php $this->load->view('header') ?>
<div class="container" style="margin-top: 10%">
    <div class="row clear_fix">
        <div class="col-md-6 col-md-offset-3"  style="position: relative">
            <p class="alert alert-danger  login-form text-center" id="response"><b>This email address already registered.</b></p>
        </div>
    </div>
            <div class="row clear_fix">
                <div class="col-md-6 col-md-offset-3 login-form"  style="position: relative">
                    <style>
                        #response{display: none}
                    </style>
                    <div class="text-center p-y-xs">
                        <img class="logo" src="<?php echo base_url() ?>asset/images/logo.png" alt="RPS Bet Logo" style="height: 50px; width: auto;"/>
                    </div>
                    <form id="frm_signup" role="form" action="<?php echo base_url() ?>auth/signUp" method="POST">
                        <div class="form-group">
                          <label for="">Enter your name!</label>
                          <input type="text" id="useremail" class="form-control" name="username" id="username"  placeholder="User Name">
                          <label for="">Enter your email address!</label>
                          <input type="text" id="useremail" class="form-control" name="email"  placeholder="User Email">
                          <label for="">Enter your password!</label>
                          <input type="password" id="useremail" class="form-control" name="password"  placeholder="User Password">
                        </div>
                        <button class="btn btn-info btn-block">Sign Up</button>
                      </form>
                    <a href="<?php echo base_url()?>auth" class="btn btn-block">login</a>                    
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function (){
            $("#frm_signup").submit(function (e){
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var data = $(this).serialize();
                
                $.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                    console.log(data);
                   if(data =='false')
                    {
                        $("#username").focus();
                        $("#response").slideDown('fast');
                        $('#frm_signup')[0].reset();
                        setTimeout(function (){
                            $("#response").slideUp('fast');
                        },3000);
                    }
                    else if(data == 'true')
                    {
                        window.location.href='<?php echo base_url() ?>auth/';
                        throw new Error('go');
                    } 
                });
            });
        });
        </script>

<?php $this->load->view('footer');
