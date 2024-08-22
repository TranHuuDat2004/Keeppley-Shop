<div class="navLayer">

    <div class="bg">
        <div class="toptop ">
            <a href="../en/product.php" class="logo"><img src="../images/20221010151821394.png" alt="Qman Toys"></a>

            <div class="txt">Home</div>
            <a style="padding-top: 20px;" href="javascript:;" class="closeBtn"><img src="../images/close.png" /></a>
        </div>
        <div class="sideNav">
        <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="subNav"><a href="/en"><img src="../images/20220825135842913.png" alt="">Our Story</a></div>
            <div class="subNav"><a href="/en/product/"><img src="../images/20220825135859657.png" alt="">Our
                    Products</a></div>

            <div class="subNav"><a href="/en/Contact/"><img src="../images/20220825135930547.png" alt="">Contact Us</a>
            </div>
        </div>
        <div class="lan">
            <ul>
                <li><a href="../en/<?php echo $website ?>" class="cur">EN</a></li>
                <li><a href="../vn/<?php echo $website ?>">VN</a></li>

            </ul>
        </div>
    </div>

</div>

<Style>
    .hamburger-menu {
        display: inline-block;
        cursor: pointer;
        position: absolute;
        top: 20px;
        /* Adjust according to your layout */
        right: 20px;
        /* Adjust according to your layout */
    }

    .hamburger-menu .bar {
        width: 25px;
        /* Width of the bars */
        height: 3px;
        /* Thickness of the bars */
        background-color: #fff;
        /* Color of the bars, adjust as needed */
        margin: 5px 0;
        transition: 0.4s;
    }
</Style>

<script>
    document.querySelector('.hamburger-menu').addEventListener('click', function () {
        document.querySelector('.navLayer').classList.toggle('open');
    });

</script>