<!-- <?php
// if (!isset($_SESSION["userName"])) {
// 	// Redirect user to the login page if not logged in
// 	header("Location: ../html/reaction_form.html");
// 	exit(); // Stop further execution of the script
// }
?> -->

<html style="font-size: 80px;">

<head>
    <?php include '../php/head.php'; ?>
    <?php include '../php/login.php'; ?>
    <?php include '../php/getUser.php'; ?>
</head>

<style>
    .frem {
        width: 100%;
        height: 1000px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background: url('../images/404.gif');
        background-position: center;
        background-repeat: no-repeat;
    }

    .frem h2 {
        position: absolute;
        bottom: 7.8rem;
        font-size: 80px;
    }

    .frem h3 {
        position: absolute;
        bottom: 2rem;
        font-size: 34px;
    }

    .frem h4 {
        position: absolute;
        bottom: 1.5rem;
        font-size: 28px;
    }
</style>

<body inmaintabuse="1">


    <div class="headD"></div>
    <div class="headDiv home">
        <?php include '../php/header_vn.php'; ?>
        <div class="lan">
            <ul>
                <li><a href="../en/404.php" >EN</a></li>
                <li><a href="" class="cur">VN</a></li>

                <?php include '../php/welcomeUser_vn.php'; ?>
            </ul>
        </div>
    </div>
    </div>
    <!---->
    <div class="navLayer">
        <div class="bg">
            <div class="toptop">
                <a href="/en" class="logo"><img src="../images/20221010151821394.png" alt="Qman Toys"></a>
                <div class="txt">Home</div>
                <a href="javascript:;" class="closeBtn"><img src="/images/close.png"></a>
            </div>
            <div class="sideNav">
                <div class="subNav"><a href="/vn"><img src="/../images/20220825135842913.png" alt="">Our Story</a></div>
                <div class="subNav"><a href="/vn/product/"><img src="/../images/20220825135859657.png" alt="">Our
                        Products</a></div>

                <div class="subNav"><a href="/vn/Contact/"><img src="/../images/20220825135930547.png" alt="">Contact
                        Us</a></div>
            </div>
            <div class="lan">
                <ul>
                    <li><a href="#" class="cur">EN</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!---->


    <!-- 404 Page -->
    <div class="frem">
        <h2>404</h2>
        <h3>Có vẻ như bạn đang lạc đường.</h3>
        <h4>Trang bạn tìm kiếm hiện không thể kết nối hoặc không tìm thấy!!</h4>
    </div>









        <script language="javascript" type="text/javascript" src="/en/script/js.js"></script>
        <script src="chrome-extension://igkkmokkmlbkkgdnkkancbonkbbmkioc/sm.bundle.js"
            data-pname="recorder-screenshot-v3" data-asset-path="https://apv3.s3.ap-northeast-2.amazonaws.com"></script>
        <div style="display: none" class="ubey-RecordingScreen-count-down ubey-RecordingScreen-count-down-container">
            
            <div class="ubey-RecordingScreen-count-down-content">
                <span id="ubey-RecordingScreen-count-count"></span>
            </div>
        </div>
</body><chatgpt-sidebar data-gpts-theme="light"></chatgpt-sidebar><chatgpt-sidebar-popups
    data-gpts-theme="light"></chatgpt-sidebar-popups>

</html>