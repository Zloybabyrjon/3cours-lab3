<?php

namespace Egor\Trading;

use Egor\Trading\Product;
use Egor\Trading\Exception\ItemOutOfStockException;
use Egor\Trading\Exception\CartLimitExceededException;

class Cart
{
    public array $items = [];
    public int $maxItem;

    public function __construct(int $maxItem = 20)
    {
        $this->maxItem = $maxItem;
    }

    public function addItem(Product $product, int $quantity): void
    {
        if (count($this->items) >= $this->maxItem) {
            throw new CartLimitExceededException("Корзина содержат максимальное количество товаров.");
        }

        if ($product->getStock() < $quantity) {
            throw new ItemOutOfStockException("Запрашивает больше, чем есть в наличии: 
            " . $product->getName());
        }

        $product->reduceStock($quantity);
        $this->items[] = ['product' => $product, 'quantity' => $quantity];
    }
    public function removeltem(Product $product): void
    {
        foreach ($this->items as $key => $item) {
            if ($item === $product) {
                unset($this->items[$key]);
            }
            $this->items = array_values($this->items);
        }
    }
    public function getTotal(): int
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }
    
}
