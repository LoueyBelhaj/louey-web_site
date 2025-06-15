<?php
include('conf.php');
$stmt=$conn->prepare("SELECT * FROM product WHERE product_category='coats' LIMIT 4");
$stmt->execute();
$coats_products = $stmt->get_result();
?>