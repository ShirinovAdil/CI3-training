<?php
/** @var $users */
/** @var $training */
/** @var $partners */
/** @var $speakers */
?>


<!-- Main content -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-2">
                <h3><b>Detailed view of a training</b></h3>
                <div class="list-group">
                    <ul class="list-group">
                        <li class="list-group-item" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?=$training['t_title_az']?></h5>
                            </div>
                            <p class="mb-1"><?=$training['t_description_az']?></p>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?=$training['t_title_en']?></h5>
                            </div>
                            <p class="mb-1"><?=$training['t_description_en']?></p>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                            </div>
                            <p class="text-muted"><small><?=$training['t_contact']?></small></p>
                            <p class="text-muted mb-1"><small>Created by <?=$training['t_created_by']?></small></p>

                        </li>
                    </ul>

                </div>

                <?php if ($partners) {?>
                    <div class="mt-4">
                        <h5>List of Partners</h5>
                        <ul class="list-group">
                            <?php foreach ($partners as $partner){ ?>
                                <li class="list-group-item"><?= $partner['p_name']?></li>
                            <?php } ?>
                        </ul>

                    </div>
                <?php } ?>

                <?php if ($speakers) {?>
                    <div class="mt-4">
                        <h5>List of Speakers</h5>
                        <ul class="list-group">
                            <?php foreach ($speakers as $speaker){ ?>
                                <li class="list-group-item"><?= $speaker['s_name']?></li>
                            <?php } ?>
                        </ul>

                    </div>
                <?php } ?>


            </div>
        </div>
    </div>
</section>

<!--<pre>--><?php //print_r($trainings) ?><!--</pre>-->


