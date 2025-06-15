<?php
session_start();
include('server/conf.php');  
include('file/header.php');
?>

<style>
  .products-grid {
  max-width: 1200px;
  margin: 40px auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 30px;
}

.product-item {
  position: relative;
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.1);
  cursor: pointer;
  background: #fff;
}
.product-item img {
  width: 100%;
  height: 300px; 
  object-fit: cover;
  transition: filter 0.3s ease;
  display: block;
}


.product-item:hover img {
  filter: brightness(0.6);
}

.product-info {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  text-align: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  width: 90%;
  pointer-events: none;
}


.product-item:hover .product-info {
  opacity: 1;
  pointer-events: auto;
}

.product-info h5 {
  margin: 0 0 10px;
  font-size: 1.2rem;
  font-weight: 700;
  text-shadow: 0 0 8px rgba(0,0,0,0.8);
}


.product-info p {
  margin: 0 0 15px;
  font-size: 1rem;
  font-weight: 600;
  text-shadow: 0 0 6px rgba(0,0,0,0.7);
}


.product-info button {
  background-color: #CBA35C;
  border: none;
  padding: 10px 30px;
  border-radius: 30px;
  color: white;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(203,163,92,0.6);
  transition: background-color 0.3s ease;
}

.product-info button:hover {
  background-color: #a97d2a;
}
.bershka-hero {
  position: relative;
  width: 100%;
  height: 70vh;
  overflow: hidden;
}

.bershka-hero-slide {
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 70vh;
  background-size: cover;
  background-position: center;
  opacity: 0;
  transition: opacity 1s ease-in-out;
  display: flex;
  justify-content: center;
  align-items: center;
}

.bershka-hero-slide.active {
  opacity: 1;
  z-index: 1;
}

.bershka-hero-text {
  text-align: center;
  color: white;
  text-transform: lowercase;
}

.bershka-hero-text h2 {
  font-size: 3.5rem;
  font-weight: bold;
  margin: 0;
  letter-spacing: 2px;
}

.underscore {
  margin: 10px auto 0;
  width: 40px;
  height: 2px;
  background-color: white;
}




.products-container {
  margin: 40px auto;
  max-width: 1200px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}

.product-card {
  width: 220px;
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  text-align: center;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
}

.product-card:hover {
  transform: translateY(-5px);
}

.product-card img {
  width: 100%;
  height: 220px;
  object-fit: cover;
}

.product-info {
  padding: 15px;
}

.product-info h5 {
  margin: 10px 0 5px 0;
  font-size: 1.1rem;
  color: #333;
}

.product-info p {
  font-weight: bold;
  color: #CBA35C;
  margin-bottom: 10px;
}

.product-info a {
  display: inline-block;
  padding: 8px 15px;
  background-color: #CBA35C;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  font-weight: 600;
}

.product-info a:hover {
  background-color: #a88532;
}
.carousel-slide.active {
  position: relative;
  height: 400px; 
  background: none !important; 
  display: flex;
  align-items: center;
  justify-content: center;
}
.category-item h3 {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-weight: bold;
  padding: 10px 20px;
  border-radius: 4px;
  font-size: 1.1rem;
  margin: 0;
  text-align: center;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.small-images {
  display: flex;
  width: 100%;
  height: 100%;
  gap: 0;
}

.small-images img {
  width: 33.3333%;
  height: 100%;
  object-fit: cover;
  display: block;
  border-radius: 0;
}

.small-images img:not(:last-child) {
  border-right: 1px solid #ddd; 
}

.carousel-caption {
  position: absolute;
  bottom: 15px;
  right: 15px;
  color: white;
  font-size: 1.5rem;
  background-color: rgba(0,0,0,0.4);
  padding: 5px 10px;
  border-radius: 4px;
  pointer-events: none; 
}

.product-categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  border-top: 1px solid white;
  border-left: 1px solid white;
}

.category-item {
  border-right: 1px solid white;
  border-bottom: 1px solid white;
  position: relative;
  overflow: hidden;
  height: 240px;
}

.category-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease; 
}

.category-item:hover img {
  transform: scale(1.05); 
}



.category-item a {
  display: block;
  width: 100%;
  height: 100%;
  text-decoration: none;
  color: inherit;
}




.product-item {
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 6px 18px rgba(0,0,0,0.1);
  transition: box-shadow 0.25s ease;
  cursor: pointer;
}

.product-item:hover {
  box-shadow: 0 14px 40px rgba(0,0,0,0.15);
}

.product-link {
  color: #222;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.image-wrapper {
  position: relative;
  padding-top: 125%;
  overflow: hidden;
  border-bottom: 1px solid #eee;
}

.image-wrapper img {
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: filter 0.3s ease;
}


.product-item:hover .image-wrapper img {
  filter: brightness(0.85);
}


