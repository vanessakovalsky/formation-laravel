# Créer un permier controleur et ses routes

Cet exercice a pour objectif : 

* de créer un premier controlleur permettant de faire différentes actions
* de créer des routes correspondantes aux différentes actions de notre contrôleur.

## Déclaration des routes 

* La déclaration des routes se fait dans le fichier ***
* Il es possible de déclarer deux types de routes :

* Pour notre application nous utilisons les routes sur notre controlleur Jeu.
* Voici le code à ajouter dans le module.config.php
``` php

```
* Si l'on détaille un peu le fichier :
* * Déclaration de routes avec le tableau routeur et la clé routes
* * L'identifiant de notre route est ici 'jeu'
* * Notre route est de type Segment
* * Le path utilisé est /jeu/ suivi de deux arguments
* * Chaque argument à une contrainte 
* * defaults permet de renvoyer vers l'action index du controleur JeuController si les options ne correspondent pas à ce qui est attendu ou si l'action demandée n'existe pas.


## Création du contrôleur

* Notre controlleur va déclarer les actions correspondants aux routes suivantes :

| URL  | Page  | Action  |
|---|---|---|
| /jeu  | Accueil(liste des albums)  | index  |
| /jeu/add  | Ajout d'un jeu  | add  |
| /jeu/edit/2 | Modifier un jeu avec l'ID 2  | edit  |
| /jeu/delete/4 | Supprimer un jeu avec l'ID 4 | delete |

* Le controlleur reprend le nom des action en rajoutant le mot clé Action derrière. Il se place dans le dossier /module/jeu/src/Controller/
et se nomme JeuController.php.
* Il contient le code suivant :
``` php

```
* Vous pouvez accéder aux différentes actions avec les urls suivantes, et rajouter des choses dans vos fonctions pour les afficher sur les différentes pages .

| URL  | Méthode appelée  | 
|---|---|
| http://laminas-mvc-tutorial.localhost/jeu  | Jeu\Controller\JeuController::indexAction  |
| http://laminas-mvc-tutorial.localhost/jeu/add  | Jeu\Controller\JeuController::addAction  |
| http://laminas-mvc-tutorial.localhost/jeu/edit/2 |  Jeu\Controller\JeuController::editAction  |
| http://laminas-mvc-tutorial.localhost/jeu/delete/4 | Jeu\Controller\JeuController::deleteAction |

* Accèdez aux 4 pages et ajouter du contenu sur les pages au travers des fonctions (de simple echo pour commencer)

-> Félicitations vous savez déclarer des routes et ajouter un controlleur dans votre module.