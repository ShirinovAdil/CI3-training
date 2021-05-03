<?php
/** @var $users */
/** @var $training */
/** @var $all_partners */
/** @var $speakers */
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
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>


                            <?php foreach ($speakers as $speaker): ?>

                                <tr>
                                    <td> <?php echo $speaker['s_id']; ?></td>
                                    <td> <?php echo $speaker['s_name']; ?></td>
                                    <td> <?php echo $speaker['s_company']; ?></td>
                                    <td> <?php echo $speaker['ts_status']; ?></td>

                                    <td>
                                        <?= form_open(base_url('admin/delete_speaker_by_id_from_training'), ['method' => 'post', 'display' => 'inline-block', 'width' => '44px;', "onsubmit" => "return(update());"]) ?>
                                        <input type="hidden" name="speakerId"
                                               value="<?= set_value('speakerId', $speaker['s_id']); ?>">

                                        <input type="hidden" name="trainingId"
                                               value="<?= set_value('trainingId', $training['t_id']); ?>">

                                        <button type="submit" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>


                                        <a href="<?php echo base_url('admin/edit_training_speaker_status/');
                                        echo '' . $training['t_id'] . '/' .  $speaker['s_id']; ?>">
                                            <?php if ($speaker['ts_status'] == 0){ ?>
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
                <a style="float:right" href="<?= base_url('admin/add_speaker_to_training/'.$training['t_id'])?>" type="button" class="btn btn-primary">Add a speaker to training</a>

            </div>
        </div>
    </div>
</section>



