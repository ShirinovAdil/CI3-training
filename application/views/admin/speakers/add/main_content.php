<?php
/** @var $partner */
/** @var $all_roles */
/** @var $error */
?>


<!-- Horizontal Form -->
<div class="card card-info col-md-6 offset-md-3 mt-5">
    <div class="card-header mt-2">
        <h3 class="card-title">Add a new Speaker</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <?= form_open_multipart(base_url() . 'admin/add_speaker_validate', ['method' => 'post', 'class' => 'form-horizontal']) ?>

    <div class="card-body">
        <div class="form-group row">
            <label for="inputSpeakerName" class="col-sm-2 col-form-label">Speaker Name</label>
            <div class="col-sm-10">
                <input type="text" name="speakerName" class="form-control" id="inputSpeakerName" value="<?= set_value('speakerName', ''); ?>"
                       placeholder="Speaker name">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputSpeakerCompany" class="col-sm-2 col-form-label">Speaker's Company</label>
            <div class="col-sm-10">
                <input type="text" name="speakerCompany" id="inputSpeakerCompany" class="form-control"  value="<?= set_value('speakerCompany', ''); ?>"
                       placeholder="Speaker Company">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputSpeakerImage" class="col-sm-2 col-form-label">Speaker's Image</label>
            <div class="col-sm-10">
                <input type="file" name="userfile" size="20"/>
            </div>
        </div>

        <?php echo '<small style="color:#fc4103">' . validation_errors() . '</small>';  ?>

        <?php
        if (isset($error)) {
            echo '<small style="color:#fc4103">' . $error . '</small>';
        }
        ?>
    </div>


    <!-- /.card-body -->
    <div class="card-footer">
        <button class="btn btn-primary" value="upload">Add</button>
        <a href="<?= base_url('admin/speakers') ?>" type="button" class="btn btn-warning">Cancel</a>
    </div>
    <!-- /.card-footer -->
    <?= form_close() ?>
</div>
<!-- /.card -->