<?php
/** @var $partner */
/** @var $all_roles */
/** @var $error */
?>


<!-- Horizontal Form -->
<div class="card card-info col-md-6 offset-md-3 mt-5">
    <div class="card-header mt-2">
        <h3 class="card-title">Add a new Partner</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <?= form_open_multipart(base_url() . 'admin/add_partner_validate', ['method' => 'post', 'class' => 'form-horizontal']) ?>

    <div class="card-body">
        <div class="form-group row">
            <label for="inputPartnerName" class="col-sm-2 col-form-label">Partner Name</label>
            <div class="col-sm-10">
                <input type="text" name="partnerName" class="form-control" id="inputPartnerName" value="<?= set_value('partnerName', ''); ?>"
                       placeholder="Partner name / Company name">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPartnerWebsite" class="col-sm-2 col-form-label">Partner's Website</label>
            <div class="col-sm-10">
                <input type="text" name="partnerWebsite" id="inputPartnerWebsite" class="form-control"  value="<?= set_value('partnerWebsite', ''); ?>"
                       placeholder="Partner website / Company website">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPartnerWebsite" class="col-sm-2 col-form-label">Partner's Image</label>
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
        <a href="<?= base_url('admin/partners') ?>" type="button" class="btn btn-warning">Cancel</a>
    </div>
    <!-- /.card-footer -->
    <?= form_close() ?>
</div>
<!-- /.card -->