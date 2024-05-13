<?php

    declare(strict_types=1);

    namespace Business;
    use Data\CityDAO;
    use Entities\City;
    use Data\AddressDAO;
    use Entities\Address;

    $cityDAO = new CityDAO();
    $addressDAO = new AddressDAO();

    class AddressService {

        /* R */
        public function getAddress(int $id): ?Address {
            global $addressDAO;
            return $addressDAO->getById($id);
        }
        public function getCity(int $id): ?City {
            global $cityDAO;
            return $cityDAO->getById($id);
        }

        /* C */
        public function addAddress(int $cityId, string $street, int $number, string $bus): bool {
            global $addressDAO;
            return $addressDAO->addAddress($cityId, $street, $number, $bus);
        }

        /* U */
        public function updateAddress(int $id, int $cityId, string $street, int $number, string $bus): bool {
            global $addressDAO;
            return $addressDAO->updateAddress($id, $cityId, $street, $number, $bus);
        }

        /* D */
        public function deleteAddress(int $id): bool {
            global $addressDAO;
            return $addressDAO->deleteAddress($id);
        }
    }
