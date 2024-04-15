<?php
session_start() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Отправка документов</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="send-file">
        <section class="send-form">
            <h2>Отправка</h2>
            <form action="upload.php" enctype="multipart/form-data" method="post">
                <label for="file">Документ: </label>
                <input type="file" name="doc" id="file" required>
                <input type="submit" name="send" value="Отправить">
            </form>
        </section>
    </main>
</body>
</html>

<?php




