<h4>Chat Admin</h4>
<div class="chat mb-3">
  <?php foreach($messages as $m): ?>
    <div class="msg <?php echo $m->sent_by=='user'?'me':'other'; ?>"><?php echo nl2br(html_escape($m->message)); ?><div class="small text-muted mt-1"><?php echo $m->created_at; ?></div></div>
  <?php endforeach; ?>
</div>
<form method="post" class="d-flex">
  <input type="text" name="message" class="form-control mr-2" placeholder="Tulis pesan..." required>
  <button class="btn btn-pink">Kirim</button>
</form>