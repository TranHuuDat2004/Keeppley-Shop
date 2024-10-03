<?php

// Lấy tên file này
$website = basename($_SERVER['SCRIPT_NAME']);
// echo $website;

include '../php/login.php';
include '../php/getUser.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $website = "Category_Product.php?id=" . $id;

    // Truy vấn chi tiết danh mục dựa trên id
    $sqlCategory = "SELECT * FROM `category` WHERE `id` = '$id'";
    $resultCategory = mysqli_query($conn, $sqlCategory);

    // Kiểm tra xem có kết quả trả về không
    if ($resultCategory->num_rows > 0) {
        // Lấy thông tin chi tiết của danh mục
        $category = $resultCategory->fetch_assoc();

        $category_name_en = $category["name_en"];
        // echo $category_name_en;

        $category_name_vn = $category["name_vn"];

        // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
        $category_images = array_map('trim', explode(',', $category["images"]));


        // Truy vấn chi tiết sản phẩm dựa trên category_name_en
        $sqlProduct = "SELECT * FROM `product` WHERE `p_category` = '$category_name_en'";
        $resultProduct = mysqli_query($conn, $sqlProduct);

        // Kiểm tra xem có kết quả trả về không
        if ($resultProduct->num_rows > 0) {
            // Khởi tạo mảng để lưu trữ các sản phẩm
            $products = array();

            while ($row = $resultProduct->fetch_assoc()) {
                // Đưa từng sản phẩm vào mảng products
                $products = array(
                    "p_id" => $row["p_id"],
                    "p_image" => $row["p_image"],
                    "p_name_en" => $row["p_name_en"],
                    "p_name_vn" => $row["p_name_vn"],
                    "p_price_en" => $row["p_price_en"],
                    "p_price_vn" => $row["p_price_vn"],
                    "p_tutorial" => $row["p_tutorial"],
                    "p_category" => $row["p_category"],
                    "p_description" => $row["p_description"]
                );
            }

            // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
            $product_images = array_map('trim', explode(',', $products["images"]));



            // Giờ bạn có thể sử dụng $products để hiển thị sản phẩm trên trang web của mình.
        } else {
            // echo "Không tìm thấy sản phẩm với danh mục là $category_name_en";
            // header("Location: 404.php");
            // exit(); // Dừng thực thi mã
        }

        $sql = "SELECT * FROM `category` WHERE `name_en` = '$category_name_en'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $provider = array();
            while ($row = $result->fetch_assoc()) {
                // Đưa từng sản phẩm vào mảng products
                $provider = array(
                    "name_en" => $row["name_en"],
                    "provider" => $row["provider"],
                );

            }
        }

        $category_website = '';
        if ($provider['provider'] == 'Keeppley') {
            $category_website = 'Keeppley-Products.php';
        } else if ($provider['provider'] == 'Qman') {
            $category_website = 'Qman-Products.php';
        } else if ($provider['provider'] == 'LEGO') {
            $category_website = 'LEGO-Products.php';
        }
    } else {
        echo "Không tìm thấy danh mục với id là $id";
        // header("Location: 404.php");
        // exit(); // Dừng thực thi mã
    }
} else {
    // header("Location: 404.php");
    // exit(); // Dừng thực thi mã
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../php/head.php'; ?>
    <?php include '../php/login.php'; ?>
    <?php include '../php/getUser.php'; ?>
    <title><?php echo $category_name_en ?></title>
    <link rel="stylesheet" href="../css/category_product.css" />
</head>


<body>
    <!-- Header Section -->
    <?php include '../php/header_home_en.php' ?>
    <!-- Cart Section -->
    <?php include '../en/cart.php' ?>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../en/index.php">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="../en/product.php">Sản phẩm</a></li>
            <li class="breadcrumb-item"><a href="../en/<?php echo $category_website ?>">
                    <?php echo $provider['provider'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $category_name_en ?></li>
        </ol>
    </nav>

    <!-- Brands Section -->
    <section class="brands">
        <div class="brand-logo">
            <img src="../images/<?php echo $category_images[1] ?>" alt="Product">
        </div>
    </section>

    <!-- Products Section -->
    <section class="products">
        <h2>Keeppley Products</h2>
        <div class="product-grid">

            <?php
        $sqlProduct = "SELECT * FROM `product` WHERE `p_category` = '$category_name_en'";
        $resultProduct = mysqli_query($conn, $sqlProduct);


            // Kiểm tra xem có kết quả trả về không
            if ($resultProduct->num_rows > 0)
                while ($products = $resultProduct->fetch_assoc()):

                    // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
                    $product_images = array_map('trim', explode(',', $products["p_image"]));


                    ?>

                    <div class="product">
                        <img src="../images/<?php echo $product_images[0]?>" alt="Pokémon Keeppley">
                        <p><?php echo $products['p_name_en']?></p>
                        <p><?php echo $products['p_number']?></p>
                        <p>$ <?php echo $products['p_price_en']?></p>
                    </div>
                    <?php

                endwhile;
            ?>


        </div>

    </section>

    <!-- Footer Section -->
    <footer style="padding: 20px 0; font-family: Arial, sans-serif; font-size:20px ">
        <div style="display: flex; justify-content: center; align-items: center;">
            <img src="../images/17.png" alt="" class="f-cute">
        </div>
        <div
            style="background-color: #f5f5f5; display: flex; justify-content: space-around; flex-wrap: wrap; padding-left:30px">
            <!-- LEGAL -->
            <div class="footer-column">
                <p class="label-footer">LEGAL</p>
                <ul style="list-style: none; padding-left: 0;">
                    <li><a href="#">Faq</a></li>
                    <li><a href="#">Retailers</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cookies</a></li>
                </ul>
            </div>

            <!-- SERVICES -->
            <div class="footer-column">
                <p class="label-footer">SERVICES</p>
                <ul style="list-style: none; padding-left: 0;">
                    <li><a href="#">Track Order</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>

            <!-- GET IN TOUCH -->
            <div class="footer-column">
                <p class="label-footer">GET IN TOUCH</p>
                <p>Any questions? Let us know in store at 8th floor,
                    379 Hudson St, New York, NY 10018 <br>
                    or call us on (+1) 96 716 6879</p>
                <div>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- NEWSLETTER -->
            <div class="footer-column">
                <p class="label-footer">NEWSLETTER</p>
                <input type="email" placeholder="email@example.com"
                    style="width: 150px; padding: 10px; margin-bottom: 10px;">
                <button
                    style="background-color: #ff4081; color: white; padding: 10px 20px; border: none; cursor: pointer;">SUBSCRIBE</button>
            </div>
        </div>

        <div style="text-align: center; background-color: #f5f5f5;">
            <img src="../icons/icon-pay-01.png" alt="Payment Methods" style="margin-top: 10px;">
            <img src="../icons/icon-pay-02.png" alt="Payment Methods" style="margin-top: 10px;">
            <img src="../icons/icon-pay-03.png" alt="Payment Methods" style="margin-top: 10px;">
            <img src="../icons/icon-pay-04.png" alt="Payment Methods" style="margin-top: 10px;">
            <img src="../icons/icon-pay-05.png" alt="Payment Methods" style="margin-top: 10px;">
            <p>&copy; 2024 All rights reserved | Made with <i class="fas fa-heart"></i> Group 5</p>
        </div>
    </footer>

</body>

</html>