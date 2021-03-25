<?php
/** @var $user */
/** @var $all_roles */
?>


<!-- Horizontal Form -->
<div class="card card-info col-md-6 offset-md-3 mt-5">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?= form_open(base_url() . 'admin/edit_user/' . $user['id'], ['method' => 'post', 'class' => 'form-horizontal']) ?>
    <div class="card-body">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" name="username" value="<?= set_value('username', $user['username']); ?>"
                       class="form-control" id="inputUsername" placeholder="Username">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <input type="text" name="role" value="<?= set_value('role', $user['role']); ?>" class="form-control"
                       disabled>
            </div>
        </div>
    </div>

        <!--            -->
        <!--            <select>-->
        <!--                --><?php
        //                //Re-Index
        //                $array = array_values($all_roles);
        //                foreach ($array as $v1) {
        //                    echo "<option>" .$v1."</option>";
        //                }
        //                ?>
        <!--            </select>-->



    <!-- /.card-body -->
    <div class="card-footer">
        <button class="btn btn-primary">Edit</button>
        <a href="<?= base_url('admin/dashboard') ?>" type="button" class="btn btn-warning">Cancel</a>
    </div>
    <!-- /.card-footer -->
    <?= form_close() ?>
</div>
<!-- /.card -->