<!DOCTYPE html>
<html>
<?php $this->load->view('include/head'); ?>
<style>
    .speaker-img{
        transition: transform .2s; /* Animation */
    }
    .speaker-img:hover {
        transform: scale(2.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */

    }
</style>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <?php $this->load->view('include/sidebar'); ?>
    <?php $this->load->view('include/header'); ?>

    <div class="content-wrapper">
        <?php $this->load->view('admin/speakers/main_content'); ?>
    </div>
    <?php $this->load->view('include/footer'); ?>

</div>
<?php $this->load->view('include/script'); ?>
<?php $this->load->view('include/confirm_modal'); ?>
</body>
</html>
