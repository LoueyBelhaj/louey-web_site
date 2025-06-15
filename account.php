
<?php
session_start();

include('server/conf.php'); 


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

include('file/header.php');  


$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';


$orders = null;
if (isset($conn)) {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
    if ($stmt) {
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $orders = $stmt->get_result();
    } else {
        die("<p> " . htmlspecialchars($conn->error) . "</p>");
    }
} else {
    die("<p</p>");
}
?>

<style>
    .order-card {
  border: 1px solid #ddd;
  border-radius: 16px;
  padding: 20px;
  margin-bottom: 20px;
  background-color: #fff;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  transition: all 0.3s ease;
}
.order-card:hover {
  transform: translateY(-4px);
}
.order-card .header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}
.order-card .order-status {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 500;
}
.order-status.paid {
  background-color: #d1f7c4;
  color: #256029;
}
.order-status.not-paid {
  background-color: #fde2e1;
  color: #b02a2a;
}
.order-card .btn {
  margin-top: 10px;
}

</style>

<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12 mx-auto">

            <?php if (isset($_GET['register_success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['register_success']) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['login_success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['login_success']) ?>
                </div>
            <?php endif; ?>

            <h3 class="font-weight-bold">Account Info</h3>

            <div class="account-info text-start border p-3 rounded">
                <p><strong>Name:</strong> <?= htmlspecialchars($user_name) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user_email) ?></p>
                <p><a href="#orders" id="order-btn">Your Orders</a></p>
                <p>
                    <a href="account.php?logout=1" id="logout-btn" class="btn btn-danger">Logout</a>
                </p>
            </div>
        </div>
    </div>
</section>

<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
        <hr class="mx-auto">
    </div>

    <?php if ($orders && $orders->num_rows > 0): ?>
        <?php while ($row = $orders->fetch_assoc()): ?>
            <?php
            // جلب أسماء المنتجات التابعة لهذا الطلب
            $order_id = $row['order_id'];
            $stmt_items = $conn->prepare("SELECT product_name FROM order_items WHERE order_id = ?");
            $stmt_items->bind_param('i', $order_id);
            $stmt_items->execute();
            $items_result = $stmt_items->get_result();

            $product_names = [];
            while ($item = $items_result->fetch_assoc()) {
                $product_names[] = $item['product_name'];
            }
            ?>
            <div class="order-card">
                <div class="header">
                    <span>
                        <strong>Products:</strong>
                        <?= implode(', ', $product_names) ?>
                    </span>
                    <span class="order-status <?= $row['order_status'] === 'paid' ? 'paid' : 'not-paid' ?>">
                        <?= ucfirst($row['order_status']) ?>
                    </span>
                </div>
                <p><strong>Total:</strong> $<?= number_format($row['order_cost'], 2) ?></p>
                <p><strong>Date:</strong> <?= htmlspecialchars($row['order_date']) ?></p>

                <form action="order_details.php" method="POST">
                    <input type="hidden" name="order_status" value="<?= htmlspecialchars($row['order_status']) ?>">
                    <input type="hidden" name="order_id" value="<?= $order_id ?>">
                    <input class="btn btn-outline-dark btn-sm" type="submit" name="order_details_btn" value="View Details">
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center">No orders found.</p>
    <?php endif; ?>
</section>


<?php include('file/footer.php'); ?>

