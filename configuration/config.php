<?php
    const FICHIER_CONFIG_INSTALLATION = __DIR__."/installation.json";
    const FICHIER_CONFIG_MAIRIE = __DIR__."/mairie.json";
    const FICHIER_CONFIG_THEME = __DIR__."/theme.json";

    $_MAIRIE = json_decode(file_get_contents(FICHIER_CONFIG_MAIRIE), true);
    $_INSTALLATION = json_decode(file_get_contents(FICHIER_CONFIG_INSTALLATION), true);
    $_THEME = json_decode(file_get_contents(FICHIER_CONFIG_THEME), true);

    if(!is_writable(FICHIER_CONFIG_MAIRIE) || !is_writable(FICHIER_CONFIG_INSTALLATION) || !is_writable(FICHIER_CONFIG_THEME)){
        echo "
            <h2>Impossible d'accéder aux fichiers de configuration. Permissions requises</h2>
            <h4>Suivez les étapes ci-après : </h4>
            <h5>Sur linux (ubuntu) : </h5>
            <ul>
                <li>Ouvrez le terminal dans le dossier du projet (THSB par défaut)</li>
                <li>Exécutez la commande : sudo chmod -R 777 . (ne pas oublier le point de la fin)</li>
                <li>Relancez le site</li>
            </ul>

        ";
        exit();
    }

    $_FONCTIONNALITES_DISPONIBLES = [
        1 => [
            "nom" => "personnel", // Ce nom est aussi celui de la page correspondante
            "label" => "Personnel"
        ],
        2 => [
            "nom" => "projets",
            "label" => "Projets"
        ],
        3 => [
            "nom" => "activites",
            "label" => "Activités"
        ],
        4 => [
            "nom" => "annonces",
            "label" => "Annonces"
        ],
        5 => [
            "nom" => "lieux-touristiques",
            "label" => "Lieux touristiques"
        ],
        6 => [
            "nom" => "espace-publicite",
            "label" => "Espace PUB"
        ],
    ];

    $_THEME_DEFAUT = [
        "numero" => 1, 
        "couleur-site" => "#0364be", 
        "couleur-admin" => "#0364be",
        "dispositions" => [
            1 => 1,
            2 => 1,
            3 => 1,
            4 => 1,
            5 => 1,
            6 => 1
        ]
    ];

    $_NB_THEMES = 4;
