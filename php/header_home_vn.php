<style>
    /* Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    a {
        text-decoration: none;
        /* Bỏ gạch chân dưới liên kết */
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
        /* Màu nền trắng */
        color: #ff5c5c;
        /* Màu chữ */
        border: 1px solid #ff5c5c;
        /* Viền với màu #ff5c5c */
        border-radius: 16px;
        /* Độ bo tròn viền */
        cursor: pointer;
    }

    .img-user {
        border-radius: 50%;
        object-fit: cover;
    }

    /* Language switcher container */
    .language-switcher {
        position: relative;
        display: inline-block;
        margin-right: 20px;
    }
</style>

<!-- Header Section -->
<header>

    <!-- Thanh điều hướng trên Desktop -->
    <div class="navbar desktop">
        <div class="logo">
            <img src="../images/logo.png" width="200" alt="Logo Brick Shop">
        </div>
        <ul>
            <li><a class="active" href="../vn/index.php">Trang chủ</a></li>
            <li><a href="../vn/product.php">Sản phẩm</a></li>
            <li><a href="../vn/404.php">Liên hệ</a></li>
        </ul>
        <ul>
            <div class="language-switcher">
                <div class="current-lang">
                    <img src="../images/flags/vn.png" alt="Vietnam Flag">
                </div>
                <div class="dropdown-content">
                    <a href="../en/<?php echo $website ?>" class="lang-option">
                        <img src="../images/flags/en.png" alt="UK Flag"> English
                    </a>
                    <a href="../vn/<?php echo $website ?>" class="lang-option">
                        <img src="../images/flags/vn.png" alt="Vietnam Flag"> Tiếng Việt
                    </a>
                </div>
            </div>
            <a href="../php/Signup_vn.php" class="btn-login">Đăng ký</a>
            <a href="../php/ChooseLogin_vn.php" class="btn">Đăng nhập</a>
        </ul>
    </div>


    <!-- Thanh điều hướng trên Mobile -->
    <div class="navbar mobile">
        <div class="menu-icon navA" onclick="toggleMenu()">
            <button class="hamburger-menu" id="btn-hamburger">☰</button>
        </div>
        <div class="logo">
            <img src="../images/logo.png" width="200" alt="Logo Brick Shop">
        </div>
    </div>

    <!-- Lớp Menu trên Mobile -->
    <div class="navLayer" id="nav-menu">
        <div class="navbar-header">
            <img src="../images/logo.png" width="200" alt="Logo Brick Shop">
            <span class="closeBtn" onclick="toggleMenu()">X</span>
        </div>
        <ul class="nav-items">
            <li><a href="../vn/index.php" class="active">Câu chuyện của chúng tôi</a></li>
            <li><a href="../vn/product.php">Sản phẩm của chúng tôi</a></li>
            <li><a href="../vn/404.php">Liên hệ</a></li>
            <li><a href="../php/Signup_vn.php">Đăng ký</a></li>
            <li><a href="../php/ChooseLogin_vn.php">Đăng nhập</a></li>
        </ul>

        <!-- Chuyển đổi ngôn ngữ -->
        <div class="lang-switch">
            <a href="../en/<?php echo $website ?>"><button class="lang-btn">EN</button></a>
            <a href="../vn/<?php echo $website ?>"><button class="lang-btn active">VN</button></a>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var navLayer = document.getElementById("nav-menu");
            navLayer.classList.toggle("active");
        }
    </script>
</header>