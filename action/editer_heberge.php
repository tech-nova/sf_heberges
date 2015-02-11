<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// http://contrib.spip.net/Gestion-des-Statuts
function heberge_instituer($id_heberge,$edition){
     include_spip('action/editer_objet');
     if($edition['statut']=='publie'){
            spip_log("Passage au statut Actif de $id_heberge",'heberges');
     }else{
        //objet_modifier('heberge', $id_heberge, array('statut'=>$edition['statut']));
    }
}

?>