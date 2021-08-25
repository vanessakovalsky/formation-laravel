# Exercice 7 - Eloquent ORM - Avancé

## Objectifs : 

Cet exercice a pour objectifs : 
* de précharger des données avec les seeders
* de créer ses propres requêtes
* de réagir à l'enregistrement d'un Jeu

## Précharger des catégories avec les seeders
* On va créer des catégories automatiquements en les chargeant avec un seeder
* Pour cela on utilise artisan pour générer notre seeder : 
```
php artisan make:seeder CategorieSeeder
```
* Le fichier une fois rempli contient : 
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Familiale',
            'slug' => 'familiale'
        ]);
        DB::table('categories')->insert([
            'name' => 'Expert',
            'slug' => 'expert'
        ]);
        DB::table('categories')->insert([
            'name' => 'Apéro',
            'slug' => 'apero'
        ]);
    }
}
```
* La méthode run est appelé lors de l'utilisation de la commande db:seed
```
php artisan db:seed
```
* Nos données sont alors insérées en BDD

## Créer ses propres requêtes avec le Query Builder

* Nous allons maintenant définir notre propre requête avec le query builder.
* Pour cela et afin de respecter les bonnes pratiques, nous rajoutons une méthode dans le modèle Jeu qui nous permet de récupérer les catégories avec la liste de jeux.
```php
    public static function getAllGamesWithCategory(){
        $games = DB::table('jeus')
                    ->join('categories', 'categories.id', '=', 'jeus.categorie_id')
                    ->select('jeus.*','categories.name')
                    ->get();
        return $games;
```
* Pour utiliser cette fonction, nous modifions notre fonction index du JeuController : 
```php
    public function index()
    {
            $jeux = Jeu::getAllGamesWithCategory();
            return view('jeu.index',['jeux' => $jeux]);
    }
```
* Vous pouvez maintenant déclarer les requêtes nécessaires à l'ensemble de l'application.

## Tracer les modifications d'un jeu

* On va créer un évènement et l'écouter pour enregistrer des logs lors de la sauvegarde d'un jeu 
* Pour cela on génère un évènement avec la commande : 
```php
php artisan make:event JeuSaved
```
* Aucune modification n'est nécessaire dans cette classe
* On va associer notre évènement JeuSaved à l'élement saved du cycle de vie Eloquent sur notre modèle Jeu, en ajoutant la variable dispatchesEvents :
```php
protected $dispatchesEvents = [
    'saved' => JeuSaved::class,
];
```
* On va maintenant générer le listener qui écoutera l'évènement et enregistrera notre log : 
```php
php artisan make:listener TraceEditGameListener
```
* On définit dans la fonction handle notre appel au Log : 
```php
<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TraceEditGameListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Log::info('Un nouveau jeu a été crée');
        // ma fonction métier à moi :p 
    }
}
```
* Il reste à faire écouter notre listener sur l'évènement JeuSaved. Pour cela on vient compléter la variable listen dans app/Provider/EventServiceProvider.php : 
```php
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        JeuSaved::class => [
            TraceEditGameListener::class,
        ],
    ];
```
* On peut tester la création d'un jeu, et vérifier dans les logs que notre message est bien enregistré. 