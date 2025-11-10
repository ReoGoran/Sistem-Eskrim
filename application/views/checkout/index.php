<h4>Checkout</h4>
<div class="row">
  <div class="col-md-7">
    <form method="post">
      <div class="form-row">
        <div class="form-group col-md-6"><label>Nama Lengkap</label><input name="full_name" class="form-control" required></div>
        <div class="form-group col-md-6"><label>No Telepon</label><input name="phone" class="form-control" required></div>
      </div>
      <div class="form-group"><label>Alamat</label><input name="address_line" class="form-control" required></div>
      <div class="form-group"><label>Detail</label><input name="detail" class="form-control"></div>
      <div class="form-group">
        <label>Tag Lokasi</label>
        <select name="label" class="form-control"><option value="Home">Rumah</option><option value="Work">Kantor</option></select>
      </div>
      <div id="map" style="height:300px;" class="mb-2"></div>
      <input type="hidden" name="lat" id="lat"><input type="hidden" name="lng" id="lng">
      <button class="btn btn-pink">Buat Pesanan</button>
    </form>
  </div>
  <div class="col-md-5">
    <div class="card p-3">
      <div>Subtotal: <strong>Rp <?php echo number_format($totals['subtotal']); ?></strong></div>
      <?php $weight=ceil($totals['weight']); $shipping=$weight*SHIPPING_RATE_PER_KG; ?>
      <div>Ongkir (<?php echo $weight; ?> kg): <strong>Rp <?php echo number_format($shipping); ?></strong></div>
      <div>Total: <strong>Rp <?php echo number_format($totals['subtotal']+$shipping); ?></strong></div>
    </div>
  </div>
</div>
<script>
  var map = L.map('map').setView([-6.2,106.8], 11);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19}).addTo(map);
  var marker;
  function setPin(latlng){ if(marker) map.removeLayer(marker); marker=L.marker(latlng).addTo(map); document.getElementById('lat').value=latlng.lat; document.getElementById('lng').value=latlng.lng; }
  map.on('click', function(e){ setPin(e.latlng); });
</script>