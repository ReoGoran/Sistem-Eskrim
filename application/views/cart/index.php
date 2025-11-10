<h4>Keranjang</h4>
<table class="table table-sm">
  <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
  <tbody>
    <?php $grand=0; foreach($items as $i): $sub=$i->price*$i->qty; $grand+=$sub; ?>
    <tr><td><?php echo $i->product_id; ?></td><td><?php echo $i->qty; ?></td><td>Rp <?php echo number_format($i->price); ?></td><td>Rp <?php echo number_format($sub); ?></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div class="mb-3">Subtotal: <strong>Rp <?php echo number_format($totals['subtotal']); ?></strong></div>
<div class="mb-3">Perkiraan Berat: <?php echo number_format($totals['weight'],2); ?> kg</div>
<a href="<?php echo site_url('checkout'); ?>" class="btn btn-pink">Checkout</a>