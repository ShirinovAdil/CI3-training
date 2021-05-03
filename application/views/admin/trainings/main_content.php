<?php
/** @var $users */
/** @var $trainings */
/** @var $all_partners */
?>


<!-- Main content -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!---->
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
                        <h3 class="card-title">List of trainings</h3>


                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title AZ</th>
                                    <th>Description AZ</th>
                                    <th>Contact</th>
                                    <th>Partners</th>
                                    <th>Speakers</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <?php foreach ($trainings as $training){ ?>

                                    <tr>
                                        <td> <?php echo $training['t_id']; ?></td>
                                        <td> <?php echo $training['t_title_az']; ?></td>
                                        <td> <?php echo $training['t_description_az']; ?></td>
                                        <td> <?php echo $training['t_contact']; ?></td>

                                        <td>
                                            <a href="<?= base_url('admin/trainings_partners_list/' . $training['t_id']) ?>"><?php echo $training['partners_count']; ?></a>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('admin/trainings_speakers_list/' . $training['t_id']) ?>"><?php echo $training['speakers_count']; ?></a>
                                        </td>

                                        <td> <?php echo $training['t_status']; ?></td>

                                        <td>
                                            <?= form_open(base_url('admin/delete_training'), ['method' => 'post', 'display' => 'inline-block', 'width' => '44px;', "onsubmit" => "return(update());"]) ?>

                                            <input type="hidden" name="t_id"
                                                   value="<?= set_value('t_id', $training['t_id']); ?>">


                                            <a href="<?php echo base_url('admin/edit_training/');
                                            echo '' . $training['t_id']; ?>">
                                                <button type="button" class="btn btn-warning mr-1"><i
                                                            class="fas fa-edit"></i></button>
                                            </a>

                                            <button type="submit" class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>


                                            <a href="<?php echo base_url('admin/edit_training_status/');
                                            echo '' . $training['t_id']; ?>">
                                                <?php if ($training['t_status'] == 0){ ?>
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

                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<pre>--><?php //print_r($trainings) ?><!--</pre>-->


