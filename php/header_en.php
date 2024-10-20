<style>
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
        font-size: 18px;
    }

    .navbar.desktop ul li .active {
        font-weight: 800;
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

    .btn {
        padding: 10px 20px;
        background-color: #ff5c5c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
    }

    .btn-login {
        padding: 10px 20px;
        background-color: #f5f5f5;
        color: #ff5c5c;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
    }
</style>

<!-- Desktop Navbar -->
<div class="navbar desktop">
            <div class="logo">
                <img src="../images/logo.png" alt="Brick Shop Logo">
            </div>
            <ul>
                <li><a class="active" href="../en">Home</a></li>
                <li><a href="../en/product.php">Products</a></li>
                <li><a href="../en/">Contact Us</a></li>
            </ul>
            <ul>
                <a href="../php/Signup_en.php" class="btn">Sign Up</a>
                <a href="../php/ChooseLogin_en.php" class="btn">Login</a>
            </ul>
        </div>