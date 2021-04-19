<?php
/** @var $partner */
/** @var $all_roles */
?>


<!-- Horizontal Form -->
<div class="card card-info col-md-6 offset-md-3 mt-5">
    <div class="card-header">
        <h3 class="card-title">Edit Partner's Info</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <?= form_open(base_url() . 'admin/edit_partner/' . $partner['p_id'], ['method' => 'post', 'class' => 'form-horizontal']) ?>
    <div class="card-body">
        <div class="form-group row">
            <label for="inputPartnerName" class="col-sm-2 col-form-label">Partner Name</label>
            <div class="col-sm-10">
                <input type="text" name="partnerName" value="<?= set_value('partnerName', $partner['p_name']); ?>"
                       class="form-control" id="inputPartnerName" placeholder="Partner name / Company name">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPartnerWebsite" class="col-sm-2 col-form-label">Partner's Website</label>
            <div class="col-sm-10">
                <input type="text" name="partnerWebsite" id="inputPartnerWebsite"
                       value="<?= set_value('partnerWebsite', $partner['p_website']); ?>" class="form-control" placeholder="Partner website / Company website">
            </div>
        </div>
    </div>


    <!-- /.card-body -->
    <div class="card-footer">
        <button class="btn btn-primary">Save</button>
        <a href="<?= base_url('admin/partners') ?>" type="button" class="btn btn-warning">Cancel</a>
    </div>
    <!-- /.card-footer -->
    <?= form_close() ?>
</div>
<!-- /.card -->