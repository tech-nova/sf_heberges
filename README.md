# Heberges

## SCHEMA

1.0.2

*   Ajout d'un champ a la table heberge : inscrit_liste
*   Mise a jour du Schema dans /base/heberge.php et mise en place de l'update du schema dans heberge_administrations.php
*   Ajout du champ au champs éditables

## Configuration

*   liste de diffusion pour les inscrits mailman uniquement
*   domaine de de la mutualisation 

## FORMULAIRES

Formulaire d'édition d'un hébergé :

*   Ajout de la prise en charge de l'inscription en saisie oui_non
*   Traitement : envoie de l'abonnement via envoyer_mail()


## TODO

  
-   Inscription a d'autres type de listes : mailman, ezml, plugin newsletter
    cf : spip abomailman

*   le bonus serait que lorsqu'on remplie le formulaire avec l'url de son site
    dans l'idée c'est lors d'un inscription de pourvoir également référencé le site en site syndiqué avec le mot clé favori
    
    *Au passage au statut Actif syndiquer le site dans l'annuaire*

## BUGS


- La puce de changement de statut sur la vue par liste, ne fonctionne pas

- pas de squelette heberge/s pour la partie public


## Travaux

2.0.4 : 

*   L'inscription a la mailing list ne pars que au passage au statut  actif de l'hébérgé

2.0.3 :

*   Ajout d'un fichier action/editer_heberge.php pour gérer la souscription a la mailing list quand l'hébergé est passé en Statut = Publie
*   Ajout d'une config host_domain, pour pouvoir changer le domaine de mutu dans le cas sites hébergés en sous-domaine
*   Le nom de la liste a laquelle on s'abonne est passé en paramètre a la chaine de langue du label @mailiinglist@
    

2.0.2:

*   Correction sur le formulaire editer_heberger, $retour au lieu de $return
*   Test sur OVH mutualisé pro : le mail d'abonement pars bien et je reçois une notification du owner de la mailing liste comme quoi je suis déjà aboné

2.0.1:

*   Ajout de l'inscription à une mailing liste type mailman

