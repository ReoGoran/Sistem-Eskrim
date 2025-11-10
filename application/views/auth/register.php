<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card p-4">
      <h4 class="mb-3">Daftar</h4>
      <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
      <?php echo form_open('register'); ?>
        <div class="form-row">
          <div class="form-group col-md-6"><label>Nama</label><input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" required></div>
          <div class="form-group col-md-6"><label>Email</label><input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" required></div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6"><label>No WhatsApp</label><input type="text" name="whatsapp" class="form-control" value="<?php echo set_value('whatsapp'); ?>" required></div>
          <div class="form-group col-md-6"><label>Password</label><input type="password" name="password" class="form-control" required></div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6"><label>Konfirmasi Password</label><input type="password" name="password_confirm" class="form-control" required></div>
          <div class="form-group col-md-6 d-flex align-items-end"><div class="text-muted small">Minimal 6 karakter</div></div>
        </div>
        <button class="btn btn-pink btn-block">Daftar</button>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>