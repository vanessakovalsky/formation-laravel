# Exercice 3 - Créer des vues

## Objectifs
Cet exercice a pour objectifs : 
* Créer des vues pour afficher du contenu
* Associer des vues à notre controlleur via les routes

## Création d'une première vue
* Nous allons créer une vue pour notre page d'accueil
* Pour cela dans le dossier resources/views créer un fichier bienvenue.blade.php
* Ce fichier va contenir les données de notre réponses 
```php
<html>
    <body>
        <h1>Hello, {{ $name }}</h1>
    </body>
</html>
```
* Il s'agit de notre premier template blade qui contient deux choses : 
    * des balises html
    * une variable qui est appelé entre double accolades. C'est le moyen d'indiquer à blade que c'est une donnée dynamique qui devra être remplacée
* Pour appeler notre vue, nous remplaçons l'appel de notre route dans routes/web.php pour le BienvenueController par la ligne suivante :
```php
Route::get('/bienvenue/{name}', function (Request $request, $name) {
    return view('bienvenue', ['name' => $name]);
});
```
* Ici nous avons appelé la méthode view en lui passant les paramètres suivants :
    * le nom de la vue (correspondant au nom du fichier)
    * un tableau de paramètre pour lui passer le name dont elle a besoin). Ce tableau de paramètre est facultatif. 

## Créer un template pour nos jeux 
* Nous allons créer deux templates : 
    * un pour la liste des jeux
    * un pour le détail d'un jeu
* Nous commençons par créer un dossier jeu dans resources/view 
* Pour appeler notre template dans la méthode du controlleur, nous utilisons le nom : nomdudossier.nomdutemplate 
* Exemple pour le template de liste
```php
$data = [
    0 => [
        'nom' => 'Les aventuriers du rail'
    ],
    1 => [
        'nom' => 'Dice Forge'
    ]
];
return view('jeu.liste', [
    'data' => $data ]
    );
```
* Le fichier jeu/liste.blade.php contient un tableau qui affiche les différents jeux. 
```php
<html>
    <body>
        <h1>Ma super liste de jeux :) </h1>
        <table>
        @forelse($data as $jeu)
            <tr><td>{{ $jeu['nom'] }}</td></tr>
        @empty
            Pas de jeux
        @endforelse
        </table>
    </body>
</html>
```
* Ici on utilise deux structures conditionnelles : 
    * forelse qui permet de vérifier si le tableau n'est pas vide
    * foreach qui permet de boucler sur les différents éléments du tableau

* On crée également un template pour afficher le détail d'un jeu dans le fichier resources/views/jeu/show.blade.php
```php
<html>
    <body>
        <h1> {{ $jeu['nom'] }}</h1>
        Nom du jeu : {{ $jeu['nom'] }}<br />
    </body>
</html>
```
* Ajouter l'appel à ce template dans le controleur
* Nous avons donc nos deux pages avec la liste et le détail d'un jeu

## Refactorisation et utilisation des templates
* Nos deux templates ont des parties communes qui pourraient être factorisées
* Nous allons donc créer un template et chaque vue viendra étendre ce template.
* Créer un fichier template.blade.php dans resources/views 
```php
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('titre')</title>
</head>
<body>
    @yield('contenu')
</body>
</html>
```
* Nous avons défini une structure HTML ainsi que deux éléments @yield. Ces éléments permettent de venir remplacer ça avec d'autre contenus mais de garder une structure commune.
* Exemple d'utilisation du template avec notre liste : 
```php
@extends('template')

@section('titre')
        Ma super liste de jeux :)
@endsection

@section('contenu')
        <table>
        @forelse($data as $jeux)
            @foreach($jeux as $jeu)
                <tr><td>{{ $jeu['nom'] }}</td></tr>
            @endforeach
        @empty
            Pas de jeux
        @endforelse
@endsection
```
* Les différents éléments utilisés : 
    * @extends('nomdutemplate') permet de dire à blade d'utiliser un template via son nom
    * @section('nomdelasection') indique à blade à quel endroit positionner ce contenu

* Définir les vues et templates des différentes affichage lié à notre controleur jeu.

## Pour aller plus loin 
* Vous pouvez également définir les vues et templates pour les collections et les utilisateurs