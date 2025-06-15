<?php
session_start();
include('server/conf.php');  
include('file/header.php');

if (isset($_POST['order_details_btn'], $_POST['order_id'], $_POST['order_status'])) {
    $order_id = intval($_POST['order_id']);
    $order_status = $_POST['order_status'];

    
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();
} else {
    header('Location: account.php');
    exit;
}
?>

<style>
#order-details {
  max-width: 900px;
  margin: 0 auto;
  font-family: 'Arial', sans-serif;
}

.order-items {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}

.order-item-card {
  background: white;
  box-shadow: 0 3px 8px rgba(0,0,0,0.1);
  border-radius: 12px;
  overflow: hidden;
  width: 260px;
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: transform 0.3s ease;
}

.order-item-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}

.order-item-card img {
  width: 100%;
  height: 220px;
  object-fit: cover;
}

.order-item-info {
  padding: 15px 20px;
  text-align: center;
}

.order-item-info h4 {
  margin: 10px 0 6px;
  font-size: 18px;
  color: #222;
}

.order-item-info .price {
  font-weight: bold;
  color: #f5a623; 
  margin-bottom: 6px;
}

.order-item-info .quantity {
  color: #555;
  font-size: 14px;
}

.pay-now-form {
  margin-top: 30px;
  text-align: center;
}

.pay-now-form .btn {
  padding: 12px 30px;
  font-size: 16px;
  border-radius: 30px;
  background-color: #f5a623;
  border: none;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.pay-now-form .btn:hover {
  background-color: #d48806;
}

/* Responsive */
@media (max-width: 700px) {
  .order-items {
    flex-direction: column;
    align-items: center;
  }
  
  .order-item-card {
    width: 90%;
  }
}


</style>

<section id="order-details" class="container my-5">
  <h2 class="text-center mb-4">Order Details</h2>
  
  <div class="order-items">
    <?php while ($row = $order_details->fetch_assoc()): ?>
      <div class="order-item-card">
        <img src="img/<?= htmlspecialchars($row['product_image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
        <div class="order-item-info">
          <h4><?= htmlspecialchars($row['product_name']) ?></h4>
          <p class="price">$<?= number_format($row['product_price'], 2) ?></p>
          <p class="quantity">Quantity: <?= htmlspecialchars($row['product_quantity']) ?></p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  
  <?php if ($order_status === "not paid"): ?>
    <form action="payment.php" method="POST" class="pay-now-form">
      <input type="hidden" name="order_id" value="<?= $order_id ?>">
      <button type="submit" class="btn btn-warning">Pay Now</button>
    </form>
  <?php endif; ?>
</section>


<?php include('file/footer.php'); ?>
