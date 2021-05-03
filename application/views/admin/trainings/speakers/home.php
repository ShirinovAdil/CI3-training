<!DOCTYPE html>
<html>
<?php $this->load->view('include/head'); ?>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <?php $this->load->view('include/sidebar'); ?>
    <?php $this->load->view('include/header'); ?>

    <div class="content-wrapper">
        <?php $this->load->view('admin/trainings/speakers/main_content'); ?>
    </div>
    <?php $this->load->view('include/footer'); ?>

</div>
<?php $this->load->view('include/script'); ?>
<?php $this->load->view('include/confirm_modal'); ?>
</body>
</html>
