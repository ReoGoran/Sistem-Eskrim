<h4>Review Moderation</h4>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Product</th><th>User</th><th>Rating</th><th>Comment</th><th>Approved</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($reviews as $r): ?>
      <tr><td><?php echo $r->id; ?></td><td><?php echo $r->product_id; ?></td><td><?php echo $r->user_id; ?></td><td><?php echo $r->rating; ?></td><td><?php echo html_escape(word_limiter($r->comment,15)); ?></td><td><?php echo $r->is_approved?'Ya':'Tidak'; ?></td><td>
        <?php if(!$r->is_approved): ?><a class="btn btn-sm btn-success" href="/admin/reviews/approve/<?php echo $r->id; ?>">Approve</a><?php endif; ?>
        <?php if($r->is_approved): ?><a class="btn btn-sm btn-warning" href="/admin/reviews/hide/<?php echo $r->id; ?>">Hide</a><?php endif; ?>
        <a class="btn btn-sm btn-danger" href="/admin/reviews/delete/<?php echo $r->id; ?>" onclick="return confirm('Hapus?')">Delete</a>
      </td></tr>
    <?php endforeach; ?>
  </tbody>
</table>