<?php

require_once "vendor/autoload.php";

use Egor\Trading\Product;
use Egor\Trading\Cart;
use Egor\Trading\Checkout;


$firstProduct = new Product("Ноутбук", 45000, 5);
$secondProduct = new Product("Телевизор", 99000, 3);
$thirdProduct = new Product("Телефон", 22000, 2);

$cart = new Cart();

$checkout = new Checkout($cart, 'банковская карта', 150000);

$cart->addItem($firstProduct, 1);
$cart->addItem($thirdProduct, 1);

$checkout->finalizeOrder();

