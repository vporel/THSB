<?php
    const CONFIG_INSTALLATION = __DIR__."/installation.json";
    const CONFIG_MAIRIE = __DIR__."/mairie.json";

    $_MAIRIE = json_decode(file_get_contents(CONFIG_MAIRIE), true);
    $_INSTALLATION = json_decode(file_get_contents(CONFIG_INSTALLATION), true);