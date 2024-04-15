<?php
session_start();
if (!empty($_FILES)) {
    if (preg_match_all('(\.(pdf|doc))', $_FILES['doc']['name']) === 1) {

        $ds = DIRECTORY_SEPARATOR;

        $url = $_SERVER['DOCUMENT_ROOT'] . $ds . 'politex' . $ds . 'docs' . $ds . 'unsigned' . $ds  ;
        $format = explode('.', $_FILES['doc']['name']);
        $filename = time() . '.' . $format[1];
        if (move_uploaded_file($_FILES['doc']['tmp_name'], $url . $filename)) {

            include "dbConfig.php";

            $sth = $dbh -> prepare('INSERT INTO docs (link) VALUES (?)');
            $sth -> execute(['unsigned' . $ds . $filename]);

        }
    }
}

header("Location: /politex/docs.php");