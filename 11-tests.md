# Exercice 11 - Tests

## Objectifs

Cet exercice a pour objectifs : 
* de concevoir, écrire et exécuter des tests unitaires
* d'imaginer des scénarios de tests fonctionnels et de les mettre en oeuvre

## Créer des tests pour notre controleur Jeu

* Pour commencer on s'appuie sur Artisan pour créé notre classe de tests qui nous servira à tester notre contrôleur de jeu
``` 
php artisan make:test JeuTest
```

* Un fichier JeuTest est alors crée dans le dossier tests/Features 

* Ensuite définissons un peu qu'est ce que nous voulons tester :
    * L'arrivée sur /jeu nous renvoit bien notre liste de jeu, avec le titre de la page, le tableau et les données que nous avons prévu d'utilisée
    * Le formulaire d'ajout du jeu s'affiche 
    * Lors de la saisie il y a bien une validation des données qui est faite
    * Lors de l'enregistrement des données nous sommes bien redirigés vers la liste des jeux
    * Le jeu est bien ajouté à la liste 

* Pour cela nous allons commencer par définir les données à utiliser avec la méthode setUp.
* Cette méthode permet de définir les données d'entrées de notre test (de figer un état de départ), pour plus d'information [voir la page de documentation](https://phpunit.readthedocs.io/fr/latest/fixtures.html)

* Ensuite pour chacune des étapes de notre plan de test défini ci-dessus, nous allons écrire une méthode test. Chacune de ces méthodes va contenir plusieurs assertions pour vérifier les différents éléments de l'étape (par exemple le code statut de la page, la présence d'un titre, d'une phrase, d'un contenu ...). Pour cela on utilise les [assertions de PHPUnit](https://phpunit.readthedocs.io/fr/latest/assertions.html)
* Laravel a également ajouter [ses propres assertions](https://laravel.com/docs/8.x/http-tests) que vous pouvez utiliser pour gagner du temps sur les vues, ou d'autres composants de Laravel

## Tester notre base de données en créant de faux jeux de données

* Afin de pouvoir tester le comportement de notre base de données, nous allons voir comment utiliser différents outils.
* Afin de remettre à 0 la base de données après chaque test, nous allons ajouter un trait RefreshDatabase à notre classe de tests : 
```php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_basic_example()
    {
        $response = $this->get('/');

        // ...
    }
}
```
* Ensuite nous allons créer une factory, dont le rôle est de générer des quantités importantes de fausses données sans que nous ayons besoin de les définir à la main. Pour cela nous utilions artisan
```
php artisan make:factory JeuFactory
```
* La factory permet alors d'utiliser la [bibliothèque PHP Faker](https://github.com/FakerPHP/Faker) pour générer des données à nos propriétés : 
```php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JeuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(),
        ];
    }
}
```
* On va pouvoir lier la factory à un modèle via la variable protégé $modèle
```php
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;
```
* Nous pouvons maintenant utiliser notre factory dans nos tests :
```php
use App\Models\User;

public function test_models_can_be_persisted()
{
    // Create a single App\Models\User instance...
    $user = User::factory()->create();

    // Create three App\Models\User instances...
    $users = User::factory()->count(3)->create();

    // Use model in tests...
}
```
* Retrouver la [documentation des factories](https://laravel.com/docs/8.x/database-testing) pour obtenir plus d'information sur leur utilisation.

## Pour aller plus loin

De nombreux autres sujets liés aux tests peuvent être approfondies : 
* [Simuler des comportements (Mock)](https://laravel.com/docs/8.x/mocking)
* [Exécuter des tests navigateurs avec Laravel Dusk](https://laravel.com/docs/8.x/dusk)
