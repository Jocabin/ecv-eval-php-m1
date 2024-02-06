<?php
require_once dirname(__FILE__) . '/../bdd/db.php';

class User
{
    private string $username;
    private string $email;
    private string $password;

    public function __construct($username = null, $email = null, $password = null) {
        if (!empty($username)) {
            $this->setUsername($username);
        }
        if (!empty($email)) {
            $this->setEmail($email);
        }
        if (!empty($password)) {
            $this->setPassword($password);
        }
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername($username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): User
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function save(): bool
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $stmt = $dbh->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        return $stmt->execute();
//        todo return error messages to front end
    }

    public static function verifyPassword($email, $password): bool|User
    {
        try {
            global $dsn, $db_user, $db_pass;
            $dbh = new PDO($dsn, $db_user, $db_pass);

            $stmt = $dbh->prepare("SELECT * FROM users WHERE email = :email;");

            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $userInfos = $stmt->fetch();
            $hashedPassword = $userInfos['password'];

            if (password_verify($password, $hashedPassword)) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            throw new Error($e);
        }
    }
}