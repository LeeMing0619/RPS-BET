<?php $this->load->view('admin/header'); ?>
<style type="text/css">
        ul>li, a{cursor: pointer;}
</style>
<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h1 class="text-center text-uppercase">Welcome</h1>
                        
            <div class="" ng-app="App1">

                <div class="tab-pane active" id="tab_default_1" ng-controller="gridController">
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                            <div class="row">
                                <div class="col-md-3">Search & Filter:
                                    <input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
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
                                                <th ng-click='sortColumn("name")'>Room Name&nbsp;</th>
                                                <!-- <th>Middle name&nbsp;</th>
                                                <th>Last name&nbsp;</th>
                                                <th>Area&nbsp;</th> -->
                                                <th ng-click='sortColumn("bet")'>Bet Amount&nbsp;</th>
                                                <th class="hidden-xs hidden-sm" ng-click='sortColumn("status")'>Status&nbsp;</th>
                                                <th class="hidden-xs hidden-sm" ng-click='sortColumn("note")'>Note&nbsp;</th>
                                                <th>Action&nbsp;</th>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="data in filtered = (list| filter:search | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit">
                                                        <td class="hidden-xs hidden-sm">{{data.member_id}}</td>
                                                        <td>{{data.fname}}</td>
                                                        <!-- <td>{{data.mname}}</td>
                                                        <td>{{data.lname}}</td>
                                                        <td>{{data.area}}</td> -->                              
                                                        <td>&pound;{{data.bet_amount}}</td>
                                                        <td class="hidden-xs hidden-sm">{{data.status == 1 ? 'private':''}}</td>
                                                        <td class="hidden-xs hidden-sm">{{data.note}}</td>
                                                        <td><form method="post" id="{{data.password}}" action="<?php echo base_url()?>joingame"><input type="hidden" name="idval" value="{{data.id}}"/>
                                                            <button type="{{data.status == 1 ? 'button':'submit'}}" onclick="javascript:test($(this));">JOIN GAME</button></form></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div  ng-show="filteredItems == 0">
                                            <div class="col-md-12">
                                                <h4>No Betting Room found</h4>
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
            <input type="text" id="password" name="password" value=""/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="javascript:condition();" id="submitEditModal">OK</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
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
$this->load->view('admin/footer');
