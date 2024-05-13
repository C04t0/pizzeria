<?php

    declare(strict_types=1);

    namespace Data;
    use PDO;
    use Entities\Order;

    $dbConn = new dbConnection();

    class OrderDAO {

        /* READ */
        public function getById(int $id): ?Order {
            global $dbConn;
            $sql = 'select id, date, time, customer_id, remark from orders where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);

            $order = new Order((int)$row['id'], $row['date'], $row['time'], (int)$row['customer_id'], $row['remark']);

            $dbh = null;

            return $order;
        }

        public function getAll(): array {
            global $dbConn;
            $orders = array();
            $sql = 'select id, date, time, customer_id, remark from orders';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $order = new Order(
                    (int)$row['id'],
                    $row['date'],
                    $row['time'],
                    (int)$row['customer_id'],
                    $row['remark']
                );
                $orders[] = $order;
            }

            $dbh = null;

            return $orders;
        }

        /* CREATE */
        public function addOrder(int $customerId, string $date, string $time, string $remark): bool {
            global $dbConn;
            $sql = 'insert into orders (date, time, customer_id, remark) 
                    values (:customerId, :date, :time, :remark)';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':customerId', $customerId, PDO::PARAM_INT);
            $statement->bindParam(':date', $date);
            $statement->bindParam(':time', $time);
            $statement->bindParam(':remark', $remark);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* UPDATE */
        public function updateOrder(int $id, string $date, string $time, string $remark): bool {
            global $dbConn;
            $sql = 'update orders set date = :date, time = :time, remark = :remark where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':date', $date);
            $statement->bindParam(':time', $time);
            $statement->bindParam(':remark', $remark);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* DELETE */
        public function deleteOrder(int $id): bool {
            global $dbConn;
            $sql = 'delete from orders where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }
    }