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

### Faites régulièrement des commits !

En cas de gros changements et de risques, n'hésitez pas à utiliser les branches !

## Copie de .env en .env.local

    cp .env .env.local

### Choix de la DB et modification du `.env.local`

```.env
###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=OnChangeLaCLef
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###

# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
DATABASE_URL="mysql://root:@127.0.0.1:3306/symentitiesg2?serverVersion=8.0.31&charset=utf8mb4"
# DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
# DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
###< doctrine/doctrine-bundle ###
```

### Création de la DB

    php bin/console doctrine:database:create
    
    Created database `symentitiesg2` for connection named default