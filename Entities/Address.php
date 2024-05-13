<?php

    declare(strict_types=1);

    namespace Entities;

    class Address {
        private int $id;
        private int $cityId;
        private string $street;
        private int $number;
        private string $bus;

        public function __construct(int $id, int $cityId, string $street, int $number, string $bus) {
            $this->id = $id;
            $this->cityId = $cityId;
            $this->street = $street;
            $this->number = $number;
            $this->bus = $bus;
        }
        public function getId(): int {
            return $this->id;
        }
        public function getCityId(): int {
            return $this->cityId;
        }
        public function getStreet(): string {
            return $this->street;
        }
        public function getHouseNumber(): int {
            return $this->number;
        }
        public function getBus(): string {
            return $this->bus;
        }
    }