# Laravel Boilerplate

## Présentation

Ce framework sert de base pour le développement d'un site sur-mesure avec backend

## Installation

1. Clonage du projet
2. Création de la base mysql + connexion utilisateur
3. Copier **.env.example** vers **.env**
4. Editer **.env** avec les bonnes variables d'environnement de connexion à la base de données, mail, captcha

### Installation en mode production :

Modifier les variables d'environnement avec les valeurs suivantes :

* APP_ENV=production
* APP_DEBUG=false
* APP_URL=[Url d'accès au site avec si besoin le numéro de port]

Ensuite indiquer les droits d'écriture web sur le répertoire `storage` puis lancer les commandes suivante :

```shell
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan storage:link
php artisan migrate --seed --force

```

### Installation en mode développement/local/debug :

```shell
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
```

## Création d'utilisateurs en production

Commande générique de création :

```shell
php artisan user:create[:admin] {email} {lastname} {firstname} {password}
```

Exemples pour générer un accès super-admin pour Useweb puis superviseur pour le client

```shell
php artisan user:create:admin dev@useweb.com Beaudouin Adrien azerty
php artisan user:create client@exemple.org John Doe azerty
```

## Développement

### Chargement des assets

Préparation des assets par elixir avec sass/webpack/browsersync :

1. Paramétrage des variables d'environnement BROWSERSYNC_*
2. Installation du package yarn puis du client gulp avec `npm install --global yarn gulp-cli`
3. Lancement des commandes suivantes :

```shell
yarn
gulp watch
```

Cela doit normalement le navigateur avec autoloading sur l'ensemble des fichiers sources du projet, que ce soit côté PHP ou bien assets

NB : A chaque mise en production, penser à faire `gulp --production` avant chaque push

## Paramétrage

### Les métas

Le paramétrage des metas *title* et *description* s'effectue dans le fichier `config/meta.php`
