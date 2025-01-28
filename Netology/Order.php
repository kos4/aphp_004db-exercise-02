<?php

namespace Netology;

use Netology\ConnectDB;

class Order extends ConnectDB
{
  protected string $table = 'order';
  protected array $orders = [
    [
      'shop_id' => 1,
      'client_id' => 1,
    ],
    [
      'shop_id' => 2,
      'client_id' => 2,
    ],
    [
      'shop_id' => 3,
      'client_id' => 3,
    ],
    [
      'shop_id' => 4,
      'client_id' => 4,
    ],
    [
      'shop_id' => 5,
      'client_id' => 5,
    ],
  ];

  public function createTable(): \PDOStatement|false
  {
    $sql = "CREATE TABLE IF NOT EXISTS `$this->table` (
      id INT AUTO_INCREMENT PRIMARY KEY,
      shop_id INT,
      client_id INT,
      created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    return $this->pdo->query($sql);
  }

  public function insertTestData(array $orders = [])
  {
    $query = $this->pdo->query("SELECT * FROM `$this->table`");

    if (!$query->rowCount()) {
      $sql = "INSERT INTO `$this->table`(shop_id, client_id) VALUES(:shop_id, :client_id)";
      $stmt = $this->pdo->prepare($sql);

      if (!count($orders)) {
        $orders = $this->orders;
      }

      foreach ($orders as $order) {
        $stmt->bindValue(':shop_id', $order['shop_id']);
        $stmt->bindValue(':client_id', $order['client_id']);
        $stmt->execute();
      }
    }
  }
}