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
            new FileProperty("photo","Photo", false, __DIR__."/assets/images/personnels", ["jpg", "jpeg", "png"]),
            new FileProperty("cv", "Curriculum Vitae",false, __DIR__."/assets/cv-personnels", ["docx", "doc", "odt", "pdf", "jpg", "jpeg", "png"]),
        ], "personnel"
    ),
    "conseiller" => new ElementSchema(
        "conseillers",
        [
            new Property("nom", "Nom complet", "varchar", 50, false),
            new FileProperty("photo","Photo", false, __DIR__."/assets/images/conseillers", ["jpg", "jpeg", "png"]),
        ], ""
    ),
    "projet" => new Contenu(
        "projets",
        [
            new Property("personnesEnCharge", "Personnes en charge", "varchar", 255, true),
            new Property("dateDebut","Date de début", "date", null, false)
        ], __DIR__."/assets/images/projets", "projets"
    ),
    "activite" => new Contenu(
        "activites",
        [
            new Property("personnesEnCharge", "Personnes en charge", "varchar", 255, true),
            new Property("dateDebut","Date de début", "date", null, false)
        ],__DIR__."/assets/images/activites", "activites"
    ),
    "annonce" => new Contenu(
        "annonces",
        [
            new Property("type","Type de l'annonce", "varchar", 255, false),
            new Property("date","Date", "date", null, false)
        ],__DIR__."/assets/images/annonces", "annonces"
    ),
    "lieuTouristique" => new Contenu(
        "lieux_touristiques",
        [
            new Property("adresse", "Adresse", "varchar", 255, false)
        ], __DIR__."/assets/images/lieux-touristiques", "lieux-touristiques"
    ),
    "publicite" => new Contenu(
        "publicites",
        [
            new Property("contacts", "Contacts", "varchar", 255, true),
            new Property("date","Date", "date", null, false)
        ],__DIR__."/assets/images/publicites", "espace-publicite"
    ),
    "vuePage" => new ElementSchema(
        "vues_pages", 
        [
            new Property("ip_visiteur", "Ip du visiteur", "varchar", 30, false),
            new Property("id_page","Id page",  "varchar", 2, false),
        ]
    )
];