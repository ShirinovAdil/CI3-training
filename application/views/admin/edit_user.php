<?php
/** @var $user */
?>



<!-- Horizontal Form -->
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?= form_open(base_url() . 'admin/edit_user/' .$user['id'], ['method' => 'post', 'class' => 'form-horizontal']) ?>
    <div class="card-body">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="username" value="<?= set_value('username', $user['username']);?>" class="form-control" id="inputUsername" placeholder="Username">
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button class="btn btn-primary">Edit</button>
        <a href="<?= base_url('admin/dashboard') ?>" type="button" class="btn btn-warning">Cancel</a>
    </div>
    <!-- /.card-footer -->
    <?= form_close() ?>
</div>
<!-- /.card -->