<?php

    declare(strict_types=1);

    namespace Data;
    use PDO;
    use Entities\Product;

    $dbConn = new dbConnection();
    class ProductDAO {

        /* READ */
        public function getById(int $id): ?Product {
            global $dbConn;
            $sql = 'select id, name, price, description, promo_id, season_id from products where id = :id';
            $dbh = $dbConn->connect();

            if ($id == 0) {
                $dbh = null;
                return null;
            }

            $statement = $dbh->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $product = new Product(
                (int)$row['id'],
                $row['name'],
                (float)$row['price'],
                $row['description'],
                (int)$row['promo_id'],
                (int)$row['season_id']
            );

            $dbh = null;

            return $product;
        }
        public function getAll(): array {
            global $dbConn;
            $products = array();
            $sql = 'select id, name, price, description, promo_id, season_id from products';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $product = new Product(
                    (int)$row['id'],
                    $row['name'],
                    (float)$row['price'],
                    $row['description'],
                    (int)$row['promo_id'],
                    (int)$row['season_id']
                );
                $products[] = $product;
            }
            $dbh = null;

            return $products;
        }

        /* CREATE */
        public function addProduct(string $name, float $price, string $description, int $promoId, int $seasonId): bool {
            global $dbConn;
            $sql = 'insert into products (name, price, description, promo_id, season_id) 
                    values (:name, :price, :description, :promo_id, :season_id)';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':promo_id', $promoId, PDO::PARAM_INT);
            $statement->bindParam(':season_id', $seasonId, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* UPDATE */
        public function updateProduct(int $id, string $name, float $price, string $description, int $promoId, int $seasonId): bool {
            global $dbConn;
            $sql = 'update products 
                    set name = :name, price = :price, description = :description, promo_id = :promo_id, season_id = :season_id
                    where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':promo_id', $promoId, PDO::PARAM_INT);
            $statement->bindParam(':season_id', $seasonId, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* DELETE */
        public function deleteProduct(int $id): bool {
            global $dbConn;
            $sql = 'delete from products where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }
    }