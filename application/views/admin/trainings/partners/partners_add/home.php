<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/trainings/partners/partners_add/head'); ?>
    <?php $this->load->view('admin/trainings/partners/partners_add/style'); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <?php $this->load->view('include/sidebar'); ?>
    <?php $this->load->view('include/header'); ?>

    <div class="content-wrapper">
        <?php $this->load->view('admin/trainings/partners/partners_add/main_content'); ?>
    </div>
    <?php $this->load->view('include/footer'); ?>

</div>
<?php $this->load->view('admin/trainings/partners/partners_add/script'); ?>
</body>
</html>
