<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card p-4">
      <h4 class="mb-3">Login</h4>
  <?php if($this->session->flashdata('error')): ?><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div><?php endif; ?>
  <?php if($this->session->flashdata('success')): ?><div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div><?php endif; ?>
      <?php echo form_open('login'); ?>
        <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required></div>
        <button class="btn btn-pink btn-block">Masuk</button>
  <div class="mt-3">Belum punya akun? <a href="<?php echo site_url('register'); ?>">Daftar</a></div>
      <?php echo form_close(); ?>
      <?php if(!empty($debug)): ?>
        <div class="mt-3 alert alert-warning">
          <strong>Debug (dev only):</strong>
          <pre style="white-space: pre-wrap; word-break: break-word; font-size: 12px;"><?php echo htmlspecialchars(print_r($debug,true)); ?></pre>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>