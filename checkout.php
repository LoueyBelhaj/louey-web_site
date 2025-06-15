<?php
session_start();

if (empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit();
}


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect=checkout.php');
    exit();
}

include('file/header.php');
?>



<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Checkout</h2>
    </div>
    <div class="mx-auto container">
        <form action="server/place_order.php" id="checkout-form" method="post">
            <div class="form-group checkout-small-element">
                <label for="">Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for="">Email</label>
                <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for="">Phone</label>
                <input type="number" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for="">City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
            </div>
            <div class="form-group checkout-large-element">
                <label for="">Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
            </div>
            <div class="form-group checkout-btn-container">
                <p>Total amount: $<?php echo number_format($_SESSION['total'] ?? 0, 2); ?></p>
                <input type="submit" class="btn" id="checkout-btn" value="Place Order" name="place_order">
            </div>
        </form>
    </div>
</section>

<?php include('./file/footer.php'); ?>
