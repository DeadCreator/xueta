<?php
session_start();
if (!empty($_POST['sign']) && !empty($_POST['doc-link'])) {

    include('Crypt/RSA.php');
    include 'dbConfig.php';

    $rsa = new Crypt_RSA();
    $sth = $dbh -> prepare('SELECT * FROM `keys` WHERE username = ?');

    try {
        $sth -> execute([$_SESSION['user']['email']]);
        $user_keys = $sth -> fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        echo $e -> getMessage();
    }
    $ds = DIRECTORY_SEPARATOR;
    $rsa -> loadKey($user_keys -> private_key);
    $plaintext = file_get_contents('docs' . $ds . $_POST['doc-link']);

    $rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PSS);
    $signature = $rsa->sign($plaintext);

    $sth = $dbh -> prepare('INSERT INTO `signed_docs` (signature, public_key, link) VALUES (?, ?, ?)');
    try {
        $newdir = explode($ds, $_POST['doc-link']);
        $sth -> execute([
            base64_encode($signature), $user_keys -> public_key, 'signed' . $ds . $newdir[1]
        ]);
        $url = $_SERVER['DOCUMENT_ROOT'] . $ds . 'politex' . $ds . 'docs' . $ds;
        rename('docs' . $ds . $_POST['doc-link'], 'docs' . $ds . 'signed' . $ds . $newdir[1]);
    } catch (PDOException $e) {
        echo $e -> getMessage();
    }

    $sth = $dbh -> prepare('DELETE FROM docs WHERE link = ?');
    try {
        $sth -> execute([$_POST['doc-link']]);
    } catch (PDOException $e) {
        echo $e -> getMessage();
    }
}

header("Location: /politex/docs.php");