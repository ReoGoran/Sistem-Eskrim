<?php $this->load->model('Flavor_model'); $flavors_bar = $this->Flavor_model->all(); $currentFlavor = $this->input->get('flavor'); ?>
<div class="mb-3">
  <div class="d-flex flex-wrap flavor-bar mb-2">
    <?php foreach($flavors_bar as $f): ?>
      <a href="<?php echo site_url('products?flavor='.$f->slug); ?>" class="flavor-item mr-2 mb-2 <?php echo $currentFlavor==$f->slug?'active':''; ?>" style="text-decoration:none;">
        <div class="flavor-thumb shadow-sm" style="width:72px;height:72px;border-radius:12px;overflow:hidden;position:relative;">
          <?php if($f->image): ?><img src="<?php echo base_url(ltrim($f->image,'/')); ?>" alt="<?php echo $f->name; ?>" style="width:100%;height:100%;object-fit:cover;"><?php endif; ?>
          <?php if($currentFlavor==$f->slug): ?><div style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(255,0,128,0.35);"></div><?php endif; ?>
        </div>
        <small class="d-block text-center mt-1 text-pink" style="width:72px;"><?php echo $f->name; ?></small>
      </a>
    <?php endforeach; ?>
    <a href="<?php echo site_url('products'); ?>" class="flavor-item mr-2 mb-2" style="text-decoration:none;">
      <div class="flavor-thumb shadow-sm d-flex align-items-center justify-content-center" style="width:72px;height:72px;border-radius:12px;background:#f8f9fa;">
        <span class="text-pink" style="font-size:11px;font-weight:600;">Semua</span>
      </div>
      <small class="d-block text-center mt-1" style="width:72px;">Reset</small>
    </a>
  </div>
  <form class="form-inline" method="get">
    <input type="hidden" name="flavor" value="<?php echo html_escape($currentFlavor); ?>">
    <input type="text" name="q" class="form-control mr-2" placeholder="Cari..." value="<?php echo html_escape($this->input->get('q')); ?>">
    <select name="sort" class="form-control mr-2">
      <option value="">Terbaru</option>
      <option value="price_asc" <?php echo $this->input->get('sort')=='price_asc'?'selected':'';?>>Harga: Murah→Mahal</option>
      <option value="price_desc" <?php echo $this->input->get('sort')=='price_desc'?'selected':'';?>>Harga: Mahal→Murah</option>
    </select>
    <button class="btn btn-outline-pink">Filter</button>
  </form>
</div>
<div class="row">
  <?php foreach($products as $p): ?>
  <div class="col-md-3 mb-3">
    <div class="card h-100">
  <img src="<?php echo base_url(ltrim($p->image,'/')); ?>" class="card-img-top" alt="<?php echo $p->name; ?>">
      <div class="card-body d-flex flex-column">
        <h6 class="card-title"><?php echo $p->name; ?></h6>
        <div class="mt-auto d-flex justify-content-between align-items-center">
          <span class="text-pink">Rp <?php echo number_format($p->price); ?></span>
          <a href="<?php echo site_url('products/detail/'.$p->id); ?>" class="btn btn-sm btn-pink">Detail</a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php $pages = ceil($total/$limit); if($pages>1): ?>
<nav>
  <ul class="pagination">
    <?php for($i=1;$i<=$pages;$i++): $q=$_GET; $q['page']=$i; $qs=http_build_query($q); ?>
      <li class="page-item <?php echo $i==$page?'active':''; ?>"><a class="page-link" href="?<?php echo $qs; ?>"><?php echo $i; ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>
<?php endif; ?>