<?php 
require_once __DIR__."/classes/ElementSchema.php";
require_once __DIR__."/classes/Contenu.php";
require_once __DIR__."/classes/Property.php";
require_once __DIR__."/classes/FileProperty.php";
require_once __DIR__."/classes/ValidationRule.php";

$_MODEL = [
    "administrateur" => new ElementSchema(
        "administrateurs",
        [
            new Property("login", "Login", "varchar", 20, false),
            new Property("motDePasse","Mot de passe",  "varchar", 255, false),
        ]
    ),
    "personnel" => new ElementSchema(
        "personnels",
        [
            new Property("nom", "Nom", "varchar", 50, false),
            new Property("poste", "Poste", "varchar", 50, false),
            new Property("parcours", "Parcours", "text", null, false),
            new FileProperty("photo","Photo", true, __DIR__."/assets/images/personnels", ["jpg", "jpeg", "png"]),
            new FileProperty("cv", "Curriculum Vitae",false, __DIR__."/assets/cv-personnels", ["pdf", "jpg", "jpeg", "png"]),
        ]
    ),
    "projet" => new Contenu(
        "projets",
        [
            new Property("dateDebut","Date de début", "date", null, false)
        ], __DIR__."/assets/images/projets"
    ),
    "activite" => new Contenu(
        "activites",
        [
            new Property("dateDebut","Date de début", "date", null, false)
        ],__DIR__."/assets/images/activites"
    ),
    "annonce" => new Contenu(
        "annonces",
        [
            new Property("type","Type de l'annonce", "varchar", 255, false)
        ],__DIR__."/assets/images/annonces"
    ),
    "lieuTouristique" => new Contenu(
        "lieux_touristiques",
        [], __DIR__."/assets/images/lieux-touristiques"
    ),
    "publicite" => new Contenu(
        "publicites",
        [],__DIR__."/assets/images/publicites"
    )
];