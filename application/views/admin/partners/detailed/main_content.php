<?php
/** @var $users */
/** @var $partner */
?>


<!-- Main content -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">

                <div class="card">
                    <img class="card-img-top" src="<?= base_url() . $partner['p_image']?>" alt="Partner image cap" style="width: 100%">
                    <div class="card-body">
                        <h5 class="card-title"><?=$partner['p_name']?></h5>
                        <p class="card-text"><small><?=$partner['p_website']?></small></p>
                        <a href="<?=base_url('admin/edit_partner/' . $partner['p_id'])?>" class="btn btn-primary">Edit</a>
                        <a href="<?php echo base_url('admin/edit_partner_status/');
                        echo '' . $partner['p_id']; ?>">
                            <?php if ($partner['p_status'] == 0){ ?>
                            <button type="button" class="btn btn-danger mr-1">
                                Off
                            </button>
                        </a>
                        <?php } else { ?>
                            <button type="button" class="btn btn-success mr-1">
                                On
                            </button>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



