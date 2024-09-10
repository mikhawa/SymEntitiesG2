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

### Création de l'entité `Post`

    php bin/console make:entity Post

Création des fichiers 

    src/Entity/Post.php
    src/Repository/PostRepository.php

Avec l'id comme seul attribut.

Si on souhaite le remplir : 

    php bin/console make:entity Post

Puis les champs souhaités :

```bash
$ php bin/console make:entity Post
 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > postTitle

 Field type (enter ? to see all types) [string]:
 >


 Field length [255]:
 > 160

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Post.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > postText

 Field type (enter ? to see all types) [string]:
 > text
text

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Post.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > postDateCreated

 Field type (enter ? to see all types) [string]:
 > datetime
datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Post.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > postDatePublished

 Field type (enter ? to see all types) [string]:
 > datetime
datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Post.php
 
 New property name (press <return> to stop adding fields):
 > postPublished

 Field type (enter ? to see all types) [string]:
 > boolean
boolean

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Post.php

```

### Première migration

    php bin/console make:migration

Un fichier est créé dans le dossier `migrations`, on peut vérifier les requêtes SQL qui seront effectuées, nous acceptons pour voir le résultat :

    php bin/console doctrine:migrations:migrate

### Modification de `src/Entity/Post.php`

```php
### ....
#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(
        # non signé
        options: [
            'unsigned' => true,
        ]
    )]
    private ?int $id = null;

    #[ORM\Column(length: 160)]
    private ?string $postTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $postText = null;

    #[ORM\Column(
        type: Types::DATETIME_MUTABLE,
        # valeur par défaut
        options: [
            'default'=> 'CURRENT_TIMESTAMP',
        ]
    )]
    private ?\DateTimeInterface $postDateCreated = null;

    #[ORM\Column(
        type: Types::DATETIME_MUTABLE,
        nullable: true
    )]
    private ?\DateTimeInterface $postDatePublished = null;

    #[ORM\Column(
        options: [
            # Par défaut, false (0)
            'default'=> false,
        ]
    )]
    private ?bool $postPublished = null;
    
### ...
```

On doit refaire un `php bin/console make:migration puis une php bin/console d:m:m`

### Création de l'entité `Section`

    php bin/console make:entity Section

On souhaite que la `Section` soit en relation `ManyToMany` avec `Post`

```bash
php bin/console make:entity Section
 created: src/Entity/Section.php
 created: src/Repository/SectionRepository.php

 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > sectionTitle

 Field type (enter ? to see all types) [string]:
 >


 Field length [255]:
 > 120

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Section.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > sectionDescription

 Field type (enter ? to see all types) [string]:
 >


 Field length [255]:
 > 500

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Section.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > sectionPost

 Field type (enter ? to see all types) [string]:
 > ManyToMany
ManyToMany

 What class should this entity be related to?:
 > Post
Post

 Do you want to add a new property to Post so that you can access/update Section objects fro
m it - e.g. $post->getSections()? (yes/no) [yes]:
 >

 A new property will also be added to the Post class so that you can access the related Sect
ion objects from it.

 New field name inside Post [sections]:
 >

 updated: src/Entity/Section.php
 updated: src/Entity/Post.php

```

On refait une migration