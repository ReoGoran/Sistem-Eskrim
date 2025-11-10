<h4>Order #<?php echo $order->id; ?> - <?php echo $order->order_code; ?></h4>
<div class="row">
  <div class="col-md-6">
    <div class="card p-3">
      <div>Total: <strong>Rp <?php echo number_format($order->total); ?></strong></div>
      <div>Status: <strong><?php echo $order->status; ?></strong></div>
      <form method="post" action="/admin/orders/status/<?php echo $order->id; ?>" class="mt-2 form-inline">
        <select name="status" class="form-control mr-2">
          <?php foreach(['Placed','Processed','Shipped','Out for delivery','Delivered','Cancelled'] as $s): ?>
            <option value="<?php echo $s; ?>" <?php echo $order->status==$s?'selected':''; ?>><?php echo $s; ?></option>
          <?php endforeach; ?>
        </select>
        <button class="btn btn-pink">Update</button>
      </form>
    </div>
    <div class="card p-3 mt-3">
      <h6>History</h6>
      <ul class="mb-0">
      <?php foreach($history as $h): ?><li><?php echo $h->status; ?> <small class="text-muted"><?php echo $h->created_at; ?></small></li><?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="col-md-6">
    <h6>Items</h6>
    <table class="table table-sm">
      <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th></tr></thead>
      <tbody>
        <?php foreach($items as $i): ?><tr><td><?php echo $i->name; ?></td><td><?php echo $i->qty; ?></td><td>Rp <?php echo number_format($i->price); ?></td></tr><?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>