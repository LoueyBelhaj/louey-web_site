<?php
include('file/header.php');
?>
<style>
  #banner {
  background-image: url("img/banner/2.jpg");
  width: 100%;
  height: 75vh;
  background-size: cover;
  background-position: center top 70px;
  background-repeat: no-repeat;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  padding-left: 50px;
  position: relative;
  cursor: pointer;
}

#banner h4,
#banner h1,
#banner button {
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
  margin: 0;
}

#banner:hover h4,
#banner:hover h1,
#banner:hover button {
  opacity: 1;
  pointer-events: auto;
}

#banner h4 {
  color: #123524;
  font-weight: 400;
  font-size: 1.2rem;
  margin-bottom: 10px;
}

#banner h1 {
  color: #fff;
  font-weight: 700;
  font-size: 3.5rem;
  margin-bottom: 20px;
}

#banner button {
  background-color: #CBA35C;
  border: none;
  padding: 12px 30px;
  font-weight: 700;
  border-radius: 4px;
  cursor: pointer;
  text-transform: uppercase;
}
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
  }

  .carousel-container {
    width: 100vw;
    height: 450px; 
    position: relative;
    overflow: hidden;
  }

  .carousel-container a {
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
  }

  .slide {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0;
    transition: opacity 1s ease-in-out;
    filter: brightness(97%);
    .slide {
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  filter: brightness(1); 
  image-rendering: auto; 

}

  }

  .slide.active {
    opacity: 1;
    z-index: 1;
  }

  .slide1 {
    background-image: url('img/homme/images (1).jfif');
  }

  .slide2 {
    background-image: url('img/homme/images (2).jfif');
  }
  /* Carousel wrapper */
.carousel {
  position: relative;
  max-width: 100%;
  height: 90vh;
  overflow: hidden;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Slides */
.carousel-slide {
  position: absolute;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  opacity: 0;
  transition: opacity 1s ease-in-out;
  cursor: pointer;
  .carousel-slide {
  display: block; 
  width: 100%;
  height: 400px;
  background-size: cover;
  background-position: center;
  position: relative;
  text-decoration: none; 
  color: inherit; 
}

}

.carousel-slide.active {
  opacity: 1;
  z-index: 1;
}

/* Overlay content */
.carousel-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  text-align: center;
  z-index: 2;
  text-shadow: 0 3px 10px rgba(0,0,0,0.6);
}

.carousel-overlay h2 {
  font-size: 3.5rem;
  margin-bottom: 1rem;
  font-weight: 700;
  letter-spacing: 2px;
}

.carousel-overlay a.btn {
  padding: 14px 40px;
  background-color: #cba35c;
  color: #000;
  font-weight: 700;
  text-transform: uppercase;
  border-radius: 6px;
  text-decoration: none;
  display: inline-block;
  transition: background-color 0.3s ease;
}

.carousel-overlay a.btn:hover {
  background-color: #b38e40;
}

/* Navigation arrows */
.carousel-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,255,255,0.7);
  border-radius: 50%;
  width: 45px;
  height: 45px;
  line-height: 45px;
  text-align: center;
  font-size: 2rem;
  font-weight: bold;
  color: #000;
  cursor: pointer;
  user-select: none;
  transition: background-color 0.3s ease;
  z-index: 3;
}
.carousel-arrow:hover {
  background: rgba(255,255,255,0.9);
}

.carousel-arrow.left {
  left: 20px;
}
.carousel-arrow.right {
  right: 20px;
}

