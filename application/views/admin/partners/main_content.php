<?php
/** @var $users */
/** @var $trainings */
/** @var $partners */
?>


<!-- Main content -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title">List of partners</h3>

                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Website</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>

                                </tr>
                                </thead>


                                <?php foreach ($partners as $partner): ?>

                                    <tr>
                                        <td><a href="<?=base_url('admin/partner_details/' . $partner['p_id'])?>"><?php echo $partner['p_id']; ?></a></td>
                                        <td> <?php echo $partner['p_name']; ?></td>
                                        <td> <?php echo $partner['p_website']; ?></td>
                                        <td><img style="width: 50px; height: 50px;"
                                                 src="<?php echo base_url() . $partner['p_image']; ?>"
                                                 alt="company image"></td>
                                        <td> <?php echo $partner['p_status']; ?></td>

                                        <td>
                                            <?= form_open(base_url('admin/delete_partner'), ['method' => 'post', 'display' => 'inline-block', 'width' => '44px;',"onsubmit" => "return(update());"]) ?>
                                            <input type="hidden" name="partnerId"
                                                   value="<?= set_value('partnerId', $partner['p_id']); ?>">


                                            <a href="<?php echo base_url('admin/edit_partner/');
                                            echo '' . $partner['p_id']; ?>">
                                                <button type="button" class="btn btn-warning mr-1"><i
                                                            class="fas fa-edit"></i></button>
                                            </a>

                                            <button type="submit" class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>



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


                                            <?= form_close() ?>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>
                            </table>
                        </div>


                    </div>
                </div>
                <a style="float:right" href="<?= base_url('admin/add_partner') ?>" type="button"
                   class="btn btn-primary">Add a partner</a>


            </div>
        </div>
    </div>
</section>



