<?php

    declare(strict_types=1);
    namespace Entities;

    class Customer {
        private int $id;
        private string $email;
        private string $password;
        private string $name;
        private string $lastName;
        private int $addressId;
        private string $phone;
        private bool $promo;

        public function __construct(int $id, string $email, string $password, string $name, string $lastName, int $addressId, string $phone, bool $promo) {
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->name = $name;
            $this->lastName = $lastName;
            $this->addressId = $addressId;
            $this->phone = $phone;
            $this->promo = $promo;
        }
        public function getId(): int {
            return $this->id;
        }
        public function getEmail(): string {
            return $this->email;
        }
        public function getPassword(): string {
            return $this->password;
        }
        public function getName(): string {
            return $this->name;
        }
        public function getLastName(): string {
            return $this->lastName;
        }
        public function getAddressId(): int {
            return $this->addressId;
        }
        public function getPhone(): string {
            return $this->phone;
        }
        public function isEligibleForPromo(): bool {
            return $this->promo;
        }
    }