<?php

/** @var $speakers */
/** @var $extras */
/** @var $training */
/** @var $selected_speakers_list */
?>


<!-- Main content -->


    <div class="card card-info col-md-6 offset-md-3 mt-5">
        <div class="card card-header mt-2 text-center" >
            <h2 class="card-title" style="padding: 0">Add new Speakers to the training</h2>
        </div>

        <?= form_open(base_url('admin/add_speaker_to_training_validate/' . $training['t_id']), ['method' => 'post', 'style' => 'min-height:250px']) ?>

        <div class="card-body align-items-center justify-content-center d-flex ">
            <div class="form-group row d-flex justify-content-between">
                <input type="hidden" name="trainingId" class="form-control"
                       value="<?= set_value('trainingId', $training['t_id']); ?>">

                <?= form_multiselect('speakerSelect[]', $speakers, $selected_speakers_list) ?>
                <button type="submit" class="btn btn-success ml-4">Add</button>
            </div>
        </div>

        <?= form_close() ?>

</div>




