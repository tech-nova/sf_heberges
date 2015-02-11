<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Hébergés
 * @copyright  2015
 * @author     Gilles
 * @licence    GNU/GPL
 * @package    SPIP\Heberges\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function heberges_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['heberges'] = 'heberges';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function heberges_declarer_tables_objets_sql($tables) {

	$tables['spip_heberges'] = array(
		'type' => 'heberge',
		'principale' => "oui",
		'field'=> array(
			"id_heberge"         => "bigint(21) NOT NULL",
			"nom"                => "tinytext NOT NULL DEFAULT ''",
			"prenom"             => "tinytext NOT NULL DEFAULT ''",
			"email"              => "tinytext NOT NULL DEFAULT ''",
			"adresse"            => "text NOT NULL DEFAULT ''",
			"code_postal"        => "tinytext NOT NULL DEFAULT ''",
			"ville"              => "tinytext NOT NULL DEFAULT ''",
			"nom_du_site"        => "tinytext NOT NULL DEFAULT ''",
			"url_du_site"        => "tinytext NOT NULL DEFAULT ''",
			"bio"                => "text NOT NULL DEFAULT ''",
			"option_ftp"         => "varchar(3) NOT NULL DEFAULT ''",
			"telephone"          => "tinytext NOT NULL DEFAULT ''",
			"siret"              => "tinytext NOT NULL DEFAULT ''",
			"num_tva"            => "tinytext NOT NULL DEFAULT ''",
			"valide_cgu"         => "varchar(3) NOT NULL DEFAULT ''",
                        "inscrit_liste"      => "varchar(3) NOT NULL DEFAULT ''",
			"date"               => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'", 
			"statut"             => "varchar(20)  DEFAULT '0' NOT NULL", 
			"maj"                => "TIMESTAMP"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_heberge",
			"KEY statut"         => "statut", 
		),
		'titre' => "nom_du_site AS titre, '' AS lang",
		'date' => "date",
		'champs_editables'  => array('nom', 'prenom', 'email', 'adresse', 'option_ftp', 'code_postal', 'ville', 'nom_du_site', 'url_du_site', 'bio', 'telephone', 'siret', 'num_tva', 'valide_cgu','inscrit_liste'),
		'champs_versionnes' => array('nom', 'prenom', 'email', 'adresse', 'option_ftp', 'code_postal', 'ville', 'nom_du_site', 'url_du_site', 'bio', 'telephone', 'siret', 'num_tva', 'valide_cgu'),
		'rechercher_champs' => array(),
		'tables_jointures'  => array(),
		'statut_textes_instituer' => array(
			'prepa'    => 'heberge:texte_statut_en_cours_redaction',
			'prop'     => 'heberge:texte_statut_propose_evaluation',
			'publie'   => 'heberge:texte_statut_publie',
			'refuse'   => 'heberge:texte_statut_refuse',
			'poubelle' => 'texte_statut_poubelle',
		),
		'statut'=> array(
			array(
				'champ'     => 'statut',
				'publie'    => 'publie',
				'previsu'   => 'publie,prop,prepa',
				'post_date' => 'date', 
				'exception' => array('statut','tout')
			)
		),
		'texte_changer_statut' => 'heberge:texte_changer_statut_heberge', 
		

	);

	return $tables;
}



?>
