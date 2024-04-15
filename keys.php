<?php //файл и сигнатурку надо поменять!!!!!!!!!!!!!
function generateKeyPair($email) {
    $config = [
        "digest_alg" => "sha256",
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
        "config" => "C:\Program Files\Ampps\apache\conf\openssl.cnf"
    ];
    $res = openssl_pkey_new($config);
    openssl_pkey_export($res , $privateKey);
    $publicKey = openssl_pkey_get_details($res)["key"];

    include 'dbConfig.php';

    $stmt = $pdo -> prepare("INSERT INTO keys (username, private_key, piblick_key) VALUES (? , ? , ?)");
    $stmt->execute([$email , $privateKey , $publicKey]);

}

$email = 'Новый пользователь';
generateKeyPair($email);
?>
