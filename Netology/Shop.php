<?php

namespace Netology;

class Shop extends ConnectDB
{
  protected string $table = 'shop';
  protected array $shops = [
    [
      'name' => 'Магазин 1',
      'address' => 'ул. Ленина, 1',
    ],
    [
      'name' => 'Магазин 2',
      'address' => 'ул. Малышева, 2',
    ],
    [
      'name' => 'Магазин 3',
      'address' => 'ул. Гагарина, 3',
    ],
    [
      'name' => 'Магазин 4',
      'address' => 'ул. Гоголя, 4',
    ],
    [
      'name' => 'Магазин 5',
      'address' => 'ул. Пушкина, 5',
    ],
  ];

  public function createTable(): \PDOStatement|false
  {
    $sql = "CREATE TABLE IF NOT EXISTS $this->table (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name CHAR(255),
      address CHAR(255)
    )";
    return $this->pdo->query($sql);
  }

  public function insertTestData(array $shops = [])
  {
    $query = $this->pdo->query("SELECT * FROM $this->table");

    if (!$query->rowCount()) {
      $sql = "INSERT INTO $this->table(name, address) VALUES(:name, :address)";
      $stmt = $this->pdo->prepare($sql);

      if (!count($shops)) {
        $shops = $this->shops;
      }

      foreach ($shops as $shop) {
        $stmt->bindValue(':name', $shop['name']);
        $stmt->bindValue(':address', $shop['address']);
        $stmt->execute();
      }
    }
  }
}