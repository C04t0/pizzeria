<?php

    declare(strict_types=1);

    namespace Data;
    use PDO;
    use Entities\City;

    $dbConn = new dbConnection();

    class CityDAO {

        /* READ */
        public function getById(int $id) : ?City {
            global $dbConn;
            $sql = 'select id, name, zipcode, deliverable from cities where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $city = new City((int)$row['id'], $row['name'], $row['zipcode'], (bool)$row['deliverable']);

            $dbh = null;

            return $city;
        }
    }