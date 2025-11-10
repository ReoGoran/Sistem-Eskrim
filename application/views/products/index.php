<?php
  // flavors should be provided by the controller; fall back to empty array if not set
  $flavors_bar = isset($flavors_bar) ? $flavors_bar : [];
  $currentFlavor = isset($currentFlavor) ? $currentFlavor : (isset($_GET['flavor'])?$_GET['flavor']:null);
?>
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
<div class="row" id="productGrid">
  <?php $this->load->view('products/_cards', ['products'=>$products]); ?>
</div>
<div id="productPagination">
  <?php $pages = ceil($total/$limit); if($pages>1): ?>
  <nav>
    <ul class="pagination">
      <?php for($i=1;$i<=$pages;$i++): $q=$_GET; $q['page']=$i; $qs=http_build_query($q); ?>
        <li class="page-item <?php echo $i==$page?'active':''; ?>"><a class="page-link" href="?<?php echo $qs; ?>"><?php echo $i; ?></a></li>
      <?php endfor; ?>
    </ul>
  </nav>
  <?php endif; ?>
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
<script>
document.addEventListener('click', function(e){
  // handle flavor badge clicks and pagination links
  var a = e.target.closest('a'); if(!a) return;
  if(a.matches('.flavor-item') || a.closest('.flavor-item')){
    e.preventDefault();
    var href = a.getAttribute('href');
    fetchFiltered(href);
  }
  if(a.matches('#productPagination .page-link')){
    e.preventDefault();
    var href = a.getAttribute('href');
    fetchFiltered(href);
  }
});

function fetchFiltered(href){
  // convert href to query string
  var url = href.indexOf('?')!==-1 ? href : (href + '') ;
  // compute full endpoint
  var endpoint = '<?php echo site_url('products/ajax_list'); ?>' + (url.indexOf('?')!==-1? url.substring(url.indexOf('?')) : '');
  fetch(endpoint, {credentials:'same-origin'})
    .then(function(r){ return r.text(); })
    .then(function(html){
      // split between cards and pagination if present
      var temp = document.createElement('div'); temp.innerHTML = html;
      // first, replace productGrid with first .col children
      var cards = temp.querySelectorAll('.col-md-3');
      var grid = document.getElementById('productGrid');
      if(grid){ grid.innerHTML = ''; cards.forEach(function(c){ grid.appendChild(c); }); }
      // replace pagination
      var pag = temp.querySelector('nav');
      var pagWrap = document.getElementById('productPagination');
      if(pagWrap){ pagWrap.innerHTML = pag? pag.outerHTML : ''; }
      // update URL
      if(history && history.pushState){ history.pushState({}, '', endpoint.replace('<?php echo site_url('products/ajax_list'); ?>','<?php echo site_url('products'); ?>')); }
    })
    .catch(function(err){ console.error('Filter error', err); });
}
</script>