.view-btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(203, 163, 92, 0.85); 
  color: white;
  border: none;
  padding: 10px 25px;
  border-radius: 30px;
  font-weight: 600;
  font-size: 1rem;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
  cursor: pointer;
  box-shadow: 0 3px 8px rgba(203,163,92,0.6);
}


.product-item:hover .view-btn {
  opacity: 1;
  pointer-events: auto;
}

.product-details {
  padding: 15px 20px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.product-name {
  font-weight: 600;
  font-size: 1.1rem;
  margin: 0 0 8px 0;
  color: #222;
}

.product-price {
  font-weight: 700;
  font-size: 1rem;
  color: #CBA35C;
  margin: 0;
}


</style>
<div class="bershka-hero">
  <div class="bershka-hero-slide active" style="background-image: url('img/femme/lunet.1.jfif');">
    <div class="bershka-hero-text">
      <h2>accessoires</h2>
      <div class="underscore"></div>
    </div>
  </div>

  <div class="bershka-hero-slide" style="background-image: url('img/femme/nav.2.jpg');">
    <div class="bershka-hero-text">
      <h2>explorer</h2>
      <div class="underscore"></div>
    </div>
  </div>

  <div class="bershka-hero-slide" style="background-image: url('img/femme/téléchargement\ \(1\).jfif');">
    <div class="bershka-hero-text">
      <h2>nouveautés</h2>
      <div class="underscore"></div>
    </div>
  </div>
</div>


<script>
  const heroSlides = document.querySelectorAll('.bershka-hero-slide');
  let currentHero = 0;

  setInterval(() => {
    heroSlides[currentHero].classList.remove('active');
    currentHero = (currentHero + 1) % heroSlides.length;
    heroSlides[currentHero].classList.add('active');
  }, 5000); // تغيير كل 5 ثواني
</script>






<div class="product-categories-grid">
  <div class="category-item">
    <a href="?category=robes">
      <img src="img/femme/accse1.jpg" alt="Robes et Combinaisons">
      <h3>Accessoires</h3>
    </a>
  </div>
  <div class="category-item">
    <a href="?category=jeans">
      <img src="img/femme/téléchargement (1).jfif" alt="Jeans">
      <h3></h3>
    </a>
  </div>
  <div class="category-item">
    <a href="?category=tops">
      <img src="img/femme/short4.webp" alt="Tops et Bodies">
      <h3>Shorts</h3>
    </a>
  </div>
  <div class="category-item">
    <a href="?category=pantalons">
      <img src="img/femme/vest1.jpg" alt="Pantalons">
      <h3>vestes</h3>
    </a>
  </div>
<div class="category-item" style="width: 220px; margin: 10px;">
  <a href="?category=robes" style="text-decoration: none; color: inherit;">
    <video
      id="video-1"
      autoplay
      muted
      loop
      playsinline
      preload="metadata"
      poster="https://static.bershka.net/assets/public/65e2/f992/7c594d3facff/972cd6d2e925/00749710514-h1/poster.jpg?ts=1746794195196"
      style="width:95%; height: auto; border-radius: 5px;">
      متصفحك لا يدعم عرض الفيديو.
    </video>
    <h3 style="text-align: center; margin-top: 8px;">Robes</h3>
  </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
  const videoSrc = "https://static.bershka.net/assets/public/65e2/f992/7c594d3facff/972cd6d2e925/00749710514-h1/master.m3u8?ts=1746794195196";
  const video = document.getElementById("video-1");

  if (Hls.isSupported()) {
    const hls = new Hls();
    hls.loadSource(videoSrc);
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED, function() {
      video.play();
    });
  } else if (video.canPlayType("application/vnd.apple.mpegurl")) {
    video.src = videoSrc;
    video.addEventListener("loadedmetadata", function() {
      video.play();
    });
  } else {
    console.error("HLS غير مدعوم في هذا المتصفح.");
  }
</script>




  <div class="category-item">
    <a href="?category=jupes">
      <img src="img/femme/top1.jpg" alt="Jupes">
      <h3>Tops </h3>
    </a>
  </div>
</div>



<!-- product femme -->
<section class="products-grid">
  <?php
  
  $stmt = $conn->prepare("SELECT * FROM product WHERE product_category = ?");
  $category = "femme";
  $stmt->bind_param("s", $category);
  $stmt->execute();
  $products = $stmt->get_result();

  
  while($row = $products->fetch_assoc()) { ?>
    <div class="product-item">
      <img src="img/<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
      <div class="product-info">
        <h5 ><?php echo htmlspecialchars($row['product_name']); ?></h5>
        <p><?php echo htmlspecialchars($row['product_price']); ?> $</p>
        <button onclick="window.location.href='details.php?product_id=<?php echo $row['product_id']; ?>'">acheter</button>
      </div>
    </div>
  <?php } ?>
</section>



<?php include('file/footer.php'); ?>


