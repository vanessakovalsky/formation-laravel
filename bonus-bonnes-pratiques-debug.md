# Bonus : les bonnes pratiques et le debug

## Bonnes pratiques 

* Des bonnes pratiques communautaires sur laravel peuvent être trouvés en français et en différentes langues ici : https://github.com/alexeymezenin/laravel-best-practices/blob/master/french.md 
* Il est aussi indispensable de connaitre et d'utiliser les [standards PSR](https://www.php-fig.org/psr/)


## Debug

* Afin de vous aider à debuguer votre code, vous pouvez utiliser la barre de debug de barryvdh : https://github.com/barryvdh/laravel-debugbar
* Pour l'installer : 
``` 
composer require barryvdh/laravel-debugbar --dev
```
* Pensez à vérifier que la variable d'environnement APP_DEBUG est bien à true