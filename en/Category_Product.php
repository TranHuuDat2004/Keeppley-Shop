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
        <h2><?php echo $category_name_en ?> Products</h2>
        <div class="product-grid ">

            <?php
        $sqlProduct = "SELECT * FROM `product` WHERE `p_category` = '$category_name_en'";
        $resultProduct = mysqli_query($conn, $sqlProduct);


            // Kiểm tra xem có kết quả trả về không
            if ($resultProduct->num_rows > 0)
                while ($products = $resultProduct->fetch_assoc()):

                    // Tách chuỗi hình ảnh thành mảng và loại bỏ khoảng trắng thừa
                    $product_images = array_map('trim', explode(',', $products["p_image"]));


                    ?>

                    <div class="product animation">
                        <a href="Product_Detail.php?p_id=<?php echo $products['p_id']?>">
                        <img class="img1 w-100" src="../images/<?php echo $product_images[0]?>" alt="<?php echo $products['p_name_en']?>">
                        <p class="p_name"><?php echo $products['p_name_en']?></p>
                        <p class="p_num"><?php echo $products['p_number']?></p>
                        <p class="p_price">$ <?php echo $products['p_price_en']?></p>
                        </a>
                    </div>
                    <?php

                endwhile;
            ?>


        </div>

    </section>

        <!-- Footer Section -->
        <?php include '../en/footer.php' ?>


</body>

</html>