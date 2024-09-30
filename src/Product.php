<?php

namespace Egor\Trading;

use Egor\Trading\Exception\OutOfStockException;

class Product
{
    public string $name;
    public float $price;
    public int $stock;

    public function __construct(string $name, float $price, int $stock)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function getStock(): int
    {
        return $this->stock;
    }
    public function reduceStock(int $quantity): void
    {
        if ($this->stock < $quantity) {
            throw new OutOfStockException("Недостаточно товара на складе для продукта: " . $this->name);
        }
        $this->stock -= $quantity;
    }
}
