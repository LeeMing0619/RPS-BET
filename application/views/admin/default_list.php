<?php $this->load->view('admin/header'); ?>
<style type="text/css">
        ul>li, a{cursor: pointer;}
</style>
<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55; height: 120vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h1 class="text-center text-uppercase">Welcome <?php echo $this->session->userdata['user_name'];?></h1>
                        
            <div class="" ng-app="App1">

                <div class="tab-pane active" id="tab_default_1" ng-controller="gridController">
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                            <div class="row">
                                <div class="col-md-3">Search & Filter:
                                    <form autocomplete="off">
                                    <input type="text" ng-model="search" ng-change="filter()" placeholder="SEARCH" class="form-control" />
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <h5>Filtered {{ filtered.length}} of {{ totalItems}} total rooms</h5>
                                </div>
                                <div class="col-md-12">
                                    <div class="thumbnail">
                                        <div ng-show="filteredItems > 0">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <th class='hidden-xs hidden-sm sortClass("id")'  ng-click='sort_by("id")'>Room ID&nbsp;</th>
                                                <th ng-click='sortColumn("name")'>Host&nbsp;</th>
                                                <!-- <th>Middle name&nbsp;</th>
                                                <th>Last name&nbsp;</th>
                                                <th>Area&nbsp;</th> -->
                                                <th ng-click='sortColumn("bet")'>Bet / PR&nbsp;</th>
                                                <th class="hidden-xs hidden-sm" ng-click='sortColumn("status")'>Status&nbsp;</th>
                                                <th class="hidden-xs hidden-sm" ng-click='sortColumn("note")'>Note&nbsp;</th>
                                                <th>Action&nbsp;</th>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="data in filtered = (list| filter:search | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit">
                                                        <td class="hidden-xs hidden-sm">
                                                            <div ng-if="data.game_kind == 0">
                                                                RPS-{{data.id}}
                                                            </div>
                                                            <div ng-if="data.game_kind == 1">
                                                                Spleesh-{{data.id}}
                                                            </div>
                                                            <div ng-if="data.game_kind == 2">
                                                                Brain-{{data.id}}
                                                            </div>
                                                            <div ng-if="data.game_kind == 3">
                                                                Mystery-{{data.id}}
                                                            </div>
                                                        </td>
                                                        <td style="display: flex;align-items: center;align-content: center;">
                                                            <div style="text-align: center;margin: 0 auto;cursor:pointer;" onclick="javascript:showProfile(this);" data-uname="{{data.fname}}" data-photo="{{data.photo}}" data-bio="{{data.bio}}">
                                                                <div ng-if="data.photo != ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block"  >
                                                                    <img src="<?php echo base_url()?>/uploads/photo/{{data.photo}}" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                </div>
                                                                <div ng-if="data.photo == ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                    <img src="<?php echo base_url()?>/asset/images/account.png" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                </div>
                                                                <span style="position: relative;display: inline-block;top: -10px;left: 3px;">{{data.fname}}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div ng-if="data.game_kind == 0">
                                                                &pound;{{data.bet_amount}} / &pound;{{data.bet_amount * 2}}
                                                            </div>
                                                            <div ng-if="data.game_kind == 1">
                                                                &pound;?? / &pound;{{data.potential_return}}
                                                            </div>
                                                            <div ng-if="data.game_kind == 2">
                                                                &pound;{{data.bet_amount}} / &pound;{{data.potential_return}}
                                                            </div>
                                                            <div ng-if="data.game_kind == 3">
                                                                &pound;{{data.bet_amount}} / &pound;{{data.potential_return}}
                                                            </div>
                                                        </td>
                                                        <td class="hidden-xs hidden-sm">{{data.status == 1 ? 'private':''}}</td>
                                                        <td class="hidden-xs hidden-sm">{{data.note}}</td>
                                                        <td><form method="post" id="{{data.password}}" action="<?php echo base_url()?>confirmWin"><input type="hidden" name="idval" value="{{data.id}}"/><input type="hidden" name="gamekind" value="{{data.game_kind}}"/>
                                                            <button type="{{data.status == 1 ? 'button':'submit'}}" onclick="javascript:test($(this));">JOIN GAME</button></form></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div  ng-show="filteredItems == 0">
                                            <div class="col-md-12">
                                                <h4>No Betting Room(s) Found.</h4>
                                            </div>
                                        </div>
                                        <div ng-show="filteredItems > 0" class="text-center">
                                            <ul pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></ul>
                                        </div>
                                        <p class="text-center">PR = Potential Return</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            
                <h1 class="text-center text-uppercase">RECENT GAMES</h1>
                        
                <div class="tab-pane active" id="tab_default_1" ng-controller="gridController_recent">
                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <div class="row">
                                    <div class="col-md-3">Search & Filter:
                                        <form autocomplete="off">
                                        <input type="text" ng-model="search" ng-change="filter()" placeholder="SEARCH" class="form-control" />
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Filtered {{ filtered.length}} of {{ totalItems}} total rooms</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="thumbnail">
                                            <div ng-show="filteredItems > 0">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <th class='hidden-xs hidden-sm sortClass("id")'  ng-click='sort_by("id")'>Room ID&nbsp;</th>
                                                    <th ng-click='sortColumn("name")'>Winner&nbsp;</th>
                                                    <th ng-click='sortColumn("name")'>Loser&nbsp;</th>
                                                    <th ng-click='sortColumn("bet")'>Best Prize&nbsp;</th>
                                                    <th class="hidden-xs hidden-sm" ng-click='sortColumn("status")'>Date Ended&nbsp;</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr ng-repeat="data in filtered = (list| filter:search | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit">
                                                            <td class="hidden-xs hidden-sm">
                                                                <div ng-if="data.game_kind == 0">
                                                                    RPS-{{data.id}}
                                                                </div>
                                                                <div ng-if="data.game_kind == 1">
                                                                    Spleesh-{{data.id}}
                                                                </div>
                                                                <div ng-if="data.game_kind == 2">
                                                                    Brain-{{data.id}}
                                                                </div>
                                                                <div ng-if="data.game_kind == 3">
                                                                    Mystery-{{data.id}}
                                                                </div>
                                                            </td>
                                                            <td style="display: flex;align-items: center;align-content: center;">
                                                                <div ng-if="data.win == 'win'" style="text-align: center;margin: 0 auto;cursor:pointer;" onclick="javascript:showProfile(this);" data-uname="{{data.user2_name}}" data-photo="{{data.photo2}}" data-bio="{{data.bio2}}">
                                                                    <div ng-if="data.photo2 != ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                        <img src="<?php echo base_url()?>/uploads/photo/{{data.photo2}}" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <div ng-if="data.photo2 == ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                        <img src="<?php echo base_url()?>/asset/images/account.png" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <span style="position: relative;display: inline-block;top: -10px;left: 3px;">{{data.user2_name}}</span>
                                                                </div>
                                                                <div ng-if="data.win == 'lose'" style="text-align: center;margin: 0 auto;cursor:pointer;" onclick="javascript:showProfile(this);" data-uname="{{data.user1_name}}" data-photo="{{data.photo1}}" data-bio="{{data.bio1}}">
                                                                    <div ng-if="data.photo1 != ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                        <img src="<?php echo base_url()?>/uploads/photo/{{data.photo1}}" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <div ng-if="data.photo1 == ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                        <img src="<?php echo base_url()?>/asset/images/account.png" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <span style="position: relative;display: inline-block;top: -10px;left: 3px;">{{data.user1_name}}</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div ng-if="data.win == 'win'" style="text-align: center;margin: 0 auto;cursor:pointer;" onclick="javascript:showProfile(this);" data-uname="{{data.user1_name}}" data-photo="{{data.photo1}}" data-bio="{{data.bio1}}">
                                                                    <div ng-if="data.photo1 != ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                        <img src="<?php echo base_url()?>/uploads/photo/{{data.photo1}}" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <div ng-if="data.photo1 == ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                        <img src="<?php echo base_url()?>/asset/images/account.png" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <span style="position: relative;display: inline-block;top: -10px;left: 3px;">{{data.user1_name}}</span>
                                                                </div>
                                                                <div ng-if="data.win == 'lose'" style="text-align: center;margin: 0 auto;cursor:pointer;" onclick="javascript:showProfile(this);" data-uname="{{data.user2_name}}" data-photo="{{data.photo2}}" data-bio="{{data.bio2}}">
                                                                    <div ng-if="data.photo2 != ''" style="width: 30px;height: 30px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                        <img src="<?php echo base_url()?>/uploads/photo/{{data.photo2}}" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <div ng-if="data.photo2 == ''" style="width: 30px;height: 30px;position: relative;overflow: hidden;border-radius: 50%; padding: 0px;display:inline-block;">
                                                                        <img src="<?php echo base_url()?>/asset/images/account.png" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <span style="position: relative;display: inline-block;top: -10px;left: 3px;">{{data.user2_name}}</span>
                                                                </div>
                                                            </td>
                                                            <td class="hidden-xs hidden-sm">&pound;{{data.bet_amount}}</td>
                                                            <td class="hidden-xs hidden-sm">{{data.end_date}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
    
                                            <div  ng-show="filteredItems == 0">
                                                <div class="col-md-12">
                                                    <h4>No Betting Room(s) Found.</h4>
                                                </div>
                                            </div>
                                            <div ng-show="filteredItems > 0" class="text-center">
                                                <ul pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="privatedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Please Enter Room's password.</h3>
        
      </div>
      <div class="modal-body">
            <input type="password" id="password" name="password" value=""/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="javascript:condition();" id="submitEditModal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="profileLabel">Pdasfrd.</h3>
        
      </div>
      <div class="modal-body">
            <img id="profile_photo" src="" style="width:300px;height:300px;"/>
            <br><br>
            <hr>
            <h3 class="modal-title" id="bio_pro">Pdasfrd.</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    var condValue = '';
    var formObj;
    function test(form) {
        if (form.prop("type") == "button") {
            formObj = form.parent();
            condValue = formObj.prop("id");

            $("#privatedModal").modal('show');
        } else {
        }
    }

    function showProfile(element) {
        var uname = element.getAttribute("data-uname");
        var photo = element.getAttribute("data-photo");
        
        if(photo == '') 
            photo = "<?php echo base_url()?>/asset/images/account.png";
        else
            photo = "<?php echo base_url()?>/uploads/photo/"+photo;
            
        var bio = element.getAttribute("data-bio");
        $("#profileLabel").text(uname);
        $("#profile_photo").attr("src", photo);
        $("#bio_pro").html(bio);
        
        $("#userModal").modal('show');
    }
    
    function condition() {
        val = document.getElementById('password').value;

        if (condValue == val) {
            $("#privatedModal").modal('hide');
            formObj.submit();                        
        } else {
            $("#privatedModal").modal('hide');
            alert("Invalid your password.");            
        }

    }
   
</script>

<?php
$this->load->view('admin/footer');?>
