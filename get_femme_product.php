<?php
include('conf.php');
$category = 'accessoires_femme'; 

$stmt = $conn->prepare("SELECT * FROM product WHERE product_category = ? ORDER BY product_id DESC LIMIT 5");
$stmt->bind_param("s", $category);
$stmt->execute();
$featured_product = $stmt->get_result();
?>


