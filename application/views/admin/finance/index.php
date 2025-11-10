<h4>Finance</h4>
<div class="row">
  <div class="col-md-5">
    <div class="card p-3 mb-3">
      <h6>Tambah Expense</h6>
      <form method="post">
        <div class="form-group"><label>Label</label><input name="label" class="form-control" required></div>
        <div class="form-group"><label>Amount</label><input name="amount" type="number" class="form-control" required></div>
        <div class="form-group"><label>Date</label><input name="occurred_on" type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"></div>
        <button class="btn btn-pink">Simpan</button>
      </form>
    </div>
    <div class="card p-3">
      <h6>Summary (7 hari)</h6>
      <div>Revenue: Rp <?php echo number_format($sum['revenue']); ?></div>
      <div>Expense: Rp <?php echo number_format($sum['expense']); ?></div>
      <div>Profit: <strong class="<?php echo $sum['profit']>=0?'text-success':'text-danger'; ?>">Rp <?php echo number_format($sum['profit']); ?></strong></div>
    </div>
  </div>
  <div class="col-md-7">
    <h6>Transaksi Terbaru</h6>
    <table class="table table-sm">
      <thead><tr><th>Tanggal</th><th>Label</th><th>Tipe</th><th>Amount</th></tr></thead>
      <tbody>
        <?php foreach($tx as $t): ?>
          <tr><td><?php echo $t->occurred_on; ?></td><td><?php echo $t->label; ?></td><td><?php echo $t->type; ?></td><td><?php echo number_format($t->amount); ?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>