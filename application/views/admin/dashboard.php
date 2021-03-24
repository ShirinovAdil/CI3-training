<?php
/** @var $users */
?>

<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of users</h3>

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
                                    <button type="button" class="btn btn-primary mr-1"><i class="far fa-eye"></i>
                                    </button>

                                    <a href="<?php echo base_url('admin/edit_user/'); echo '' . $user->id; ?>">
                                        <button type="button" class="btn btn-success mr-1"><i class="fas fa-edit"></i></button>
                                    </a>

                                    <?php if ($user->role != "root") { ?>
                                        <?= form_open(base_url('admin/delete_user'), ['method' => 'post', 'display'=> 'inline-block', 'width' => '44px;']) ?>
                                        <input type="hidden" name="userId"
                                               value="<?= set_value('userId', $user->id); ?>">

                                        <button type="submit" class="btn btn-danger mr-1"><i
                                                    class="far fa-trash-alt"></i>
                                        </button>
                                        <?= form_close() ?>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>