<?php
    const FICHIER_CONFIG_INSTALLATION = __DIR__."/installation.json";
    const FICHIER_CONFIG_MAIRIE = __DIR__."/mairie.json";
    const FICHIER_CONFIG_THEME = __DIR__."/theme.json";
    const FICHIER_BASE_DE_DONNEES = __DIR__."/../bd.sqlite";

    //Vérification de l'existance des fichiers
    if(!file_exists(FICHIER_CONFIG_MAIRIE))
        file_put_contents(FICHIER_CONFIG_MAIRIE, "{}");
    if(!file_exists(FICHIER_CONFIG_INSTALLATION))
        file_put_contents(FICHIER_CONFIG_INSTALLATION, "{}");
    if(!file_exists(FICHIER_CONFIG_THEME)){
        file_put_contents(FICHIER_CONFIG_THEME, "{}");
    }

    /**
     * CONTENU DES FICHIERS DE CONFIGURATION MIS DANS DES VARIABLES
     */
    $_MAIRIE = json_decode(file_get_contents(FICHIER_CONFIG_MAIRIE), true) ?? [];
    $_MAIRIE["imagePresente"] = isset($_MAIRIE["image"]) && $_MAIRIE["image"] != null && file_exists(__DIR__."/../assets/images/".$_MAIRIE["image"]);
    $_INSTALLATION = json_decode(file_get_contents(FICHIER_CONFIG_INSTALLATION), true) ?? [];
    $_THEME = json_decode(file_get_contents(FICHIER_CONFIG_THEME), true) ?? [];

    /**
     * VERIFICATION DES PERMISSIONS SUR LES FICHIERS
     */
    if(!is_writable(FICHIER_CONFIG_MAIRIE) || !is_writable(FICHIER_CONFIG_INSTALLATION) || !is_writable(FICHIER_CONFIG_THEME)){
        echo "
            <h2>Impossible d'accéder aux fichiers de configuration. Permissions requises</h2>
            <h4>Suivez les étapes ci-après : </h4>
            <h5>Sur linux (ubuntu) : </h5>
            <ul>
                <li>Ouvrez le terminal dans le dossier du projet (THSB par défaut)</li>
                <li>Exécutez la commande : sudo chmod -R 777 . (ne pas oublier le point de la fin)</li>
                <li>Entrez votre mot de passe s'il est demandé</li>
		<li>Relancez le site</li>
            </ul>

        ";
        exit();
    }

    $_FONCTIONNALITES_DISPONIBLES = [
        1 => [
            "nom" => "personnel", // Ce nom est aussi celui de la page correspondante
            "label" => "Personnel",
            "page" => "personnel.php"
        ],
        2 => [
            "nom" => "projets",
            "label" => "Projets",
            "page" => "projets.php"
        ],
        3 => [
            "nom" => "activites",
            "label" => "Activités",
            "page" => "activites.php"
        ],
        4 => [
            "nom" => "annonces",
            "label" => "Annonces",
            "page" => "annonces.php"
        ],
        5 => [
            "nom" => "lieux-touristiques",
            "label" => "Lieux touristiques",
            "page" => "lieux-touristiques.php"
        ],
        6 => [
            "nom" => "espace-publicite",
            "label" => "Espace PUB",
            "page" => "espace-publicite.php"
        ],
    ];

    /**
     * Valeurs des clés pour le thème par défaut
     */
    $_THEME_DEFAUT = [
        "numero" => 1, 
        "couleur-site" => "#0364be", 
        "couleur-admin" => "#2e3436",
        "dispositions" => [
            1 => 1,
            2 => 1,
            3 => 1,
            4 => 1,
            5 => 1,
            6 => 1
        ]
    ];

    $_NB_THEMES = 3;
