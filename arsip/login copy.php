<?php
    session_start();
    require 'functions.php';





    if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];
        $result = mysqli_query($db, "SELECT nim FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
        if($key === hash('sha256', $row['nim'])) {
            $_SESSION['login'] = true;
        }
    }
    if (isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }
    if (isset($_POST["login"])){
        $nim = $_POST["nim"];
        $password = $_POST["password"];
        $result = mysqli_query($db, "SELECT * FROM user WHERE nim = '$nim'");

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;
                    if(isset($_POST['remember'])) {
                        setcookie('id', $row['id'], time() + 86400);
                        setcookie('key', hash('sha256', $row['nim'], time() + 86400));
                    }
                header("Location: index.php");
                exit;
            }
        }
        $error = true;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman login</title>
</head>
<body>

<h1>Halaman login</h1>

<?php if(isset($error)) : ?>
    <p style="color: red; font-style: italic;">username / password salah!</p>
    <?php endif; ?>

<form action="" method="post">
    <ul>
        <li>
            <label for="nim">nim: </label>
            <input type="text" name="nim" id="nim">
        </li>
        <li>
            <label for="password">password: </label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label>
        </li>
        <li>
            <button type="submit" name="login">login!</button>
        </li>

    </ul>


</form>
    
</body>
</html>