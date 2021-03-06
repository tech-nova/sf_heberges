<?php
/**
 * Fichier gérant l'installation et désinstallation du plugin Hébergés
 *
 * @plugin     Hébergés
 * @copyright  2015
 * @author     Gilles
 * @licence    GNU/GPL
 * @package    SPIP\Heberges\Installation
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Fonction d'installation et de mise à jour du plugin Hébergés.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *     Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
**/
function heberges_upgrade($nom_meta_base_version, $version_cible) {
	$maj = array();

	$maj['create'] = array(array('maj_tables', array('spip_heberges')));
        $maj['1.0.1'] = array(array('maj_tables', array('spip_heberges')));
        $maj['1.0.2'] = array(array('maj_tables', array('spip_heberges')));
        
	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}


/**
 * Fonction de désinstallation du plugin Hébergés.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
**/
function heberges_vider_tables($nom_meta_base_version) {

	sql_drop_table("spip_heberges");

	# Nettoyer les versionnages et forums
	sql_delete("spip_versions",              sql_in("objet", array('heberge')));
	sql_delete("spip_versions_fragments",    sql_in("objet", array('heberge')));
	sql_delete("spip_forum",                 sql_in("objet", array('heberge')));

	effacer_meta($nom_meta_base_version);
}

?>