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
                    <h3 class="black-title">YOU HAVE 60 SECONDS TO GUESS AS MANY QUESTIONS CORRECTLY</h3>
                    <hr style="border-color: #c73128;">
                    <div id="ajaxresponse"><font color="red"><?php echo isset($msg) ? $msg:'';?></font></div>
                    <br>
                    
                    <div class="col-md-8 clearfix" style="position: relative;margin: auto; left:0; right:0;">
                    <br>
                    <label>Timer:</label><br>
                    
                    <font class="countdown" id="countdown" color="red" size="36px">59</font><span style="text-align: center; display: block;">seconds left</span>
                    <label style="float:right;">
                        <div class"pull-right" style="float:left;">
                            <font color="red">Score:</font>
                            <font id="score" class="score" color="#32CD32">0</font>
                        </div>
                    </label>
                    <br><br>
                    <div style="position: relative; margin-top:0px;text-align:center;">
                        <p class="question" style="font-weight: bolder;"><?php echo $questions;?></p>
                    </div>
                    <div class="answer_div">
                    <?php
                        $i = 0;
                        shuffle($answers);
                        foreach($answers as $answer) {
                            $i++;
                            ?>
                            <div class="col-md-8 clearfix" style="position: relative;">
                                    <div class="clearfix"></div>
                                    <label class="radio-inline checked" style="display: block; position:relative; margin: 5px 0 !important;">
                                        
                                        <input type="radio" name="withbalance" value="<?php echo $answer->id; ?>" id="withbalance" onclick="javascript:answer(<?php echo $q_id;?>, <?php echo $answer->id; ?>)" />
                                        <p style="text-align:center; font-size: 40px; margin-bottom: 0;"><?php echo $answer->answer; ?></p>
                                    </label>
                            </div>
                            <?php
                        }
                    ?>
                    </div>
                </div>
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
.genderblock span label {
    position: relative;
}
</style>
<script>
    var total_score = 0;
    function answer(qui_id, an_id) {
        var data =  {q_id: qui_id, an_id: an_id};

        $.ajax({
          url: '<?php echo base_url() ?>admin/getJoinBrainGame',
          type: 'post',
          data: data,
        }).done(function (data) {
            var data = JSON.parse(data);
            if (data.correct != 0) {
                var score = $("#score").html();
                score = parseInt(score) + 1;
                total_score = total_score + 1;
                $("#score").html(score);
            } else if (data.correct == 0) {
                var score = $("#score").html();
                score = parseInt(score) - 1;
                total_score = total_score - 1;
                $("#score").html(score);
            }
            
            $(".question").html(data.questions);
            
            $(".answers_div").remove();
            
            var answers_array = data.answers;
            shuffle(answers_array);
            
            var idx = 0;
            var innerHTM = '';
            answers_array.forEach(function(element) {
                idx = idx + 1;
                
                var m_top = idx*60;
                var html= "<div class='col-md-8 clearfix answers_div' style='position:relative; margin: 10px 0 !important;";
                  //  html+= m_top;
                    html+= "px;'><div class='clearfix'></div><label class='radio-inline checked' style='display: block; position:relative; margin: 5px 0 !important;'>"
                    html+= "<input type='radio' name='withbalance' value='";
                    html+= element.id;
                    html+= "' id='withbalance' onclick='javascript:answer(";
                    html+= data.q_id + ', ' + element.id;
                    html+= ")'/><p style='text-align:center;font-size:40px; margin-bottom: 0;'>";
                    html+= element.answer;
                    html+= "</p></label></div>";
                innerHTM +=html;
            });
            
            $(".answer_div").html(innerHTM);
        });
    }
    
    var timeleft = 59;
    var downloadTimer = setInterval(function(){
        document.getElementById("countdown").innerHTML = timeleft;
        timeleft -= 1;
        
        if(timeleft <= 0){
            clearInterval(downloadTimer);
            document.getElementById("countdown").innerHTML = "Finished";
            
            var data={total:1};
            $.ajax({
              url: '<?php echo base_url() ?>admin/isWinBrain',
              type: 'post',
              data: data,
            }).done(function (data) {
                if(data == 1)
                    alert("WOW, What a BRAIN BOX - You WIN!");
                else if (data==0)
                    alert("Draw, No Winner! PR will be split.");
                else 
                    alert("Oops, back to school for you loser!!")
                
                
                location.href="/memberList";
            });
        }
    }, 1000);
    
    var shuffle = function (array) {
    
    	var currentIndex = array.length;
    	var temporaryValue, randomIndex;
    
    	// While there remain elements to shuffle...
    	while (0 !== currentIndex) {
    		// Pick a remaining element...
    		randomIndex = Math.floor(Math.random() * currentIndex);
    		currentIndex -= 1;
    
    		// And swap it with the current element.
    		temporaryValue = array[currentIndex];
    		array[currentIndex] = array[randomIndex];
    		array[randomIndex] = temporaryValue;
    	}
    
    	return array;
    
    };
</script>


<?php
$this->load->view('admin/footer');
    