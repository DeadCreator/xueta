<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Главная страница</title>
</head>
<body>
    <?php include 'dbConfig.php' ;
    session_start();
    set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');

    include('Net/SSH2.php');
    unset($_SESSION['error'])?>

    <?php if (!isset($_SESSION['user'])) { ?>
        <main class="main-greetings">
            <section class="greetings">
                <a href="login.php">Вход</a>
                <a href="register.php">Регистрация</a>
<!--                <img src="media/main-logo.png" alt="">-->
            </section>
<!--            <section class="props">-->
<!--                <div class="prop">-->
<!--                    <img src="media/Options1.svg" alt="">-->
<!--                </div>-->
<!--                <div class="prop">-->
<!--                    <img src="media/Options2.svg" alt="">-->
<!--                </div>-->
<!--                <div class="prop">-->
<!--                    <img src="media/Options3.png" alt="">-->
<!--                </div>-->
<!--                <div class="prop">-->
<!--                    <img src="media/Options4.svg" alt="">-->
<!--                </div>-->
<!--            </section>-->
        </main>


    <?php } else {
        include 'header.php';
//        var_dump($_SESSION['user']);
//        var_dump($_SESSION); ?>

        <main class="main-page">
            <h2>Личные данные</h2>
            <section class="profile">
                <img src="media/avatar.svg" alt="" class="avatar">
                <h3 class="name">Имя: <b><?= $_SESSION['user']['name'] ?></b></h3>
                <h3 class="surname">Фамилия: <b><?= $_SESSION['user']['surname'] ?></b></h3>
                <h3 class="login">Логин: <b><?= $_SESSION['user']['email'] ?></b></h3>
                <h3 class="passport">Серия Паспорта: <b><?= $_SESSION['user']['passport_serie'] ?></b></h3>
                <h3 class="passport">Номер Паспорта: <b><?= $_SESSION['user']['passport_num'] ?></b></h3>
            </section>
            <img src="media/main-profile-dollar.svg" alt="" class="dollar bg">
            <img src="media/main-profile-triangle-big.svg" alt="" class="triangle-big bg">
            <img src="media/main-profile-triangle-up.svg" alt="" class="triangle-up bg">
            <img src="media/main-profile-triangle.svg" alt="" class="triangle-down bg">
            <img src="media/profile-man.svg" alt="" class="profile-man bg">
        </main>
        <?php } ?>
</body>
</html>

