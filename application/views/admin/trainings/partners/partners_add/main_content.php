<?php

/** @var $partners */
?>


<!-- Main content -->
<section>
    <div class="container-fluid dashboard-content" style="padding-top: 25px;">
        <div class="row">
            <div class="col-12">

                <?= form_open(base_url('admin/add_partner_to_training_validate'), ['method' => 'post']) ?>
                <select name="partnerID[]"  class="selectpicker" multiple data-live-search="true">
                    <?php foreach ($partners as $partner): ?>
                        <option value="<?= set_value('partnerId', $partner['p_id']); ?>"><?= $partner['p_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-success">Add</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>



