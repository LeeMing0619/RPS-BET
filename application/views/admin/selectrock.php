<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55; padding-bottom: 60px;">
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
                <div class="col-md-12">
                    <h3 class="red-title">Choose: Rock - Paper - Scissors</h3>
                    <div id="ajaxresponse"></div>
                    <br>
                    <form id="frm_admin_create" class="form" action="" method="POST">
                        
                        <div class="row clearfix">

                            <div class="cc-selector">                           <input id="rock" type="radio" checked="true"  name="card" value="0" />
                                <label class="drinkcard-cc rock" for="rock"></label>
                                <input id="paper" type="radio" name="card" value="1" />
                                <label class="drinkcard-cc paper"for="paper"></label>
                                <input id="scissors" type="radio" name="card" value="2" />
                                <label class="drinkcard-cc scissors"for="scissors"></label>
                            </div>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success " value="Betting"/><br>
                    </form>
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

        $(document).ready(function () {
    //        call plan list method for populate table
    //        plan craete form submit code
            $('#frm_admin_create').submit(function (e) {
                e.preventDefault(); 

                var data =  $(this).serialize();               
                $.ajax({
                  url: '<?php echo base_url() ?>admin/confirmWin',
                  type: 'post',
                  data: data
                }).done(function (html) {                  
                  alert(html);
                  window.location.href = "<?php echo base_url() ?>memberList";
                });
            });
          });
    </script>


    <?php
    $this->load->view('admin/footer');
    