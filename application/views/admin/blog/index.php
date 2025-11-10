<h4>Blog Posts</h4>
<a href="/admin/blog/create" class="btn btn-pink mb-2">Tambah Post</a>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Judul</th><th>Published</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($posts as $p): ?>
      <tr><td><?php echo $p->id; ?></td><td><?php echo $p->title; ?></td><td><?php echo $p->is_published?'Ya':'Tidak'; ?></td><td><a class="btn btn-sm btn-outline-pink" href="/admin/blog/edit/<?php echo $p->id; ?>">Edit</a> <a class="btn btn-sm btn-danger" href="/admin/blog/delete/<?php echo $p->id; ?>" onclick="return confirm('Hapus?')">Hapus</a></td></tr>
    <?php endforeach; ?>
  </tbody>
</table>