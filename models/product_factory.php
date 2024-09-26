<?php 
class ProductFactory {
    public static function getAllProducts($mysqli) {
        $products = [];

        // Fetch products from the database
        $query = "SELECT p.id, p.name, p.description, p.category_id, c.name AS category_name FROM products p 
                  JOIN categories c ON p.category_id = c.id";
        $result = $mysqli->query($query);

        while ($row = $result->fetch_assoc()) {
            $product = self::createProduct($mysqli, $row);
            if ($product !== null) {
                $products[] = $product;
            }
        }

        return $products;
    }

    private static function createProduct($mysqli, $row) {
        // Use polymorphism to create the correct product type
        $attributes = self::getAttributesForProduct($mysqli, $row['id'], $row['category_id']);

        $categoryName = $row['category_name'];

        if ($row['category_id'] == 2) {
            return new ClothesProduct($row['id'], $row['name'], $row['description'], $categoryName, new ClothesAttributes($attributes['size'], $attributes['color']));
        } elseif ($row['category_id'] == 3) {
            return new TechProduct($row['id'], $row['name'], $row['description'], $categoryName, new TechAttributes($attributes['brand'], $attributes['specifications']));
        }

        return null; // For other categories
    }

    private static function getAttributesForProduct($mysqli, $productId, $categoryId) {
        $attributes = [];

        if ($categoryId == 2) { // Clothes
            $query = "SELECT size, color FROM clothes_attributes WHERE product_id = ?";
        } elseif ($categoryId == 3) { // Tech
            $query = "SELECT brand, specifications FROM tech_attributes WHERE product_id = ?";
        }

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $attributes = $result->fetch_assoc();
        }

        return $attributes;
    }
}
