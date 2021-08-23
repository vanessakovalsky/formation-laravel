# Créer un permier controleur et ses routes

Cet exercice a pour objectif : 

* de créer un premier controlleur permettant de faire différentes actions
* de créer des routes correspondantes aux différentes actions de notre contrôleur.

## Déclaration des routes 

* La déclaration des routes se fait dans le fichier ***routes/web.php***
* Le format de déclaration des routes est le suivant : 
```php
use Illuminate\Support\Facades\Route;

Route::get('/bienvenue', function () {
    return 'Bienvenue';
});
```
* Ajouter cela au fichier que vous avez ouvert
* Ajouter /bienvenue à l'url dans votre navigateur, que voyez vous afficher ?
* Si l'on détaille la déclaration : 
    * On utilise la Facade Route fournit par laravel
    * Puis la méthode sur laquelle la route s'exécute (voir la liste des méthodes disponibles ici : https://laravel.com/docs/8.x/routing#available-router-methods ), ici on utilise Get
    * en argument on lui donne deux éléments : 
        * le chemin sur lequel cette route réagit
        * la fonction qui est appelé sous forme d'une fonction anonyme
* On peut également donner un paramètre à une route : 
```php
use Illuminate\Http\Request;

Route::get('/user/{id}', function (Request $request, $id) {
    return 'User '.$id;
});
```
* Le paramètre est alors rajouté au chemin entre accolade (on peut le rendre optionnel en rajoutant un ? apres le nom du parametre)
* Il est également récupéré au niveau de la fonction anonyme dans les paramètres avec le même nom que celui utilisé dans le chemin
* Ajouter à notre route welcome un parametre name et utiliser le pour afficher différents noms sur la page en fonction du paramètre passé en URL.


## Création du contrôleur

* Notre controlleur va déclarer les actions correspondants aux routes suivantes :

| URL  | Page  | Action  |
|---|---|---|
| /jeu  | Accueil(liste des jeux)  | index  |
| /jeu/add  | Ajout d'un jeu  | add  |
| /jeu/edit/2 | Modifier un jeu avec l'ID 2  | edit  |
| /jeu/delete/4 | Supprimer un jeu avec l'ID 4 | delete |

* Pour générer notre controleur au bon endroit dans l'arborescence, nous utilisons artisan avec la commande suivante :
```
php artisan make:controller JeuController
```
* Le controleur vide est alors crée dans app/Http/Controllers/JeuController.php
* Nous rajoutons alors la premiere méthode index
* Il contient le code suivant :
``` php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JeuController extends Controller
{
    public function index()
    {
        return 'index des jeux';
    }
}
```
* Si l'on détaille un peu : 
    * On créé une classe JeuController qui étend la classe Controller standard du framework
    * on déclare une fonction index qui ne prend pas de paramètres et renvoit simplement du texte. 
* Il nous reste à crée la route pour associer un chemin à notre méthode index . 
* Ajouter dans le fichier routes/web.php la ligne suivante (sans oublier d'importer avec use en début de fichier notre classe JeuController) :
```php
Route::get('/', [JeuController::class, 'index']);
```
* Ici nous faisons correspondre un chemi, avec un controleur et une méthode de celui-ci.
* Tester en allant sur votre site en local, que s'affiche t'il ?
* Ajouter les 4 méthodes et routes que nous avions définis au démarrage comme objectifs dans ce controleur.

-> Félicitations vous savez déclarer des routes et ajouter un controlleur dans votre application.