<?php

class Location {
    private $name;
    private $description;
    private $location;
    private $color;

    function __construct(string $name, string $description, string $location, string $color = "#093")
    {
        $this->name = $name;
        $this->color = $color;
        $this->description = $description;
        $this->location = $location;
    }

    function setName(string $name) {
        $this->name = $name;
    }

    function getName() {
        return $this->name;
    }

    function setLocation(Location $location) {
        $this->location = $location;
    }
    function getLocation() {
        return $this->location;
    }

    function setColor(string $color) {
        $this->color = $color;
    }
    function getColor() {
        return $this->color;
    }

    function setDescription(string $description) {
        $this->description = $description;
    }
    function getDescription() {
        return $this->description;
    }
}


class Piece {
    private $name;
    private $location;

    function __construct(string $name, Location $location) {
        $this->location = $location;
        $this->name = $name;
        
    }

    function setName(string $name) {
        $this->name = $name;
    }

    function getName() {
        return $this->name;
    }

    function setLocation(Location $location) {
        $this->location = $location;
    }
    function getLocation() {
        return $this->location;
    }
}

