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
    $p_description = $_POST['p_description'];

    // Xử lý các tệp hình ảnh
    $p_images = $_FILES['p_image']['name'];
    $p_images_tmp = $_FILES['p_image']['tmp_name'];
    $p_image_paths = []; // Mảng để chứa các đường dẫn ảnh

    foreach ($p_images as $index => $p_image) {
        if (!empty($p_image)) { // Kiểm tra nếu có tệp ảnh được tải lên
            $p_image_tmp = $p_images_tmp[$index];
            $image_path = $p_image;
            move_uploaded_file($p_image_tmp, '../images/' . $image_path);
            $p_image_paths[] = $image_path;
        }
    }

    // Nếu không có tệp mới, giữ nguyên các tệp ảnh cũ
    if (empty($p_image_paths)) {
        $p_image = $_POST['existing_images'];
    } else {
        $p_image = implode(',', $p_image_paths);
    }

    // Xử lý tệp PDF hướng dẫn
    $p_tutorial_name = '';
    if (isset($_FILES['p_tutorial']) && $_FILES['p_tutorial']['error'] == UPLOAD_ERR_OK) {
        $p_tutorial_name = $_FILES['p_tutorial']['name'];
        $p_tutorial_tmp = $_FILES['p_tutorial']['tmp_name'];
        $p_tutorial_path = $p_tutorial_name;
        move_uploaded_file($p_tutorial_tmp, '../../pdf/' . $p_tutorial_path);
    } else {
        // Giữ lại tệp PDF cũ nếu không có tệp mới được tải lên
        $p_tutorial_name = $_POST['existing_tutorial'];
    }

    // Câu lệnh SQL để cập nhật sản phẩm
    $sql = "UPDATE product 
            SET p_number = '$p_number', 
                p_name_en = '$p_name_en', 
                p_name_vn = '$p_name_vn', 
                p_image = '$p_image', 
                p_price = '$p_price', 
                p_category = '$p_category', 
                p_tutorial = '$p_tutorial_name', 
                p_description = '$p_description' 
            WHERE p_id = '$p_id'";

    try {
        $query = mysqli_query($conn, $sql);
        header('Location: manageProduct.php');
    } catch (Exception $e) {
        var_dump($e);
    }
}



?>