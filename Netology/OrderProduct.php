<?php

namespace Netology;

use Netology\ConnectDB;

class OrderProduct extends ConnectDB
{
  protected string $table = 'order_product';
  protected array $order_products = [
    [
      'order_id' => 1,
      'product_id' => 1,
      'price' => 50,
      'quantity' => 2,
    ],
    [
      'order_id' => 2,
      'product_id' => 2,
      'price' => 100,
      'quantity' => 1,
    ],
    [
      'order_id' => 3,
      'product_id' => 3,
      'price' => 150,
      'quantity' => 1,
    ],
    [
      'order_id' => 4,
      'product_id' => 4,
      'price' => 90,
      'quantity' => 2,
    ],
    [
      'order_id' => 5,
      'product_id' => 5,
      'price' => 50,
      'quantity' => 3,
    ],
  ];

  public function createTable(): \PDOStatement|false
  {
    $sql = "CREATE TABLE IF NOT EXISTS `$this->table` (
      id INT AUTO_INCREMENT PRIMARY KEY,
      order_id INT,
      product_id INT,
      price FLOAT DEFAULT 0,
      quantity INT DEFAULT 0
    )";
    return $this->pdo->query($sql);
  }

  public function insertTestData(array $order_products = [])
  {
    $query = $this->pdo->query("SELECT * FROM `$this->table`");

    if (!$query->rowCount()) {
      $sql = "INSERT INTO `$this->table`(order_id, product_id, price, quantity) VALUES(:order_id, :product_id, :price, :quantity)";
      $stmt = $this->pdo->prepare($sql);

      if (!count($order_products)) {
        $order_products = $this->order_products;
      }

      foreach ($order_products as $order_product) {
        $stmt->bindValue(':order_id', $order_product['order_id']);
        $stmt->bindValue(':product_id', $order_product['product_id']);
        $stmt->bindValue(':price', $order_product['price']);
        $stmt->bindValue(':quantity', $order_product['quantity']);
        $stmt->execute();
      }
    }
  }
}