<?php

require_once dirname(__FILE__) . '/../bdd/db.php';

class Product
{
    private int $id;
    private string $name;
    private string $description;
    private float $price;

    public function __construct($item)
    {
        $this->id = $item['id'];
        $this->name = $item['name'];
        $this->description = $item['description'];
        $this->price = $item['price'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public static function getList(): array
    {
        try {
            global $dsn, $db_user, $db_pass;
            $dbh = new PDO($dsn, $db_user, $db_pass);

            $stmt = $dbh->prepare("SELECT * FROM products;");

            $stmt->execute();
            $resultArray = $stmt->fetchAll();

            return array_map(function ($item) {
                return new Product($item);
            }, $resultArray);
        } catch (PDOException $e) {
            throw new Error($e);
        }
    }

    public static function get($id): Product
    {
        try {
            global $dsn, $db_user, $db_pass;
            $dbh = new PDO($dsn, $db_user, $db_pass);

            $stmt = $dbh->prepare("SELECT * FROM products WHERE id = :id;");
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            $item = $stmt->fetch();

            return new Product($item);
        } catch (PDOException $e) {
            throw new Error($e);
        }
    }
}