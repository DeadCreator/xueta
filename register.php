<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Регистрация</title>
</head>
<body>
    <?php session_start();
        if (isset($_SESSION['user'])) header('Location: /');
    ?>
    <main class="main-auth main-reg">
        <h2>Регистрация</h2>
        <form action="auth.php" method="post" class="auth reg">
            <label for="email">Login</label>
            <input id="email" type="email" name="email" required>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            <label for="date">Date of Your birthday</label>
            <input id="date" type="date" name="date" required>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" required>
            <label for="surname">Surname</label>
            <input id="surname" type="text" name="surname" required>
            <label for="passport_serie">Passport Serie</label>
            <input id="passport_serie" type="text" name="passport_serie" minlength="4" maxlength="4" required>
            <label for="passport_num">Passport No.</label>
            <input id="passport_num" type="text" minlength="6" maxlength="6" name="passport_num" required>

            <input type="submit" name="register" value="Зарегистрироваться">
        </form>
        <img class="triangle" src="media/auth-triangle-reg.svg" alt="">
        <img src="media/reg-man.svg" alt="" class="man">
    </main>
</body>
</html>