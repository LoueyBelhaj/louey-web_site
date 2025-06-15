<?php
include('server/conf.php');    // Connexion à la base de données
include('file/header.php');    // Fichier du header

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Récupérer les données du produit selon l'identifiant
    $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $product_name = $product['product_name'];
        $product_category = $product['product_category'];
    } else {
        // Si le produit n'existe pas, retourner à la page d'accueil
        header("Location: index.php");
        exit();
    }

    // Récupérer les produits similaires avec le même nom et catégorie en excluant le produit actuel
    $stmt_related = $conn->prepare("SELECT * FROM product 
        WHERE product_name = ? AND product_category = ? AND product_id != ? 
        ORDER BY product_id DESC LIMIT 6");
    $stmt_related->bind_param("ssi", $product_name, $product_category, $product_id);
    $stmt_related->execute();
    $related_products = $stmt_related->get_result();

} else {
    // Si l'identifiant du produit est absent du lien, retourner à la page d'accueil
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Détails du produit</title>
  <style>
    /* Styles généraux */
    .sproduct {
      max-width: 1200px; 
      margin: auto; 
      font-family: Arial, sans-serif;
    }

    #mainImg {
      width: 100%;
      height: 500px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Images miniatures */
    .small-img-group {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-top: 10px;
    }
    .small-img-col {
      flex: 1;
      max-width: 23%;
    }
    .small-img {
      width: 100%;
      height: 90px;
      object-fit: cover;
      border-radius: 8px;
      cursor: pointer;
      border: 2px solid transparent;
      transition: border-color 0.3s ease;
    }
    .small-img:hover,
    .small-img.active {
      border-color: #CBA35C;
    }

    /* Boutons d'achat */
    .buy-btn {
      background-color: #CBA35C;
      border: none;
      padding: 12px 25px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      border-radius: 6px;
      margin-top: 15px;
    }
    .buy-btn:hover {
      background-color: #b88d45;
    }

    /* Mise en forme de la section des produits similaires */
    #featured .product {
      margin-bottom: 30px;
    }
    #featured .product img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 10px;
    }
    #featured .buy-btn {
      margin-top: 10px;
    }

    /* Mise en forme du texte */
    h6 {
      color: #555;
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 5px;
    }
    h3 {
      font-size: 28px;
      margin-bottom: 10px;
    }
    p.description {
      font-style: italic;
      color: #666;
      font-size: 16px;
      margin-top: -5px;
      margin-bottom: 25px;
      line-height: 1.4;
    }
    h2 {
      color: #CBA35C;
      font-weight: 700;
      font-size: 32px;
      margin-bottom: 20px;
    }

    /* Formulaire pour taille et quantité */
    form {
      max-width: 300px;
      margin-top: 20px;
    }

    form div {
      margin-bottom: 12px;
    }

    form label {
      font-weight: 600;
      display: block;
      margin-bottom: 4px;
      font-size: 14px;
    }

    select, input[type="number"] {
      width: 100%;
      padding: 6px 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
      cursor: pointer;
      transition: border-color 0.3s ease;
    }

    select:focus, input[type="number"]:focus {
      outline: none;
      border-color: #CBA35C;
    }
    p.description {
      font-style: normal;
      color: black;
      font-size: 16px;
      margin-top: -5px;
      margin-bottom: 25px;
      line-height: 1.4;
    }
  </style>
</head>
<body>

<section class="container sproduct my-5 pt-5">
  <div class="row mt-5">
    <!-- Section des images du produit -->
    <div class="col-lg-5 col-md-12 col-12">
      <img id="mainImg" src="img/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Image principale">

      <div class="small-img-group">
        <div class="small-img-col"><img class="small-img active" src="img/<?php echo htmlspecialchars($product['product_image']); ?>" alt=""></div>
        <div class="small-img-col"><img class="small-img" src="img/<?php echo htmlspecialchars($product['product_image2']); ?>" alt=""></div>
        <div class="small-img-col"><img class="small-img" src="img/<?php echo htmlspecialchars($product['product_image3']); ?>" alt=""></div>
        <div class="small-img-col"><img class="small-img" src="img/<?php echo htmlspecialchars($product['product_image4']); ?>" alt=""></div>
      </div>
    </div>

    <!-- Section des détails du produit -->
    <div class="col-lg-6 col-md-12 col-12">
      <h6>Catégorie / <?php echo htmlspecialchars($product['product_category']); ?></h6>
      <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
      <p class="description"><?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>
      <span style="color:black; font-weight: 700; font-size: 28px; display: block; margin-top: 10px;">
        <?php echo htmlspecialchars($product['product_price']); ?>$
      </span>

      <!-- Formulaire pour taille et quantité -->
      <form action="cart.php" method="post">
        <!-- Champs cachés pour envoyer les données du produit -->
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['product_image']); ?>">
        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>">
        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['product_price']); ?>">

        <div>
          <label for="size">Taille:</label>
          <select name="product_size" id="size" required>
            <option value="" disabled selected>Choisir la taille</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
          </select>
        </div>

        <div>
          <label for="quantity">Quantité:</label>
          <input type="number" name="product_quantity" id="quantity" value="1" min="1">
        </div>

        <div>
          <button class="buy-btn" type="submit" name="add_to_cart">
            Ajouter au panier
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Section des produits similaires -->
<section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Produits similaires</h3>
    <p>Basé sur le même nom et la même catégorie</p>
  </div>
  <div class="row mx-auto container-fluid">
    <?php while($related = $related_products->fetch_assoc()): ?>
      <div class="product text-center col-lg-2 col-md-4 col-6 mb-4">
        <a href="details.php?product_id=<?php echo $related['product_id']; ?>">
          <img src="img/<?php echo htmlspecialchars($related['product_image']); ?>" alt="">
        </a>
        <h5 class="p-name"><?php echo htmlspecialchars($related['product_name']); ?></h5>
        <h4 class="p-price"><?php echo htmlspecialchars($related['product_price']); ?>$</h4>
        <a href="details.php?product_id=<?php echo $related['product_id']; ?>">
          <button class="buy-btn">achter</button>
        </a>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<script>
  // Changer l'image principale lorsqu'on clique sur une image miniature
  const mainImg = document.getElementById('mainImg');
  const smallImgs = document.querySelectorAll('.small-img');

  smallImgs.forEach(img => {
    img.addEventListener('click', () => {
      mainImg.src = img.src;
      smallImgs.forEach(i => i.classList.remove('active'));
      img.classList.add('active');
    });
  });
</script>

<?php include('file/footer.php'); ?>
</body>
</html>







