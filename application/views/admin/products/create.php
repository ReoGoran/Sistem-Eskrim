<h4>Buat Produk</h4>
<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<?php if(!empty($upload_error)): ?><div class="alert alert-danger"><?php echo $upload_error; ?></div><?php endif; ?>
<?php echo form_open('admin/products/create', ['enctype'=>'multipart/form-data']); ?>
  <div class="form-row">
  <div class="form-group col-md-6"><label>Nama Ice Cream</label><input name="name" class="form-control" value="<?php echo set_value('name'); ?>" required></div>
    <div class="form-group col-md-3"><label>Harga</label><input name="price" type="number" class="form-control" value="<?php echo set_value('price'); ?>" required></div>
    <div class="form-group col-md-3"><label>Stok</label><input name="stock" type="number" class="form-control" value="<?php echo set_value('stock'); ?>" required></div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6"><label>Rasa (boleh lebih dari satu)</label>
      <div class="border rounded p-2" style="max-height:180px;overflow:auto;">
        <?php if(!empty($flavors)): foreach($flavors as $f): ?>
          <div class="custom-control custom-checkbox mb-1">
            <input type="checkbox" class="custom-control-input" id="flavor_<?php echo $f->id; ?>" name="flavor_ids[]" value="<?php echo $f->id; ?>">
            <label class="custom-control-label" for="flavor_<?php echo $f->id; ?>"><?php echo $f->name; ?></label>
          </div>
        <?php endforeach; else: ?>
          <small class="text-muted">Belum ada data rasa. Tambahkan di menu Admin > Flavors.</small>
        <?php endif; ?>
      </div>
    </div>
    <div class="form-group col-md-3"><label>Popular</label><input type="checkbox" name="is_popular" value="1" <?php echo set_checkbox('is_popular','1'); ?>></div>
    <div class="form-group col-md-3"><label>Discount</label><input type="checkbox" name="is_discount" value="1" <?php echo set_checkbox('is_discount','1'); ?>></div>
  </div>
  <div class="form-group"><label>Deskripsi</label><textarea name="description" class="form-control" rows="4"><?php echo set_value('description'); ?></textarea></div>
  <div class="form-group"><label>Gambar</label><input type="file" name="image" class="form-control-file"></div>
  <button class="btn btn-pink">Simpan</button>
<?php echo form_close(); ?>