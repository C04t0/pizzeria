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
    function checkDeliveryAddress($cityName): bool {
        global $addressService;

    }


