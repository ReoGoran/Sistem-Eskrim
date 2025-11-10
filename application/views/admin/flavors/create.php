<h4>Tambah Flavor</h4>
<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
<?php if(!empty($upload_error)): ?><div class="alert alert-danger"><?php echo $upload_error; ?></div><?php endif; ?>
<?php echo form_open('admin/flavors/create', ['enctype'=>'multipart/form-data']); ?>
  <div class="form-row">
    <div class="form-group col-md-6"><label>Nama</label><input name="name" class="form-control" required></div>
    <div class="form-group col-md-6"><label>Gambar (opsional)</label><input type="file" name="image" class="form-control-file"></div>
  </div>
  <button class="btn btn-pink">Simpan</button>
<?php echo form_close(); ?>
