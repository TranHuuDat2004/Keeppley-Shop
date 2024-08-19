<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'keeppley-shop'); // servername, username, password, database's name
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}


// Xử lý cập nhật sản phẩm khi người dùng submit form
if (isset($_POST['sbm'])) {
    $p_id = $_POST['p_id'];
    $p_number = $_POST['p_number'];
    $p_name_en = $_POST['p_name_en'];
    $p_name_vn = $_POST['p_name_vn'];
    $p_category = $_POST['p_category'];
    $p_price = $_POST['p_price'];
    $p_age = $_POST['p_age'];
    $p_description = $_POST['p_description'];
    $p_stock_status = $_POST['p_stock_status'];
    $p_product_status = $_POST['p_product_status'];

    // Câu lệnh SQL để cập nhật sản phẩm
    $sql = "UPDATE product 
            SET p_number = '$p_number', 
                p_name_en = '$p_name_en', 
                p_name_vn = '$p_name_vn', 
                p_price = '$p_price', 
                p_category = '$p_category', 
                p_age = '$p_age',
                p_description = '$p_description', 
                p_stock_status = '$p_stock_status',
                p_product_status = '$p_product_status' 
            WHERE p_id = '$p_id'";

    try {
        $query = mysqli_query($conn, $sql);
        header('Location: manageProduct.php');
    } catch (Exception $e) {
        var_dump($e);
    }
}
?>