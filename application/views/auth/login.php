<?php $this->load->view('header') ?>
<div class="container" style="margin-top: 10%">
    <div class="row clear_fix">
        <div class="col-md-4 col-md-offset-4"style="position: relative">
            <p class="alert alert-danger text-center  login-form" id="response"><b>INVALID USER NAME OR PASSWORD</b></p>
        </div>
    </div>
    <br>
    
            <div class="row clear_fix">
                <div class="col-md-4 col-md-offset-4 login-form"  style="position: relative">
                    <style>
                        #response{display: none}
                    </style>
                    <div class="text-center p-y-xs">
                        <img class="logo" id="logo-img" src="<?php echo base_url() ?>asset/images/logo.png" alt="RPS Bet Logo" style="height: 50px; width: auto;"/>
                    </div>
                    <form id="frm_login" role="form" action="<?php echo base_url() ?>auth/login" method="POST">
                        <div class="form-group">
                          <label for="">Username</label>
                          <input type="text" class="form-control" name="username" id="username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" placeholder="Username">
                        </div>
                        <div class="form-group">
                          <label for="">Password</label>
                          <input type="password" class="form-control" name="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" placeholder="Password" <?php if(isset($_COOKIE["member_login"])) { ?> checked
                <?php } ?>>
                        </div>
                        <input type="submit" class="btn btn-info btn-block" value="Login">
                      
                    <a href="<?php echo base_url()?>signUp" class="btn btn-block" id="signup">Sign Up</a> 
                    <div class="keep">
                        <h4>Stay Logged In</h4>
                        <input type="checkbox" name="keep" id="keep"/><label class="keep" for="keep"></label>
                        <a href="<?php echo base_url()?>resetPassword" class="" id="resetpwd">Forgot your Password?</a>
                    </div>
                    </form>
                </div>
                
            </div>
        </div>

<div class="container-fluid navbar-fixed-bottom text-center text-info" style="color: #fff;">Copyright © 2019 RPS Bet, rpsbet.com&nbsp;&nbsp;<a style="font-size: 12px; color: #fff;" href="https://rpsbet.com/privacy_policy/">Privacy</a> | <a style="font-size: 12px; color: #fff;" href="https://rpsbet.com/terms_conditions/">Terms</a></div>
        <script>
        $(document).ready(function (){
            document.cookie = "login = false";
            $("#frm_login").submit(function (e){
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var data = $(this).serialize();
                $.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
                   if(data =='false')
                    {
                        $("#username").focus();
                        $("#response").slideDown('fast');
                        $('#frm_login')[0].reset();
                        setTimeout(function (){
                            $("#response").slideUp('fast');
                        },3000);
                    }
                    else if(data =='true')
                    {
                    document.cookie = "login = true";
                    window.location.href='<?php echo base_url() ?>topList/';
                    throw new Error('go');
                    } 
                });
            });
        });
        </script>

<?php $this->load->view('footer');
