<?php
require_once dirname(__FILE__) . '/../bdd/db.php';

class Order
{
    private int $id;
    private int $productId;
    private int $userId;
    private float $total;

    public function __construct($item = null) {
        if (isset($item)) {
            $this->id = $item['id'];
            $this->productId = $item['product_id'];
            $this->userId = $item['user_id'];
            $this->total = $item['total'];
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): Order
    {
        $this->total = $total;
        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): Order
    {
        $this->productId = $productId;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): Order
    {
        $this->userId = $userId;
        return $this;
    }

    public function save(): bool
    {
        try {
            global $dsn, $db_user, $db_pass;
            $dbh = new PDO($dsn, $db_user, $db_pass);

            $stmt = $dbh->prepare("INSERT INTO orders (product_id, user_id, total) VALUES (:product_id, :user_id, :total);");
            $stmt->bindParam(':product_id', $this->productId);
            $stmt->bindParam(':user_id', $this->userId);
            $stmt->bindParam(':total', $this->total);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Error($e);
        }
    }

    public static function getList($userId): array {
        try {
            global $dsn, $db_user, $db_pass;
            $dbh = new PDO($dsn, $db_user, $db_pass);

            $stmt = $dbh->prepare("SELECT * FROM orders where user_id = :user_id;");
            $stmt->bindParam(':user_id', $userId);

            $stmt->execute();
            $resultArray = $stmt->fetchAll();

            return array_map(function ($item) {
                return new Order($item);
            }, $resultArray);
        } catch (PDOException $e) {
            throw new Error($e);
        }
    }
}