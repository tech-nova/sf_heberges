<?php
/**
 * Définit les autorisations du plugin Hébergés
 *
 * @plugin     Hébergés
 * @copyright  2015
 * @author     Gilles
 * @licence    GNU/GPL
 * @package    SPIP\Heberges\Autorisations
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Fonction d'appel pour le pipeline
 * @pipeline autoriser */
function heberges_autoriser(){}


// -----------------
// Objet heberges


/**
 * Autorisation de voir un élément de menu (heberges)
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_heberges_menu_dist($faire, $type, $id, $qui, $opt){
	return autoriser('webmestre');
} 


/**
 * Autorisation de créer (heberge)
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_heberge_creer_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('webmestre');
}

/**
 * Autorisation de voir (heberge)
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_heberge_voir_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('webmestre');
}

/**
 * Autorisation de modifier (heberge)
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_heberge_modifier_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('webmestre');
}

/**
 * Autorisation de supprimer (heberge)
 *
 * @param  string $faire Action demandée
 * @param  string $type  Type d'objet sur lequel appliquer l'action
 * @param  int    $id    Identifiant de l'objet
 * @param  array  $qui   Description de l'auteur demandant l'autorisation
 * @param  array  $opt   Options de cette autorisation
 * @return bool          true s'il a le droit, false sinon
**/
function autoriser_heberge_supprimer_dist($faire, $type, $id, $qui, $opt) {
	return autoriser('webmestre');
}




?>
