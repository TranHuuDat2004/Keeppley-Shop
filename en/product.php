<?php $website = 'product.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../php/head.php'; ?>
    <?php include '../php/login.php'; ?>
    <?php include '../php/getUser.php'; ?>
    <title>Brick Shop - Products</title>
</head>

<style>
    /* Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        line-height: 1.6;
    }

    /* Desktop Navbar */
    .navbar.desktop {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: #fff;
    }

    .navbar.desktop ul {
        display: flex;
        list-style: none;
    }

    .navbar.desktop ul li {
        margin-left: 20px;
    }

    .navbar.desktop ul li .active {
        font-weight: 700;
    }


    .navbar.desktop ul li a {
        text-decoration: none;
        color: black;
        font-weight: 500;
    }

    .navbar.desktop .btn,
    .navbar.desktop .btn-login {
        margin: 10px;
        /* Điều chỉnh khoảng cách giữa hai nút */
    }

    .navbar.mobile {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .logo img {
        max-width: 200px;
    }

    .hamburger-menu {
        padding: 15px 15px;
        background-color: #ff5c5c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 24px;
    }

    /* Mobile Menu Layer */
    .navLayer {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        z-index: 9999;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
    }

    .navLayer.active {
        display: flex;
    }

    .navbar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .closeBtn {
        font-size: 30px;
        cursor: pointer;
    }

    .nav-items {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .nav-items li {
        margin: 20px 0;
    }

    .nav-items li a {
        display: block;
        padding: 10px 20px;
        border-radius: 10px;
        background-color: #fff;
        color: #ff5c5c;
        font-weight: bold;
        text-decoration: none;
        font-size: 16px;
        text-align: center;
        border: 1px solid #ff5c5c;
        transition: background-color 0.3s ease;
    }

    .nav-items .active {
        background-color: #ff5c5c;
        color: white;
    }

    /* Language Switch */
    .lang-switch {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .lang-btn {
        background-color: #fff;
        color: #ff5c5c;
        border: 1px solid #ff5c5c;
        padding: 10px 20px;
        border-radius: 50px;
        margin: 0 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .lang-btn.active,
    .lang-btn:hover {
        background-color: #ff5c5c;
        color: white;
    }

    .navbar.desktop {
        display: flex;
    }

    .navbar.mobile {
        display: none;
    }

    /* Responsive Styles Header */
    @media (max-width: 768px) {
        .navbar.desktop {
            display: none;
        }

        .navbar.mobile {
            display: flex;
        }
    }

    /* Utility classes */
    .text-center {
        text-align: center;
    }


    .hamburger-menu {
        padding: 10px 10px;
        background-color: #ff5c5c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn {
        padding: 10px 20px;
        background-color: #ff5c5c;
        color: white;
        border: none;
        border-radius: 16px;
        cursor: pointer;

    }

    .btn-login {
        padding: 10px 20px;
        background-color: #ffffff;
        color: #ff5c5c;
        border: 1px solid #ff5c5c;
        border-radius: 16px;
        cursor: pointer;
    }

    /* Language switcher container */
    .language-switcher {
        position: relative;
        display: inline-block;
        margin-right: 20px;
    }

    h2 {
        text-align: center;
    }

    h4 {
        text-align: center;

    }

    /* Current language flag icon */
    .current-lang img {
        padding-top: 20px;
        width: 48px;
        cursor: pointer;
    }

    /* Dropdown styling */
    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        width: 150px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        z-index: 1;
        border-radius: 5px;
        overflow: hidden;
    }

    .dropdown-content a {
        display: flex;
        align-items: center;
        padding: 10px;
        text-decoration: none;
        color: black;
        font-size: 14px;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    /* Language option flag icons */
    .lang-option img {
        width: 18px;
        margin-right: 8px;
    }

    /* Show dropdown when hovering */
    .language-switcher:hover .dropdown-content {
        display: block;
    }


    .brands {
        display: flex;
        justify-content: center;
        padding: 20px 0px;

    }

    .brands img {
        margin: 0 20px;
        height: 400px;
        width: 1400px;
        object-fit: cover;
    }

    /* Responsive Styles Header */
    @media (max-width: 768px) {
        .brands img {
            margin: 0 20px;
            height: 120px;
            width: 350px;
            object-fit: cover;
        }

    }

    .products {
        padding: 20px;
    }

    .products h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        padding: 20px 100px;
        /* 5 cột, mỗi cột có cùng kích thước */
        gap: 20px;
        /* Khoảng cách giữa các sản phẩm */
        margin-bottom: 40px;
        /* Khoảng cách dưới */
    }


    /* Responsive Styles Header */
    @media (max-width: 1400px) {
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 4 cột, mỗi cột có cùng kích thước */
            gap: 20px;
            /* Khoảng cách giữa các sản phẩm */
            margin-bottom: 40px;
            /* Khoảng cách dưới */
            padding: 10px 0px;
        }

    }

    /* Responsive Styles Header */
    @media (max-width: 900px) {
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* 2 cột, mỗi cột có cùng kích thước */
            gap: 20px;
            /* Khoảng cách giữa các sản phẩm */
            margin-bottom: 40px;
            /* Khoảng cách dưới */
            padding: 10px 0px;
        }

    }

    /* Responsive Styles Header */
    @media (max-width: 768px) {
        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* 2 cột, mỗi cột có cùng kích thước */
            gap: 20px;
            /* Khoảng cách giữa các sản phẩm */
            margin-bottom: 40px;
            /* Khoảng cách dưới */
            padding: 10px 0px;
        }

    }

    .product {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        padding: 10px;
        text-align: center;
    }

    .product img {
        max-width: 100%;
        border-radius: 10px;
    }

    .product p {
        margin-top: 10px;
        font-size: 16px;
    }

    .breadcrumb {
        display: flex;
        flex-wrap: wrap;
        padding: 10px 300px;
        margin-bottom: 1rem;
        list-style: none;
        background-color: transparent;
        border-radius: 0.25rem;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        display: inline-block;
        padding-right: 0.5rem;
        padding-left: 0.5rem;
        color: #6c757d;
        content: "/";
    }

    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }

    /* Responsive Styles Header */
    @media (max-width: 768px) {
        .breadcrumb {
            display: none;
        }

    }

    /* Footer */
    footer a {
        color: #000;
        text-decoration: none;
        font-size: 14px;
        padding-bottom: 30px
    }

    footer p {
        color: #000;
        text-decoration: none;
        font-size: 14px;
        padding-bottom: 30px;
        padding-top: 18px
    }

    footer a:hover {
        text-decoration: underline;
        padding-bottom: 30px
    }

    footer i {
        margin: 0 5px;
        font-size: 14px;
    }

    footer input[type="email"] {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding-bottom: 30px
    }

    footer button {
        border-radius: 16px;
        padding-bottom: 30px
    }

    .label-footer {
        font-weight: bold;
        font-size: 18px;
    }

    .footer-column {
        flex: 1 1 200px;
        max-width: 15%;
        background-color: #f5f5f5;
    }

    p {
        font-size: 16px;
        font-weight: 600;
    }

    a {
        text-decoration: none;
        /* Xóa gạch chân */
    }

    @media only screen and (max-width: 600px) {
        .footer-column {
            flex: 1 1 100px;
            /* Giảm xuống còn 100px cho màn hình nhỏ */
            max-width: 100%;
            /* Chiếm 100% chiều rộng của màn hình */
        }

        footer p {
            color: #000;
            text-decoration: none;
            font-size: 12px;
            padding-bottom: 30px;
            padding-top: 18px;
        }

        footer i {
            margin: 0 5px;
            font-size: 12px;
        }

        .label-footer {
            font-weight: bold;
            font-size: 12px;
        }

        .f-cute {
            width: 75%;
        }

        footer input[type="email"] {
            border: 1px solid #ccc;
            border-radius: 16px;
            padding-bottom: 30px;
            width: 250px;
        }
    }
