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

                <!-- FLASH DATA -->

                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } else if ($this->session->flashdata('error')) { ?>

                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>

                <?php } else if ($this->session->flashdata('warning')) { ?>

                    <div class="alert alert-warning">
                        <?php echo $this->session->flashdata('warning'); ?>
                    </div>

                <?php } else if ($this->session->flashdata('info')) { ?>

                    <div class="alert alert-info">
                        <?php echo $this->session->flashdata('info'); ?>
                    </div>
                <?php } ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of trainings</h3>

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
                                <th>ID</th>
                                <th>Title AZ</th>
                                <th>Title EN</th>
                                <th>Description EN</th>
                                <th>Description AZ</th>
                                <th>Contact</th>
                                <th>Partners name</th>
                                <th>Partners website</th>
                            </tr>
                            </thead>


                            <?php foreach ($trainings as $training): ?>

                                <tr>
                                    <td> <?php echo $training['t_id']; ?></td>
                                    <td> <?php echo $training['t_title_az']; ?></td>
                                    <td> <?php echo $training['t_title_en']; ?></td>
                                    <td> <?php echo $training['t_description_az']; ?></td>
                                    <td> <?php echo $training['t_description_en']; ?></td>
                                    <td> <?php echo $training['t_contact']; ?></td>
                                    <td> <?php echo $training['partners_name']; ?></td>
                                    <td> <?php echo $training['partners_website']; ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<pre><?php print_r($trainings) ?></pre>

