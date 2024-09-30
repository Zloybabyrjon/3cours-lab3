<?php

use PHPUnit\Framework\TestCase;
use Egor\Trading\Checkout;
use Egor\Trading\Cart;
use Egor\Trading\Product;

class CheckoutTest extends TestCase {
    public function testProcessPayment() {
        $product = new Product("T-shirt", 100, 10); // Цена 100, в наличии 10 штук
        $cart = new Cart();
        $cart->addItem($product, 2); // Добавляем 2 футболки в корзину

        // Создаем объект Checkout с корзиной и балансом пользователя
        $checkout = new Checkout($cart,"кредитная карта",500); // У пользователя 500 на счете

        $checkout->setPaymentMethod("credit card");

        // Оплата должна пройти (500 > 2 * 100).
        $this->expectNotToPerformAssertions();
        $checkout->finalizeOrder();
    }
}
