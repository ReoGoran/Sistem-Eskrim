<h4>Edit Produk</h4>
<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<?php if(!empty($upload_error)): ?><div class="alert alert-danger"><?php echo $upload_error; ?></div><?php endif; ?>
<?php echo form_open('admin/products/edit/'.$product->id, ['enctype'=>'multipart/form-data']); ?>
  <div class="form-row">
  <div class="form-group col-md-6"><label>Nama Ice Cream</label><input name="name" class="form-control" value="<?php echo $product->name; ?>" required></div>
    <div class="form-group col-md-3"><label>Harga</label><input name="price" type="number" class="form-control" value="<?php echo $product->price; ?>" required></div>
    <div class="form-group col-md-3"><label>Stok</label><input name="stock" type="number" class="form-control" value="<?php echo $product->stock; ?>" required></div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6"><label>Rasa (boleh lebih dari satu)</label>
      <div class="border rounded p-2" style="max-height:180px;overflow:auto;">
        <?php if(!empty($flavors_all)): foreach($flavors_all as $f): $checked=in_array($f->id,$flavor_ids); ?>
          <div class="custom-control custom-checkbox mb-1">
            <input type="checkbox" class="custom-control-input" id="flavor_<?php echo $f->id; ?>" name="flavor_ids[]" value="<?php echo $f->id; ?>" <?php echo $checked?'checked':''; ?>>
            <label class="custom-control-label" for="flavor_<?php echo $f->id; ?>"><?php echo $f->name; ?></label>
          </div>
        <?php endforeach; else: ?>
          <small class="text-muted">Belum ada data rasa. Tambahkan di menu Admin > Flavors.</small>
        <?php endif; ?>
      </div>
    </div>
    <div class="form-group col-md-3"><label>Popular</label><input type="checkbox" name="is_popular" value="1" <?php echo $product->is_popular?'checked':''; ?>></div>
    <div class="form-group col-md-3"><label>Discount</label><input type="checkbox" name="is_discount" value="1" <?php echo $product->is_discount?'checked':''; ?>></div>
  </div>
  <div class="form-group"><label>Deskripsi</label><textarea name="description" class="form-control" rows="4"><?php echo $product->description; ?></textarea></div>
  <div class="form-group"><label>Gambar</label><input type="file" name="image" class="form-control-file"> <?php if($product->image): ?><img src="<?php echo $product->image; ?>" height="60"><?php endif; ?></div>
  <button class="btn btn-pink">Simpan</button>
<?php echo form_close(); ?>