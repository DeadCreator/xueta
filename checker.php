<?php //файл и сигнатурку надо поменять!!!!!!!!!!!!!
function cheker ($file , $signature , $email) {
    $stmt = $pdo->prepare("select publick_key FROM keys WHERE email = ?");
     $stmt->execute([$email]);
     $row = $stmt -> fetch();

     if (!row) {
         echo "Пользователь не найден.";
         return false ;
     }
     $publick_key = $row['publick_key'];

     $data = file_get_contents($file);

     $signature = base64_decode($signature);

     $res = openssl_get_publickey($publick_key);
     $result = openssl_verify($data , $signature , $res , OPENSSL_ALGO_SHA256);
     openssl_free_keys($res);

     if ($result == 1) {
     echo "Подпись верна , личность пользователя подтверждена";
     } elseif ($result == 0) {
         echo "Подпись не верна , попробуйте еще раз";
     } else {
         "Ошибка при проверке подписи";
     }
}
