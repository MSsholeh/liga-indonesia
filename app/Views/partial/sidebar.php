<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <img src="<?= base_url() ?>assets/img/logo-lib-nav.png" width="140px">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menus
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('clubs') ?>" ><i class="fa fa-futbol"></i><span>Clubs</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('players') ?>" ><i class="fa fa-users"></i><span>Players</span></a>
    </li>

</ul>
<!-- End of Sidebar -->
