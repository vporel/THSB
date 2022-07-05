<?php 

/**
 * Enregistrer l'administrateur à l'id $id comme administrateur connecté
 * @param mixed $id
 * 
 * @return [type]
 */
function connectAdmin($id)
{
    $_SESSION["connected-admin-ionnected-admin-id"] = $id;
}

/**
 * Vérifie si un administrateur est connecté
 * @return bool
 */
function isAdminConnected():bool
{
    return isset($_SESSION["connected-admin-id"]) && (int) $_SESSION["connected-admin-id"] > 0;
}

/**
 * Retournes les infos sur l'administrateur connecté (les valeurs de son enregistrment dans la base de données)
 * @return array
 */
function getConnectedAdminInfos():array
{
    return findById("administrateur", $_SESSION["connected-admin-id"]);
}