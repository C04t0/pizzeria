<?php

    declare(strict_types=1);

    namespace Entities;

    class Order {
        private int $id;
        private string $date;
        private string $time;
        private int $customerId;
        private string $remark;

        public function __construct(int $id, string $date, string $time, int $customerId, string $remark) {
            $this->id = $id;
            $this->date = $date;
            $this->time = $time;
            $this->customerId = $customerId;
            $this->remark = $remark;
        }
        public function getId(): int {
            return $this->id;
        }
        public function getDate(): string {
            return $this->date;
        }
        public function getTime(): string {
            return $this->time;
        }
        public function getCustomerId(): int {
            return $this->customerId;
        }
        public function getRemark(): string {
            return $this->remark;
        }
    }