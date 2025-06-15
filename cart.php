<?php
session_start();


function calculerTotalPanier() {
    $total = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $produit) {
            $total += $produit['product_price'] * $produit['product_quantity'];
        }
    }
    $_SESSION['total'] = $total;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );

        if (isset($_SESSION['cart'])) {
            $ids_produits = array_column($_SESSION['cart'], 'product_id');

            if (!in_array($product_id, $ids_produits)) {
                $_SESSION['cart'][$product_id] = $product_array;
            } else {
                
                $_SESSION['message'] = "Produit déjà dans le panier.";
            }
        } else {
            $_SESSION['cart'][$product_id] = $product_array;
        }

        calculerTotalPanier();
    }


    elseif (isset($_POST['remove_product'])) {
        $product_id = $_POST['product_id'];
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
            calculerTotalPanier();
        }
    }

    
    elseif (isset($_POST['edit_quantity'])) {
        $product_id = $_POST['product_id'];
        $product_quantity = intval($_POST['product_quantity']);
        if ($product_quantity < 1) $product_quantity = 1; 

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;
            calculerTotalPanier();
        }
    }

    
    elseif (isset($_POST['checkout'])) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php?redirect=cart.php");
            exit();
        } else {
            header("Location: checkout.php");
            exit();
        }
    }
}



include('file/header.php'); 
?>

<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2>Panier</h2>
        <hr>
    </div>

    <?php
    
    if (isset($_SESSION['message'])) {
        echo '<script>alert("' . htmlspecialchars($_SESSION['message']) . '");</script>';
        unset($_SESSION['message']);
    }
    ?>

    <table class="mt-5 pt-5">
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Sous-total</th>
        </tr>

        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $produit): ?>
                <tr>
                    <td>
                        <div class="product_info">
                            <img src="img/<?php echo htmlspecialchars($produit['product_image']); ?>" alt="">
                            <div>
                                <p><?php echo htmlspecialchars($produit['product_name']); ?></p>
                                <small><span>$</span><?php echo number_format($produit['product_price'], 2); ?></small>
                                <br>
                                <form action="cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $produit['product_id']; ?>">
                                    <input type="submit" class="remove-btn" name="remove_product" value="Supprimer">
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $produit['product_id']; ?>">
                            <input type="number" name="product_quantity" value="<?php echo $produit['product_quantity']; ?>" min="1" class="w-25 pl-1">
                            <input type="submit" class="edit-btn" value="Modifier" name="edit_quantity">
                        </form>
                    </td>
                    <td>
                        <span>$<?php echo number_format($produit['product_quantity'] * $produit['product_price'], 2); ?></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3" class="text-center">Votre panier est vide.</td></tr>
        <?php endif; ?>
    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>$<?php echo number_format($_SESSION['total'] ?? 0, 2); ?></td>
            </tr>
        </table>
    </div>

    <div class="checkout-container">
        <form action="cart.php" method="post">
            <input type="submit" value="Valider la commande" class="btn checkout-btn" name="checkout">
        </form>
    </div>
</section>

<?php include('file/footer.php'); ?>


