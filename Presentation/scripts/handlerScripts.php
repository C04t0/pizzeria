<?php

    declare(strict_types=1);

    function checkCustomerCredentials($customerList, $email, $password): ?int {
        foreach ($customerList as $customer) {
            if ($customer->getEmail() == $email && $customer->getPassword() == $password) {
                return $customer->getId();
            }
        }

        return null;
    }
    function checkDeliveryAddress($zipcode): bool {
        global $addressService;
        $city = $addressService->getCityByZipcode($zipcode);

        if ($city->isDeliverable()) {
            return true;
        }

        return false;
    }


