<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55; padding-bottom: 90px;">
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="ajaxResponse"><input type="hidden" name="ajaxResponse"></div>
            <div class="row" style="padding: 0px 5px;">
            </div>
        </div>
    </div>

</div>

<script>
</script>
<?php
$this->load->view('admin/footer');
