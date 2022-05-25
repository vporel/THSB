<?php 
require_once __DIR__."/classes/Element.php";
require_once __DIR__."/classes/Property.php";
require_once __DIR__."/classes/ValidationRule.php";

$_MODEL = [
    "administrateur" => new Element(
        "administrateurs",
        [
            new Property("login", "varchar", 20, false),
            new Property("motDePasse", "varchar", 255, false),
        ]
    )
];