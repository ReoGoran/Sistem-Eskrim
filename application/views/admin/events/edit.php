<h4>Edit Event</h4>
<form method="post">
  <div class="form-group"><label>Title</label><input name="title" class="form-control" value="<?php echo $event->title; ?>" required></div>
  <div class="form-group"><label>Konten</label><textarea name="content" class="form-control" rows="5"><?php echo $event->content; ?></textarea></div>
  <div class="form-group"><label>Target Amount</label><input type="number" name="target_amount" class="form-control" value="<?php echo $event->target_amount; ?>"></div>
  <div class="form-group"><label>Active</label> <input type="checkbox" name="is_active" value="1" <?php echo $event->is_active?'checked':''; ?>></div>
  <button class="btn btn-pink">Update</button>
</form>