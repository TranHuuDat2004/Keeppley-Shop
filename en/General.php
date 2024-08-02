<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Account Settings - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include '../php/head.php'; ?>
    <?php include '../php/login.php'; ?>
    <?php include '../php/getUser.php'; ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        body {
            background: #f5f5f5;
            margin-top: 20px;
        }

        .ui-w-80 {
            width: 80px !important;
            height: auto;
        }

        .btn-default {
            border-color: rgba(24, 28, 33, 0.1);
            background: rgba(0, 0, 0, 0);
            color: #4E5155;
        }

        .preview-img {
            display: block;
            max-width: 200px;
            margin-top: 10px;
        }
    </style>

    <script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
</head>

<body inmaintabuse="1">
<div class="headD">
    <div class="headDiv home">
    <!-- Important -->
    <div class="wal">
        <a href="../en/product.php" class="logo">
            <img src="../images/20221010151814746.png" class="PC-Box" alt="Qman Toys">
            <img src="../images/20221010151821394.png" class="Phone-Box" alt="Qman Toys">
        </a>

        <div class="lan">
            <ul>
                <li><a href="javascript:;" class="cur">EN</a></li>
                <li><a href="../vn/product.php">VN</a></li>

                <?php include '../php/welcomeUser_en.php'; ?>
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
                <div class="subNav"><a href="/en"><img src="/../images/20220825135842913.png" alt="">Our Story</a></div>
                <div class="subNav"><a href="/en/product/"><img src="/../images/20220825135859657.png" alt="">Our
                        Products</a></div>

                <div class="subNav"><a href="/en/Contact/"><img src="/../images/20220825135930547.png" alt="">Contact
                        Us</a></div>
            </div>
            <div class="lan">
                <ul>
                    <li><a href="javascript:;" class="cur">EN</a></li>

                </ul>
            </div>
        </div>
    </div>
</div>
    <!---->
    <div style="margin-top:80px"  class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" 
                            href="general.php">General</a>
                        <a class="list-group-item list-group-item-action"
                            href="ChangePassword.php">Change password</a>
                        <a class="list-group-item list-group-item-action " 
                            href="Information.php">Information</a>
                        <a class="list-group-item list-group-item-action " 
                            href="SocialLinks.php">Social links</a>
                        <a class="list-group-item list-group-item-action"
                            href="Connections.php">Connections</a>
                        <a class="list-group-item list-group-item-action " 
                            href="Notifications.php">Notifications</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">

                            <?php
                            if (isset($_SESSION['success_message'])) {
                                echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                                unset($_SESSION['success_message']); // Xóa thông báo sau khi hiển thị
                            }
                            ?>

                            <form action="../php/ChangeGeneral.php" method="POST" enctype="multipart/form-data">
                                <div class="card-body media align-items-center">
                                    <?php if($userLogin['image']):?>
                                        <img id="preview1" src="../user/<?php echo $userLogin['image'] ?>" height="200">
                                    <?php else:?>
                                        <img id="preview1" src="../user/male.png" height="200" >
                                    <?php endif; ?>
                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            
                                            <input type="file" class="account-settings-fileinput" name="profileImage" onchange="previewImage(event, 'preview1')">
                                        </label>
                                        
                                        
                                    </div>
                                </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">UserID:</label>
                                        <input type="text" class="form-control mb-1" value="<?php echo $userLogin['userID'] ?>" readonly>
                                        <input type="hidden" name="userID" value="<?php echo $userLogin['userID'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Username:</label>
                                        <input type="text" class="form-control mb-1" name="userName" value="<?php echo $userLogin['userName'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email:</label>
                                        <input type="email" class="form-control mb-1" name="email" value="<?php echo $userLogin['email'] ?>">
                                        <div class="alert alert-warning mt-3">
                                            Your email is not confirmed. Please check your inbox.<br>
                                            <a href="javascript:void(0)">Resend confirmation</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <button style="margin-bottom:30px; margin-right:30px" type="submit" class="btn btn-primary">Save changes</button>
                                    <button style="margin-bottom:30px; margin-right:30px" type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
