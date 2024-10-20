<?php $website = 'product.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../php/head.php'; ?>
    <?php include '../php/login.php'; ?>
    <?php include '../php/getUser.php'; ?>
    <title>Brick Shop - LEGO Products</title>
    <link rel="stylesheet" href="../css/product.css" />
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
            <li class="breadcrumb-item active" aria-current="page">Keeppley</li>
        </ol>
    </nav>

    <!-- Brands Section -->
    <section class="brands">
        <div class="brand-logo">
            <img src="../images/LEGO_Wallpaper.png" alt="Product">
        </div>
    </section>

    <!-- Products Section -->
    <section class="products">
        <h2>LEGO Products</h2>
        <div class="product-grid">

            <?php
            $sqlQman = "SELECT * FROM `Category` WHERE `provider` = 'LEGO'";
            $result = mysqli_query($conn, $sqlQman);

            // Kiểm tra xem có kết quả trả về không
            if ($result->num_rows > 0)
                while ($category = $result->fetch_assoc()):

                    // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
                    $product_images = array_map('trim', explode(',', $category["images"]));
                    ?>

                    <div class="product">
                        <a href="../en/Category_Product.php?id=<?php echo $category['id']; ?>">
                            <img src="../images/<?php echo $product_images[0]; ?>" alt="Pokémon Keeppley">
                            <p><?php echo $category['name_en'] ?></p>
                        </a>
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