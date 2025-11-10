<h4>Buat Banner</h4>
<form method="post" enctype="multipart/form-data">
  <div class="form-group"><label>Title</label><input name="title" class="form-control" required></div>
  <div class="form-group"><label>Link</label><input name="link" class="form-control"></div>
  <div class="form-group"><label>Image</label><input type="file" name="image" class="form-control-file"></div>
  <div class="form-group"><label>Active</label> <input type="checkbox" name="is_active" value="1" checked></div>
  <div class="form-group"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
  <button class="btn btn-pink">Simpan</button>
</form>