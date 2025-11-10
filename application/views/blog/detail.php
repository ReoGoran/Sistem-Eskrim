<article class="card p-3">
  <h3 class="text-pink"><?php echo $post->title; ?></h3>
  <div class="text-muted mb-2"><?php echo $post->created_at; ?></div>
  <div><?php echo $post->content; ?></div>
</article>