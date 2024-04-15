<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Документы</title>
</head>
<body>
    <?php
        session_start();
        include 'header.php';
        include 'dbConfig.php';
        include('Crypt/RSA.php');

        $ds = DIRECTORY_SEPARATOR;
    ?>
    <main class="docs">
        <h2 class="hd">Документы</h2>
        <section class="doc-list">
            <h2>Отправленные документы</h2>
            <ol>
            <?php
            $sth = $dbh -> query('SELECT * FROM docs');

            while ($doc = $sth -> fetch(PDO::FETCH_OBJ)) {
                $filename = explode($ds, $doc -> link)
                ?>
                <li class="doc">Документ
                    <a href="docs/<?= $doc -> link ?>" class="doc-link" > <?= $filename[1] ?></a>
                    загружен.
                </li>
            <?php } ?>
            </ol>
        </section>
        <section class="signed-doc-list">
            <h2>Подписанные документы</h2>
            <ol>
            <?php
            $sth = $dbh -> query('SELECT * FROM signed_docs');
            $ds = DIRECTORY_SEPARATOR;

            while ($doc = $sth -> fetch(PDO::FETCH_OBJ)) {
                $rsa = new Crypt_RSA();

                $rsa -> loadKey($_SESSION['user']['public_key']);
                $plaintext = file_get_contents('docs' . $ds . $doc -> link);
                $filename = explode($ds, $doc -> link)
                ?>
                <li class="doc">
                    <a href="politex/docs/signed/<?= $filename[1] ?>" class="doc-link"><?= $filename[1]?></a>
                    <?php

                        if ($rsa->verify($plaintext, base64_decode($doc -> signature))) { ?>
                            Подпись подтверждена.
                        <?php } else { ?>
                            Подпись не подтверждена.
                        <?php } ?>
                </li>
            <?php } ?>
            </ol>
        </section>
        <img src="media/docs-triangle-1.svg" alt="" class="docs-triangle-1">
        <img src="media/docs-triangle-2.svg" alt="" class="docs-triangle-2">
    </main>
</body>
</html>

