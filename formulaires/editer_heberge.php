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
//var_dump($valeurs);
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
        
        $mailinglist = lire_config('heberges/mailing_list');
        $statut_abo = _request('inscrit_liste');
        $mail_subscriber = _request('email');
        
        spip_log("Inscription statut $statut_abo pour $mail_subscriber a la liste $mailinglist",'heberges');
   
        // Si c'est int c'est une id donc une modif
	if (is_int($id_heberge)) {
		$row = sql_fetsel("statut, date, inscrit_liste", "spip_heberges", "id_heberge=$id_heberge");
		$statut_ancien = $row['statut'];
		$date_ancienne = $row['date'];
                $statut_abo_ancien = $row['inscrit_liste'];
	}
 
        
	$return = formulaires_editer_objet_traiter('heberge',$id_heberge,'',$lier_trad,$retour,$config_fonc,$row,$hidden);

        
     	// envoi de l'inscription a la mailinglist
        if($statut_abo=='on'){ //  || $id_heberge='new'
                $liste_email = explode ("@", $mailinglist);
                // abonnement ou desabonement : on rajoute -join ou -leave dans l'email de la liste
                // http://www.list.org/mailman-member/node13.html
                
                $dowhat = "-join@";
                $dest = $liste_email[0]."$dowhat".$liste_email[1];
                $subject = '';
                $body =array(
                    'from'=>$mail_subscriber);
            
                spip_log("Subcription subject : $subject",'heberges');
                
                // http://code.spip.net/autodoc/tree/ecrire/inc/envoyer_mail.php.html#function_inc_envoyer_mail_dist
                $envoyer_mail = charger_fonction('envoyer_mail', 'inc');
                
                $envoyer_mail($dest, $subject, $body);
                
        }
        
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
