# Exercice 8 - Authentification

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

## Limiter l'accès à certaines pages aux utilisateurs authentifiés : 

* Nous allons pouvoir limiter au niveau des routes, l'accès à certaines pages, comme par exemple la création / modification / suppression des jeux, qui ne doivent pas être faites par des utilisateurs non connectés : 
```php
Route::post('/jeu/create', [JeuController::class, 'create')->middleware('auth');
```
* Ici j'applique le middleware auth sur le formulaire de création de jeu. 
* Cela nous oblige à redéclarer nos routes séparément, ou alors on souhaite que l'ensemble des ressources Jeu ne soit pas accessible, et on applique le middleware sur la ressource en entier.

* Nous pouvons également au sein d'une classe vérifier si l'utilisateur est authentifié : 
```php
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    // The user is logged in...
}
```
* Vous pouvez maintenant ajouter la vérification de l'authentification là où cela est nécessaire soit via les routes soit avec la Facades Auth

## Définir les autorisations via les Policy

* Afin de limiter les accès à certaines fonctionnalités en fonction du rôle, nous allons définir une Policy pour mettre en place notre logique d'autorisation.
* Pour cela on génère notre Policy attacher à notre modèle Jeu pour qu'il génère les fonctions liés au modèle :
``` 
php artisan make:policy JeuPolicy --model=Jeu
```
* Une fois le modèle généré, nous définissions des règles pour la fonction viewAny. Notre fonction doit renvoyer la fonction allow ou deny de l'objet Response. 
```php
<?php

namespace App\Policies;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class JeuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->role != 'admin'){
            Response::allow();
        }
        else {
            Response::deny('Pas autorisé');
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Jeu  $jeu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Jeu $jeu)
    {
        
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Jeu  $jeu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Jeu $jeu)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Jeu  $jeu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Jeu $jeu)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Jeu  $jeu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Jeu $jeu)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Jeu  $jeu
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Jeu $jeu)
    {
        //
    }
}
```
* On associe le modèle de données à notre policy dans app/Providers/AuthServiceProvider.php
```php
    protected $policies = [
        Jeu::class => JeuPolicy::class,
    ];
```
* On utilise notre police dans le controleur : 
```php
    public function index()
    {
        if (Gate::authorize('viewAny')){
            $jeux = Jeu::getAllGamesWithCategory();
            return view('jeu.index',['jeux' => $jeux]);
        }
    }
```
* La fonction authorize de la facade Gate permet d'appeler notre fonction dans notre policy. 
* Il reste à définir les différentes règles dans les fonctions et à les appeler dans les fonctions de notre controleur.

## Pour aller plus loin 

* Ajouters les champs de profils sur le modèle User
* Limiter les droits en fonction du rôle de l'utilisateur
