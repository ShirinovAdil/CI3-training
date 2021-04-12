<?php
/** @var $header_data */
?>
<!DOCTYPE html>
<html>
<?php $this->load->view('include/head'); ?>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <?php $this->load->view('include/sidebar'); ?>
    <?php $this->load->view('include/header', $header_data); ?>

    <div class="content-wrapper">
        <?php $this->load->view('admin/users/edit/main_content'); ?>
    </div>
    <?php $this->load->view('include/footer'); ?>

</div>
<?php $this->load->view('include/script'); ?>
</body>
</html>
