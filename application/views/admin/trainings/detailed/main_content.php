<?php
/** @var $users */
/** @var $training */
/** @var $partners */
/** @var $speakers */
?>

<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="col-12">
                        <?php if($training['t_image'] != '') {?>
                        <img src="<?= base_url() . $training['t_image']?>" class="product-image" alt="Training Image">
                        <?php } else {?>
                        <img src="<?= base_url() . './uploads/trainings/placeholder.jpg'?>" class="product-image" alt="Training Image">
                        <?php }?>

                    </div>
                </div>
                <div class="col-12 col-sm-6">
                        <?php if ($partners) {?>
                            <hr>
                            <h4>List of Partners</h4>
                            <div class="mt-4">
                                <ul class="list-group">
                                    <?php foreach ($partners as $partner){ ?>
                                        <li class="list-group-item"><?= $partner['p_name']?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                    <?php if ($speakers) {?>
                        <hr>
                        <div class="mt-4">
                            <h5>List of Speakers</h5>
                            <ul class="list-group">
                                <?php foreach ($speakers as $speaker){ ?>
                                    <li class="list-group-item"><?= $speaker['s_name']?></li>
                                <?php } ?>
                            </ul>

                        </div>
                    <?php } ?>

                        <p class="text-muted"><small>Contacts: <b><?=$training['t_contact']?></b></small></p>
                        <p class="text-muted mb-1"><small>Created by: <b><?=$training['t_created_by']?></b></small></p>

                    <div class="mt-4">
                        <button class="btn btn-primary">
                            Register
                        </button>
                    </div>

                </div>
            </div>

            <div class="row mt-4">
                <nav class="w-100">
                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">English</a>
                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Azerbaijani</a>
                        <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Contacts</a>
                    </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                        <h3 class="my-3"><?=$training['t_title_en']?></h3>
                        <p><?=$training['t_description_en']?></p>
                    </div>
                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                        <h3 class="my-3"><?=$training['t_title_az']?></h3>
                        <p><?=$training['t_description_az']?></p>
                    </div>
                    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                        <p class="text-muted"><small><b><?=$training['t_contact']?></b></small></p>
                        <p class="text-muted mb-1"><small>Created by: <b><?=$training['t_created_by']?></b></small></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
