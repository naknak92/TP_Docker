
# TP Docker #2

Ce projet contient la mise en place de plusieurs containers Docker sur plusieurs étapes. Chaque étape est située dans son propre répertoire (etapeX).

## Étape 1

Dans cette étape, nous mettons en place deux containers Docker : 
- Un container HTTP qui écoute sur le port 8080.
- Un container SCRIPT avec un interpréteur PHP (sans PHP-FPM).

### Commandes

```bash
docker run -d --name script -v $(pwd)/app:/app php:7.4-fpm
docker run -d --name http -p 8080:80 -v $(pwd)/app:/app -v $(pwd)/config/nginx.conf:/etc/nginx/conf.d/default.conf --link script nginx:latest
```

## Étape 2

Nous ajoutons un serveur de base de données SQL en plus des containers HTTP et SCRIPT.

### Commandes

```bash
docker run -d --name database --network tp2-network -e MYSQL_ROOT_PASSWORD=rootpassword -e MYSQL_DATABASE=wordpress -p 3306:3306 mysql:8.0
docker run -d --name script --network tp2-network -v $(pwd)/app:/app php_fpm_custom
docker run -d --name http --network tp2-network -p 8080:80 -v $(pwd)/app:/app -v $(pwd)/config/nginx.conf:/etc/nginx/conf.d/default.conf nginx:latest
```

## Étape 3

Remplacement des pages PHP par un package WordPress complet.

### Commandes

```bash
docker run -d --name database_wp -e MYSQL_ROOT_PASSWORD=rootpassword -e MYSQL_DATABASE=wordpress -p 3306:3306 mysql:8.0
docker run -d --name script -v $(pwd)/app:/app php_fpm_wordpress
docker run -d --name http -p 8080:80 -v $(pwd)/app:/app -v $(pwd)/config/nginx.conf:/etc/nginx/conf.d/default.conf --link script --link database_wp nginx:latest
```

## Étape 4

Conversion de la configuration en Docker Compose.

### Commande

```bash
docker compose up -d
```
