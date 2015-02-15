<?php
/**
 * Gestion du formulaire de d'édition de heberge
 *
 * @plugin     Hébergés
 * @copyright  2015
 * @author     Gilles
 * @licence    GNU/GPL
 * @package    SPIP\Heberges\Formulaires
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/actions');
include_spip('inc/editer');

/**
 * Identifier le formulaire en faisant abstraction des paramètres qui ne représentent pas l'objet edité
 *
 * @param int|string $id_heberge
 *     Identifiant du heberge. 'new' pour un nouveau heberge.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un heberge source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du heberge, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return string
 *     Hash du formulaire
 */
function formulaires_editer_heberge_identifier_dist($id_heberge='new', $retour='', $lier_trad=0, $config_fonc='', $row=array(), $hidden=''){
	return serialize(array(intval($id_heberge)));
}

/**
 * Chargement du formulaire d'édition de heberge
 *
 * Déclarer les champs postés et y intégrer les valeurs par défaut
 *
 * @uses formulaires_editer_objet_charger()
 *
 * @param int|string $id_heberge
 *     Identifiant du heberge. 'new' pour un nouveau heberge.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un heberge source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du heberge, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Environnement du formulaire
 */
function formulaires_editer_heberge_charger_dist($id_heberge='new', $retour='', $lier_trad=0, $config_fonc='', $row=array(), $hidden=''){
	$valeurs = formulaires_editer_objet_charger('heberge',$id_heberge,'',$lier_trad,$retour,$config_fonc,$row,$hidden);
	return $valeurs;
}

/**
 * Vérifications du formulaire d'édition de heberge
 *
 * Vérifier les champs postés et signaler d'éventuelles erreurs
 *
 * @uses formulaires_editer_objet_verifier()
 *
 * @param int|string $id_heberge
 *     Identifiant du heberge. 'new' pour un nouveau heberge.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un heberge source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du heberge, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Tableau des erreurs
 */
function formulaires_editer_heberge_verifier_dist($id_heberge='new', $retour='', $lier_trad=0, $config_fonc='', $row=array(), $hidden=''){
	 
	$champs_obligatoires = array('nom', 'prenom', 'email', 'adresse', 'code_postal', 'ville', 'nom_du_site','valide_cgu');
	foreach ($champs_obligatoires as $champ) if (!is_array(_request($champ))) set_request($champ,trim(_request($champ)));
	return formulaires_editer_objet_verifier('heberge',$id_heberge, $champs_obligatoires);

}

/**
 * Traitement du formulaire d'édition de heberge
 *
 * Traiter les champs postés
 *
 * @uses formulaires_editer_objet_traiter()
 *
 * @param int|string $id_heberge
 *     Identifiant du heberge. 'new' pour un nouveau heberge.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un heberge source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du heberge, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Retours des traitements
 */
function formulaires_editer_heberge_traiter_dist($id_heberge='new', $retour='', $lier_trad=0, $config_fonc='', $row=array(), $hidden=''){
	
        $statut_ancien = $date_ancienne = '';
      
   
	if (is_int($id_heberge)) {
		$row = sql_fetsel("statut, date", "spip_heberges", "id_heberge=$id_heberge");
		$statut_ancien = $row['statut'];
		$date_ancienne = $row['date'];
	}
 
        
	$return = formulaires_editer_objet_traiter('heberge',$id_heberge,'',$lier_trad,$retour,$config_fonc,$row,$hidden);

               
        // Notifications
	if (isset($return['id_heberge']) and $notifications = charger_fonction('notifications', 'inc')) {
		$row = sql_fetsel("statut, date", "spip_heberges", "id_heberge=".sql_quote($return['id_heberge']));
		$statut = $row['statut'];
		$date = $row['date'];
		$notifications('instituerheberge', $return['id_heberge'],
			array('statut' => $statut, 'statut_ancien' => $statut_ancien, 'date'=>$date, 'date_ancienne' => $date_ancienne)
		);
	}
        
	return $return;

}



?>
