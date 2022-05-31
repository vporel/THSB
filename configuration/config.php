<?php
    const CONFIG_INSTALLATION = __DIR__."/installation.json";
    const CONFIG_MAIRIE = __DIR__."/mairie.json";

    $_MAIRIE = json_decode(file_get_contents(CONFIG_MAIRIE), true);
    $_INSTALLATION = json_decode(file_get_contents(CONFIG_INSTALLATION), true);
    if(!is_writable(CONFIG_MAIRIE) || !is_writable(CONFIG_INSTALLATION)){
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

    $_NB_THEMES = 6;