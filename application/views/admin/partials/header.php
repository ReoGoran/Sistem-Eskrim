<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Admin IceScoop</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-xh6f+ZgC9f+9o2y5Z8E7+8yQyX1a7YJr5nqFz6tX7xg1k9lVqfWJmWwFQh9nK4iXJf5mWk3Yk0Q3n8s6GJYhQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="<?php echo base_url('public/assets/css/pink.css'); ?>">
	</head>
	<body>
		<div class="site-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light">
				<a class="navbar-brand" href="<?php echo site_url('admin'); ?>"><i class="fa-solid fa-gauge-high"></i> Admin</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNav"><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="adminNav">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/products'); ?>"><i class="fa-solid fa-box"></i> Products</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/flavors'); ?>"><i class="fa-solid fa-ice-cream"></i> Flavors</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/orders'); ?>"><i class="fa-solid fa-truck"></i> Orders</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/blog'); ?>"><i class="fa-regular fa-newspaper"></i> Blog</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/finance'); ?>"><i class="fa-solid fa-chart-line"></i> Finance</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/chat'); ?>"><i class="fa-regular fa-comments"></i> Chat</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo site_url('admin/banners'); ?>"><i class="fa-regular fa-image"></i> Banners</a></li>
					</ul>
					<a class="btn btn-outline-pink" href="<?php echo site_url('logout'); ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
				</div>
			</nav>
			<div class="site-wrapper py-3">