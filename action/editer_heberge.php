<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// http://contrib.spip.net/Gestion-des-Statuts
function heberge_instituer($id_heberge, $edition){
    include_spip('action/editer_objet');
    
    if($edition['statut']=='publie'){
        spip_log("Passage au statut Actif de $id_heberge",'heberges');
            
        $row = sql_fetsel("email,inscrit_liste", "spip_heberges", "id_heberge=$id_heberge");
           
        // envoi de l'inscription a la mailinglist
        if($row['inscrit_liste']=='on'){ 
                  
                $mailinglist = lire_config('heberges/mailing_list');
                $mail_subscriber = $row['email'];
    
                spip_log("Inscription de $mail_subscriber a la liste $mailinglist", 'heberges');
    
                $liste_email = explode ("@", $mailinglist);
                
                // abonnement ou desabonement : on rajoute -join ou -leave dans l'email de la liste
                // http://www.list.org/mailman-member/node13.html            
                $dowhat = "-join@";
                $dest = $liste_email[0]."$dowhat".$liste_email[1];
                $subject = "Inscription a la liste $mailinglist";
                $body =array(
                    'from'=>$mail_subscriber);
        
                // http://code.spip.net/autodoc/tree/ecrire/inc/envoyer_mail.php.html#function_inc_envoyer_mail_dist
                $envoyer_mail = charger_fonction('envoyer_mail', 'inc');
            
                $envoyer_mail($dest, $subject, $body);  
        }
           
    }
    else{
        $statut = $edition['statut'];
        spip_log("Passage au statut $statut de $id_heberge",'heberges');
        objet_modifier('heberge', $id_heberge, array('statut'=>$edition['statut']));
    }
}

?>