<?php

    declare(strict_types=1);

    namespace Data;
    use PDO;
    use Entities\Customer;

    $dbConn = new dbConnection();

    class CustomerDAO {

        /* READ */
        public function getById(int $id) : ?Customer {
            global $dbConn;
            $sql = 'select id, email, password, name, last_name, address_id, phone, promo
                    from customers
                    where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $customer = new Customer(
                (int)$row['id'],
                $row['email'],
                $row['password'],
                $row['name'],
                $row['last_name'],
                (int)$row['address_id'],
                $row['phone'],
                (bool)$row['promo']
            );

            $dbh = null;

            return $customer;
        }
        public function getAllCustomers(): ?array {
            global $dbConn;
            $customers = array();
            $sql = 'select id, email, password, name, last_name, address_id, phone, promo from customers';
            $dbh = $dbConn->connect();

            $statement = $dbh->query($sql);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $customer = new Customer(
                    (int)$row['id'],
                    $row['email'],
                    $row['password'],
                    $row['name'],
                    $row['last_name'],
                    (int)$row['address_id'],
                    $row['phone'],
                    (bool)$row['promo']
                );
                $customers[] = $customer;
            }

            $dbh = null;

            return $customers;
        }
        /* CREATE */
        public function addCustomer(string $email, string $password, string $name, string $last_name, string $address_id, string $phone, bool $promo) : bool {
            global $dbConn;
            $sql = 'insert into customers (email, password, name, last_name, address_id, phone)
                    values (:email, :password, :name, :last_name, :address_id, :phone)';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':last_name', $last_name);
            $statement->bindParam(':address_id', $address_id, PDO::PARAM_INT);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':promo', $promo, PDO::PARAM_BOOL);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* UPDATE */
        public function updateCustomer(int $id, string $email, string $password, string $name, string $last_name, string $address_id, string $phone, bool $promo) : bool {
            global $dbConn;
            $sql = 'update customers 
                    set email = :email, password = :password, name = :name, last_name = :last_name, address_id = :address_id, phone = :phone, promo = :promo
                    where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':last_name', $last_name);
            $statement->bindParam(':address_id', $address_id, PDO::PARAM_INT);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':promo', $promo, PDO::PARAM_BOOL);
            $statement->execute();

            $dbh = null;

            return true;
        }

        /* DELETE */
        public function deleteCustomer(int $id): bool {
            global $dbConn;
            $sql = 'delete from customers where id = :id';
            $dbh = $dbConn->connect();

            $statement = $dbh->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $dbh = null;

            return true;
        }
    }