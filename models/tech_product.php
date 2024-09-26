<?php 
class TechProduct extends Product {
    private $techAttributes;

    public function __construct($id, $name, $description, $category, TechAttributes $techAttributes) {
        parent::__construct($id, $name, $description, $category);
        $this->techAttributes = $techAttributes;
    }

    public function getAttributes() {
        return $this->techAttributes->getDetails();
    }
}
