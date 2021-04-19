<?php

/** @var $partners */
/** @var $extras */
/** @var $training */
/** @var $selected_partners_list */
?>


<!-- Main content -->


    <div class="card card-info col-md-6 offset-md-3 mt-5">
        <div class="card-header" style="text-align: center !important;">
            <h2 class="card-title">Add new Partners to the training</h2>
        </div>

        <?= form_open(base_url('admin/add_partner_to_training_validate/' . $training['t_id']), ['method' => 'post']) ?>

        <div class="card-body">
            <div class="form-group row">
                <input type="hidden" name="trainingId" class="form-control"
                       value="<?= set_value('trainingId', $training['t_id']); ?>">

                <?= form_multiselect('partnerSelect[]', $partners, $selected_partners_list) ?>
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </div>

        <?= form_close() ?>

</div>




