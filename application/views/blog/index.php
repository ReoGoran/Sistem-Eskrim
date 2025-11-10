<h4>Blog</h4>
<div class="row">
  <?php foreach($posts as $p): ?>
  <div class="col-md-4 mb-3"><div class="card p-3"><h6><a href="<?php echo site_url('blog/'.$p->slug); ?>"><?php echo $p->title; ?></a></h6><small class="text-muted"><?php echo $p->created_at; ?></small></div></div>
  <?php endforeach; ?>
</div>