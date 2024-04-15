<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация</title>
</head>
<body>
    <?php session_start();
    if (isset($_SESSION['user'])) header('Location: /');
    ?>
    <main class="main-auth">
        <h2>Авторизуйтесь</h2>
        <form action="auth.php" class="auth log" method="post">
            <label for="email">login</label>
            <input id="email" type="email" name="email">
            <label for="password">password</label>
            <input id="password" type="password" name="password">
            <p>Если у вас нет аккаунта, <a href="register.php">создайте его</a></p>
            <input type="submit" name="login" value="Login">

        </form>
        <img class="triangle" src="media/auth-triangle.svg" alt="">
        <img src="media/man.svg" alt="" class="man">
    </main>
</body>
</html>
