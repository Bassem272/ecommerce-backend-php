<?php 
class TechAttributes extends Attribute {
    private $brand;
    private $specifications;

    public function __construct($brand, $specifications) {
        $this->brand = $brand;
        $this->specifications = $specifications;
    }

    public function getDetails() {
        return [
            'brand' => $this->brand,
            'specifications' => $this->specifications
        ];
    }
}