</style>

<body>

    <!-- Header Section -->
    <header>

        <!-- Desktop Navbar -->
        <div class="navbar desktop">
            <div class="logo">
                <img src="../images/logo.png" width="200" alt="Brick Shop Logo">
            </div>
            <ul>
                <li><a class="active" href="#">Home</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <ul>
                <div class="language-switcher">
                    <div class="current-lang">
                        <img src="../images/flags/en.png" alt="Vietnam Flag">
                    </div>
                    <div class="dropdown-content">
                        <a href="../html/index-chatgpt_en.html" class="lang-option">
                            <img src="../images/flags/en.png" alt="UK Flag"> English
                        </a>
                        <a href="../html/index-chatgpt_vn.html" class="lang-option">
                            <img src="../images/flags/vn.png" alt="Vietnam Flag"> Tiếng Việt
                        </a>
                    </div>
                </div>
                <a href="#" class="btn-login">Sign Up</a>
                <a href="#" class="btn">Login</a>
            </ul>
        </div>

        <!-- Mobile Navbar -->
        <div class="navbar mobile">
            <div class="menu-icon navA" onclick="toggleMenu()">
                <button class="hamburger-menu" id="btn-hamburger">☰</button>
            </div>
            <div class="logo">
                <img src="../images/logo.png" width="200" alt="Brick Shop Logo">
                <!-- <a href="#" class="btn">Login</a>
                <a href="#" class="btn">Sign Up</a> -->
            </div>
        </div>

        <!-- Mobile Menu Layer -->
        <div class="navLayer" id="nav-menu">
            <div class="navbar-header">
                <img src="../images/logo.png" width="200" alt="Brick Shop Logo">
                <span class="closeBtn" onclick="toggleMenu()">X</span>
            </div>
            <ul class="nav-items">
                <li><a href="#" class="active">Our Story</a></li>
                <li><a href="#">Our Products</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Sign Up</a></li>
                <li><a href="#">Login</a></li>
            </ul>

            <!-- Language Switch -->
            <div class="lang-switch">
                <a href="../html/index-chatgpt_en.html"><button class="lang-btn active">EN</button></a>
                <a href="../html/index-chatgpt_vn.html"><button class="lang-btn ">VN</button></a>
            </div>
        </div>



    </header>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../en/index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Sản phẩm</li>
            <!-- <li class="breadcrumb-item active" aria-current="page">Keeppley</li> -->
        </ol>
    </nav>

    <!-- Brands Section -->
    <section class="brands">
        <div class="brand-logo">
            <img src="../images/Products.png" alt="Product">
        </div>
    </section>

    <!-- Products Section -->
    <section class="products">
        <h2>Qman Products</h2>
        <div class="product-grid">

            <?php
            $sqlQman = "SELECT * FROM `Category` WHERE `provider` = 'Qman'";
            $result = mysqli_query($conn, $sqlQman);

            // Kiểm tra xem có kết quả trả về không
            if ($result->num_rows > 0)
                while ($category = $result->fetch_assoc()):

                    // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
                    $product_images = array_map('trim', explode(',', $category["images"]));
                    ?>

                    <div class="product">
                        <img src="../images/5ce61d2ed281b.jpg" alt="Pokémon Keeppley">
                        <p>Pokémon</p>
                    </div>
                    <?php

                endwhile;
            ?>

        </div>
        <h4>View More > </h4>

        <h2>Keeppley Products</h2>
        <div class="product-grid">


            <?php
            $sqlQman = "SELECT * FROM `Category` WHERE `provider` = 'Keeppley'";
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
                        <img src="../images/5ce61d2ed281b.jpg" alt="Pokémon Keeppley">
                        <p>Pokémon</p>
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