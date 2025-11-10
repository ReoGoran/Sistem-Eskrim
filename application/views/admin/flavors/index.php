<h4>Flavors</h4>
<a href="<?php echo site_url('admin/flavors/create'); ?>" class="btn btn-pink mb-3">Tambah Flavor</a>
<table class="table table-sm">
  <thead><tr><th>Gambar</th><th>Nama</th><th>Slug</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($flavors as $f): ?>
      <tr>
        <td><?php if($f->image): ?><img src="<?php echo base_url(ltrim($f->image,'/')); ?>" height="40"><?php endif; ?></td>
        <td><?php echo $f->name; ?></td>
        <td><code><?php echo $f->slug; ?></code></td>
        <td>
          <a class="btn btn-sm btn-outline-pink" href="<?php echo site_url('admin/flavors/edit/'.$f->id); ?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/flavors/delete/'.$f->id); ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
