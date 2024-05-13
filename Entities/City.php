<?php

    declare(strict_types=1);

    namespace Entities;
    class City {
        private int $id;
        private string $name;
        private string $zipcode;
        private bool $deliverable;

        public function __construct(int $id, string $name, string $zipcode, bool $deliverable) {
            $this->id = $id;
            $this->name = $name;
            $this->zipcode = $zipcode;
            $this->deliverable = $deliverable;
        }
        public function getId(): int {
            return $this->id;
        }
        public function getName(): string {
            return $this->name;
        }
        public function getZipcode(): string {
            return $this->zipcode;
        }
        public function isDeliverable(): bool {
            return $this->deliverable;
        }
    }