<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IceScoop</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-xh6f+ZgC9f+9o2y5Z8E7+8yQyX1a7YJr5nqFz6tX7xg1k9lVqfWJmWwFQh9nK4iXJf5mWk3Yk0Q3n8s6GJYhQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?php echo base_url('public/assets/css/pink.css'); ?>">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
  <script>
    window.BASE_URL = '<?php echo rtrim(base_url(),'/').'/'; ?>';
    window.SITE_URL = '<?php echo rtrim(site_url(),'/').'/'; ?>';
  </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="site-wrapper">
    <a class="navbar-brand" href="<?php echo site_url(); ?>"><i class="fa-solid fa-ice-cream"></i> IceScoop</a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('products'); ?>"><i class="fa-solid fa-store"></i> Esss Krim</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('blog'); ?>"><i class="fa-regular fa-newspaper"></i> Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('chat'); ?>"><i class="fa-regular fa-comments"></i> Chat</a></li>
      </ul>
  <ul class="navbar-nav ml-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="<?php echo site_url('cart'); ?>"><i class="fa-solid fa-basket-shopping"></i> Keranjang</a></li>
        <li class="nav-item"><a class="nav-link position-relative" href="#"><i class="fa-regular fa-bell"></i> Notifikasi <span class="badge badge-pill badge-notif notif-badge" style="display:none">0</span></a></li>
        <?php if($this->session->userdata('user_id')): ?>
          <li class="nav-item"><a class="btn btn-outline-pink" href="<?php echo site_url('logout'); ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="btn btn-pink" href="<?php echo site_url('login'); ?>"><i class="fa-regular fa-user"></i> Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="site-wrapper py-3">
