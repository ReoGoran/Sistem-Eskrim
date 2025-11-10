<h4>Edit Flavor</h4>
<?php if(!empty($upload_error)): ?><div class="alert alert-danger"><?php echo $upload_error; ?></div><?php endif; ?>
<?php echo form_open('admin/flavors/edit/'.$flavor->id, ['enctype'=>'multipart/form-data']); ?>
  <div class="form-row">
    <div class="form-group col-md-6"><label>Nama</label><input name="name" class="form-control" value="<?php echo $flavor->name; ?>" required></div>
    <div class="form-group col-md-6"><label>Gambar</label><input type="file" name="image" class="form-control-file"> <?php if($flavor->image): ?><img src="<?php echo base_url(ltrim($flavor->image,'/')); ?>" height="50" class="ml-2 rounded"><?php endif; ?></div>
  </div>
  <button class="btn btn-pink">Simpan</button>
<?php echo form_close(); ?>
