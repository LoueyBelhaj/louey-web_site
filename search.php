<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proget_pff";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$search = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

if (strlen($search) < 2) {
    
    echo json_encode([]);
    exit;
}
$sql = "SELECT product_name, product_description, product_price, product_category FROM product WHERE 
        product_name LIKE '%$search%' OR 
        product_description LIKE '%$search%' OR 
        product_price LIKE '%$search%' OR 
        product_category LIKE '%$search%' 
        LIMIT 10";


$result = $conn->query($sql);
$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
