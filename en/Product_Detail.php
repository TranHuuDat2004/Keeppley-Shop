<?php

include '../php/login.php';
include '../php/getUser.php';
if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];

    $sqlProduct = "SELECT * FROM `product` WHERE `p_id` = '$p_id'";
    $resultProduct = mysqli_query($conn, $sqlProduct);

    // Kiểm tra xem có kết quả trả về không
    if ($resultProduct->num_rows > 0) {
        // Khởi tạo mảng để lưu trữ các sản phẩm
        $products = array();

        while ($row = $resultProduct->fetch_assoc()) {
            // Đưa từng sản phẩm vào mảng products
            $products = array(
                "p_id" => $row["p_id"],
                "p_number" => $row["p_number"],
                "p_image" => $row["p_image"],
                "p_name_en" => $row["p_name_en"],
                "p_name_vn" => $row["p_name_vn"],
                "p_price_en" => $row["p_price_en"],
                "p_price_vn" => $row["p_price_vn"],
                "p_age" => $row["p_age"],
                "p_category" => $row["p_category"], // Thêm trường p_category
                "p_tutorial" => $row["p_tutorial"],
                "p_description_en" => $row["p_description_en"],
                "p_description_vn" => $row["p_description_vn"],
                "p_sold" => $row["p_sold"],
                "p_stock_status" => $row["p_stock_status"], // Thêm trường p_stock_status
                "p_product_status" => $row["p_product_status"] // Thêm trường p_product_status
            );
        }

        // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
        $product_images = array_map('trim', explode(',', $products["p_image"]));

        // Kiểm tra và gán lại giá trị nếu ảnh thứ 2 và thứ 3 trống
        if (empty($product_images[1])) {
            $product_images[1] = $product_images[0];
        }

        if (empty($product_images[2])) {
            $product_images[2] = $product_images[0];
        }
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
// Truy vấn chi tiết danh mục dựa trên id
$sqlCategory = "SELECT * FROM `category` WHERE `name_en` = '" . $products['p_category'] . "'";
$resultCategory = mysqli_query($conn, $sqlCategory);

// Kiểm tra xem có kết quả trả về không
if ($resultCategory->num_rows > 0) {
    // Lấy thông tin chi tiết của danh mục
    $category = $resultCategory->fetch_assoc();

    $category_name_en = $category["name_en"];
    $category_name_vn = $category["name_vn"];
    $provider = $category["provider"];
}
$website = "Product_Detail.php?p_id=" . $product['p_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail Page</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <?php include '../php/head.php'; ?>
    <?php include '../php/login.php'; ?>
    <?php include '../php/getUser.php'; ?>

    <style>
        body {
            background-color: #f8f8f8;
            padding-top: 80px;
            margin: 0;
            /* padding: 0; */
            min-height: 100%;
            overflow-x: hidden;
        }

        .container {
            background-color: #fff;
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .left-column {
            flex: 70%;
            display: flex;
        }

        .left-column img#main-image {
            width: 70%;
            border-radius: 10px;
        }

        /* Ảnh nhỏ bên trái */
        .thumbnails {
            display: flex;
            flex-direction: column;
            margin-right: 10px;
            width: 33%;
        }

        .thumbnails img {
            max-width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            cursor: pointer;
            border-radius: 10px;

        }

        .right-column {
            flex: 50%;
            padding: 20px;
        }


        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .price {
            font-size: 28px;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .quantity {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .quantity input {
            width: 50px;
            height: 30px;
            text-align: center;
            border-radius: 5px;
            margin: 0 10px;
            border: 1px solid #ddd;
        }

        .add-to-cart-btn {
            background-color: #e74c3c;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
        }

        .instruction-btn {
            margin-left: 20px;
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
        }


        .store-info,
        .product-info {
            margin-top: 20px;
            font-size: 18px;
        }

        h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .store-info div,
        .product-info div {
            margin-bottom: 10px;

        }

        .productBox {
            margin-bottom: 0;
            /* Đảm bảo không có margin phía dưới */
            padding-bottom: 0;
            /* Đảm bảo không có padding phía dưới */
        }

        /* Đối với Chrome, Safari, Edge, và Opera */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Đối với Firefox */
        /* input[type=number] {
            -moz-appearance: textfield;
        } */

        /* Định dạng container của các nút và trường nhập */
        .quantity {
            display: flex;
            align-items: center;
        }

        .quantity input[type="number"] {
            width: 50px;
            height: 40px;
            text-align: center;
            font-size: 18px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 0 10px;
        }

        /* Định dạng cho nút + và - */
        .quantity .quantity-btn {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #333;
            font-size: 20px;
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .quantity .quantity-btn:hover {
            background-color: #ddd;
        }

        .quantity .quantity-btn:active {
            background-color: #ccc;
        }

        /* Zoom image */
        .zoom-container {
            position: relative;
            overflow: hidden;
            width: 150%;
        }

        /* Ensure the image fits within the container */
        .zoom-container img {
            padding-left: 50px;
            width: 150%;
            border-radius: 10px;
            height: auto;
            transition: transform 0.3s ease;
        }

        /* Zoom Hover */
        .zoom-container:hover img {
            transform: scale(1.5);
            /* Scale upsize 150% on hover */
        }
    </style>
</head>

<body>
    <!-- Desktop -->
    <?php include '../php/OurProducts_en.php'; ?>
    <!-- Mobile-->
    <?php include '../php/mobile_en.php'; ?>

    <div class="container">
        <div class="left-column">
            <div class="thumbnails">
                <img src="../images/<?php echo $product_images[0] ?>" alt="Thumbnail 1" onclick="changeImage(this)">
                <img src="../images/<?php echo $product_images[1] ?>" alt="Thumbnail 2" onclick="changeImage(this)">
                <img src="../images/<?php echo $product_images[2] ?>" alt="Thumbnail 3" onclick="changeImage(this)">
            </div>
            <div class="zoom-container">
                <img src="../images/<?php echo $product_images[0] ?>" alt="Product Image" id="main-image">
            </div>

        </div>

        <div class="right-column">
            <h1 class="product-title"><?php echo $products['p_name_en'] ?></h1>
            <div class="price">$ <?php echo $products['p_price_en'] ?></div>

            <!-- <div class="product-info">
                <h3>Thông tin sản phẩm:</h3>
                <div>Chủ đề: <?php echo $products['p_category'] ?></div>
                <div>Mã sản phẩm: <?php echo $products['p_number'] ?> </div>
                <div>Nhà cung cấp: <?php echo $provider ?></div>
                <div>Tuổi: <?php echo $products['p_age'] ?></div>
                <!-- Thêm thông tin sản phẩm khác -->
            <!--</div> -->

            <div class="product-info">
                <h3>Product Information:</h3>
                <div>Category: <?php echo $products['p_category'] ?></div>
                <div>Product Code: <?php echo $products['p_number'] ?></div>
                <div>Supplier: <?php echo $provider ?></div>
                <div>Age: <?php echo $products['p_age'] ?></div>
                <!-- Add other product information -->
            </div>



            <div class="quantity">
                <button onclick="decreaseQuantity()" class="quantity-btn">-</button>
                <input id="quantity-input" type="number" value="1" min="1">
                <button onclick="increaseQuantity()" class="quantity-btn">+</button>
            </div>

            <button id="button-add"
                class="add-to-cart-btn flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">Add
                to cart</button>

            <?php if ($products['p_tutorial']): ?>
                <a href="../pdf/<?php echo $products['p_tutorial']; ?>"><button class="instruction-btn">View
                        Instruction</button></a>
            <?php else: ?>
                <a href="404.php"><button class="instruction-btn">View Instruction</button></a>
            <?php endif; ?>


        </div>
    </div>

    <div class="productBox">
        <div class="wal">

            <div class="title title2" id="page-100000010724924">Best-Selling Products</div>
            <div class="list">
                <ul>
                    <?php

                    $sqlKeeppley = "SELECT * FROM `Category` WHERE `provider` = 'Keeppley'";
                    $result = mysqli_query($conn, $sqlKeeppley);

                    // Kiểm tra xem có kết quả trả về không
                    if ($result->num_rows > 0)
                        while ($category = $result->fetch_assoc()):

                            // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
                            $product_images = array_map('trim', explode(',', $category["images"]));
                            ?>
                            <li>
                                <div class="box">
                                    <div class="imgDiv"><a
                                            href="../en/Category_Product.php?id=<?php echo $category['id']; ?>"><img
                                                src="../images/<?php echo $product_images[0]; ?>"
                                                alt="<?php echo $category['name_en'] ?>"></a>
                                    </div>
                                    <div style="background-color: #f8f8f8" class="botDiv">
                                        <div class="name"><a href="../en/doraemon.php"><?php echo $category['name_en'] ?></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php

                        endwhile;
                    ?>
                </ul>
                <div class="clear_f"></div>
            </div>

            <div class="pageMore" onclick="MoreData(this)" data-id="100000010724924" data-page="2"
                style="display: none;"><a href="javascript:;">
                    More Series &gt;</a></div>

        </div>

        <!-- Moblie  -->
        <script language="javascript" type="text/javascript" src="../script/js.js"></script>
        <script>


            function changeImage(element) {
                document.getElementById('main-image').src = element.src;
            }

            function increaseQuantity() {
                var quantityInput = document.getElementById('quantity-input');
                var currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            }

            function decreaseQuantity() {
                var quantityInput = document.getElementById('quantity-input');
                var currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            }

            // Công thức zoom ảnh
            $(document).ready(function () {
                $(".zoom-container").mousemove(function (e) {
                    var image = $(this).find("img");
                    var offsetX = e.pageX - $(this).offset().left;
                    var offsetY = e.pageY - $(this).offset().top;
                    var posX = offsetX / $(this).width() * 100;
                    var posY = offsetY / $(this).height() * 100;
                    image.css("transform-origin", posX + "% " + posY + "%");
                });
            });
        </script>

        <!--===============================================================================================-->
        <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="../vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="../vendor/bootstrap/js/popper.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="../vendor/select2/select2.min.js"></script>
        <script>
            $(".js-select2").each(function () {
                $(this).select2({
                    minimumResultsForSearch: 20,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            })
        </script>
        <!--===============================================================================================-->
        <script src="../vendor/daterangepicker/moment.min.js"></script>
        <script src="../vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="../vendor/slick/slick.min.js"></script>
        <script src="js/slick-custom.js"></script>
        <!--===============================================================================================-->
        <script src="../vendor/parallax100/parallax100.js"></script>
        <script>
            $('.parallax100').parallax100();
        </script>
        <!--===============================================================================================-->
        <script src="../vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
        <script>
            $('.gallery-lb').each(function () { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    mainClass: 'mfp-fade'
                });
            });
        </script>
        <!--===============================================================================================-->
        <script src="../vendor/isotope/isotope.pkgd.min.js"></script>
        <!--===============================================================================================-->
        <script src="../vendor/sweetalert/sweetalert.min.js"></script>
        <script>
            $('.js-addwish-b2, .js-addwish-detail').on('click', function (e) {
                e.preventDefault();
            });

            $('.js-addwish-b2').each(function () {
                var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
                $(this).on('click', function () {
                    swal(nameProduct, "is added to wishlist !", "success");

                    $(this).addClass('js-addedwish-b2');
                    $(this).off('click');
                });
            });

            $('.js-addwish-detail').each(function () {
                var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

                $(this).on('click', function () {
                    swal(nameProduct, "is added to wishlist !", "success");

                    $(this).addClass('js-addedwish-detail');
                    $(this).off('click');
                });
            });

            /*---------------------------------------------*/

            $('.js-addcart-detail').each(function () {
                var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
                $(this).on('click', function () {
                    swal(nameProduct, "is added to cart !", "success");
                });
            });

            $('.js-buycart-detail').each(function () {
                var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
                $(this).on('click', function () {
                    swal(nameProduct, "is ready to buy !", "success");
                });
            });

            // Zoom Image
            $(document).ready(function () {
                $(".zoom-container").mousemove(function (e) {
                    var image = $(this).find("img");
                    var offsetX = e.pageX - $(this).offset().left;
                    var offsetY = e.pageY - $(this).offset().top;
                    var posX = offsetX / $(this).width() * 100;
                    var posY = offsetY / $(this).height() * 100;
                    image.css("transform-origin", posX + "% " + posY + "%");
                });
            });
        </script>
        <!--===============================================================================================-->
        <script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script>
            $('.js-pscroll').each(function () {
                $(this).css('position', 'relative');
                $(this).css('overflow', 'hidden');
                var ps = new PerfectScrollbar(this, {
                    wheelSpeed: 1,
                    scrollingThreshold: 1000,
                    wheelPropagation: false,
                });

                $(window).on('resize', function () {
                    ps.update();
                })
            });

            document.getElementById("button-add").addEventListener("click", function () {

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "add_to_cart.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Xử lý phản hồi từ máy chủ (nếu cần)
                        console.log(xhr.responseText);
                    }
                };
                xhr.send("productId=" + productId + "&quantity=" + quantity);
            });

            // Người dùng lựa chọn số lượng sản phẩm để thêm vào giỏ hàng
            document.addEventListener("DOMContentLoaded", function () {
                var quantityInput = document.getElementById("quantity-input");
                var hiddenQuantity = document.getElementById("hidden-quantity");
                var hiddenQuantityBuy = document.getElementById("hidden-quantity-buy");

                // Lắng nghe sự kiện thay đổi giá trị trong ô input
                quantityInput.addEventListener("change", function () {
                    // Cập nhật giá trị biến quantity
                    var quantity = parseInt(this.value);
                    hiddenQuantity.value = quantity;
                    hiddenQuantityBuy.value = quantity;
                });

                // Lắng nghe sự kiện nhấn nút tăng giảm số lượng
                var buttons = document.querySelectorAll(".btn-num-product-up, .btn-num-product-down");
                buttons.forEach(function (button) {
                    button.addEventListener("click", function () {
                        // Cập nhật giá trị biến quantity
                        var currentValue = parseInt(quantityInput.value);
                        var newValue = this.classList.contains("btn-num-product-up") ? currentValue : currentValue;
                        quantityInput.value = newValue >= 1 ? newValue : 1;
                        hiddenQuantity.value = quantityInput.value;
                        hiddenQuantityBuy.value = quantityInput.value;
                    });
                });
            });

            // Truyền biến PHP vào JavaScript
            var images = "<?php echo $product["p_image"]; ?>";

            // Tách chuỗi thành mảng
            var imageArray = images.split(',');

            // Container để chứa các hình ảnh
            var container = document.getElementById('image-container');

            // Duyệt qua từng hình ảnh trong mảng và tạo các phần tử hình ảnh
            imageArray.forEach(function (imagePath, index) {
                var img = document.createElement('img');
                img.src = imagePath;

                // Thêm các class màu sắc khác nhau dựa vào index
                if (index % 3 === 0) {
                    img.classList.add('image-1');
                } else if (index % 3 === 1) {
                    img.classList.add('image-2');
                } else {
                    img.classList.add('image-3');
                }

                container.appendChild(img);
            })

        </script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>
</body>
<?php include 'footer.php'; ?>
<?php include 'cart.php'; ?>

</html>