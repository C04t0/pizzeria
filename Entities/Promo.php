<?php

    declare(strict_types=1);

    namespace Entities;

    class Promo {
        private int $id;
        private float $value;
        private string $description;

        public function __construct(int $id, float $value, string $description) {
            $this->id = $id;
            $this->value = $value;
            $this->description = $description;
        }
        public function getId(): int {
            return $this->id;
        }
        public function getValue(): float {
            return $this->value;
        }
        public function getDescription(): string {
            return $this->description;
        }
    }