<?php

    declare(strict_types=1);

    namespace Data;
    use PDO;
    use Entities\Season;

    $dbConn = new dbConnection();

    class SeasonDAO {

        /* READ */
        public function getById(int $id): ?Season {
            global $dbConn;
            $sql = 'select id, code, description from seasons where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $season = new Season((int)$row['id'], $row['code'], $row['description']);

            $dbh = null;

            return $season;
        }
        public function getAll(): array {
            global $dbConn;
            $seasons = array();
            $sql = 'select id, code, description from seasons';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $season = new Season((int)$row['id'], $row['code'], $row['description']);
                $seasons[] = $season;
            }

            $dbh = null;

            return $seasons;
        }

        /* CREATE */
        public function addSeason(string $code, string $description): bool {
            global $dbConn;
            $sql = 'insert into seasons (code, description) values (:code, :description)';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':code', $code);
            $statement->bindParam(':description', $description);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* UPDATE */
        public function updateSeason(int $id, string $code, string $description): bool {
            global $dbConn;
            $sql = 'update seasons set code = :code, description = :description where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':code', $code);
            $statement->bindParam(':description', $description);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* DELETE */
        public function deleteSeason(int $id): bool {
            global $dbConn;
            $sql = 'delete from seasons where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }
    }