<?php
/** @var $is_authenticated */
?>

<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="<?= base_url('admin/dashboard')?>" class="brand-link">
        <img src="<?php echo base_url() ?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url() ?>/assets/dist/img/user1-128x128.jpg"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <?php if($this->session->userdata('username')!="")
                {
                    echo '<a href="#" class="d-block">' . $this->session->userdata('username') . '</a>';

                } ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?= base_url('admin/trainings') ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Training
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/partners') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Partners
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/speakers') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Speakers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            UI Elements
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../UI/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../UI/icons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Icons</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('admin/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
