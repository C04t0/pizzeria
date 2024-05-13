<?php

    declare(strict_types=1);

    namespace Business;
    use Data\CustomerDAO;
    use Entities\Customer;

    $customerDAO = new CustomerDAO();

    class CustomerService {

        /* R */
        public function getCustomer(int $id): ?Customer {
            global $customerDAO;
            return $customerDAO->getById($id);
        }

        /* C */
        public function addCustomer(string $email, string $password, string $name, string $lastName, string $addressId, string $phone, bool $promo): bool {
            global $customerDAO;
            return $customerDAO->addCustomer($email, $password, $name, $lastName, $addressId, $phone, $promo);
        }

        /* U */
        public function updateCustomer(int $id, string $email, string $password, string $name, string $lastName, string $addressId, string $phone, bool $promo) : bool {
            global $customerDAO;
            return $customerDAO->updateCustomer($id, $email, $password, $name, $lastName, $addressId, $phone, $promo);
        }

        /* D */
        public function deleteCustomer(int $id): bool {
            global $customerDAO;
            return $customerDAO->deleteCustomer($id);
        }
    }