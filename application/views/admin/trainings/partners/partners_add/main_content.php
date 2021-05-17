<?php

/** @var $partners */
/** @var $extras */
/** @var $training */
/** @var $selected_partners_list */
?>


<!-- Main content -->


<div class="card card-info col-md-6 offset-md-3 mt-5">
    <div class="card card-header mt-2 text-center">
        <h2 class="card-title" style="padding: 0">Add new Partners to the training</h2>
    </div>

    <?= form_open(base_url('admin/add_partner_to_training_validate/' . $training['t_id']), ['method' => 'post', 'style' => 'min-height:250px']) ?>

    <div class="card-body align-items-center justify-content-center d-flex ">
        <div class="form-group row d-flex justify-content-between">
            <input type="hidden" name="trainingId" class="form-control"
                   value="<?= set_value('trainingId', $training['t_id']); ?>">

            <?= form_multiselect('partnerSelect[]', $partners, $selected_partners_list) ?>
            <button type="submit" class="btn btn-success ml-4">Add</button>
        </div>
    </div>

    <?= form_close() ?>

</div>




