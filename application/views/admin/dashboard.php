<h4>Dashboard</h4>
<div class="row">
  <div class="col-md-4"><div class="card p-3"><h6>Today</h6><div>Revenue: Rp <?php echo number_format($sum_today['revenue']); ?></div><div>Expense: Rp <?php echo number_format($sum_today['expense']); ?></div><div>Profit: <strong class="<?php echo $sum_today['profit']>=0?'text-success':'text-danger'; ?>">Rp <?php echo number_format($sum_today['profit']); ?></strong></div></div></div>
  <div class="col-md-4"><div class="card p-3"><h6>7 Days</h6><div>Revenue: Rp <?php echo number_format($sum_week['revenue']); ?></div><div>Expense: Rp <?php echo number_format($sum_week['expense']); ?></div><div>Profit: <strong class="<?php echo $sum_week['profit']>=0?'text-success':'text-danger'; ?>">Rp <?php echo number_format($sum_week['profit']); ?></strong></div></div></div>
  <div class="col-md-4"><div class="card p-3"><h6>30 Days</h6><div>Revenue: Rp <?php echo number_format($sum_month['revenue']); ?></div><div>Expense: Rp <?php echo number_format($sum_month['expense']); ?></div><div>Profit: <strong class="<?php echo $sum_month['profit']>=0?'text-success':'text-danger'; ?>">Rp <?php echo number_format($sum_month['profit']); ?></strong></div></div></div>
</div>
<div class="card p-3 mt-3">
  <h6>Trend (14 hari)</h6>
  <div class="small text-muted">Tabel sederhana (grafik bisa ditambahkan dengan Chart.js)</div>
  <table class="table table-sm"><thead><tr><th>Tanggal</th><th>Revenue</th><th>Expense</th></tr></thead><tbody>
    <?php foreach($trend as $t): ?>
      <tr><td><?php echo $t->occurred_on; ?></td><td><?php echo number_format($t->rev); ?></td><td><?php echo number_format($t->exp); ?></td></tr>
    <?php endforeach; ?>
  </tbody></table>
</div>