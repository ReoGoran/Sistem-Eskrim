<h4>Edit Post</h4>
<form method="post">
  <div class="form-group"><label>Judul</label><input name="title" class="form-control" value="<?php echo $post->title; ?>" required></div>
  <div class="form-group"><label>Konten</label><textarea name="content" class="form-control" rows="6"><?php echo $post->content; ?></textarea></div>
  <div class="form-group"><label>Publish?</label> <input type="checkbox" name="is_published" value="1" <?php echo $post->is_published?'checked':''; ?>></div>
  <button class="btn btn-pink">Update</button>
</form>