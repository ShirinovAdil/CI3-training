<?php
/** @var $speaker */
/** @var $all_roles */
?>


<!-- Horizontal Form -->
<div class="card card-info col-md-6 offset-md-3 mt-5">
    <div class="card-header">
        <h3 class="card-title">Edit Partner's Info</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <?= form_open(base_url() . 'admin/edit_speaker/' . $speaker['s_id'], ['method' => 'post', 'class' => 'form-horizontal']) ?>
    <div class="card-body">
        <div class="form-group row">
            <label for="inputSpeakerName" class="col-sm-2 col-form-label">Speaker Name</label>
            <div class="col-sm-10">
                <input type="text" name="speakerName" value="<?= set_value('speakerName', $speaker['s_name']); ?>"
                       class="form-control" id="inputSpeakerName" placeholder="Speaker name">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputSpeakerCompany" class="col-sm-2 col-form-label">Speaker's Company</label>
            <div class="col-sm-10">
                <input type="text" name="speakerCompany" id="inputSpeakerCompany"
                       value="<?= set_value('speakerCompany', $speaker['s_company']); ?>" class="form-control" placeholder="Speaker company">
            </div>
        </div>
    </div>


    <!-- /.card-body -->
    <div class="card-footer">
        <button class="btn btn-primary">Save</button>
        <a href="<?= base_url('admin/speakers') ?>" type="button" class="btn btn-warning">Cancel</a>
    </div>
    <!-- /.card-footer -->
    <?= form_close() ?>
</div>
<!-- /.card -->