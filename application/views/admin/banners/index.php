<h4>Banners</h4>
<a href="/admin/banners/create" class="btn btn-pink mb-2">Tambah Banner</a>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Title</th><th>Image</th><th>Active</th><th>Order</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($banners as $b): ?>
      <tr><td><?php echo $b->id; ?></td><td><?php echo $b->title; ?></td><td><?php if($b->image): ?><img src="<?php echo $b->image; ?>" height="40"><?php endif; ?></td><td><?php echo $b->is_active?'Ya':'Tidak'; ?></td><td><?php echo $b->sort_order; ?></td><td><a class="btn btn-sm btn-outline-pink" href="/admin/banners/edit/<?php echo $b->id; ?>">Edit</a> <a class="btn btn-sm btn-danger" href="/admin/banners/delete/<?php echo $b->id; ?>" onclick="return confirm('Hapus?')">Hapus</a></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>