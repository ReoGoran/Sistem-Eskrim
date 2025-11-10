<h4>Tracking Order <?php echo $order->order_code; ?></h4>
<div class="timeline my-3">
  <?php foreach($history as $h): ?>
    <div class="item"><div class="ml-4"><strong><?php echo $h->status; ?></strong> <small class="text-muted"><?php echo $h->created_at; ?></small></div></div>
  <?php endforeach; ?>
</div>
<table class="table table-sm">
  <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th></tr></thead>
  <tbody>
    <?php foreach($items as $i): ?>
    <tr><td><?php echo $i->name; ?></td><td><?php echo $i->qty; ?></td><td>Rp <?php echo number_format($i->price); ?></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div>Status Saat Ini: <strong><?php echo $order->status; ?></strong></div>