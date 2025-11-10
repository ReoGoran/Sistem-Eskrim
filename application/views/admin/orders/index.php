<h4>Orders</h4>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Code</th><th>User</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($orders as $o): ?>
      <tr><td><?php echo $o->id; ?></td><td><?php echo $o->order_code; ?></td><td><?php echo $o->user_id; ?></td><td>Rp <?php echo number_format($o->total); ?></td><td><?php echo $o->status; ?></td><td><a class="btn btn-sm btn-outline-pink" href="/admin/orders/view/<?php echo $o->id; ?>">Detail</a></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>