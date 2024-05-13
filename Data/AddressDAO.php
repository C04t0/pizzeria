<?php

    declare(strict_types=1);

    namespace Data;
    use PDO;
    use Entities\Address;

    $dbConn = new dbConnection();

    class AddressDAO {

        /* READ */
        public function getById(int $id): ?Address {
            global $dbConn;
            $sql = 'select id, city_id, street, number, bus from addresses where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $address = new Address(
                (int)$row['id'],
                (int)$row['city_id'],
                $row['street'],
                (int)$row['number'],
                $row['bus']
            );

            $dbh = null;

            return $address;
        }

        /* CREATE */
        public function addAddress(int $cityId, string $street, int $number, string $bus): bool {
            global $dbConn;
            $sql = 'insert into addresses (city_id, street, number, bus) values (:cityId, :street, :number, :bus)';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':cityId', $cityId, PDO::PARAM_INT);
            $statement->bindParam(':street', $street);
            $statement->bindParam(':number', $number, PDO::PARAM_INT);
            $statement->bindParam(':bus', $bus);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* UPDATE */
        public function updateAddress(int $id, int $cityId, string $street, int $number, string $bus): bool {
            global $dbConn;
            $sql = 'update addresses 
                    set city_id = :city_id, street = :street, number = :number, bus = :bus
                    where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':cityId', $cityId, PDO::PARAM_INT);
            $statement->bindParam(':street', $street);
            $statement->bindParam(':number', $number, PDO::PARAM_INT);
            $statement->bindParam(':bus', $bus);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* DELETE */
        public function deleteAddress(int $id): bool {
            global $dbConn;
            $sql = 'delete from addresses where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }
    }