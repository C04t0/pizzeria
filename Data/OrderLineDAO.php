<?php

    declare(strict_types=1);

    namespace Data;
    use PDO;
    use Entities\OrderLine;

    $dbConn = new dbConnection();

    class OrderLineDAO {

        /* READ */
        public function getById(int $orderId, int $productId): ?OrderLine {
            global $dbConn;
            $sql = 'select order_id, product_id, amount, extra, price
                    from orderlines 
                    where order_id = :orderId and product_id = :productId
                    group by order_id, product_id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $statement->bindParam(':productId', $productId, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $orderLine = new OrderLine(
                (int)$row['order_id'],
                (int)$row['product_id'],
                (int)$row['amount'],
                (float)$row['price'],
                $row['extra']
            );

            $dbh = null;

            return $orderLine;
        }
        public function getOrderLinesFromOrder(int $orderId): ?array {
            global $dbConn;
            $orderLines = array();
            $sql = 'select order_id, product_id, amount, extra, price 
                    from orderlines 
                    where order_id = :orderId
                    group by order_id, product_id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $orderLine = new OrderLine(
                    (int)$row['order_id'],
                    (int)$row['product_id'],
                    (int)$row['amount'],
                    (float)$row['price'],
                    $row['extra']
                    );
                $orderLines[] = $orderLine;
            }

            $dbh = null;

            return $orderLines;
        }

        /* CREATE */
        public function addOrderLine(int $orderId, int $productId, int $amount, float $price, string $extra): bool {
            global $dbConn;
            $sql = 'insert into orderlines (order_id, product_id, amount, extra, price) 
                    values (:orderId, :productId, :amount, :price, :extra)';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $statement->bindParam(':productId', $productId, PDO::PARAM_INT);
            $statement->bindParam(':amount', $amount, PDO::PARAM_INT);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':extra', $extra);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* UPDATE */
        public function updateOrderLine(int $orderId, int $productId, int $amount, float $price, string $extra): bool {
            global $dbConn;
            $sql = 'update orderlines set amount = :amount, price = :price, extra = :extra';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $statement->bindParam(':productId', $productId, PDO::PARAM_INT);
            $statement->bindParam(':amount', $amount, PDO::PARAM_INT);
            $statement->bindParam(':price', $price, PDO::PARAM_INT);
            $statement->bindParam(':extra', $extra);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* DELETE */
        public function deleteOrderLine(int $orderId, int $productId): bool {
            global $dbConn;
            $sql = 'delete from orderlines where order_id = :orderId and product_id = :productId';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $statement->bindParam(':productId', $productId, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }
    }