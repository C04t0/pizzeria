<?php

    declare(strict_types=1);

    namespace Entities;

    class OrderLine {
        private int $orderId;
        private int $productId;
        private int $amount;
        private float $price;
        private string $extra;

        public function __construct(int $orderId, int $productId, int $amount, float $price, string $extra) {
            $this->orderId = $orderId;
            $this->productId = $productId;
            $this->amount = $amount;
            $this->price = $price;
            $this->extra = $extra;
        }
        public function getOrderId(): int {
            return $this->orderId;
        }
        public function getProductId(): int {
            return $this->productId;
        }
        public function getAmount(): int {
            return $this->amount;
        }
        public function getPrice(): float {
            return $this->price;
        }
        public function getExtra(): string {
            return $this->extra;
        }
    }