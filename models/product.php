<?php

abstract class Product {
    protected $id;
    protected $name;
    protected $description;
    protected $category;

    public function __construct($id, $name, $description, $category) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
    }

    abstract public function getAttributes();

    public function getDetails() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'attributes' => $this->getAttributes()
        ];
    }
}
