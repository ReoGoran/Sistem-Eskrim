// IceScoop main JS
(function(){
  // simple slider auto-scroll
  const slides = document.querySelectorAll('.hero-slide');
  const dotsContainer = document.querySelector('.hero-dots');
  if(slides.length){
    let idx=0;const interval=5000;
    slides.forEach((_,i)=>{const b=document.createElement('button');if(i===0)b.classList.add('active');dotsContainer.appendChild(b);b.addEventListener('click',()=>{idx=i;render();reset();});});
    function render(){slides.forEach((s,i)=>{s.style.transform=`translateX(${(i-idx)*100}%)`;dotsContainer.children[i].classList.toggle('active',i===idx);});}
    function next(){idx=(idx+1)%slides.length;render();}
    function reset(){clearInterval(timer);timer=setInterval(next,interval);}    
    let timer=setInterval(next,interval);render();
  }

  // helper build url
  function u(p){return (window.SITE_URL||'/')+p.replace(/^\//,'');}

  // polling notifications
  function pollNotifications(){
    fetch(u('notifications/pull')).then(r=>r.json()).then(data=>{
      const badge=document.querySelector('.notif-badge');
      if(badge){badge.textContent=data.count;badge.style.display=data.count>0?'inline-block':'none';}
    }).catch(()=>{});
  }
  setInterval(pollNotifications, 8000);
  pollNotifications();

  // add to cart
  document.addEventListener('click', function(e){
    if(e.target.matches('.btn-add-cart')){
      const id=e.target.dataset.id;
      fetch(u('cart/add/'+id),{method:'POST',headers:{'X-Requested-With':'XMLHttpRequest'}})
        .then(r=>r.json()).then(data=>{if(data.success){e.target.classList.add('added');e.target.textContent='Ditambahkan';}});
    }
  });
})();