<?php
/** @var $users */
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
                        <h3 class="card-title">List of users</h3>


                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <?php foreach ($users as $user): ?>

                                    <tr>
                                        <td> <?php echo $user->id; ?></td>
                                        <td> <?php echo $user->username; ?></td>
                                        <td> <?php echo $user->role; ?></td>
                                        <td style="display: flex;">
                                            <button type="button" class="btn btn-primary mr-1"><i
                                                        class="far fa-eye"></i>
                                            </button>


                                            <?php if ($user->role != "root") { ?>
                                                <?= form_open(base_url('admin/delete_user'), ['method' => 'post', 'display' => 'inline-block', 'width' => '44px;']) ?>
                                                <input type="hidden" name="userId"
                                                       value="<?= set_value('userId', $user->id); ?>">


                                                <a href="<?php echo base_url('admin/edit_user/');
                                                echo '' . $user->id; ?>">
                                                    <button type="button" class="btn btn-success mr-1"><i
                                                                class="fas fa-edit"></i></button>
                                                </a>

                                                <button type="submit" class="btn btn-danger mr-1"><i
                                                            class="far fa-trash-alt"></i>
                                                </button>
                                                <?= form_close() ?>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            </table>
                        </div>

                </div>
            </div>

        </div>
    </div>
    </div>
</section>

