# Heberges

## SHEMA

1.0.1
*   Ajout d'un champ a la table heberge : inscrit_liste
*   Mise a jour du Shema dans /base/heberge.php et mise en place de l'update du shema dans heberge_administrations.php
1.0.2
*   Ajout du champ au champs éditables ^^

## Config

*   Ajout d'une config pour indiquer la liste de diffusion pour les inscrits

## FORMULAIRES

*   Formulaire d'édition d'un hébergé :
    	*   Ajout de la prise en charge de l'inscription en saisie oui_non
*   Traitement :
	*  envoie de l'abonnement via envoyer_mail()

## TODO

-   EN COURS 2.0.3 : si c'est une modification de l'hébergé, savoir si le statut de l'abonnement a changé et faire en fonction,
    pour ne pas envoyer une demande d'abonnement a chaque fois qu'on fait une modification.

    
-   Inscription a d'autres type de listes : mailman, ezml, plugin newsletter
    cf : spip abomailman



## BUGS

- La puce de changement de statut sur la vue par liste, ne fonctionne pas
- pas de squelette heberge/s pour la partie public 

## Travaux

2.0.3
:   *   Ajout d'un fichier action/editer_heberge.php pour gérer la souscription a la mailing list quand l'hébergé est passé en Statut = Publie
    *   Ajout d'une config host_domain, pour pouvoir changer le domaine de mutu dans le cas sites hébergés en sous-domaine
    *   Le nom de la liste a laquelle on s'abonne est passé en paramètre a la chaine de langue du label @mailiinglist@
    

2.0.2
:   *   Correction sur le formulaire editer_heberger, $retour au lieu de $return
    *   Test sur OVH mutualisé pro : le mail d'abonement pars bien et je reçois une notification du owner de la mailing liste comme quoi je suis déjà aboné

2.0.1
:   *   Ajout de l'inscription à une mailing liste type mailman