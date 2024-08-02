<?php
session_start();

// if (!isset($_SESSION['username'])) {
//   header('Location: ../admin/index.php');
//   die();
// }

$username = '';
$password = '';
$error = '';

$conn = new mysqli('localhost', 'root', '', 'keeppley-shop'); //servername, usernamename, password, database's name
if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
} else {
    if (isset($_POST['username']) && isset($_POST['password'])) { // kiểm tra xem biến có tồn tại hay không
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username === 'admin' && $password === '1234') {
            $_SESSION['username'] = 'admin.com';
            header('Location: ../Admin/public/index.php');
        } else {
            $stmt = $conn->prepare("SELECT * FROM login WHERE username = ? AND loginpassword = ?"); // so sánh biến nhập vào với database
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows <= 0) {
                $error = 'Invalid username or password';
                header('Location: ../html/reaction_form_vn.html'); // Chuyển hướng đến trang reaction_form.html nếu đăng nhập thất bại
            } else {
                $row = $result->fetch_assoc();
                $_SESSION['userID'] = $row['userID'];

                // print_r($_SESSION['username']);
                
                header('Location: ../vn/product.php');
            }

            $stmt->close();
            $conn->close();
        }
    }
}
?>
