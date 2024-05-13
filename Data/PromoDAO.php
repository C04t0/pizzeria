<?php

    declare(strict_types=1);

    namespace Data;
    use PDO;
    use Entities\Promo;

    $dbConn = new dbConnection();

    class PromoDAO {

        /* READ */
        public function getById(int $id): ?Promo {
            global $dbConn;
            $sql = 'select id, value, description from promos where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $promo = new Promo((int)$row['id'], (float)$row['value'], $row['description']);

            $dbh = null;

            return $promo;
        }
        public function getAll(): array {
            global $dbConn;
            $promos = array();
            $sql = 'select id, value, description from promos';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $promo = new Promo((int)$row['id'], (float)$row['value'], $row['description']);
                $promos[] = $promo;
            }

            $dbh = null;

            return $promos;
        }

        /* CREATE */
        public function addPromo(float $value, string $description) : bool {
            global $dbConn;
            $sql = 'insert into promos (value, description) values (:value, :description)';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':value', $value, PDO::PARAM_STR);
            $statement->bindParam(':description', $description, PDO::PARAM_STR);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* UPDATE */
        public function updatePromo(int $id, float $value, string $description) : bool {
            global $dbConn;
            $sql = 'update promos set value = :value, description = :description where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':value', $value);
            $statement->bindParam(':description', $description);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* DELETE */
        public function deletePromo(int $id): bool {
            global $dbConn;
            $sql = 'delete from promos where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }
    }