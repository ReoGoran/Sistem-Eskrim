</div><!-- /.site-wrapper content -->
<footer class="footer mt-5 text-center shadow-sm" style="width:100%">
  <div class="site-wrapper py-5">
    <small>&copy; <?php echo date('Y'); ?> IceScoop.</small>
    <div class="mt-2">
      <a href="<?php echo site_url('products'); ?>" class="text-pink mr-3"><i class="fa-solid fa-store"></i> Produk</a>
      <a href="<?php echo site_url('blog'); ?>" class="text-pink mr-3"><i class="fa-regular fa-newspaper"></i> Blog</a>
      <a href="<?php echo site_url('chat'); ?>" class="text-pink"><i class="fa-regular fa-comments"></i> Chat</a>
    </div>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="<?php echo base_url('public/assets/js/main.js'); ?>"></script>
<script>
// Hero slider autoplay & dots (5s interval)
(function(){
  var hero=document.getElementById('mainHero');
  if(!hero) return;
  var track=hero.querySelector('.hero-track');
  var slides=hero.querySelectorAll('.hero-slide');
  if(!track||!slides.length) return;
  var dotsWrap=hero.querySelector('.hero-dots');
  dotsWrap.innerHTML='';
  var dots=[];
  for(var i=0;i<slides.length;i++){var btn=document.createElement('button');(function(idx){btn.addEventListener('click',function(){goTo(idx);resetTimer();});})(i);dotsWrap.appendChild(btn);dots.push(btn);} 
  var index=0;
  function update(){track.style.transform='translateX('+(-index*100)+'%)';dots.forEach(function(d,i){d.classList.toggle('active',i===index);});}
  function goTo(i){index=(i+slides.length)%slides.length;update();}
  update();
  var timer=null;function resetTimer(){if(timer)clearInterval(timer);timer=setInterval(function(){goTo(index+1);},5000);}resetTimer();
})();
</script>
</body>
</html>