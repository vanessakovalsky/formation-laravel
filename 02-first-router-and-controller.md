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


## Création du contrôleur BienvenueController

* Pour générer notre controleur au bon endroit dans l'arborescence, nous utilisons artisan avec la commande suivante :
```
php artisan make:controller BienvenueController
```
* Le controleur vide est alors crée dans app/Http/Controllers/BienvenueController.php
* Nous rajoutons alors la premiere méthode index
* Il contient le code suivant :
``` php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BienvenueController extends Controller
{
    public function index()
    {
        return 'Bienvenue sur Kingoludo';
    }
}
```
* Si l'on détaille un peu : 
    * On créé une classe BienvenueController qui étend la classe Controller standard du framework
    * on déclare une fonction index qui ne prend pas de paramètres et renvoit simplement du texte. 
* Il nous reste à crée la route pour associer un chemin à notre méthode index . 
* Ajouter dans le fichier routes/web.php la ligne suivante (sans oublier d'importer avec use en début de fichier notre classe BienvenueController) :
```php
Route::get('/', [BienvenueController::class, 'index']);
```
* Ici nous faisons correspondre un chemi, avec un controleur et une méthode de celui-ci.
* Tester en allant sur votre site en local, que s'affiche t'il ?

-> Félicitations vous savez déclarer des routes et ajouter un controlleur dans votre application.

## Création d'un controleur de ressource (CRUD)

* Notre controlleur va déclarer les actions correspondants aux routes suivantes :

| URL  | Page  | Action  |
|---|---|---|
| /jeu  | Accueil(liste des jeux)  | index  |
| /jeu/add  | Ajout d'un jeu  | add  |
| /jeu/edit/2 | Modifier un jeu avec l'ID 2  | edit  |
| /jeu/delete/4 | Supprimer un jeu avec l'ID 4 | delete |

* Nous allons utiliser artisan pour nous simplifier la vie 
```
php artisan make:controller JeuController --resource
```
* Il est alors nécessaire de déclarer les méthodes à notre ressource, cela peut se faire en une seule ligne : 
```php
Route::resource('jeux', JeuController::class);
```

## Utiliser les paramètres des requêtes HTTP

* Afin d'utiliser les paramètres des requêtes HTTP nous récupérons un objet Request dans notre controleur (passer automatiquement par le routeur)
```php
Route::get('/bienvenue/{name}', [BienvenueController::class, 'bienvenue']);
```
* Dans notre exemple, notre route passe l'objet Request avant de passer le paramètre
* Du côté du controlleur nous allons pouvoir récupérer cet objet et accéder aux éléments de la requête :
```php
public function bienvenue(Request $request, $name)
    {
        $path = $request->path();
        return 'Le chemin est : ' . $path . ' et nous souhaitons la bienvenue à ' .$name;
    }
```
* La requête fournit de nombreuses informations sur l'URL, les headers et c'est également via la requête que nous allons par exemple récupérer les données envoyées depuis un formulaire : 
https://laravel.com/docs/8.x/requests 

## Définir sa propre réponse HTTP

* Il est possible de renvoyer différents éléments en guise de réponse : 
    * une simple chaine de caractère
    * un réponse sous forme d'un objet `response` 
    * une redirection
    * une vue

* Nous avons déjà renvoyer une chaine de caractère, voyons un peu ce que l'on peut faire avec la fonction response :
```php
public function show($id){
    $response_text = 'l id du jeu'. $id;
    return response($response_text, 200)
                    ->header('Content-type','text/plain');
}
```
* Ici nous avons créer un objet réponse contenant :
    * un texte 
    * un code de status à 200
    * un header de Content-type
* Il est possible de définir autant de headers que l'on souhaite à sa réponse, soit en appelant headers, soit sous forme d'un tableau avec withHeaders : https://laravel.com/docs/8.x/responses#attaching-headers-to-responses 

* Il est également possible de rediriger l'utilisateur avec redirect() :
```php
Route::get('/bienvenue', function () {
    return redirect('home/bienvenue');
});
```

* Vous savez maintenant manipuler les routes, les controleurs, les requêtes et les réponses

## Pour aller plus loin 
* Vous pouvez construire le contrôleur qui va permettre de gérer les collections et ses routes
