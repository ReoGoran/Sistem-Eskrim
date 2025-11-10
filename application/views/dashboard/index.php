<!-- Old hero slider removed -->
<div class="hero-slider mb-4" id="mainHero">
  <div class="hero-track">
    <?php foreach($banners as $i=>$b): ?>
      <div class="hero-slide" data-index="<?php echo $i; ?>" style="background-image:url('<?php echo base_url(ltrim($b->image,'/')); ?>');">
        <div class="hero-slide-inner">
          <h2 class="hero-title"><?php echo $b->title; ?></h2>
          <?php if(!empty($b->link)): ?><a href="<?php echo site_url(ltrim($b->link,'/')); ?>" class="btn btn-gradient mt-3 shadow-hover">Lihat Detail</a><?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <!-- Slide tambahan diskon -->
    <div class="hero-slide" data-index="extra" style="background-image:url('<?php echo base_url('public/assets/img/uploads/banner_extra_discount.jpg'); ?>');">
      <div class="hero-slide-inner">
        <h2 class="hero-title">Flash Diskon Tambahan!</h2>
        <p class="lead mb-2">Campur rasa favoritmu & hemat lebih banyak.</p>
        <a href="<?php echo site_url('products?discount=1'); ?>" class="btn btn-pink shadow-hover">Belanja Diskon</a>
      </div>
    </div>
  </div>
  <div class="hero-dots"></div>
</div>
<h5 class="text-pink">Most Popular</h5>
<div class="row">
  <?php foreach($popular as $p): ?>
  <div class="col-md-3 mb-3">
    <div class="card h-100">
  <img src="<?php echo base_url(ltrim($p->image,'/')); ?>" class="card-img-top" alt="<?php echo $p->name; ?>">
      <div class="card-body">
        <h6 class="card-title"><?php echo $p->name; ?></h6>
        <p class="small text-muted mb-2">Rp <?php echo number_format($p->price); ?></p>
  <button class="btn btn-sm btn-pink btn-add-cart" data-id="<?php echo $p->id; ?>">Tambah ke Cart</button>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<h5 class="mt-4 text-pink">Flavors</h5>
<div class="h-scroll">
  <?php foreach($flavors as $f): ?><a class="badge badge-pink p-2" href="<?php echo site_url('products'); ?>?flavor=<?php echo urlencode($f->flavor); ?>"><?php echo ucfirst($f->flavor); ?></a><?php endforeach; ?>
</div>
<h5 class="mt-4 text-pink">Event Berbagi</h5>
<div class="row">
  <?php foreach($events as $e): ?>
    <div class="col-md-4 mb-3">
      <div class="card p-3">
        <h6><?php echo $e->title; ?></h6>
        <p class="small text-muted"><?php echo word_limiter(strip_tags($e->content),20); ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</div>