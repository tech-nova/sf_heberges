<?php
/*
 * Plugin Notifications
 * (c) 2009 SPIP
 * Distribue sous licence GPL
 *
 */


if (!defined('_ECRIRE_INC_VERSION')) return;

// Fonction appelee par divers pipelines
// http://doc.spip.org/@notifications_instituerheberge_dist
function notifications_instituerheberge_dist($quoi, $id_heberge, $options) {

	// ne devrait jamais se produire
	if ($options['statut'] == $options['statut_ancien']) {
		spip_log("statut inchange",'notifications');
		return;
	}

	include_spip('inc/texte');

	$modele = "";
	if ($options['statut'] == 'publie')
		$modele = "notifications/heberge_publie";

	if ($options['statut'] == 'prepa' AND !$options['statut_ancien'])
		$modele = "notifications/heberge_propose";

	if ($modele){
		$destinataires = array();
		if ($GLOBALS['meta']["suivi_edito"] == "oui")
			$destinataires = explode(',',$GLOBALS['meta']["adresse_suivi"]);


		$destinataires = pipeline('notifications_destinataires',
			array(
				'args'=>array('quoi'=>$quoi,'id'=>$id_heberge,'options'=>$options)
			,
				'data'=>$destinataires)
		);

		$envoyer_mail = charger_fonction('envoyer_mail','inc'); // pour nettoyer_titre_email
		$texte = recuperer_fond($modele,array('id_heberge'=>$id_heberge));
		notifications_envoyer_mails($destinataires, $texte);
	}

}




?>
