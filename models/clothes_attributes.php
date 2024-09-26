<?php 
class ClothesAttributes extends Attribute {
    private $size;
    private $color;

    public function __construct($size, $color) {
        $this->size = $size;
        $this->color = $color;
    }

    public function getDetails() {
        return [
            'size' => $this->size,
            'color' => $this->color
        ];
    }
}
