# Création Symfony LTS avec webapp

    symfony new SymEntitiesG2 --webapp --version=lts

Puis :

    cd SymEntitiesG2
    ls

## Création d'un github public vide

Puis ajoutez le lien à votre projet

    git remote add origin git@github.com:WebDevCF2m2023/SymEntitiesG2.git
    git branch -M main
    git push -u origin main

## Lancement du serveur

    symfony serve -d

## Création du contrôleur

    php bin/console make:controller MainController

2 fichiers sont créés, le contrôleur et la vue en `twig`

**Pour voir les routes : **

    php bin/console debug:route

#### Changement du chemin pour que ce soit le contrôleur de notre accueil

Dans `src/Controller/MainController.php`

on change :

```php
#[Route('/main', name: 'app_main')]
## par
#[Route('/', name: 'homepage')]
```

** ! Si vous faites un commit, vérifiez que les fichiers non nécessaires se trouvent dans le `.gitignore` !