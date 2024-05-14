<?php

    declare(strict_types=1);

    namespace Business;
    use Data\OrderDAO;
    use Entities\Order;
    use Data\OrderLineDAO;
    use Entities\OrderLine;

    $orderDAO = new OrderDAO();
    $orderLineDAO = new OrderLineDAO();

    class OrderService {

        /* R */
        public function getOrder(int $id): ?Order {
            global $orderDAO;
            return $orderDAO->getById($id);
        }
        public function getSingleOrderLine(int $orderId, int $productId): ?OrderLine {
            global $orderLineDAO;
            return $orderLineDAO->getById($orderId, $productId);
        }
        public function getAllOrderLinesFromOrder(int $orderId): ?array {
            global $orderLineDAO;
            return $orderLineDAO->getOrderLinesFromOrder($orderId);
        }

        /* C */
        public function addOrder(int $customerId, string $date, string $time, string $remark): string {
            global $orderDAO;
            return $orderDAO->addOrder($customerId, $date, $time, $remark);
        }
        public function addOrderLine(int $orderId, int $productId, int $amount, float $price, string $extra): bool {
            global $orderLineDAO;
            return $orderLineDAO->addOrderLine($orderId, $productId, $amount, $price, $extra);
        }

        /* U */
        public function updateOrder(int $orderId, string $date, string $time, string $remark): bool {
            global $orderDAO;
            return $orderDAO->updateOrder($orderId, $date, $time, $remark);
        }
        public function updateOrderLine(int $orderId, int $productId, int $amount, float $price, string $extra): bool {
            global $orderLineDAO;
            return $orderLineDAO->updateOrderLine($orderId, $productId, $amount, $price, $extra);
        }

        /* D */
        public function deleteOrder(int $orderId): bool {
            global $orderDAO;
            return $orderDAO->deleteOrder($orderId);
        }
        public function deleteOrderLine(int $orderId, int $productId): bool {
            global $orderLineDAO;
            return $orderLineDAO->deleteOrderLine($orderId, $productId);
        }

    }