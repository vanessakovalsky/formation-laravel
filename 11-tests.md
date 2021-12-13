# Exercice 11 - Tests

## Objectifs

Cet exercice a pour objectifs : 
* de concevoir, écrire et exécuter des tests unitaires
* d'imaginer des scénarios de tests fonctionnels et de les mettre en oeuvre

## Créer des tests pour notre controleur Jeu

* Pour commencer on s'appuie sur Artisan pour créé notre classe de tests qui nous servira à tester notre contrôleur de jeu
``` 
php artisan make:test JeuTest
```

* Un fichier JeuTest est alors crée dans le dossier tests/Features 

* Ensuite définissons un peu qu'est ce que nous voulons tester :
    * L'arrivée sur /jeu nous renvoit bien notre liste de jeu, avec le titre de la page, le tableau et les données que nous avons prévu d'utilisée
    * Le formulaire d'ajout du jeu s'affiche 
    * Lors de la saisie il y a bien une validation des données qui est faite
    * Lors de l'enregistrement des données nous sommes bien redirigés vers la liste des jeux
    * Le jeu est bien ajouté à la liste 

* Pour cela nous allons commencer par définir les données à utiliser avec la méthode setUp.
* Cette méthode permet de définir les données d'entrées de notre test (de figer un état de départ), pour plus d'information [voir la page de documentation](https://phpunit.readthedocs.io/fr/latest/fixtures.html)

* Ensuite pour chacune des étapes de notre plan de test défini ci-dessus, nous allons écrire une méthode test. Chacune de ces méthodes va contenir plusieurs assertions pour vérifier les différents éléments de l'étape (par exemple le code statut de la page, la présence d'un titre, d'une phrase, d'un contenu ...). Pour cela on utilise les [assertions de PHPUnit](https://phpunit.readthedocs.io/fr/latest/assertions.html)
* Laravel a également ajouter [ses propres assertions](https://laravel.com/docs/8.x/http-tests) que vous pouvez utiliser pour gagner du temps sur les vues, ou d'autres composants de Laravel

## Tester notre base de données

https://laravel.com/docs/8.x/database-testing

## Simuler des comportements (Mock)

https://laravel.com/docs/8.x/mocking
https://laravel.sillo.org/cours-laravel-8-les-tests/