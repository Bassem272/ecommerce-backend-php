<?php 
class ClothesProduct extends Product {
    private $clothesAttributes;

    public function __construct($id, $name, $description, $category, ClothesAttributes $clothesAttributes) {
        parent::__construct($id, $name, $description, $category);
        $this->clothesAttributes = $clothesAttributes;
    }

    public function getAttributes() {
        return $this->clothesAttributes->getDetails();
    }
}
