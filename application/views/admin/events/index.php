<h4>Events</h4>
<a href="/admin/events/create" class="btn btn-pink mb-2">Tambah Event</a>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Title</th><th>Target</th><th>Collected</th><th>Active</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($events as $e): ?>
      <tr><td><?php echo $e->id; ?></td><td><?php echo $e->title; ?></td><td><?php echo number_format($e->target_amount); ?></td><td><?php echo number_format($e->collected_amount); ?></td><td><?php echo $e->is_active?'Ya':'Tidak'; ?></td><td><a class="btn btn-sm btn-outline-pink" href="/admin/events/edit/<?php echo $e->id; ?>">Edit</a> <a class="btn btn-sm btn-danger" href="/admin/events/delete/<?php echo $e->id; ?>" onclick="return confirm('Hapus?')">Hapus</a></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>