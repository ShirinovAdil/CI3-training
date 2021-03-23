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
                                <td>
                                    <button type="button" class="btn btn-primary"><i class="far fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-success"><i class="fas fa-edit"></i>
                                    </button>

                                    <?php if ($user->role != "root") { ?>
                                        <?= form_open(base_url('admin/delete_user'), ['method' => 'post']) ?>
                                        <input type="hidden" name="userId"
                                               value="<?= set_value('userId', $user->id); ?>">

                                        <button type="submit" class="btn btn-danger"><i
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