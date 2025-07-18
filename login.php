<?php
session_start();
include("Database/PDO-Connection.php");
$error="";
if (
isset($_POST['email']) && $_POST['email'] !== '' &&
isset($_POST['password']) && $_POST['password'] !== ''

) {
    if (isset($_POST['sub'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $result=$connection->prepare("SELECT * FROM `users` WHERE `email`=? AND `password`=?");
        $result->bindValue(1,$email);
        $result->bindValue(2,$password);
        $result->execute();

        if ($result->rowCount() >= 1) {
            $role=$result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $_POST['email'];
            $_SESSION['role'] = $role['role'];
            header('Location: /panel/user_panel.php');
            exit();
        }
        else{
            $error="ایمیل یا رمز عبور اشتباه است";
        }
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
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"-->
<!--          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="-->
<!--          crossorigin="anonymous" referrerpolicy="no-referrer"/>-->
    <title>ورود به حساب کاربری</title>
</head>
<body>
<section class="d-flex justify-content-center align-items-center min-h-screen bg">
    <div id="overlay"></div>
    <div class="form-container">
        <form action="#" method="post">
            <section class="title" style="color: red !important; font-size: 15px!important;">
                <?php
                if ($error !== "") {
                echo $error;
                }
                ?>
            </section>
            <h1 class="title">ورود به حساب کاربری</h1>
            <div class="mt-3 position-relative">
                <input type="email" name="email" class="field" placeholder="ایمیل ...">
                <i class="fa fa-user field_icon"></i>
            </div>
            <div class="mt-3 position-relative">
                <input name="password" type="password" class="field" id="fieldPass" placeholder="رمز عبور ...">
                <i class="fa fa-lock field_icon"></i>
                <button type="button" id="showPass"></button>
            </div>
            <div class="mt-3">
                <button type="submit" name="sub" class="btn-submit bg-primary">
                    <i class="fa fa-sign-in ms-1"></i>
                    <span>ورود به حساب کاربری</span>
                </button>
            </div>

            <p class="text">
                حساب کاربری ندارید ؟ <a href="/register.php" class="text-primary">یکی بسازید</a>
            </p>
        </form>
    </div>
</section>

<script src="js/showPassword.js"></script>
<script src="js/darkMode.js"></script>
</body>
</html>