<?php

class User
{
    private $name;
    private $surname;
    private $email;
    private $password_hash;
    private $passport_serie;
    private $passport_num;
    private $date;
    private $public_key;
    private $private_key;

    public function register($name, $surname, $email, $date, $passport_serie, $passport_num, $password) {
        include 'dbConfig.php';

        $sth = $dbh -> prepare('INSERT INTO users (name, surname, email, date, passport_serie, passport_num, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?)');
        try {
            $sth -> execute([
                $name, $surname, $email, $date, $passport_serie, $passport_num, password_hash($password, PASSWORD_DEFAULT)
            ]);

            $this -> generateKeyPair($email);
            $this -> login($email, $password);

        } catch (PDOException $e) {
            echo $e -> getMessage();
        }
    }

    public function login($email, $password) {
        include 'dbConfig.php';

        $sth = $dbh -> prepare('SELECT * FROM users WHERE email = ?');
        $sth -> execute([$email]);
        $user = $sth -> fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $user -> password_hash)) {
            $this -> name = $user -> name;
            $this -> surname = $user -> surname;
            $this -> email = $user -> email;
            $this -> date  = $user -> date;
            $this -> passport_serie = $user -> passport_serie;
            $this -> passport_num = $user -> passport_num;
            $this -> password_hash = $user -> password_hash;

            $sth = $dbh -> prepare('SELECT * FROM `keys` WHERE username = ?');
            $sth -> execute([$email]);
            $user = $sth -> fetch(PDO::FETCH_OBJ);

            $this -> public_key = $user -> public_key;
            $this -> private_key = $user -> private_key;
        }
    }

    public function generateKeyPair($email) {

        include('Crypt/RSA.php');

        $rsa = new Crypt_RSA();

        extract($rsa->createKey());


        include 'dbConfig.php';

        $stmt = $dbh -> prepare("INSERT INTO `keys` (username, private_key, public_key) VALUES (? , ? , ?)");

        try {
            $stmt->execute([$email , $privatekey, $publickey]);
            echo 'll';
        } catch (PDOException $e) {
            echo $e -> getMessage();
        }

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
 * @return mixed
 */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function getDate()
    {
        return $this -> date;
    }

    public  function getPassportSerie()
    {
        return $this -> passport_serie;
    }

    public function getPassportNum()
    {
        return $this -> passport_num;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    public function getPublicKey()
    {
        return $this -> public_key;
    }

    public function getPrivateKey()
    {
        return $this -> private_key;
    }
}