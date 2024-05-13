<?php

    declare(strict_types=1);

    namespace Business;
    use Data\PromoDAO;
    use Data\SeasonDAO;
    use Data\ProductDAO;
    use Entities\Promo;
    use Entities\Season;
    use Entities\Product;

    $promoDAO = new PromoDAO();
    $seasonDAO = new SeasonDAO();
    $productDAO = new ProductDAO();

    class ProductService {

        /* R */
        public function getProduct(int $id): ?Product {
            global $productDAO;
            return $productDAO->getById($id);
        }
        public function getAllProducts(): ?array {
            global $productDAO;
            return $productDAO->getAll();
        }
        public function getPromo(int $id): ?Promo {
            global $promoDAO;
            return $promoDAO->getById($id);
        }
        public function getAllPromos() : ?array {
            global $promoDAO;
            return $promoDAO->getAll();
        }
        public function getSeason(int $id): ?Season {
            global $seasonDAO;
            return $seasonDAO->getById($id);
        }
        public function getAllSeasons() : ?array {
            global $seasonDAO;
            return $seasonDAO->getAll();
        }

        /* C */
        public function addProduct(string $name, float $price, string $description, int $promoId, int $seasonId): bool {
            global $productDAO;
            return $productDAO->addProduct($name, $price, $description, $promoId, $seasonId);
        }
        public function addPromo(float $value, string $description): bool {
            global $promoDAO;
            return $promoDAO->addPromo($value, $description);
        }
        public function addSeason(string $code, string $description): bool {
            global $seasonDAO;
            return $seasonDAO->addSeason($code, $description);
        }

        /* U */
        public function updateProduct(int $id, string $name, float $price, string $description, int $promoId, int $seasonId): bool {
            global $productDAO;
            return $productDAO->updateProduct($id, $name, $price, $description, $promoId, $seasonId);
        }
        public function updatePromo(int $id, float $value, string $description): bool {
            global $promoDAO;
            return $promoDAO->updatePromo($id, $value, $description);
        }
        public function updateSeason(int $id, string $code, string $description): bool {
            global $seasonDAO;
            return $seasonDAO->updateSeason($id, $code, $description);
        }

        /* D */
        public function deleteProduct(int $id): bool {
            global $productDAO;
            return $productDAO->deleteProduct($id);
        }
        public function deletePromo(int $id): bool {
            global $promoDAO;
            return $promoDAO->deletePromo($id);
        }
        public function deleteSeason(int $id): bool {
            global $seasonDAO;
            return $seasonDAO->deleteSeason($id);
        }
    }
