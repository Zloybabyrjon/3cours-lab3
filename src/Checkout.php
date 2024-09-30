<?php

namespace Egor\Trading;

use Egor\Trading\Cart;
use Egor\Trading\Exception\InsufficientFundsException;
use Egor\Trading\Exception\PaymentGatewayException;

class Checkout
{
    public Cart $cart;
    public string $paymentMethod;
    public int $userBalance;

    public function __construct(Cart $cart, string $paymentMethod, int $userBalance)
    {
        $this->cart = $cart;
        $this->paymentMethod = $paymentMethod;
        $this->userBalance = $userBalance;
    }

    public function setPaymentMethod(string $method):void
    {
        $this->paymentMethod = $method;
    }

    public function processPayment($amount):void
    {
        try {
          if($this->userBalance < $amount){
            throw new InsufficientFundsException('Недостаточно денег: ');
          }
          if($this->paymentMethod != 'банковская карта'){
            throw new PaymentGatewayException('Ошибка при оплате');
          }
    
          $this->userBalance -= $amount;
        } catch (InsufficientFundsException | PaymentGatewayException  $e) {
          print $e->getMessage();
        }
      }
      public function finalizeOrder():void
      {
        $totalAmount = $this->cart->getTotal();
        try {
            $this->processPayment($totalAmount);
        } catch (InsufficientFundsException | PaymentGatewayException $e) {
            print "Ошибка при оплате: " . $e->getMessage();
        }
      }
}
