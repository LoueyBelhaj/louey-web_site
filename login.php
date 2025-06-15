<?php
session_start();
include('server/conf.php');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: account.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['user_password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_email'] = $user['user_email'];
                $_SESSION['logged_in'] = true;

            // Protection contre la redirection

                $allowed_pages = ['cart.php', 'checkout.php', 'account.php', 'index.php'];

                if (isset($_GET['redirect']) && in_array($_GET['redirect'], $allowed_pages)) {
                    $redirect = $_GET['redirect'];
                    header("Location: $redirect");
                    exit();
                } else {
                    header('Location: account.php?login_success=You have logged in successfully');
                    exit();
                }
            } else {
                $error = "Incorrect email or password.";
            }
        } else {
            $error = "Incorrect email or password.";
        }
        $stmt->close();
    }
}

include('file/header.php'); 

?>

<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="font-weight-bold">Login</h2>
    </div>
    <div class="mx-auto container" style="max-width:1100px;">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="login.php<?php echo isset($_GET['redirect']) ? '?redirect=' . urlencode($_GET['redirect']) : ''; ?>" id="login-form" method="post" novalidate>
            <div class="form-group mb-3">
                <label for="login-email">Email</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group mb-3">
                <label for="login-password">Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary w-60" id="login-btn" value="Login" name="login_btn">
            </div>
            <div class="form-group mt-3 text-center">
                <a href="register.php">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</section>

<?php include('file/footer.php'); ?>

