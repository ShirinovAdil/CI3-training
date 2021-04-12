<?php
/** @var $users */
/** @var $training */
/** @var $all_partners */
/** @var $partners */
?>


<!-- Main content -->
<section>
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-12">

                <!-- FLASH DATA -->

<!--                --><?php //if ($this->session->flashdata('success')) { ?>
<!--                    <div class="alert alert-success">-->
<!--                        --><?php //echo $this->session->flashdata('success'); ?>
<!--                    </div>-->
<!--                --><?php //} else if ($this->session->flashdata('error')) { ?>
<!---->
<!--                    <div class="alert alert-danger">-->
<!--                        --><?php //echo $this->session->flashdata('error'); ?>
<!--                    </div>-->
<!---->
<!--                --><?php //} else if ($this->session->flashdata('warning')) { ?>
<!---->
<!--                    <div class="alert alert-warning">-->
<!--                        --><?php //echo $this->session->flashdata('warning'); ?>
<!--                    </div>-->
<!---->
<!--                --><?php //} else if ($this->session->flashdata('info')) { ?>
<!---->
<!--                    <div class="alert alert-info">-->
<!--                        --><?php //echo $this->session->flashdata('info'); ?>
<!--                    </div>-->
<!--                --><?php //} ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of partners of <b><?= $training['t_title_az'] ?></b></h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                       placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Partner ID</th>
                                <th>Partner name</th>
                                <th>Partner website</th>
                                <th>Actions</th>
                            </tr>
                            </thead>


                            <?php foreach ($partners as $partner): ?>

                                <tr>
                                    <td> <?php echo $partner['p_id']; ?></td>
                                    <td> <?php echo $partner['p_name']; ?></td>
                                    <td> <?php echo $partner['p_website']; ?></td>

                                    <td>
                                        <?= form_open(base_url('admin/delete_partner_by_id_from_training'), ['method' => 'post', 'display' => 'inline-block', 'width' => '44px;']) ?>
                                        <input type="hidden" name="partnerId"
                                               value="<?= set_value('partnerId', $partner['p_id']); ?>">

                                        <input type="hidden" name="trainingId"
                                               value="<?= set_value('trainingId', $training['t_id']); ?>">



                                        <button type="submit" class="btn btn-danger mr-1"><i
                                                    class="far fa-trash-alt"></i>
                                        </button>


                                        <div class="custom-control custom-switch" style="display: inline;">
                                            <input type="checkbox" class="custom-control-input" id=<?="customSwitch" .$partner['p_id']?>>
                                            <label class="custom-control-label" for=<?="customSwitch" .$partner['p_id']?>>Status</label>
                                        </div>


                                        <?= form_close() ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <a style="float:right" href="<?= base_url('admin/add_partner_to_training/'.$training['t_id'])?>" type="button" class="btn btn-primary">Add partner</a>

            </div>
        </div>
    </div>
</section>



