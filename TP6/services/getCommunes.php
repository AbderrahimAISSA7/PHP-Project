<?php
// fichiers requis
set_include_path('..' . PATH_SEPARATOR);
require_once('lib/common_service.php');
require_once('lib/initDataLayer.php');
require_once('lib/fonctions_parms.php');

try {
    // traitement des paramètres
    $territoire = checkUnsignedInt('territoire', NULL, FALSE);
    // interrogation de la bdd
    $communes = $data->getCommunes( $territoire );
    // production du résultat
    produceResult($communes);
} catch (PDOException $e) {
    produceError($e->getMessage());
} catch (ParmsException $e) {
    produceError($e->getMessage());
}
?>
