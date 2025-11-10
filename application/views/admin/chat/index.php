<h4>Chat Pengguna</h4>
<div class="row">
  <div class="col-md-3">
    <div class="list-group mb-3">
      <?php foreach($users as $u): ?><a class="list-group-item list-group-item-action <?php echo $selected_user==$u->id?'active':''; ?>" href="/admin/chat?user_id=<?php echo $u->id; ?>"><?php echo $u->name; ?></a><?php endforeach; ?>
    </div>
  </div>
  <div class="col-md-9">
    <?php if($selected_user): ?>
    <div class="chat mb-3">
      <?php foreach($messages as $m): ?>
        <div class="msg <?php echo $m->sent_by=='admin'?'me':'other'; ?>"><?php echo nl2br(html_escape($m->message)); ?><div class="small text-muted mt-1"><?php echo $m->created_at; ?></div></div>
      <?php endforeach; ?>
    </div>
    <form method="post" class="d-flex mb-3">
      <input type="hidden" name="user_id" value="<?php echo $selected_user; ?>">
      <input type="text" name="message" class="form-control mr-2" placeholder="Balas..." required>
      <button class="btn btn-pink">Kirim</button>
    </form>
    <?php else: ?>
      <div class="alert alert-info">Pilih user untuk mulai chat.</div>
    <?php endif; ?>
  </div>
</div>