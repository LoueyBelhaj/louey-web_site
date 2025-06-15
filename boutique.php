<?php
include('./file/header.php');

$selected_category = $_GET['category'] ?? '';
$page = max((int)($_GET['page'] ?? 1), 1);
$limit = 8;
$offset = ($page - 1) * $limit;

if ($selected_category) {
    $count_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM product WHERE product_category = ?");
    $count_stmt->bind_param("s", $selected_category);
} else {
    $count_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM product");
}
$count_stmt->execute();
$total_products = $count_stmt->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total_products / $limit);

if ($selected_category) {
    $stmt = $conn->prepare("SELECT * FROM product WHERE product_category = ? LIMIT ? OFFSET ?");
    $stmt->bind_param("sii", $selected_category, $limit, $offset);
} else {
    $stmt = $conn->prepare("SELECT * FROM product LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset);
}
$stmt->execute();
$products = $stmt->get_result();

$cat_result = $conn->query("SELECT DISTINCT product_category FROM product ORDER BY product_category ASC");
?>

<style>
.sidebar-categories {
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  padding: 10px;
}

.sidebar-categories .btn {
  border-radius: 50px;
  padding: 6px 18px;
  font-weight: 500;
  transition: 0.2s ease;
  background-color:#fff;
  color:black;
  
}

.sidebar-categories .btn.active,
.sidebar-categories .btn:hover {
  background-color:#CBA35C;
  color: #fff;
  border-color: #212529;
}
.product-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 12px; 
  margin: 0 -6px; 
}

.product-grid a {
  flex: 1 1 calc(25% - 12px); 
  display: block;
  margin: 0;
  padding: 0;
  position: relative;
  overflow: hidden;
  aspect-ratio: 1 / 1;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
  cursor: pointer;
}

.product-grid a:hover {
  transform: scale(1.05);
  z-index: 10;
}

.product-grid img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  border-radius: 6px;
  pointer-events: none; 
}
.product-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 15px;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0;
}

.product-card {
  position: relative;
  display: block;
  width: 100%;
height: 320px; 
  aspect-ratio: auto;
  ...
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  background: #fff;
  text-decoration: none;
  color: inherit;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 20px rgba(0,0,0,0.25);
  z-index: 10;
}

.product-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  border-radius: 8px;
  pointer-events: none;
  transition: filter 0.3s ease;
}

.product-card:hover img {
  filter: brightness(0.7);
}

.product-info {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, 20%);
  opacity: 0;
  color: white;
  text-align: center;
  width: 90%;
  transition: opacity 0.3s ease, transform 0.3s ease;
  pointer-events: none;
}

.product-card:hover .product-info {
  opacity: 1;
  transform: translate(-50%, -50%);
  pointer-events: auto;
}

.product-info h5 {
  margin: 0 0 8px;
  font-size: 1.1rem;
  font-weight: 600;
  text-shadow: 0 1px 4px #fff;
  color:white;
}

.product-info p {
  margin: 0 0 12px;
  font-size: 1rem;
  font-weight: 500;
  text-shadow: 0 1px 4px #fff;
  color:#fff;
}

.buy-btn {
  background-color: #CBA35C;
  border: none;
  padding: 8px 16px;
  border-radius: 25px;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  box-shadow: 0 3px 8px rgba(203,163,92,0.6);
  transition: background-color 0.3s ease;
}

.buy-btn:hover {
  background-color: #a67c39;
}


</style>
<?php
$limit = 12; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$total_result = $conn->query("SELECT COUNT(*) AS total FROM product");
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);


$stmt = $conn->prepare("SELECT * FROM product ORDER BY product_id DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$products = $stmt->get_result();
?>

<div class="product-grid">
  <?php while($row = $products->fetch_assoc()): ?>
    <a href="details.php?product_id=<?= (int)$row['product_id']; ?>" class="product-card">
      <img src="img/<?= htmlspecialchars($row['product_image']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>">
      <div class="product-info">
        <h5><?= htmlspecialchars($row['product_name']); ?></h5>
        <p>$<?= htmlspecialchars($row['product_price']); ?></p>
        <button class="buy-btn">Acheter</button>
      </div>
    </a>
  <?php endwhile; ?>
</div>

<nav aria-label="Pagination">
  <ul class="pagination mt-5 justify-content-center">
    <?php if($page > 1): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?= $page - 1; ?>">Précédent</a>
      </li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
      </li>
    <?php endfor; ?>

    <?php if($page < $total_pages): ?>
      <li class="page-item">
        <a class="page-link" href="?page=<?= $page + 1; ?>">Suivant</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>
