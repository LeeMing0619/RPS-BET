<?php $this->load->view('header') ?>
    <style>
        .drop { background-color: #fff; }
        
        .drop:after { border: dashed 0.3rem rgba(0, 0, 0, 0.0875); }
        
        .drop .drop-label { color: rgba(0, 0, 0, 0.0875); }
        
        .drop:hover:after { border-color: rgba(0, 0, 0, 0.125); }
        
        .drop:hover .drop-label { color: rgba(0, 0, 0, 0.125); }
        
        #image-preview, .image-preview { background-color: #000; }
        
        .drop {
          max-width: 150px;
          min-height: 100px;
          position: relative;
          overflow: hidden;
          cursor: pointer;
          margin-top: 30px;
          margin-bottom: 30px;
        }
        
        .drop:after {
          content: "";
          position: absolute;
          top: 0;
          right: 0;
          left: 0;
          bottom: 0;
        }
        
        .drop.file-focus { border: 0; }
        
        .drop:hover { cursor: pointer; }
        
        .drop .drop-label {
          font-size: 1.8rem;
          font-weight: 200;
          line-height: 2rem;
          width: 200px;
          text-align: center;
          position: absolute;
          top: 50%;
          margin-top: -1.5rem;
        }
        
        .drop input[type=file] {
          line-height: 100px;
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          height: 100px;
          width: 200px;
          opacity: 0;
          z-index: 10;
          cursor: pointer;
        }
        
        #image-preview, .image-preview {
          width: 200px;
          display: block;
          position: relative;
          z-index: 1;
        }
        
        #image-preview:empty, .image-preview:empty { display: none; }
        
        #image-preview img, .image-preview img {
          display: block;
          margin: 0 auto;
          width: 200px;
        }
        
        #image-preview:after, .image-preview:after {
          content: "";
          position: absolute;
          top: 0;
          bottom: 0;
          right: 0;
          left: 0;
          border: solid 0.1rem rgba(0, 0, 0, 0.08);  
        }
    </style>
    
<div class="container" style="margin-top: 10%">
    <div class="row clear_fix">
        <div class="col-md-5 col-md-offset-3"  style="position: relative">
            <p class="alert alert-danger  login-form text-center" id="response"></p>
        </div>
    </div>
            <div class="row clear_fix">
                <div class="col-md-5 col-md-offset-3 login-form"  style="position: relative">
                    <style>
                        #response{display: none}
                    </style>
                    <div class="text-center p-y-xs">
                        <img class="logo" src="<?php echo base_url() ?>asset/images/logo.png" alt="RPS Bet Logo" id="logo-img" style="height: 50px; width: auto;"/>
                    </div>
                    <form id="frm_signup" role="form" action="<?php echo base_url() ?>auth/signUp" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                          <div class="drop">
                            <div class="uploader">
                              <label class="drop-label">Drag and drop images here</label>
                              <input type="file" class="image-upload" id="photo" name="photo" accept="image/*">
                            </div>
                            <div id="image-preview"></div>
                          </div>
                          
                          <label for="">Enter a Username!</label>
                          <input type="text" class="form-control" name="username" id="username"  placeholder="Username">
                          <label for="">Enter your Email Address!</label>
                          <input type="email" id="useremail" class="form-control" name="useremail"  placeholder="Email Address">
                          <label for="">Enter your Password!</label>
                          <input type="password" id="password" class="form-control" name="password"  placeholder="Password">
                          
                          <label for="">Your Biography (less than 200 characters)</label>
                          <textarea class="form-control" rows="3" name="bio" id="bio" maxlength="200"></textarea>
                        </div>
                        <button class="btn btn-info btn-block">Sign Up</button>
                      </form>
                    <a style="background: snow !important;" href="<?php echo base_url()?>auth" class="btn btn-block">login</a>                    
                </div>
            </div>
        </div>
        <script src="<?php echo base_url() ?>asset/lib/js/jquery.imagereader-1.1.0.js"></script> 
        <script>
        $(document).ready(function (){
            $("#frm_signup").submit(function (e){
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                
                var useremail = $("#useremail").val();
                var username = $("#username").val();
                var userpass = $("#password").val();
                
                var photo = $("#photo").val();
                var bio = $("#bio").val();
                
                if (photo == '') {
                    alert("please select your avatar.");
                    return false;
                }
                if (bio == '') {
                    alert("Please enter your biography.");
                    return false;
                }
                
                if (useremail == '' || username == "" || userpass == '') {
                    alert("please enter all field.");
                    $("#username").focus();
                    return false;
                }
                $.ajax({
                   url:url,
                   type:method,
                   contentType: false,
                   processData: false,
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
                    } else {
                        $("#username").focus();
                        $("#response").html(data);
                        $("#response").slideDown('fast');
                        $('#frm_signup')[0].reset();
                        setTimeout(function (){
                            $("#response").slideUp('fast');
                        },3000);
                    }
                });
            });
            
            $('#photo').imageReader({
              renderType: 'canvas',
              onload: function(canvas) {
                var ctx = canvas.getContext('2d');
                ctx.fillStyle = "orange";
                ctx.font = "12px Verdana";
                ctx.fillText("Filename : "+ this.name, 10, 20, canvas.width - 10);
                $(canvas).css({
                  width: '100%',
                  height: '100px'
                });
              }
            });
        });
        </script>

<?php $this->load->view('footer');
