<?php

    declare(strict_types=1);

    namespace Entities;

    class Season {
        private int $id;
        private string $code;
        private string $description;

        public function __construct(int $id, string $code, string $description) {
            $this->id = $id;
            $this->code = $code;
            $this->description = $description;
        }
        public function getId(): int {
            return $this->id;
        }
        public function getCode(): string {
            return $this->code;
        }
        public function getDescription(): string {
            return $this->description;
        }
    }