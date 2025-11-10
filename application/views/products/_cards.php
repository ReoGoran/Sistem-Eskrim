<?php if(empty($products)): ?>
  <div class="col-12"><div class="alert alert-light">Belum ada produk.</div></div>
<?php else: ?>
  <?php foreach($products as $p): ?>
  <div class="col-md-3 mb-3">
    <div class="card h-100">
      <?php
        $img = isset($p->image) ? trim($p->image) : '';
        if(empty($img)){
            $src = base_url('public/assets/img/placeholder.png');
        } elseif(preg_match('#^https?://#i', $img)){
            $src = $img;
        } elseif(strpos($img, 'public/assets') !== false || substr($img,0,1) === '/'){
            $src = base_url(ltrim($img, '/'));
        } else {
            $src = base_url('public/assets/img/uploads/' . $img);
        }
      ?>
      <img src="<?php echo $src; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($p->name); ?>">
      <div class="card-body d-flex flex-column">
        <h6 class="card-title"><?php echo htmlspecialchars($p->name); ?></h6>
        <div class="mt-auto d-flex justify-content-between align-items-center">
          <span class="text-pink">Rp <?php echo number_format($p->price); ?></span>
          <a href="<?php echo site_url('products/'.$p->slug); ?>" class="btn btn-sm btn-outline-pink">Detail</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
<?php endif; ?>
