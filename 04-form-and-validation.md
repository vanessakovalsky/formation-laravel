# Exercice 4 - Créer un formulaire d'ajout de jeu et valider les données

## Objectifs
Cet exercice a pour objectifs : 
* De créer un formulaire d'ajout de jeu
* De valider les données

## Définir la vue du formulaire d'ajout

* Nous commençons par créer un fichier create.template.php dans resources/views 
```php
@extends('template')
 
@section('contenu')
    <form action="{{ url('/jeu') }}" method="POST">
        @csrf
        <label for="nom">Entrez le nom du jeu : </label>
        <input type="text" name="nom" id="nom">
        <label for="editeur">Entrez l éditeur du jeu : </label>
        <input type="text" name="editeur" id="editeur">
        <label for="year">Entrez l année du jeu : </label>
        <input type="number" name="year" id="year">
        <label for="categorie">Entrez la catégorie du jeu : </label>
        <input type="text" name="categorie" id="categorie">
        <input type="submit" value="Envoyer !">
    </form>
@endsection
```
* Si l'on détaille un peu le code : 
    * sur la balise form on renvoit vers notre chemin jeu
    * on utilise l'inclusion de la protection du middleware de CSRF avec @crsf (cela permet 'ajouter un champ masque à notre formulaire qui le protège contre certains types d'attaques)
    * Le reste est uniquement des balises HTML 
* Nous pouvons maintenant travailler sur le controleur à partir de cette vue.

## Appeler la vue et traiter les données

* Dans notre contrôleur de jeux nous allons appeler la vue : 
```php
    public function create()
    {
        return view('jeu.create');
    }
```
* Cela permet d'afficher notre formulaire en allant sur /jeu/create 
* Ensuite nous traitons les données (lorsque la méthode POST est appelé c'est la fonction store d'un contrôleur de ressource qui est appelées)
```php
    public function store(Request $request)
    {
        return 'Le nom du jeu est ' . $request->input('nom');
    }
```
* Ici on utilise l'objet Request pour récupérer nos données. 

* Il est maintenant possible de traiter nos données, pour par exemple les enregistrer dans un fichier (en attendant de voir la partie ORM / Eloquent qui nous permettra de stocker les données dans une BDD)

## Valider ses données et afficher les messages de validations à l'utilisateur 

* Nous allons maintenant ajouter un FormRequest pour valider nos données.
* Pour cela on utilise artisan 
```
php artisan make:request JeuFormRequest
```
* Cela va générer une classe de validation JeuFormRequest qui contient le code suivant : 
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JeuFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}

```
* Les deux fonctions ont le rôle suivant :
    * authorize : permet de valider l'identité ou les droits de l'émetteur
    * rules : permet de définir des règles de validation
* Nous ajoutons les règles de validation suivante :
```php
    public function rules()
    {
        return [
            'nom' => 'bail|required|between:5,20|',
            'editeur' => 'bail|required|alpha',
            'categorie' => 'bail|required|max:250'
        ];
    }
```
* Il existente de nombreuses règles de validations https://laravel.com/docs/8.x/validation#available-validation-rules 
* Voici celles qui sont utilisés ici : 
    * bail : s'arrête à la première erreur
    * required : champs obligatoire
    * between:0,n : nombre de caractère compris entre 0 et n
    * alpha: champ alphanumérique

* Pour utiliser notre FormRequest, nous devons modifier au niveau du contrôleur le type de données appelées lors de la récéption de la requête par la méthode qui reçoit le POST sur le formulaire (penser à mettre le use correspondant en début de fichier) : 
```php
    public function store(JeuFormRequest $request)
    {
        return 'Le nom du jeu est ' . $request->input('nom');
    }
```
* Vous pouvez tester, votre formulaire ne s'enverra pas tant que vous ne respecter pas les règles de validation
* Par contre rien n'est affiché, il est nécessaire de rajouter l'affichage des message d'erreur dans le template : 
```php
@extends('template')
 
@section('contenu')
    <form action="{{ url('/jeu') }}" method="POST">
        @csrf
        <label for="nom">Entrez le nom du jeu : </label>
        <input type="text" name="nom" id="nom">
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="editeur">Entrez l éditeur du jeu : </label>
        <input type="text" name="editeur" id="editeur">
        @error('editeur')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="year">Entrez l année du jeu : </label>
        <input type="number" name="year" id="year">
        @error('year')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="categorie">Entrez la catégorie du jeu : </label>
        <input type="text" name="categorie" id="categorie">
        @error('categorie')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <input type="submit" value="Envoyer !">
    </form>
@endsection
```
* Nous avons ici rajouter l'appel à @error avec le nom de la règle de validation, afin d'afficher le message correspondant si un message existe. 

-> La validation fonctionne

## Pour aller plus loin : 

* Permettre la modification d'un jeu
* Créer le formulaire permettant d'ajouter un jeu à sa collection
* Créer un formulaire permettant de supprimer un jeu de la liste des jeux et un de sa propre collection