<!-- Old hero slider removed -->
<div class="hero-slider mb-4" id="mainHero">
  <div class="hero-track">
    <?php $totalSlides = count($banners) + 1; ?>
    <?php foreach($banners as $i=>$b): ?>
      <?php $index = $i + 1; ?>
      <div class="hero-slide" data-index="<?php echo $index; ?>" style="background-image:url('<?php echo base_url(ltrim($b->image,'/')); ?>');">
        <div class="hero-slide-inner">
          <span class="hero-badge">NEW MENU THIS MONTH</span>
          <h2 class="hero-title"><?php echo $b->title; ?></h2>
          <?php if(!empty($b->description)): ?><p class="lead mb-2"><?php echo $b->description; ?></p><?php endif; ?>
          <?php if(!empty($b->link)): ?><a href="<?php echo site_url(ltrim($b->link,'/')); ?>" class="btn btn-gradient mt-3 shadow-hover">Lihat Detail</a><?php endif; ?>
        </div>
        
      </div>
    <?php endforeach; ?>
    <!-- Slide tambahan diskon -->
  <div class="hero-slide" data-index="<?php echo $totalSlides; ?>" style="background-image:url('<?php echo base_url('public/assets/img/uploads/banner_extra_discount.jpg'); ?>');">
      <div class="hero-slide-inner">
        <span class="hero-badge">EXTRA</span>
        <h2 class="hero-title">Flash Diskon Tambahan!</h2>
        <p class="lead mb-2">Campur rasa favoritmu & hemat lebih banyak.</p>
        <a href="<?php echo site_url('products?discount=1'); ?>" class="btn btn-pink shadow-hover">Belanja Diskon</a>
      </div>
      
    </div>
  </div>
  <div class="hero-dots"></div>
</div>
<h5 class="text-pink">Most Popular</h5>
<div class="row" id="popularGrid">
  <?php foreach($popular as $p): ?>
  <div class="col-md-3 mb-3">
    <div class="card h-100">
  <?php
    // build image src robustly: support full URL, stored web path, or filename
    $img = isset($p->image) ? trim($p->image) : '';
    if(empty($img)){
        $src = base_url('public/assets/img/placeholder.png');
    } elseif(preg_match('#^https?://#i', $img)){
        $src = $img;
    } elseif(strpos($img, 'public/assets') !== false || substr($img,0,1) === '/'){
        $src = base_url(ltrim($img, '/'));
    } else {
        // assume it's a filename
        $src = base_url('public/assets/img/uploads/' . $img);
    }
  ?>
  <img src="<?php echo $src; ?>" class="card-img-top" alt="<?php echo $p->name; ?>">
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
  <?php foreach($flavors as $f): ?>
    <a class="flavor-item mr-2 mb-2" href="<?php echo site_url('products?flavor='.$f->slug); ?>" style="text-decoration:none;">
      <div class="flavor-thumb shadow-sm" style="width:72px;height:72px;border-radius:12px;overflow:hidden;position:relative;">
        <?php if(!empty($f->image)): ?><img src="<?php echo base_url(ltrim($f->image,'/')); ?>" alt="<?php echo $f->name; ?>" style="width:100%;height:100%;object-fit:cover;">
        <?php else: ?><div style="width:100%;height:100%;background:#f8f9fa;"></div><?php endif; ?>
      </div>
      <small class="d-block text-center mt-1 text-pink" style="width:72px;"><?php echo ucfirst($f->name); ?></small>
    </a>
  <?php endforeach; ?>
</div>
<script>
// Intercept flavor clicks on dashboard and fetch filtered products into #popularGrid
document.addEventListener('click', function(e){
  var a = e.target.closest('a'); if(!a) return;
  if(a.classList && a.classList.contains('flavor-item')){
    e.preventDefault();
    var href = a.getAttribute('href');
    // extract query part
    var q = href.indexOf('?')!==-1 ? href.substring(href.indexOf('?')) : '';
    var endpoint = '<?php echo site_url('products/ajax_list'); ?>' + q;
    fetch(endpoint, {credentials:'same-origin'})
      .then(function(res){ return res.text(); })
      .then(function(html){
        var tmp = document.createElement('div'); tmp.innerHTML = html;
        var cards = tmp.querySelectorAll('.col-md-3');
        var grid = document.getElementById('popularGrid');
        if(grid){ grid.innerHTML = ''; cards.forEach(function(c){ grid.appendChild(c); }); }
      }).catch(function(err){ console.error('Filter error', err); });
  }
});
</script>
<!-- Kategori Es Krim removed (reverted to previous layout) -->
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