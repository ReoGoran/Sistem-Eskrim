<h4>Banners</h4>
<a href="<?php echo site_url('admin/banners/create'); ?>" class="btn btn-pink mb-2">Tambah Banner</a>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Title</th><th>Image</th><th>Active</th><th>Order</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($banners as $b): ?>
      <tr>
        <td><?php echo $b->id; ?></td>
        <td><?php echo $b->title; ?></td>
        <td><?php if($b->image): ?><img src="<?php echo $b->image; ?>" height="40"><?php endif; ?></td>
        <td><?php echo $b->is_active?'Ya':'Tidak'; ?></td>
        <td><?php echo $b->sort_order; ?></td>
        <td>
          <a class="btn btn-sm btn-outline-pink" href="<?php echo site_url('admin/banners/edit/'.$b->id); ?>">Edit</a>
          <form method="post" action="<?php echo site_url('admin/banners/delete'); ?>" style="display:inline-block;margin:0;padding:0;" onsubmit="return confirm('Hapus?')">
            <input type="hidden" name="id" value="<?php echo $b->id; ?>" />
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>