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
                                        <td> <?php echo $partner['p_id']; ?></td>
                                        <td> <?php echo $partner['p_name']; ?></td>
                                        <td> <?php echo $partner['p_website']; ?></td>
                                        <td><img style="width: 50px; height: 50px;"
                                                 src="<?php echo base_url() . $partner['p_image']; ?>"
                                                 alt="company image"></td>
                                        <td> <?php echo $partner['p_status']; ?></td>

                                        <td>
                                            <?= form_open(base_url('admin/delete_partner'), ['method' => 'post', 'display' => 'inline-block', 'width' => '44px;']) ?>
                                            <input type="hidden" name="partnerId"
                                                   value="<?= set_value('partnerId', $partner['p_id']); ?>">


                                            <a href="<?php echo base_url('admin/edit_partner/');
                                            echo '' . $partner['p_id']; ?>">
                                                <button type="button" class="btn btn-warning mr-1"><i
                                                            class="fas fa-edit"></i></button>
                                            </a>



                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger mr-1" data-toggle="modal" data-target="#deletePartnerModal"><i
                                                        class="far fa-trash-alt"></i>
                                            </button>


                                            <!-- Modal -->
                                            <div class="modal fade" id="deletePartnerModal" tabindex="-1" role="dialog" aria-labelledby="deletePartnerModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deletePartnerModalLabel">Confirmation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this partner?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



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



