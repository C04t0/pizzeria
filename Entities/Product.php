<?php

    declare(strict_types=1);

    namespace Entities;

    class Product {
        private int $id;
        private string $name;
        private float $price;
        private string $description;
        private int $seasonId;
        private int $promoId;

        public function __construct(int $id, string $name, float $price, string $description, int $seasonId, int $promoId) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->description = $description;
            $this->seasonId = $seasonId;
            $this->promoId = $promoId;
        }
        public function getId(): int {
            return $this->id;
        }
        public function getName(): string {
            return $this->name;
        }
        public function getPrice(): float {
            return $this->price;
        }
        public function getDescription(): string {
            return $this->description;
        }
        public function getSeasonId(): int {
            return $this->seasonId;
        }
        public function getPromoId(): int {
            return $this->promoId;
        }
    }