<h4>Buat Banner</h4>
<form method="post" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
  <div class="form-group"><label>Header / Caption</label><input name="title" class="form-control" placeholder="Ringkas, contoh: Super Delicious" required></div>
  <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat di bawah judul"></textarea></div>
  <div class="form-group"><label>Link</label><input name="link" class="form-control"></div>
  <div class="form-group"><label>Image</label><input type="file" name="image" class="form-control-file"></div>
  <div class="form-group"><label>Active</label> <input type="checkbox" name="is_active" value="1" checked></div>
  <div class="form-group"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
  <button class="btn btn-pink">Simpan</button>
</form>