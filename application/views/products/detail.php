<div class="row">
  <div class="col-md-5">
  <img src="<?php echo base_url(ltrim($product->image,'/')); ?>" class="product-img-cover" alt="<?php echo $product->name; ?>">
  </div>
  <div class="col-md-7">
    <h3 class="text-pink"><?php echo $product->name; ?></h3>
    <p><?php echo nl2br(html_escape($product->description)); ?></p>
    <div class="mb-3">Harga: <strong>Rp <?php echo number_format($product->price); ?></strong></div>
    <button class="btn btn-pink btn-add-cart" data-id="<?php echo $product->id; ?>">Tambah ke Cart</button>
    <hr>
    <h6>Review</h6>
  <form method="post" action="<?php echo site_url('reviews/store'); ?>">
      <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
      <div class="form-group">
        <label>Rating</label>
        <select name="rating" class="form-control" required>
          <option value="5">★★★★★</option>
          <option value="4">★★★★</option>
          <option value="3">★★★</option>
          <option value="2">★★</option>
          <option value="1">★</option>
        </select>
      </div>
      <div class="form-group"><label>Komentar</label><textarea name="comment" class="form-control" rows="3"></textarea></div>
      <button class="btn btn-outline-pink">Kirim</button>
    </form>
    <div class="mt-3">
      <?php foreach($reviews as $r): ?>
        <div class="border rounded p-2 mb-2"><strong><?php echo $r->rating; ?>/5</strong><div><?php echo nl2br(html_escape($r->comment)); ?></div></div>
      <?php endforeach; ?>
    </div>
  </div>
</div>