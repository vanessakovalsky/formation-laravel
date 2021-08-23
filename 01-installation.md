# Installation et creation d'une application Laravel

Cet exercice a pour objectifs :
* installer l'environnement Laravel
* créer une première application 

## Pré-requis
Pour réaliser cet exercice vous avez besoin : 
* d'un serveur web comprenant : PHP , une BDD SQL et un serveur Web comme Apache ou Nginx
* d'un éditeur de code comme Visual Studio Code ou PHPStorm


## Installation de composer 

* Récupérer composer en fonction de votre OS : https://getcomposer.org/download/
* Ajouter Composer dans le path : https://getcomposer.org/doc/00-intro.md
* Vérifier le fonctionnement avec la commande :
```
composer --version
```

## Création de la première application 

* On peut maintenant lancer le téléchargement de laravel avec la commande :
``` 
composer create-project laravel/laravel kingoludo
```
* Composer télécharge alors l'ensemble des composants nécessaire à laravel pour fonctionner.
* Lancer l'application avec le serveur artisant :
```
cd kingoludo
php artisan serve
```
* Cliquer alors sur le lien qui vous emmène sur votre laravel installé.
* Votre installation est prête

## Configuration et création de la base de données

* Ouvrir le fichier .env
* Modifier les valeurs de connexion à la base de données pour les faire correspondre à votre environnement
* Cela nous permettra lors des créations de modèles de demander à artisan de générer les structures de table pour nous, et d'insérer / lire des données dans la BDD.

## Activation du mode développement 

* Nous allons maintenant activer le mode développement.
* Dans le fichier config/app.php 
    * Passer la ligne     
    ```'env' => env('APP_ENV', 'production'),```
    à     
    ```'env' => env('APP_ENV', 'development'),```
    * Passer la ligne 
    ```'debug' => (bool) env('APP_DEBUG', false),```
    à
    ```'debug' => (bool) env('APP_DEBUG', true),```
* Ces deux modifications permettent d'activer le mode développement et d'afficher le debug 
* /!\ Ces deux options ne sont à utiliser que lors du développement et doivent être remise à production et false pour un passage en production de l'application



-> Félicitations vous avez installer et configurer votre projet Laravel, et vous allez pouvoir commencer à développer.