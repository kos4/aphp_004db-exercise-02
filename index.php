<?php

use Netology\Client;
use Netology\Order;
use Netology\OrderProduct;
use Netology\Product;
use Netology\Shop;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';

$shop = new Shop();
$shop->createTable();
$shop->insertTestData();

$product = new Product();
$product->createTable();
$product->insertTestData();

$client = new Client();
$client->createTable();
$client->insertTestData();

$order = new Order();
$order->createTable();
$order->insertTestData();

$orderProduct = new OrderProduct();
$orderProduct->createTable();
$orderProduct->insertTestData();
