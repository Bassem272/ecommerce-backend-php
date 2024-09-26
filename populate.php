<?php
header("Content-Type: application/json");
include "db.php"; // Include your database connection

try {
    // Read the JSON file
    $jsonData = file_get_contents('./data.json');

    // Decode the JSON data
    $data = json_decode($jsonData, true);

    // Insert categories
    foreach ($data['data']['categories'] as $category) {
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$category['name']]);
    }

    // Insert products
    foreach ($data['data']['products'] as $product) {
        // Insert product
        $stmt = $conn->prepare("INSERT INTO products (id, name, in_stock, description, category_id, brand) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $product['id'],
            $product['name'],
            $product['inStock'],
            $product['description'],
            $product['category'],
            $product['brand']
        ]);

        // Get the last inserted product ID
        $productId = $conn->insert_id; // Use insert_id property

        // Insert prices
        foreach ($product['prices'] as $price) {
            $stmt = $conn->prepare("INSERT INTO prices (product_id, amount, currency_label, currency_symbol) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $productId,
                $price['amount'],
                $price['currency']['label'],
                $price['currency']['symbol']
            ]);
        }

        // Insert attributes
        foreach ($product['attributes'] as $attribute) {
            $stmt = $conn->prepare("INSERT INTO attributes (product_id, name, type) VALUES (?, ?, ?)");
            $stmt->execute([
                $productId,
                $attribute['name'],
                $attribute['type']
            ]);

            $productId = $conn->insert_id; // Use insert_id property

            foreach ($attribute['items'] as $item) {
                $stmt = $conn->prepare("INSERT INTO attribute_items (attribute_id, display_value, value) VALUES (?, ?, ?)");
                $stmt->execute([
                    $attributeId,
                    $item['displayValue'],
                    $item['value']
                ]);
            }
        }

        // Insert gallery images
        foreach ($product['gallery'] as $image) {
            $stmt = $conn->prepare("INSERT INTO gallery (product_id, image_url) VALUES (?, ?)");
            $stmt->execute([
                $productId,
                $image
            ]);
        }
    }

    echo json_encode(["message" => "Data inserted successfully!"]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
