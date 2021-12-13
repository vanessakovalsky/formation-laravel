# Exercice 7 - Eloquent ORM - Seeders et Requêtes

## Objectifs : 

Cet exercice a pour objectifs : 
* de précharger des données avec les seeders
* de créer ses propres requêtes


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

