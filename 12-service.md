# Exercice 12 - Définir un service et l'utiliser

## Objectifs
Cet exercice a pour objectif : 
* de créer un service
* d'utiliser ce service dans notre application

## Créer un service

* Commençons par déclarer un service, celui-ci nous permettra de retrouver les coordonnées GPS à partir d'une adresse via un appel à une API et d'afficher une carte à partir de ces coordonnées.
* On crée un fichier App/Services/GeoService.php avec le contenu suivant :
```php
<?php

namespace App\Services;

class GeoService {

}
```
* Pour l'instant notre service ne fait rien, on va ajouter des fonctions.
* Ajouter une fonction qui permet d'appeler une [API qui renvoit les coordonnées GPS à partir d'une adresse](https://adresse.data.gouv.fr/api-doc/adresse) : 

```php
use Illuminate\Support\Facades\Http;

public function getCoordonnees($adresse) {
    $adresse_url = urlencode($adresse);
    $response = Http::get('https://api-adresse.data.gouv.fr/search/?q='.$adresse_url);
    return $response;
}
```
* Nous pouvons ensuite définir une fonction qui passera les bonnes informations au template. Voir le code JS à utiliser ici : https://www.datavis.fr/index.php?page=leaflet-firstmap 

## Utiliser notre service dans un controleur

* Pour utiliser notre service, il est nécessaire de l'injecter dans le constructeur de notre controleur :
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeoService;
[...]

class UserController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(GeoService $geoService)
    {
        $this->geoService = $geoService;
    }
```
* Nous pouvons ensuite utiliser notre service pour récupérer les coordonnées GPS à partir de l'adresse
```php
public function store(Request $request){
    $adresse = $request->get('adresse');
    $coordonnees = $this->geoService->getCoordonnes($adresse);
    $user->coordonnees = $coordonnees;
    $user->save();
}
```
* Ajouter dans l'affichage de l'utilsiateur, l'appel à la fonction qui permet d'afficher la carte depuis les coordonnées.