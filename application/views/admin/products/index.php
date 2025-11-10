<h4>Products</h4>
<a href="<?php echo site_url('admin/products/create'); ?>" class="btn btn-pink mb-3">Tambah Produk</a>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Popular</th><th>Discount</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($products as $p): ?>
      <tr><td><?php echo $p->id; ?></td><td><?php echo $p->name; ?></td><td><?php echo number_format($p->price); ?></td><td><?php echo $p->stock; ?></td><td><?php echo $p->is_popular?'Ya':'Tidak'; ?></td><td><?php echo $p->is_discount?'Ya':'Tidak'; ?></td><td><a class="btn btn-sm btn-outline-pink" href="<?php echo site_url('admin/products/edit/'.$p->id); ?>">Edit</a> <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/products/delete/'.$p->id); ?>" onclick="return confirm('Hapus?')">Hapus</a></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>