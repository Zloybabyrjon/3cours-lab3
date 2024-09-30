<?php

use PHPUnit\Framework\TestCase;
use Egor\Trading\Checkout;
use Egor\Trading\Cart;
use Egor\Trading\Product;

class CheckoutTest extends TestCase
{
    public function testProcessPayment()
    {
        $product = new Product("T-shirt", 100, 10);
        $cart = new Cart();
        $cart->addItem($product, 2);

        $checkout = new Checkout($cart, "кредитная карта", 500);

        $checkout->setPaymentMethod("credit card");

        $this->expectNotToPerformAssertions();
        $checkout->finalizeOrder();
    }
}
