# Exercice 9 - Authentification

## Objectifs 

Cet exercice a pour objectifs : 
* de comprendre les outils de l'authentification
* de mettre en place une authentification
* de limiter l'accès à certaines pages 

## Outils de l'authentification

### Qu'est ce qui est fourni par Laravel
* Laravel fournit un certains nombres d'éléments pour l'authentification : 
    * Deux middleware : auth et guest
    * Un model User et des migrations pour créer les tables
* Cela n'est pas suffisant, il manque les routes, les vues et les actions pour permettre à un utilisateur de s'authentifier. Pour cela nous devons choisir un starterkit a utiliser ou bien tout refaire manuellement

### Les starterkits d'authentification
* Il existe différents outils pour mettre en place l'authentification, voici les 3 préconisés par Laravel : 
    * Laravel Breeze : simple et minimal. Il inclut le minimum requis et permet d'avoir du code très léger et simple.
    * Laravel Fortify : est un backend d'authentification headless qui sert surtout de base pour Jetstream ou d'autres outils.
    * Laravel Jetstream : est un starter lit Robust qui supporte l'authentification multi-factor (MFA), la gestion d'équipe, la gestion des sessions de navigateurs, les profiles et permet via Laravel Sanctym d'autoriser une authentification via des token d'API.

## Mise en place de l'authentification avec Laravel Breeze

* Afin de comprendre et parce qu'il répond à des besoins simples d'authentification, nous avons fait le choix d'utiliser LaravelBreeze.
* Nous devons l'installer, puis demander à artisan d'effectuer certaines opérations et enfin nous devons installer les assets et lancer les migrations : 
```
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run dev
php artisan migrate
```
* Se rendre sur le chemin /login, une page de connexion devrait apparaître.
* Créer un utilisateur en utilisant le chemin /register, puis connectez-vous avec l'utilisateur que vous venez de créer.

