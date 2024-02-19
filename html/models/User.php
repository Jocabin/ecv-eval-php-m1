<?php
require_once dirname(__FILE__) . '/../bdd/db.php';

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;

    public function __construct($id = null, $username = null, $email = null, $password = null) {
        if (!empty($username)) {
            $this->setUsername($username);
        }
        if (!empty($email)) {
            $this->setEmail($email);
        }
        if (!empty($password)) {
            $this->setPassword($password);
        }
        if (!empty($id)) {
            $this->setId($id);
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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function save(): bool
    {
        global $dsn, $db_user, $db_pass;
        $dbh = new PDO($dsn, $db_user, $db_pass);

        $stmt = $dbh->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        return $stmt->execute();
    }

    public static function get($userId) {
        try {
            global $dsn, $db_user, $db_pass;
            $dbh = new PDO($dsn, $db_user, $db_pass);

            $stmt = $dbh->prepare("SELECT * FROM users WHERE id = :id;");

            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Error($e);
        }
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
                return new User($userInfos['id'], $userInfos['username'], $userInfos['email'], $userInfos['password']);
            }

            return false;
        } catch (PDOException $e) {
            throw new Error($e);
        }
    }
}