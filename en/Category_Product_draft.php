<?php

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


<html style="font-size: 80px;">

<head>
    <title><?php echo $category_name_en; ?></title>
    <?php include '../php/head.php'; ?>
</head>
<style>
    .imgDiv img {
        width: 75%;
        height: 75%;
        object-fit: cover
    }

    .box {
        padding-bottom: 40px;
        height: 500px;
    }

    .p_num {
        padding-top: 2px;
        text-align: center;
        line-height: 30px;
        color: #919191;
        font-size: 22px;
    }

    .p_name {
        padding-top: 2px;
        font-weight: bold;
        font-size: 24px;
        color: #242424;
        text-align: center;
    }

    .p_price {
        padding-top: 2px;
        font-weight: bold;
        font-size: 24px;
        color: #e74c3c;
        text-align: center;
    }

    @media only screen and (max-width: 1400px) {
        .pbanner {
            display: flex;
            justify-content: center;
            height: 90%;
            width: 80%;
            margin: auto;
        }
    }

    /* For mobile phones: */
    @media only screen and (max-width: 600px) {
        .imgDiv img {
            width: 75%;
            height: 75%;
            object-fit: cover
        }

        .box {
            padding-bottom: 40px;
            height: 600px;
        }

        .p_num {
            padding-top: 2px;
            text-align: center;
            line-height: 20px;
            color: #919191;
            font-size: 14px;
        }

        .p_name {
            padding-top: 2px;
            font-weight: bold;
            font-size: 14px;
            color: #242424;
            text-align: center;
        }

        .p_price {
            padding-top: 2px;
            font-weight: bold;
            font-size: 14px;
            color: #e74c3c;
            text-align: center;
        }


    }
</style>

<body>
    <!-- Desktop -->
    <?php include '../php/OurProducts_en.php'; ?>
    <!-- Mobile-->
    <?php include '../php/mobile_en.php'; ?>

    <!---->


    <div class="productList">
        <div class="wal">
            <div class="pbanner">
                <img src="../images/<?php echo $category_images[1]; ?>" class="PC-Box" alt="Doraemon" />
                <img src="../images/<?php echo $category_images[1]; ?>" class="Phone-Box" alt="Doraemon" />
            </div>
            <div class="title font-family"><?php echo $category_name_en; ?></div>
            <div class="list">
                <ul>

                    <?php
                    // Khởi tạo con trỏ kết quả truy vấn về sản phẩm
                    mysqli_data_seek($resultProduct, 0);

                    while ($product = $resultProduct->fetch_assoc()) {
                        // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
                        $product_images = array_map('trim', explode(',', $product["p_image"]));
                        // Kiểm tra và gán lại giá trị nếu ảnh thứ 2 và thứ 3 trống
                        if (empty($product_images[1])) {
                            $product_images[1] = $product_images[0];
                        }

                        if (empty($product_images[2])) {
                            $product_images[2] = $product_images[0];
                        }
                    ?>

                        <li>
                            <div class="box">
                                <a href="Product_Detail.php?p_id=<?php echo $product['p_id'] ?>">
                                    <div class="imgDiv">
                                        <img src="../images/<?php echo $product_images[0]; ?>"
                                            alt="<?php echo $product['p_name_en']; ?>" />
                                    </div>

                                    <div class="p_num"><?php echo $product['p_number']; ?></div>
                                    <div class="p_name"><?php echo $product['p_name_en']; ?></div>
                                    <div class="p_price">$ <?php echo $product['p_price_en']; ?></div>
                                </a>
                            </div>

                        </li>

                    <?php } ?>

                    <li>
                        <div class="box">
                            <div class="txt">More new products<br>Stay tuned</div>
                        </div>
                    </li>
                </ul>
                <div class="clear_f"></div>
            </div>
        </div>
    </div>

    <!---->

    </script>
    <!-- Moblie  -->
    <script language="javascript" type="text/javascript" src="../script/js.js"></script>

    <script src="chrome-extension://igkkmokkmlbkkgdnkkancbonkbbmkioc/sm.bundle.js" data-pname="recorder-screenshot-v3"
        data-asset-path="https://apv3.s3.ap-northeast-2.amazonaws.com"></script>
    <div style="display: none" class="ubey-RecordingScreen-count-down ubey-RecordingScreen-count-down-container">
        <style>
            .ubey-RecordingScreen-count-down-container {
                position: fixed;
                height: 100vh;
                width: 100vw;
                top: 0;
                left: 0;
                z-index: 9999999999999;
                background-color: rgba(0, 0, 0, 0.2);
            }

            .ubey-RecordingScreen-count-down-content {
                position: absolute;
                display: flex;
                top: 50%;
                left: 50%;
                justify-content: center;
                align-items: center;
                color: white;
                height: 15em;
                width: 15em;
                transform: translate(-50%, -100%);
                background-color: rgba(0, 0, 0, 0.6);
                border-radius: 50%;
            }

            #ubey-RecordingScreen-count-count {
                font-size: 14em;
                transform: translateY(-2%);
            }
        </style>
        <div class="ubey-RecordingScreen-count-down-content">
            <span id="ubey-RecordingScreen-count-count"></span>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>
<?php include 'cart.php'; ?>
<chatgpt-sidebar data-gpts-theme="light"></chatgpt-sidebar><chatgpt-sidebar-popups
    data-gpts-theme="light"></chatgpt-sidebar-popups>

</html>