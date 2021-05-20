<?php
/** @var $partners */
/** @var $speakers */
/** @var $all_roles */
/** @var $error */
/** @var $training_partners */
/** @var $training_speakers */
?>


<!-- Horizontal Form -->
<div class="card card-info col-md-6 offset-md-3 mt-5">
    <div class="card-header mt-2">
        <h3 class="card-title">Create a new training</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <?= form_open_multipart(base_url() . 'admin/add_training_validate', ['method' => 'post', 'class' => 'form-horizontal']) ?>

    <div class="card-body">
        <div class="form-group row">
            <label for="trainingTitleAz" class="col-sm-2 col-form-label">Training Title AZ</label>
            <div class="col-sm-10">
                <input type="text" name="trainingTitleAz" class="form-control" id="trainingTitleAz"
                       value="<?= set_value('trainingTitleAz', ''); ?>"
                       placeholder="Training title in Azerbaijani">
            </div>
        </div>

        <div class="form-group row">
            <label for="trainingTitleEn" class="col-sm-2 col-form-label">Training Title EN</label>
            <div class="col-sm-10">
                <input type="text" name="trainingTitleEn" class="form-control" id="trainingTitleEn"
                       value="<?= set_value('trainingTitleEn', ''); ?>"
                       placeholder="Training title in English">
            </div>
        </div>

        <div class="form-group row">
            <label for="trainingDescriptionAz" class="col-sm-2 col-form-label">Training Description AZ</label>
            <div class="col-sm-10">
                <textarea rows="3" name="trainingDescriptionAz" class="form-control"
                          id="trainingDescriptionAz" placeholder="Training description in Azerbaijani"><?= set_value('trainingDescriptionAz', ''); ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="trainingDescriptionEn" class="col-sm-2 col-form-label">Training Description EN</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="trainingDescriptionEn"
                          id="trainingDescriptionAz" placeholder="Training description in English"><?= set_value('trainingDescriptionEn', ''); ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="trainingContact" class="col-sm-2 col-form-label">Training contacts</label>
            <div class="col-sm-10">
                <input type="text" name="trainingContact" id="trainingContact" class="form-control"
                       value="<?= set_value('trainingContact', ''); ?>"
                       placeholder="Training contacts">
            </div>
        </div>

        <div class="form-group row">
            <label for="trainingImage" class="col-sm-2 col-form-label">Training Image</label>
            <div class="col-sm-10">
                <input type="file" name="userfile" size="20"/>
            </div>
        </div>

        <div class="form-group row">
            <label for="partnerSelect[]" class="col-sm-2 col-form-label">Training partners</label>
            <div class="card-body justify-content-center d-flex">
                <div class="form-group row d-flex justify-content-between">

                    <?php if (isset($training_partners)){ ?>
                        <?= form_multiselect('partnerSelect[]', $partners, $training_partners) ?>
                    <?php }
                    else {  ?>
                        <?= form_multiselect('partnerSelect[]', $partners) ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="speakerSelect[]" class="col-sm-2 col-form-label">Training speakers</label>
            <div class="card-body justify-content-center d-flex ">
                <div class="form-group row d-flex justify-content-between">
                    <?php if (isset($training_speakers)){ ?>
                        <?= form_multiselect('speakerSelect[]', $speakers, $training_speakers) ?>
                    <?php }
                    else {  ?>
                        <?= form_multiselect('speakerSelect[]', $speakers) ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php echo '<small style="color:#fc4103">' . validation_errors() . '</small>'; ?>

        <?php
        if (isset($error)) {
            echo '<small style="color:#fc4103">' . $error . '</small>';
        }
        ?>
    </div>


    <!-- /.card-body -->
    <div class="card-footer">
        <button class="btn btn-primary" value="upload">Create</button>
        <a href="<?= base_url('admin/trainings') ?>" type="button" class="btn btn-warning">Cancel</a>
    </div>
    <!-- /.card-footer -->
    <?= form_close() ?>
</div>
<!-- /.card -->