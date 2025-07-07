<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
<i class="fa fa-bars"></i>
</button>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?=$judul;?></h1>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  <div class="topbar-divider d-none d-sm-block"></div>

  <?php if (!$this->session->userdata('email')): ?>
    <!-- Jika BELUM login -->
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('autentifikasi'); ?>">
        <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i> Login
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('autentifikasi/daftar'); ?>">
        <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400"></i> Daftar
      </a>
    </li>
  <?php else: ?>
    <!-- Jika SUDAH login -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama']; ?></span>
        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?= base_url('user'); ?>">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile Saya
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= base_url('autentifikasi/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
        </a>
      </div>
    </li>
  <?php endif; ?>

</ul>

</nav>
<!-- End of Topbar -->