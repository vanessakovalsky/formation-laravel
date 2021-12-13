# Exercice 10 - Limiter les droits d'accès des utilisateurs

## Objectifs

Cet exercice a pour objectifs : 
* d'utiliser le middleware Auth pour limiter les accès
* de définir sa propre police d'accès et de l'appliquer

## Limiter l'accès à certaines pages aux utilisateurs authentifiés via les routes ou dans une classe  

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
