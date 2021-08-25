# Exercice 5 - Créer un modèle de données avec Eloquent

## Objectifs
Cet exercice a pour objectifs : 
* De configurer l'accès à notre base de données
* De créer un modèle de donnée pour nos jeux 
* D'aller lire / écrire / supprimer des données à l'aide de l'ORM depuis notre controleur

## Configurer l'accès à notre base de données

* On suppose que vous avez déjà une base de données (vierge) avec un utilisateur qui a les droits de tout faire dessus
* Dans le fichier .env de votre application, renseigner la section avec les paramètres de base de données : 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=databasename
DB_USERNAME=username
DB_PASSWORD=password
```
* Pour vérifier que la connexion fonctionne, vous pouvez lancer la commande : 
```
php artisan make:install
```
* En cas de succès une table migrations sera créé dans votre base de données
* Votre base est alors prête à être utilisée

## Créer un premier modèle et la structure dans la table correspondante.
* Eloquent fonctionne avec deux notions importantes : 
    * le modèle est la déclaration d'un modèle de donnée 
    * la migration est l'outil utilisé pour créer / modifier la structure d'une table de base de données correspondante à un modèle.
* Pour se simplifier la tâche, une commande artisan permet de créer à la fois le fichier de modèle et le fichier de migration
```
php artisan make:model Jeu -m
```
* Sur cette commande : 
    * make:model nomDuModel créer un fichier modèle dans app/Models
    * l'option -m crée la migration associée à ce modèle

* Commençons par étudier le fichier de migration qui est dans database/migrations/{date-heure}_create_jeus_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJeusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jeus');
    }
}
```
* Ici on a une classe qui vient étendre la classe migration et qui est composé de deux fonctions :
    * la fonction up est appelé lors de la migration et va crée la table avec la méthode statique create de la classe Schema. 
    Cette table contiendra deux champs, un premier contenant un id, et un second contenant un timestamp
    * la fonction down est appelée lors du retour en arrière sur une migration (en cas d'erreur par exemple pour remettre la base de données à l'état précédent)
* Avant d'utiliser ce fichier pour créer notre table, nous allons compléter la fonction up pour ajouter nos champs lié à nos jeux : 
```php
    public function up()
    {
        Schema::create('jeus', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->year('annee');
            $table->string('editeur');
            $table->string('categorie');
            $table->timestamps();
        });
    }
```
* Les différents types de colonnes disponibles à la création ainsi que leurs options respectives sont décrites dans la documentation : https://laravel.com/docs/8.x/migrations#available-column-types 
* Nous allons lancer la migration pour créer notre table : 
```
php artisan migrate
```
* Cette commande va alors scanner le dossier contenant les fichiers de migrations et comparer son contenu à celui de la table migrations. Les fichiers n'ayant pas été déjà migrés sont alors appelés. Cela va avoir pour effet de créer différentes tables, notre table jeu mais également des tables déjà décrite dans ce dossier (ces tables servent notamment pour l'authentification des utilisateurs)
* Vérifier dans la base de données que votre table a été créé.

* Du côté du modèle, le fichier app/Models/Jeu contient le code suivant : 
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeu extends Model
{
    use HasFactory;
}
```
* Comme vous le constater ce modèle est plutôt vide, et il va rester comme ça, il n'est pas nécessaire de le faire évoluer pour pouvoir l'utiliser dans le controleur. Il s'agit seulement de déclarer un objet, et l'ORM fait le lien avec la table créé par la migration et ses colonnes. 

## Connecter le modèle et le controleur

* Nous allons maintenant utiliser notre modèle avec notre contrôleur. 
* Pour cela commençons par enregistrer le résultat de  notre formulaire de création dans la base de donnée via le modèle: 
```php
    public function store(JeuFormRequest $request)
    {
        $jeu = new \App\Models\Jeu();
        $jeu->nom = $request->input('nom');
        $jeu->editeur = $request->input('editeur');
        $jeu->categorie = $request->input('categorie');
        $jeu->annee = $request->input('year');
        $jeu->save();
        return "Le jeu est bien enregistré !";
    }
```
* Dans cette fonction : 
    * On initialise un objet Jeu vide
    * On assigne la valeur des input du formulaire aux propriétés de notre objet
    * On enregistre l'objet
* Pour récupérer la liste des jeux on utilise la méthode all():
```php
    public function index()
    {
        $jeux = Jeu::all();
        return view('jeu.index',['jeux' => $jeux]);
    }
```
* /!\ $jeux est alors un tableau d'objet il faut donc légèrement modifier le template pour récupérer les propriétés de l'objet et nom plus depuis un tableau.
```php
@extends('layout.template')

@section('titre')
    Liste des jeux
@endsection

@section('contenu')
    @forelse($jeux as $jeu)
        {{$jeu->nom}}
    @empty
        Pas de jeux
    @endforelse
@endsection
```

* Pour la suppression, on commence par récupérer l'objet concerné à partir de son id puis on le supprime
```php
    public function destroy($id)
    {
        $jeu = Jeu::find($id);
        $jeu->delete();
    }
```

* Vous savez maintenant manipuler les bases d'un objet et de ses données en bases de données