.carousel-dots {
  position: absolute;
  bottom: 20px;
  width: 100%;
  text-align: center;
  z-index: 3;
}
.carousel-dot {
  display: inline-block;
  width: 14px;
  height: 14px;
  margin: 0 6px;
  background-color: rgba(255,255,255,0.5);
  border-radius: 50%;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.carousel-dot.active {
  background-color: #cba35c;
}

/* Responsive */
@media (max-width: 768px) {
  .carousel-overlay h2 {
    font-size: 2rem;
  }
  .carousel-arrow {
    width: 35px;
    height: 35px;
    line-height: 35px;
    font-size: 1.5rem;
  }
}

.social-section {
  background: #f4f4f4;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
}

.social-section h2 {
  font-size: 2rem;
  font-weight: bold;
  color: #333;
}

.social-section p {
  font-size: 1.1rem;
  color: #666;
}

.social-section .btn {
  padding: 10px 25px;
  font-size: 1rem;
  border-radius: 25px;
  transition: all 0.3s ease;
}

.social-section .btn:hover {
  background-color: #000;
  color: #fff;
}


</style>

<section class="carousel" aria-label="Carrousel de promotion">
  <a href="pd_homme.php" class="carousel-slide active" style="background-image: url('img/femme/short4.webp');" tabindex="0" role="group" aria-roledescription="slide" aria-label="Nouvelle collection">
    <div class="carousel-overlay">
      <h2>NOUVELLE COLLECTION</h2>
    </div>
  </a>

  <a href="pd_homme.php" class="carousel-slide" style="background-image: url('img/homme/images (2).jfif');" tabindex="0" role="group" aria-roledescription="slide" aria-label="Style Homme">
    <div class="carousel-overlay">
      <h2>STYLE HOMME</h2>
    </div>
  </a>

  <a href="pd_homme.php" class="carousel-slide" style="background-image: url('img/homme/images (1).jfif');" tabindex="0" role="group" aria-roledescription="slide" aria-label="Accessoires Chic">
    <div class="carousel-overlay">
      <h2>ACCESSOIRES CHIC</h2>
    </div>
  </a>

  <!-- Navigation -->
  <div class="carousel-arrow left" role="button" aria-label="Slide précédent" tabindex="0">&#10094;</div>
  <div class="carousel-arrow right" role="button" aria-label="Slide suivant" tabindex="0">&#10095;</div>

  <!-- Dots -->
  <div class="carousel-dots" role="tablist" aria-label="Navigation par points">
    <span class="carousel-dot active" role="tab" aria-selected="true" tabindex="0" aria-controls="slide1"></span>
    <span class="carousel-dot" role="tab" aria-selected="false" tabindex="-1" aria-controls="slide2"></span>
    <span class="carousel-dot" role="tab" aria-selected="false" tabindex="-1" aria-controls="slide3"></span>
  </div>
</section>


<script>(() => {
  const slides = document.querySelectorAll('.carousel-slide');
  const dots = document.querySelectorAll('.carousel-dot');
  const leftArrow = document.querySelector('.carousel-arrow.left');
  const rightArrow = document.querySelector('.carousel-arrow.right');
  let current = 0;
  let interval;

  function setActiveSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
      slide.setAttribute('aria-hidden', i !== index);
    });
    dots.forEach((dot, i) => {
      dot.classList.toggle('active', i === index);
      dot.setAttribute('aria-selected', i === index);
      dot.tabIndex = i === index ? 0 : -1;
    });
    current = index;
  }

  function nextSlide() {
    setActiveSlide((current + 1) % slides.length);
  }

  function prevSlide() {
    setActiveSlide((current - 1 + slides.length) % slides.length);
  }

  // Auto slide
  function startAutoSlide() {
    interval = setInterval(nextSlide, 5000);
  }

  function stopAutoSlide() {
    clearInterval(interval);
  }

  // Event listeners
  rightArrow.addEventListener('click', () => {
    stopAutoSlide();
    nextSlide();
    startAutoSlide();
  });
  leftArrow.addEventListener('click', () => {
    stopAutoSlide();
    prevSlide();
    startAutoSlide();
  });

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      stopAutoSlide();
      setActiveSlide(i);
      startAutoSlide();
    });
    dot.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        stopAutoSlide();
        setActiveSlide(i);
        startAutoSlide();
      }
    });
  });

  // Keyboard navigation for arrows
  [leftArrow, rightArrow].forEach(arrow => {
    arrow.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        arrow.click();
      }
    });
  });

  // Initialize
  setActiveSlide(0);
  startAutoSlide();
})();
</script>
<section class="social-section text-center py-5">
  <div class="container">
    <h2 class="mb-3">Inspire-toi de notre galerie</h2>
    <p class="lead">Partage tes looks avec <strong>catcy99</strong> et <strong>catchystyle</strong></p>
    <a href="https://www.instagram.com/bershka" target="_blank" class="btn btn-dark mt-3">Voir sur Instagram</a>
  </div>
</section>



<section id="banner" class="my-5 py-5" style="cursor:pointer;" onclick="window.location.href='pd_famme.php';">
  <div class="container">
    <h4>Découvrez nos offres</h4>
    <h1>Vêtements pour femmes</h1>
    <button class="text-uppercase">Nouveau</button>
  </div>
</section>



  <script>
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;

    function showNextSlide() {
      slides[currentIndex].classList.remove('active');
      currentIndex = (currentIndex + 1) % slides.length;
      slides[currentIndex].classList.add('active');
    }

    setInterval(showNextSlide, 4000);
  </script>
</body>






<div class="footer_container" style="width: 100%; padding: 40px 20px; background-color: #f8f8f8; box-shadow: 0 -2px 10px rgba(0,0,0,0.05);">
  <h3 style="text-align: center; margin-bottom: 20px; font-size: 24px; font-weight: 600;">📍 Retrouvez-nous ici</h3>
  
  <div class="google_maps" style="width: 100%; max-width: 100%; height: 400px; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3192.0950557549036!2d10.166426999999999!3d36.8641435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12e2cdb01e9e7d01%3A0x5bad5f3fbb4d5911!2sCatchy%2099!5e0!3m2!1sfr!2stn!4v1742261027190!5m2!1sfr!2stn" 
      width="100%" 
      height="100%" 
      style="border:0;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</div>



  


<?php
include('./file/footer.php');
?>