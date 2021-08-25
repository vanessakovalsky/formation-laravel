# Exercice 6 - Définir des relations entre nos modèles

## Objectifs

Cet exercice a pour objectifs : 
* de lier les jeux à une catégorie
* de lier les jeux à une collections

## Pré-requis
* Avoir créer les modèles et migrations Jeu, Collection, Catégorie

## Définir le lien entre un jeu et une catégorie

* On va commencer par créer une nouvelle migration pour mettre à jour la table Jeu et ajouter la relation vers notre catégorie : 
```
php artisan make:migration UpdateJeuAddCategorie
```
* Dans le fichier nous venons modifier la table avec la méthode table de Schema en ajoutant une colonne et une clé étrangère : 
```php
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('jeus', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }
```
* La fonction disableForeignKeyConstraints est là pour éviter une erreur si les fichiers ne sont pas appelés dans le bon ordre (ils sont lus dans l'ordre alphabétiques)
* On va ensuite déclarer la relation dans nos deux modèles : 
    * Commençons avec le modèle Jeu dans lequel nous ajoutons une méthode categorie : 
    ```php
        public function categorie()
    { 
        return $this->belongsTo(Categorie::class); 
    }
    ```
    * Ensuite nous déclarons une méthode jeus dans le modèle Categorie : 
    ```php
        public function jeus() 
    { 
        return $this->hasMany(Jeu::class); 
    }
    ```
* Ce double ajout permet aux modèles de faire la relation entre eux. 
* Nous allons maintenant utiliser cette relation, en commençant par le formulaire d'ajout de jeu pour afficher une liste déroulante des catégories :
    * au niveau du template on ajoute un select : 
    ```php
    <div class="select">
            <select name="categorie_id">
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                @endforeach
            </select>
        </div>
    ```
    * On vient ajouter la liste des catégories lors de l'appel de la vue dans le contrôleur 
    ```php
    public function create()
    {
        $categories = Categorie::all();
        return view('jeu.create', compact('categories'));
    }
    ```
    * On vient également ajouter l'id de la categorie à l'enregistrement
    ```php
    public function store(JeuFormRequest $request)
    {
        $jeu = new Jeu();
        $jeu->nom = $request->input('nom');
        $jeu->editeur = $request->input('editeur');
        $jeu->categorie = $request->input('categorie');
        $jeu->annee = $request->input('year');
        $jeu->categorie_id = $request->input('categorie_id');
        $jeu->save();
        return "Le jeu est bien enregistré !";
    }
    ```
* Notre liaison fonctionne, on peut maintenant si on le souhaite afficher des listes de jeux par catégorie ou faire apparaitre le nom de la catégorie dans notre liste de jeux.
* Par exemple pour récupérer le nom de la catégorie et l'afficher dans le Show, on ajoute dans le controleur : 
```php
public function show($id){
    $jeu = Jeu::find($id);
    $categorie = $jeu->categorie->name;    
    return view('show', compact('jeu', 'categorie'));
}
```
* Félicitations vous savez manipuler les relations 1:n

## Lier les jeux et les collections

* Cette fois ci on va créer une relation de type n:n, c'est-à-dire que plusieurs jeux vont pouvoir être liés à plusieurs collections.
* Pour cela on crée une table spécifique qui va permettre d'associer un id de jeu à un id de collection : 
```
php artisan make:migration CreateJeuCollectionTable
```
* Puis nous déclarons deux colonnes avec les clés étrangères associées : 
```php
    public function up()
    {
        Schema::create('jeu_collection', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('collection_id');
            $table->foreign('collection_id')
                ->references('id')
                ->on('collections')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('jeu_id');
            $table->foreign('jeu_id')
                ->references('id')
                ->on('jeus')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
```
* Comme pour la relation 1:n il est nécessaire de déclarer au niveau de chaque modèle la relation, la seule différence est ici la méthodes qui passe en belongsToMany pour chaque modèle :
* Sur le modèle Jeu on ajoute la méthode : 
```php
public function collections()
{
    return $this->belongsToMany(Collection::class, 'jeu_collection');
}
```
* Sur le modèle Collection on ajoute la méthode : 
```php
public function jeus()
{
    return $this->belongsToMany(Jeu::class, 'jeu_collection');
}
```
* On vient alors ajouter dans le formulaire de Jeu notre nouveau item collection 
    * Dans le controleur : 
    ```php
    public function create()
    {
        $categories = Categorie::all();
        $collections = Collection::all();
        return view('jeu.create', compact('categories','collections'));
    }
    ```
    * Dans le template du formulaire, j'ajoute mon nouveau champ
    ```php
    <div class="select">
                <select name="collections[]" multiple>
                    @foreach($collections as $collection)
                        <option value="{{ $collection->id }}">{{ $collection->id }}</option>
                    @endforeach
                </select>
            </div>
    ```
* Pour le traitement, je vais utiliser la méthode attach : 
```php
    public function store(JeuFormRequest $request)
    {
        $jeu = Jeu::create($request->all());
        $jeu->collections()->attach($request->collections);
        return "Le jeu est bien enregistré !";
    }
```
* Pour que le Jeu::create fonctionne il faut rendre les champs assignable en masse, pour cela on rajoute la ligne suivante dans app\Models\Jeu :
```php
    protected $fillable = ['nom', 'editeur', 'categorie', 'categorie_id', 'annee'];
```
* Vous pouvez maintenant définir l'ensemble de vos relations

## Pour aller plus loin 
* Mettre à jour le formulaire de collection pour permettre l'ajout d'un jeu et faire apparaitre la liste des jeux dans une collection

