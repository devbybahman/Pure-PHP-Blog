<?php
include("Database/PDO-Connection.php");
$error = "";

if (isset($_POST['sub'])) {
    if (
        isset($_POST['username']) && $_POST['username'] !== '' &&
        isset($_POST['email']) && $_POST['email'] !== '' &&
        isset($_POST['password']) && $_POST['password'] !== '' &&
        isset($_POST['repassword']) && $_POST['repassword'] !== ''
    ) {
        if ($_POST['password'] !== $_POST['repassword']) {
            $error = "رمز عبور با تکرار آن یکسان نیست";
        } elseif (strlen($_POST['password']) < 5) {
            $error = "رمز عبور باید بیشتر از 5 کاراکتر باشد";
        } else {
            // رمزها درست هستند و طول مناسبه، حالا ذخیره کن
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $result = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $result->bindValue(1, $username);
            $result->bindValue(2, $email);
            $result->bindValue(3, $password);

            if ($result->execute()) {
                echo "ثبت‌نام با موفقیت انجام شد.";
            } else {
                $error = "خطا در ثبت اطلاعات.";
            }
        }
    } else {
        $error = "لطفاً تمام فیلدها را پر کنید.";
    }
}
?>



<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/style.css">
    <link rel="stylesheet" href="styles/css/auth.css">
    <!-- Css Reset -->
    <link rel="stylesheet" href="styles/css/reset.css">
    <!-- Vazir Font -->
    <link rel="stylesheet" href="fonts/vazir.css">
    <!-- Fontawsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>ثبت نام</title>
</head>
<body>
<section class="d-flex justify-content-center align-items-center min-h-screen bg">
    <div id="overlay"></div>
    <div class="form-container">
        <form action="#" method="post">
            <span class="text-bg-danger"><?php $error ?></span>
            <h1 class="title">ثبت نام در وبلاگ</h1>
            <div class="mt-3 position-relative">
                <input type="" name="username" class="field" placeholder="نام ...">
                <i class="fa fa-user-plus field_icon"></i>
            </div>
            <div class="mt-3 position-relative">
                <input type="email" name="email" class="field" placeholder="ایمیل ...">
                <i class="fa fa-envelope field_icon" aria-hidden="true"></i>
            </div>
            <div class="mt-3 position-relative">
                <input type="password" name="password" class="field" id="fieldPass" placeholder="رمز عبور ...">
                <i class="fa fa-lock field_icon"></i>
                <button type="button" id="showPass"></button>
            </div>
            <div class="mt-3 position-relative">
                <input type="password" name="repassword" class="field" id="fieldPass" placeholder="تکرار رمز عبور ...">
                <i class="fa fa-check field_icon"></i>
                <button type="button" id="showPass"></button>
            </div>
            <div class="mt-3">
                <button name="sub" type="submit" class="btn-submit bg-primary">
                    <i class="fa fa-user-plus ms-1"></i>
                    <span>ثبت نام</span>
                </button>
            </div>

            <p class="text">
                قبلا ثبت نام کرده اید ؟ <a href="/login.php" class="text-primary">ورود</a>
            </p>
        </form>
    </div>
</section>

<script src="js/showPassword.js"></script>
<script src="js/darkMode.js"></script>
<script src="js/scroll.js"></script>
</body>
</html>