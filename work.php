<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Организация</title>
</head>
<body>
    <?php
    include 'header.php';
    session_start();
    include 'dbConfig.php';
    $ds = DIRECTORY_SEPARATOR;
    ?>
<main class="work">
    <h2>Организация</h2>
    <h3>Выберите файл</h3>
    <section class="doc-list">
        <?php
        $sth = $dbh -> query('SELECT * FROM docs');

        while ($doc = $sth -> fetch(PDO::FETCH_OBJ)) {
            $filename = explode($ds,$doc -> link)
            ?>
            <div class="doc-sign">
                <a href="docs/<?= $doc -> link ?>" class="doc-link"><?= $filename[1] ?></a>
                <form action="sign.php" method="post">
                    <input type="text" hidden="hidden" name="doc-link" value="<?= $doc -> link ?>">
                    <input name="sign" type="submit" value="Подписать">
                </form>
            </div>
        <?php } ?>
    </section>
    <img src="media/work-rect.svg" alt="" class="work-rect">
    <img src="media/profile-man.svg" alt="" class="work-man">
</main>
</body>
</html>

