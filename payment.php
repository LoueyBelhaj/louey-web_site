<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    include('server/conf.php'); 

    $order_id = intval($_POST['order_id']);
    
    $stmt = $conn->prepare("SELECT order_cost, order_status FROM orders WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    if (!$order) {
        
        echo "<p class='alert alert-danger text-center'>Order not found.</p>";
        include('file/footer.php');
        exit;
    }
} else {
    header('Location: account.php');  
    exit;
}

include('file/header.php');
?>

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Payment</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">
        <p>Status: <?= htmlspecialchars($order['order_status']) ?></p>
        <p>Total Payment: $<?= htmlspecialchars(number_format($order['order_cost'], 2)) ?></p>

        <?php if ($order['order_status'] === 'not paid'): ?>
            <form action="process_payment.php" method="POST">
                <input type="hidden" name="order_id" value="<?= $order_id ?>">
                <input type="submit" class="btn btn-primary" value="Confirm Payment">
            </form>
        <?php else: ?>
            <p class="text-success">This order is already paid.</p>
        <?php endif; ?>
    </div>
</section>

<?php include('file/footer.php'); ?>

